<? if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') die();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;

if($_GET['id'])
{
  /*if(!$USER->IsAuthorized())
  {*/
	$arElements = unserialize($APPLICATION->get_cookie('favorites'));
	if(!in_array($_GET['id'], $arElements))
	{
		   $arElements[] = $_GET['id'];
		   $result = 1; 
	}
	else {
		$key = array_search($_GET['id'], $arElements); 
		unset($arElements[$key]);
		$result = 2; 
	}
	$APPLICATION->set_cookie("favorites", serialize($arElements));
    $result = count($arElements);
    //}
 /* else {
	 $idUser = $USER->GetID();
	 $rsUser = CUser::GetByID($idUser);
	 $arUser = $rsUser->Fetch();
	 $arElements = $arUser['UF_FAVORITES'];
	 if(!in_array($_GET['id'], $arElements))
	 {
		$arElements[] = $_GET['id'];
		$result = count($arElements);
	 }
	 else {
		$key = array_search($_GET['id'], $arElements); 
		unset($arElements[$key]);
		$result = count($arElements);
	 }
	 $USER->Update($idUser, Array("UF_FAVORITES"=>$arElements ));
  }*/
}
echo json_encode($result);


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php"); ?>