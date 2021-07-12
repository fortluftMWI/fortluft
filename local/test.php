<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Каталог");
?>

<section>
    <div class="container page_simple">
        <?$APPLICATION->IncludeComponent(
            "finnit:finnit.filter",
            "auto",
            array(
                "A_IBLOCK_ID" => 20,

            )
        );?>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
