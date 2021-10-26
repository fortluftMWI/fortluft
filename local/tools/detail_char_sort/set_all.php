<? // definitions
define("IBLOCK_ID", 16);
?>
<? // checks
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';

if (!CModule::includeModule('iblock')) throw new Error("Module iblock is not installed!");
?>
<pre>
<? // script body
    $rsProps = CIBlockProperty::GetList(
    $arOrder  = array("SORT" => "ASC"),
    $arFilter = array(
        "IBLOCK_ID" => IBLOCK_ID,
        )
    );
    $arProps = [];
    while($arProp = $rsProps->Fetch())
    {
        $arProps[$arProp['ID']] = $arProp;
    }
    $ibp = new CIBlockProperty;
    foreach($arProps as $iPropId => $arProp)
    {
        if($arProp['SORT'])
        {
            $arFields = [
                'HINT' => $arProp['SORT'],
            ];
            if(!$ibp->Update($iPropId, $arFields))
                echo $ibp->LAST_ERROR; 
        }
    }
?>
</pre>
<script> // autoreload
    // setTimeout(function(){ window.location.reload(); 3000})
</script>
