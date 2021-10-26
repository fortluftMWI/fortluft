<?
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';
require_once __DIR__.'/settings.php';
if (!CModule::includeModule('iblock')) throw new Error("Module iblock is not installed!");
try
{
    if($arSettings['using_link'])
    {
        $sFileSrc = $arSettings['file_src'];
    }
    else
    {
        $sFileSrc = FILE_PATH;
    }

    $oCrossFiller = new CrossFiller($arSettings['remove_special_chars']);
    if($_SESSION['NEXT_INDEX'])
    {
        $oCrossFiller->loadProgress();
    }
    else
    {
        unset($_SESSION['UPDATED_VALUES']);
        $_SESSION['FAILED'] = [];
        $oCrossFiller->getFile($sFileSrc);
        $oCrossFiller->getFileData();
    }
    if($oCrossFiller->updateCrossNumbers())
    {
        $arOutput['result'] = $_SESSION['UPDATED_VALUES'];
        $sReload = $_SESSION['NEXT_INDEX'] ? 'true' : 'false';
    }
    if($_SESSION['FAILED'])
    {
        $arOutput['failed'] = $_SESSION['FAILED'];
    }
}
catch(Throwable $th)
{
    $arOutput['error'] = [
        'CODE' => $th->getCode(),
        'MESSAGE' => $th->getMessage(),
    ];
}
finally
{
    $sOutput = json_encode($arOutput);
    echo $sOutput;
};


class CrossFiller 
{
    private $file;
    private $sNextIndex;
    public $arData;
    public $arFailed;
    public $bStripSymbols;
    public $iUpdatedValues = 0;
    public function __construct(bool $bStripSymbols)
    {
        $this->bStripSymbols = $bStripSymbols;
    }
    public function getFile($sFile)
    {
        $this->file = fopen($sFile, "r");
        if(!$this->file)
            throw new Exception('Unable to read file!', 1);
    }
    public function saveProgress()
    {
        file_put_contents(TEMP_FILE, json_encode($this->arData));
        $_SESSION['NEXT_INDEX'] = $this->sNextIndex;
        $_SESSION['FAILED'] = array_merge($_SESSION['FAILED'], $this->arFailed);
    }
    public function loadProgress()
    {
        $this->arData = json_decode(file_get_contents(TEMP_FILE), true);
        $this->sNextIndex = $_SESSION['NEXT_INDEX'];
        unset($_SESSION['NEXT_INDEX']);
    }
    public function updateCrossNumbers()
    {
        foreach($this->arData as $sVendorCode => $arCrossNumbers)
        {
            try
            {
                if($this->sNextIndex && $sVendorCode != $this->sNextIndex)
                {
                    continue;
                }
                unset($this->sNextIndex);
                if($this->iUpdatedValues >= STEP_LIMIT)
                {
                    $this->sNextIndex = $sVendorCode;
                    $this->saveProgress();
                    break;
                }
                $this->updateCrossByVendorCode($sVendorCode, $arCrossNumbers['cross_numbers']);
            }
            catch (Exception $e)
            {
                $this->arFailed[] = $sVendorCode;
                if(STOP_ON_UNIDENTIFIED_ELEMENTS)
                    throw $e;
                continue;
            }
        }
        $_SESSION['UPDATED_VALUES'] += $this->iUpdatedValues;
        return true;
    }
    private function updateCrossByVendorCode($sVendorCode, $arCrossNumbers)
    {
        $rsElement = CIBlockElement::GetList(
            array("SORT" => "ASC"),
            array(
                "PROPERTY_CML2_ARTICLE" => $sVendorCode
            ),
            false,
            false,
            array("ID", "PROPERTY_CML2_ARTICLE")
        );
        while($arElement = $rsElement->fetch())
        {
            $arElements[] = $arElement; 
        }

        if(!$arElements) throw new Exception("Element with vendor_code $sVendorCode not found", 2);
        foreach($arElements as $arElement)
        {
            CIBlockElement::SetPropertyValuesEx($arElement['ID'], false, [
                'CROSS_NUMBERS' => $arCrossNumbers,
            ]);
        }
        $this->iUpdatedValues++;
    }
    private function vendorCodeAsKey($arData)
    {
        $arResult = [];
        foreach ($arData as $arRow)
        {
            $arResult[$arRow['number']]['cross_numbers'][] = $this->bStripSymbols  ? str_replace(['/', '-', '.', ' ', '_'], '', $arRow['cross_number']) : $arRow['cross_number'];
        }
        return $arResult;
    }
    public function getFileData()
    {
        $i = 0;
        $arHeader = [];
        while(($arData = fgetcsv($this->file, 1000, ";")) !== false)
        {
            $i++;

            //$arData = array_diff($arData, array(''));
            if($i == 1)
            {
                $arHeader = $arData;
                continue;
            }
            foreach($arHeader as $iKey => $sField)
            {
                $arRow[$sField] = $arData[$iKey];
            }

            $arResult[] = $arRow;
        }
        $this->arData = $this->vendorCodeAsKey($arResult);
        return $this->arData;
    }
}

?>
<script> 
let reload = <?=$sReload?>;
if(reload)
{
    // autoreload
    window.location.reload();
}
else
{
    // send data
    var f = document.createElement('form');
    f.action='cross_index.php';
    f.method='POST';
    var i=document.createElement('input');
    i.type='hidden';
    i.name='result';
    i.value='<?=$sOutput?>';
    f.appendChild(i);
    document.body.appendChild(f);
    f.submit();
}

</script>