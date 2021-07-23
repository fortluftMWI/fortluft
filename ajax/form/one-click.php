<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?if($_REQUEST['id'] && $_REQUEST['iblock'] && \Bitrix\Main\Loader::includeModule('prymery.major')):?>
    <div class="modalForm">
        <?$APPLICATION->IncludeComponent(
            "prymery:quick.order",
            "modal",
            array(
                "BUY_ALL_BASKET" => "N",
                "IBLOCK_ID" => (int)$_REQUEST["iblock"],
                "ELEMENT_ID" => (int)$_REQUEST["id"],
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600000",
                "CACHE_GROUPS" => "N",
                "COMPONENT_TEMPLATE" => "modal",
                "IBLOCK_TYPE" => "prymery_content",
                "PROPERTIES" => array(
                    0 => "FIO",
                    1 => "PHONE",
                    2 => "EMAIL",
                ),
                "REQUIRED" => array(
                    0 => "FIO",
                    1 => "PHONE",
                    2 => "EMAIL",
                )
            ),
            false
        );?>
    </div>
	<script>
		inputmask();
	</script>
<?endif;?>