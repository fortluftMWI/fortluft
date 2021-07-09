<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('sale');

if($_POST['city']){
	$res = \Bitrix\Sale\Location\LocationTable::getList(array(
		'filter' => array('=TYPE.ID' => '5','=NAME.LANGUAGE_ID' => LANGUAGE_ID, '?NAME_RU' => $_POST['city']),
		'select' => array('NAME_RU' => 'NAME.NAME', 'ID')
		));
		while ($item = $res->fetch()) {?>
			<a href="javascript:void(0)" class="child-catalog-link selectLoc" onclick="setCity('<?=$item['ID']?>',this)"><?=$item['NAME_RU']?></a>
		<?}
	?>
	<script>
		function setCity(id,th){
			th.parentNode.parentNode.querySelector('input').value =th.textContent;
			th.parentNode.parentNode.querySelector('input').setAttribute('data-cityId',id);
			th.parentNode.style.display="none";
		}
	</script>
<?}?>