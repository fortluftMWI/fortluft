<?
use \Bitrix\Main\Loader;
use \Bitrix\Sale\DiscountCouponsManager;

if (isset($_REQUEST['SITE_ID']) && !empty($_REQUEST['SITE_ID']))
{
    if(isset($_REQUEST['SITE_ID']) && !empty($_REQUEST['SITE_ID']))
        if(preg_match('/^[a-z0-9_]{2}$/i',$_REQUEST['SITE_ID']) === 1)
            define('SITE_ID', $_REQUEST['SITE_ID']);
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


header('Content-type: application/json; charset=utf-8');
require(dirname(__FILE__)."/functions.php");

ob_start();

if(!function_exists('json_encode')){
    function json_encode($value){
        if(is_int($value)){
            return (string)$value;
        }
        elseif(is_string($value)){
            $value = str_replace(array('\\', '/', '"', "\r", "\n", "\b", "\f", "\t"),  array('\\\\', '\/', '\"', '\r', '\n', '\b', '\f', '\t'), $value);
            $convmap = array(0x80, 0xFFFF, 0, 0xFFFF);
            $result = "";
            for ($i = mb_strlen($value) - 1; $i >= 0; $i--){
                $mb_char = mb_substr($value, $i, 1);
                if (mb_ereg("&#(\\d+);", mb_encode_numericentity($mb_char, $convmap, "UTF-8"), $match)) { $result = sprintf("\\u%04x", $match[1]) . $result;  }
                else { $result = $mb_char . $result;  }
            }
            return '"' . $result . '"';
        }
        elseif(is_float($value)) { return str_replace(",", ".", $value); }
        elseif(is_null($value)) {  return 'null';}
        elseif(is_bool($value)) { return $value ? 'true' : 'false';   }
        elseif(is_array($value)){
            $with_keys = false;
            $n = count($value);
            for ($i = 0, reset($value); $i < $n; $i++, next($value))  { if (key($value) !== $i) {  $with_keys = true; break;  }  }
        }
        elseif (is_object($value)) { $with_keys = true; }
        else { return ''; }
        $result = array();
        if ($with_keys)  {  foreach ($value as $key => $v) {  $result[] = json_encode((string)$key) . ':' . json_encode($v); }  return '{' . implode(',', $result) . '}'; }
        else {  foreach ($value as $key => $v) { $result[] = json_encode($v); } return '[' . implode(',', $result) . ']';  }
    }
}

if(!function_exists('getJson')) {
    function getJson($message, $res='N', $error=''){
        global $APPLICATION;
        $result = array(
            'result' => $res=='Y'?'Y':'N',
            'message' => $APPLICATION->ConvertCharset($message, SITE_CHARSET, 'utf-8')
        );
        if (strlen($error) > 0) { $result['err'] = $APPLICATION->ConvertCharset($error, SITE_CHARSET, 'utf-8'); }
        return json_encode($result);
    }
}

if(!CModule::IncludeModule('sale') || !CModule::IncludeModule('iblock') || !CModule::IncludeModule('catalog') || !CModule::IncludeModule('currency')){
    die(getJson(GetMessage('CANT_INCLUDE_MODULE')));
}

global $APPLICATION, $USER;
$user_registered =$user_exists = false;
$bAllBasketBuy = $_POST['BUY_TYPE'] == 'ALL';
$SITE_ID = $_REQUEST['SITE_ID'];

// conver charset
if($_POST['QUICK_FORM'] && is_array($_POST['QUICK_FORM']))
{
    foreach($_POST['QUICK_FORM'] as $key => $value)
    {
        $_POST['QUICK_FORM'][$key] = $APPLICATION->ConvertCharset($_POST['QUICK_FORM'][$key], 'utf-8', SITE_CHARSET);
    }
}

// check input data
if(!empty($_POST['QUICK_FORM']['EMAIL']) && !preg_match('/^[0-9a-zA-Z\-_\.]+@[0-9a-zA-Z\-]+[\.]{1}[0-9a-zA-Z\-]+[\.]?[0-9a-zA-Z\-]+$/', $_POST['QUICK_FORM']['EMAIL'])) die(getJson(GetMessage('BAD_EMAIL_FORMAT')));

$basketUserID = CSaleBasket::GetBasketUserID();
$arBasketItemsAll=array();
// register user if not registered
$resBasketItems = CSaleBasket::GetList(array('SORT' => 'DESC'), array('FUSER_ID' => $basketUserID, 'LID' => $SITE_ID, 'ORDER_ID' => NULL));
while($arBasketItem = $resBasketItems->Fetch()){
    // get props
    $arProps = array();
    $dbRes = CSaleBasket::GetPropsList(array(), array('BASKET_ID' => $arBasketItem['ID']));
    while($arProp = $dbRes->Fetch()){
        $arProps[] = $arProp;
    }
    if($arProps){
        $arBasketItem["BASKET_PROPS"]=$arProps;
    }
    $arBasketItemsAll[]=$arBasketItem;
}

if(!$USER->IsAuthorized()){
    if(!isset($_POST['QUICK_FORM']['EMAIL']) || trim($_POST['QUICK_FORM']['EMAIL']) == ''){
        $login = 'user_' . substr((microtime(true) * 10000), 0, 12);
        if (strlen(SITE_SERVER_NAME)) { $server_name = SITE_SERVER_NAME; } else { $server_name = $_SERVER["SERVER_NAME"];}
        $server_name = Cutil::translit($server_name, "ru");
        if($dotPos = strrpos($server_name, "_")){
            $server_name = substr($server_name, 0, $dotPos).str_replace("_", ".", substr($server_name, $dotPos));
        }
        else{
            $server_name .= ".ru";
        }
        $_POST['QUICK_FORM']['EMAIL'] = $login.'@'.$server_name;
        $user_registered = true;
    }
    else{
        $dbUser = CUser::GetList(($by = 'ID'), ($order = 'ASC'), array('=EMAIL' => trim($_POST['QUICK_FORM']['EMAIL'])));
        if($dbUser->SelectedRowsCount() == 0){
            $login = 'user_'.substr((microtime(true) * 10000), 0, 12);
            $user_registered = true;
        }
        elseif($dbUser->SelectedRowsCount() == 1){
            $ar_user = $dbUser->Fetch();
            $registeredUserID = $ar_user['ID'];
            $user_registered = true;
            $user_exists = true;
        }
        else die(getJson(GetMessage('TOO_MANY_USERS')));
    }

    if($user_registered && !$user_exists){
        $captcha = COption::GetOptionString('main', 'captcha_registration', 'N');
        if($captcha == 'Y'){COption::SetOptionString('main', 'captcha_registration', 'N');}
        $userPassword = randString(10);
        $username = explode(' ', trim($_POST['QUICK_FORM']['FIO']));
        $newUser = $USER->Register($login, $username[0], $username[1], $userPassword,  $userPassword, $_POST['QUICK_FORM']['EMAIL']);

        if($captcha == 'Y'){
            COption::SetOptionString('main', 'captcha_registration', 'Y');
        }
        if($newUser['TYPE'] == 'ERROR') {
            die(getJson(GetMessage('USER_REGISTER_FAIL'), 'N', $newUser['MESSAGE']));
        }
        else{
            $registeredUserID = $newUser['ID'];
            if (!empty($_POST['QUICK_FORM']['PHONE'])) {
                $USER->Update($registeredUserID,  array('PERSONAL_PHONE' => $_POST['QUICK_FORM']['PHONE']));
            }
            if (!empty($username[2])) {
                $USER->Update($registeredUserID,  array('SECOND_NAME' => $username[2]));
            }
            //$USER->Logout();
        }
    }
}
else{
    $registeredUserID = $USER->GetID();
}

if(!$_POST['QUICK_FORM']['EMAIL']){
    $_POST['QUICK_FORM']['EMAIL'] = $USER->GetEmail();
}

if(!$_POST['QUICK_FORM']['LOCATION']){
    $arLocation = CSaleOrderProps::GetList(array("SORT" => "ASC"), array("PERSON_TYPE_ID" => intval($_POST['PERSON_TYPE_ID']) > 0 ? $_POST['PERSON_TYPE_ID']: 1, "CODE" => "LOCATION"), false, false, array())->Fetch();
    $_POST['QUICK_FORM']['LOCATION'] = $arLocation["DEFAULT_VALUE"];
}
$db_dtype = CSaleDelivery::GetList(
    array( "SORT" => "ASC", "NAME" => "ASC" ),
    array( "LID" => SITE_ID, "ACTIVE" => "Y"),
    false,
    false,
    array()
);
if ($ar_dtype = $db_dtype->Fetch()){
    $deliveryId = $ar_dtype['ID'];
}
$isOrderConverted = \Bitrix\Main\Config\Option::get("main", "~sale_converted_15", 'N');

/* New discount */
DiscountCouponsManager::init();

$newOrder = array(
    'LID' => $SITE_ID,
    'PAYED' => 'N',
    "CANCELED" => "N",
    "STATUS_ID" => "N",
    'USER_ID' => $registeredUserID,
    'PERSON_TYPE_ID' => 1,
    'DELIVERY_ID' => $deliveryId,
    'PAY_SYSTEM_ID' => intval($_POST['PAY_SYSTEM_ID']) > 0 ? $_POST['PAY_SYSTEM_ID'] : 1,
    'USER_DESCRIPTION' => $_POST['QUICK_FORM']['COMMENT'],
    'COMMENTS' => GetMessage('FAST_ORDER_COMMENT'),
);

$arBasketItems = array();
if($user_registered){
    if($arBasketItemsAll){
        $arProductIDs=array();
        foreach($arBasketItemsAll as $arItem){
            if (CSaleBasketHelper::isSetItem($arItem) || $arItem["CAN_BUY"]=="N" || $arItem["DELAY"]=="Y" || $arItem["SUBSCRIBE"]=="Y") // set item
                continue;
            $arBasketItems[] = $arItem;
            $arProductIDs[]=$arItem["PRODUCT_ID"];
        }
    }
}else{
    $arSelFields = array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT", "NAME", "CURRENCY", "CATALOG_XML_ID", "VAT_RATE", "NOTES", "DISCOUNT_PRICE", "PRODUCT_PROVIDER_CLASS", "DIMENSIONS", "TYPE", "SET_PARENT_ID", "DETAIL_PAGE_URL");
    $resBasketItems = CSaleBasket::GetList(array('SORT' => 'DESC'), array('FUSER_ID' => $basketUserID, 'LID' => $SITE_ID, 'ORDER_ID' => 'NULL', 'DELAY' => 'N', 'CAN_BUY' => 'Y'), false, false, $arSelFields);
    while($arBasketItem = $resBasketItems->Fetch()){
        if (CSaleBasketHelper::isSetItem($arBasketItem)) // set item
            continue;
        $arBasketItems[] = $arBasketItem;
    }
}

if($arBasketItems){
    // update basket items prices
    CSaleBasket::UpdateBasketPrices($basketUserID, $SITE_ID);

    // calculate order prices
    $arOrderDat = CSaleOrder::DoCalculateOrder($SITE_ID, $registeredUserID, $arBasketItems, $newOrder['PERSON_TYPE_ID'], array(), $deliveryId, $newOrder['PAY_SYSTEM_ID'], array(), $arErrors, $arWarnings);

    // set delivery price to 0
    $newOrder['PRICE_DELIVERY_DIFF'] = $arOrderDat["PRICE_DELIVERY"];
    $newOrder["PRICE_DELIVERY"] = $newOrder["DELIVERY_PRICE"] = $arOrderDat["DELIVERY_PRICE"] = $arOrderDat["PRICE_DELIVERY"] = 0;

    $newOrder['CURRENCY'] = $arOrderDat["CURRENCY"];
    $newOrder['PRICE'] = $arOrderDat["PRICE"] = $arOrderDat["ORDER_PRICE"] + $arOrderDat["DELIVERY_PRICE"] + $arOrderDat["TAX_PRICE"] - $arOrderDat["DISCOUNT_PRICE"];
    $newOrder["DISCOUNT_VALUE"] = $arOrderDat["DISCOUNT_PRICE"];
    $newOrder["TAX_VALUE"] = $arOrderDat["bUsingVat"] == "Y" ? $arOrderDat["VAT_SUM"] : $arOrderDat["TAX_PRICE"];
    $arOrderDat['USER_ID'] = $registeredUserID;

    // create order

    $order = placeOrder($registeredUserID, $basketUserID, $newOrder, $arOrderDat, $_POST);
    $orderID = $order->GetId();

    if($orderID == false){
        $strError = '';
        if($ex = $APPLICATION->GetException()) $strError = $ex->GetString();

        if($user_registered)
            $USER->Logout();

        die(getJson(GetMessage('ORDER_CREATE_FAIL'), 'N', $strError));
    }

    if($orderID){
        // add basket to order
        if($user_registered){
            foreach($arProductIDs as $id)
                CSaleBasket::Update($id, array('ORDER_ID' => $orderID));
        }else{
            CSaleBasket::OrderBasket($orderID, $basketUserID, $SITE_ID, false);
        }

        if($user_registered){
            // if latest sale version with converted module sale, than check items
            $resBasketItems = CSaleBasket::GetList(array('SORT' => 'DESC'), array(/*'FUSER_ID' => $basketUserID,*/ 'LID' => $SITE_ID, 'ORDER_ID' => $orderID, '!PRODUCT_ID' => $arProductIDs), false, false, array('ID', 'QUANTITY', 'PRODUCT_ID', 'TYPE', 'SET_PARENT_ID'));
            while($arBasketItem = $resBasketItems->Fetch()){
                $bSetItem = CSaleBasketHelper::isSetItem($arBasketItem);
                if($bSetItem) // set item
                    continue;
                // get props
                $arProps = array();
                $dbRes = CSaleBasket::GetPropsList(array(), array('BASKET_ID' => $arBasketItem['ID']));
                while($arProp = $dbRes->Fetch()){
                    if(isset($arProp['BASKET_ID']))
                        unset($arProp['BASKET_ID']);
                    $arProps[] = $arProp;
                }

                // delete from order
                CSaleBasket::Delete($arBasketItem['ID']);

                // add to basket again
                if(!$bSetItem){
                    Add2BasketByProductID($arBasketItem['PRODUCT_ID'], $arBasketItem['QUANTITY'], array(), $arProps);
                }
            }
        }
        if(class_exists('\Bitrix\Sale\Internals\OrderTable')){
            $arOrder = \Bitrix\Sale\Internals\OrderTable::getList(array('order' => array('ID' => 'ASC'), 'filter' => array('ID' => $orderID)))->Fetch();
        }
        else{
            $arOrder = CSaleOrder::GetList(array(), array('ID' => $orderID))->Fetch();
        }
        // add payment SUM
        if(class_exists('\Bitrix\Sale\Internals\PaymentTable')){
            $res = \Bitrix\Sale\Internals\PaymentTable::getList(array('order' => array('ID' => 'ASC'), 'filter' => array('ORDER_ID' => $orderID)));
            if($payment = $res->fetch()){
                \Bitrix\Sale\Internals\PaymentTable::update($payment['ID'], array('SUM' => $arOrder['PRICE']));
            }
        }
    }
}

//Обратно добавляем все товары в корзину
if($arBasketItemsAllFull){
    foreach ($arBasketItemsAllFull as $product){
        Add2BasketByProductID($product['PRODUCT_ID'], $product['QUANTITY'], array(), $product['BASKET_PROPS']);
    }
}

if($user_registered){
    $USER->Logout();
}

// add order properties
$personType = intval($_POST['PERSON_TYPE_ID']) > 0 ? $_POST['PERSON_TYPE_ID']: 1;
$res = CSaleOrderProps::GetList(array(), array('@CODE' => unserialize($_POST["PROPERTIES"]), 'PERSON_TYPE_ID' =>$personType));

while($prop = $res->Fetch()){
    if($_POST['QUICK_FORM'][$prop['CODE']]){
        $dbP = CSaleOrderPropsValue::GetList(Array(),array('ORDER_ID' => $orderID, 'ORDER_PROPS_ID' => $prop['ID']));
        if($arP = $dbP->Fetch()){
            CSaleOrderPropsValue::Update($arP['ID'], array( 'VALUE' => $_POST['QUICK_FORM'][$prop['CODE']]));
        }else{
            CSaleOrderPropsValue::Add(array('ORDER_ID' => $orderID, 'NAME' => $prop['NAME'], 'ORDER_PROPS_ID' => $prop['ID'], 'CODE' => $prop['CODE'], 'VALUE' => $_POST['QUICK_FORM'][$prop['CODE']]));
        }
    }
}

// send mail
if($orderID){
    $orderPrice = 0;
    $orderList = '';
    $arCurrency = CCurrencyLang::GetByID($newOrder['CURRENCY'], LANGUAGE_ID);
    $currencyThousandsSep = (!$arCurrency["THOUSANDS_VARIANT"] ? $arCurrency["THOUSANDS_SEP"] : ($arCurrency["THOUSANDS_VARIANT"] == "S" ? " " : ($arCurrency["THOUSANDS_VARIANT"] == "D" ? "." : ($arCurrency["THOUSANDS_VARIANT"] == "C" ? "," : ($arCurrency["THOUSANDS_VARIANT"] == "B" ? "\xA0" : "")))));

    $arSelFields = array("ID", "PRODUCT_ID", "QUANTITY", "CAN_BUY", "PRICE", "WEIGHT", "NAME", "CURRENCY", "DISCOUNT_PRICE", "TYPE", "SET_PARENT_ID", "DETAIL_PAGE_URL");
    $resBasketItems = CSaleBasket::GetList(array('SORT' => 'DESC'), array(/*'FUSER_ID' => $basketUserID,*/ 'LID' => $SITE_ID, 'ORDER_ID' => $orderID), false, false, $arSelFields);
    while($arBasketItem = $resBasketItems->Fetch()){
        if(CSaleBasketHelper::isSetItem($arBasketItem)) // set item
            continue;

        if($arBasketItem['CAN_BUY'] === 'Y'){
            $curPrice = roundEx($arBasketItem['PRICE'], SALE_VALUE_PRECISION) * DoubleVal($arBasketItem['QUANTITY']);
            $orderPrice += $curPrice;
            $orderList .= GetMessage('ITEM_NAME') . $arBasketItem['NAME']
                . GetMessage('ITEM_PRICE') . str_replace('#', number_format($arBasketItem['PRICE'], $arCurrency["DECIMALS"], $arCurrency["DEC_POINT"], $currencyThousandsSep), $arCurrency['FORMAT_STRING'])
                . GetMessage('ITEM_QTY') . intval($arBasketItem['QUANTITY'])
                . GetMessage('ITEM_TOTAL') . str_replace('#', number_format($curPrice, $arCurrency["DECIMALS"], $arCurrency["DEC_POINT"], $currencyThousandsSep), $arCurrency['FORMAT_STRING']) . "\n";
        }
    }


    $arOrderQuery=CSaleOrder::GetList(array(), array("ID"=>$orderID), false, false, array("ID", "ACCOUNT_NUMBER", "PRICE"))->Fetch();

    $arMessageFields = array(
        "RS_ORDER_ID" => $orderID,
        "CLIENT_NAME" => ($_POST['QUICK_FORM']['FIO'] ? $_POST['QUICK_FORM']['FIO'] : $_POST['QUICK_FORM']['CONTACT_PERSON']),
        "ACCOUNT_NUMBER" => $arOrderQuery["ACCOUNT_NUMBER"],
        "PHONE" => $_POST["QUICK_FORM"]["PHONE"],
        "ORDER_ITEMS" => $orderList,
        "ORDER_PRICE" => str_replace('#', number_format(($arOrderQuery["PRICE"] ? $arOrderQuery["PRICE"] : $orderPrice), $arCurrency["DECIMALS"], $arCurrency["DEC_POINT"], $currencyThousandsSep), $arCurrency['FORMAT_STRING']),
        "COMMENT" => $_POST['QUICK_FORM']['COMMENT'],
        "RS_DATE_CREATE" => ConvertTimeStamp(false, "FULL"),
    );
    if($_POST['QUICK_FORM']['EMAIL']){
        $arMessageFields["EMAIL_BUYER"]=$_POST['QUICK_FORM']['EMAIL'];
    }

    CEvent::Send("NEW_ONE_CLICK_BUY", $SITE_ID, $arMessageFields);
}

$_SESSION['SALE_BASKET_NUM_PRODUCTS'][$SITE_ID] = 0;

/*bind sale events*/
foreach(GetModuleEvents("sale", "OnSaleComponentOrderOneStepComplete", true) as $arEvent)
    ExecuteModuleEventEx($arEvent, Array($orderID, $arOrder, $arParams));

ob_clean();

die(getJson($orderID, 'Y'));

?>