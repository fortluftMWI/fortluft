<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



if($arResult['SECTIONS']){
	foreach($arResult['SECTIONS'] as $section){
		if($section['DEPTH_LEVEL'] == 1){
			unset($arParentType);
			if($section['UF_TYPE']){
				if(is_array($section['UF_TYPE'])){
					foreach($section['UF_TYPE'] as $type){
						$arParentType = $type;
						$arResult['TYPE_LIST'][$type][$section['ID']] = $section;
						$arTypes[] = $type;
					}
				}else{
					$arResult['TYPE_LIST'][$section['UF_TYPE']][] = $section;
					$arTypes[] = $section['UF_TYPE'];
				}
			}else{
				$arResult['NOTYPE_LIST'][$section['ID']] = $section;
			}
		}elseif($section['DEPTH_LEVEL'] == 2){
			if($arParentType){
				$arResult['TYPE_LIST'][$arParentType][$section['IBLOCK_SECTION_ID']]['SUB'][] = $section;
			}else{
				$arResult['NOTYPE_LIST'][$section['IBLOCK_SECTION_ID']]['SUB'][] = $section;
			}
		}
	}
	if($arTypes){
		$rsData = CUserFieldEnum::GetList( array('SORT'=>'ASC'), array('ID' => $arTypes) );
		while($arRes = $rsData->Fetch()){
			$arResult['TYPES'][$arRes['ID']] = $arRes;
		}
	}
}
