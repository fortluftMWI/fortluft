<?
function getPropertyByCode($propertyCollection, $code){
	foreach ($propertyCollection as $property){
		if($property->getField('CODE') == $code){
			return $property;
		}
	}
}
function placeOrder($registeredUserID, $basketUserID, $newOrder, $arOrderDat, $POST){
	\Bitrix\Sale\DiscountCouponsManager::init();
	$deliveryName = $paymentName = "";
	if(class_exists('\Bitrix\Sale\Delivery\Services\Manager'))
	{
		$service = \Bitrix\Sale\Delivery\Services\Manager::getObjectById($newOrder["DELIVERY_ID"]);
		if(is_object($service))
		{
			if ($service->isProfile())
				$arDelivery['DELIVERY_NAME'] = $service->getNameWithParent();
			else
				$arDelivery['DELIVERY_NAME'] = $service->getName();
			$deliveryName = $arDelivery["DELIVERY_NAME"];
		}
		else
		{
			$deliveryName = "QUICK_ORDER";
		}
	}
	else
	{
		$deliveryName = "QUICK_ORDER";
	}

	if(class_exists('\Bitrix\Sale\PaySystem\Manager'))
	{
		$service = \Bitrix\Sale\PaySystem\Manager::getObjectById($newOrder["PAY_SYSTEM_ID"]);
		if(is_object($service))
			$paymentName=$service->getField('NAME');
		else
			$paymentName = "QUICK_ORDER";
	}
	else
	{
		$paymentName = "QUICK_ORDER";
	}

	$siteId = $_POST['SITE_ID'];

	$order = Bitrix\Sale\Order::create($siteId, $basketUserID);
    $db_ptype = CSalePersonType::GetList(Array("SORT" => "ASC"), Array("LID"=>$siteId));
    while ($ptype = $db_ptype->Fetch())
    {
        $personTypeId = $ptype['ID'];
        break;
    }

	$order->setPersonTypeId($personTypeId);
	$order->setFieldNoDemand('USER_ID', $registeredUserID);

	$basket = Bitrix\Sale\Basket::loadItemsForFUser($basketUserID, $siteId)->getOrderableItems();

	$basketItems = $basket->getBasketItems();
	foreach ($basketItems as $basketItem){
		$basketItem->setField('PRODUCT_PROVIDER_CLASS', '\CCatalogProductProvider');
	}

	CSaleBasket::UpdateBasketPrices($basketUserID, $siteId);
	Bitrix\Sale\Compatible\DiscountCompatibility::stopUsageCompatible();
	$order->setBasket($basket);

	$shipmentCollection = $order->getShipmentCollection();
	$shipment = $shipmentCollection->createItem();
	$shipment->setField('CURRENCY', $arOrderDat["CURRENCY"]);
	$shipmentItemCollection = $shipment->getShipmentItemCollection();
	foreach ($order->getBasket() as $item)
	{
		$shipmentItem = $shipmentItemCollection->createItem($item);
		$shipmentItem->setQuantity($item->getQuantity());
	}

	$shipment->setFields(
		array(
			'DELIVERY_ID' => $newOrder["DELIVERY_ID"],
			'DELIVERY_NAME' => $deliveryName
		)
	);

	$shipmentCollection->calculateDelivery();

	$paymentCollection = $order->getPaymentCollection();
	$extPayment = $paymentCollection->createItem();
	$extPayment->setFields(
		array(
			'PAY_SYSTEM_ID' => $newOrder['PAY_SYSTEM_ID'],
			'PAY_SYSTEM_NAME' => $paymentName,
		)
	);

	$order->getDiscount()->calculate();

	$order->doFinalAction(true);

	$order->setField('CURRENCY', $arOrderDat["CURRENCY"]);
	$order->setFields(
		array(
			'USER_DESCRIPTION' => $POST['QUICK_FORM']['COMMENT'],
			'COMMENTS' => GetMessage('FAST_ORDER_COMMENT'),
		)
	);
	$propertyCollection = $order->getPropertyCollection();
	if($POST['QUICK_FORM']['EMAIL']){
		$obProperty = getPropertyByCode($propertyCollection, 'EMAIL');
		if($obProperty)
			$obProperty->setValue($POST['QUICK_FORM']['EMAIL']);
	}
	if($POST['QUICK_FORM']['PHONE']){
		$obProperty = getPropertyByCode($propertyCollection, 'PHONE');
		if($obProperty)
			$obProperty->setValue($POST['QUICK_FORM']['PHONE']);
	}

	$r=$order->save();
	if (!$r->isSuccess()){
		die(getJson(GetMessage('ORDER_CREATE_FAIL'), 'N', implode('<br />', (array)$r->getErrors())));
	}

	return $r;
}
?>