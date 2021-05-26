<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>			
<div class="filter__category">
	<div class="bx-filter">
		<div class="bx-filter-section">
			<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
				<?foreach($arResult["HIDDEN"] as $arItem):?>
				<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
				<?endforeach;?>
				<div class="filter_block">
					<?foreach($arResult["ITEMS"] as $key=>$arItem){
						$key = $arItem["ENCODED_ID"];
						if(isset($arItem["PRICE"])):
							if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
								continue;
							$step_num = 4;
							$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
							$prices = array();
							if (Bitrix\Main\Loader::includeModule("currency"))
							{
								for ($i = 0; $i < $step_num; $i++)
								{
									$prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
								}
								$prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
							}
							else
							{
								$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
								for ($i = 0; $i < $step_num; $i++)
								{
									$prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
								}
								$prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
							}
							?>
							<div class="fiter__control deployed bx-filter-parameters-box bx-active">
								<span class="bx-filter-container-modef"></span>
								<div class="filter__title bx-filter-parameters-box-title"><?=GetMessage('PRYMERY_FILTER_PRICE');?> <svg class="filter__icon"><use xlink:href="#angle-down"></use></svg></div>
								<div class="filter__item bx-filter-block" data-role="bx_filter_block" style="display: block">
									<div class="filter__group">
										<?if(!$arItem["VALUES"]["MIN"]["HTML_VALUE"]){
											$min_price = $prices[0];
										}
										if(!$arItem["VALUES"]["MAX"]["HTML_VALUE"]){
											$max_price = $prices[count($prices)-1];
										}?>
										<div class="filter__price">
											<input
												class="filter-price__val filter-price__min min-price"
												type="text"
												placeholder="<?=$min_price?>"
												name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
												id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
												value="<?= $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
											/>
											<span class="price__divider">-</span>
											<input
												class="filter-price__val filter-price__max max-price"
												type="text"
												placeholder="<?=$max_price?>"
												name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
												id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
												value="<?= $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
											/>
										</div>
									</div>
									<div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
										<div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
											<div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
											<div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
											<div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
											<div class="bx-ui-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0%; right: 0%;">
												<a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
												<a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
											</div>
										</div>
									</div>
								</div>
								<?
								$arJsParams = array(
									"leftSlider" => 'left_slider_'.$key,
									"rightSlider" => 'right_slider_'.$key,
									"tracker" => "drag_tracker_".$key,
									"trackerWrap" => "drag_track_".$key,
									"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
									"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
									"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
									"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
									"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
									"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
									"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
									"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
									"precision" => $precision,
									"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
									"colorAvailableActive" => 'colorAvailableActive_'.$key,
									"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
								);
								?>
								<script type="text/javascript">
									BX.ready(function(){
										window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
									});
								</script>
							</div>
						<?endif;
					}
					foreach($arResult["ITEMS"] as $key=>$arItem){
						if($arItem['CODE'] == 'visota'){continue;}
						if(empty($arItem["VALUES"])|| isset($arItem["PRICE"]))
							continue;

						if ($arItem["DISPLAY_TYPE"] == "A"&& ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
							continue;
						?>
						<div class="fiter__control deployed" data-role="bx_filter_block">
							<span class="bx-filter-container-modef"></span>
							<div class="filter__title bx-filter-parameters-box-title"><?=$arItem["NAME"]?> <svg class="filter__icon"><use xlink:href="#angle-down"></use></svg></div>
							<?
							$arCur = current($arItem["VALUES"]);
							switch ($arItem["DISPLAY_TYPE"]){
								case "A"://NUMBERS_WITH_SLIDER
									break;
								case "B"://NUMBERS
									break;
								case "G"://CHECKBOXES_WITH_PICTURES
									break;
								case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
									break;
								case "P"://DROPDOWN
									break;
								case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
									break;
								case "K"://RADIO_BUTTONS
									break;
								case "U"://CALENDAR
									break;
								default://CHECKBOXES
									$count_val = 0;?>
								<div class="filter__item" style="display: block">
									<?foreach($arItem["VALUES"] as $val => $ar):$count_val++;?>
										<div class="filter__group">
											<label data-role="label_<?=$ar["CONTROL_ID"]?>" for="<? echo $ar["CONTROL_ID"] ?>" class="custom-checkbox checkbox--info-square">
												<input data-name="<?=$ar["VALUE"];?>" class="checkbox-value smartFilterCheckbox" type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" 
												id="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["CHECKED"]? 'checked="checked"': '' ?> onclick="smartFilter.click(this)" />
												<span class="checkbox-icon"></span>
												<span class="checkbox-text"><?=$ar["VALUE"];?></span>
											</label>
										</div>
										<?if($count_val==4 && count($arItem["VALUES"])>4):?>
											<div class="dropdown-link">
												<div class="dropdown-link__header">
													<div class="dropdown-link__title">Показать еще <?=count($arItem["VALUES"])-7;?></div>
													<svg class="icon"><use xlink:href="#angle-down"></use></svg>
												</div>
												<div class="dropdown-link__body">
										<?endif;?>
									<?endforeach;?>
									<?if($count_val>4):?>
										</div></div>
									<?endif;?>
								</div>
							<?}?>
						</div>
					<?}?>
				</div>
				<div class="row">
					<div class="col-xs-12 bx-filter-button-box">
						<div class="bx-filter-block" style="display:none!important;">
							<div class="bx-filter-parameters-box-container">
								<input
									class="btn btn-themes"
									type="submit"
									id="set_filter"
									name="set_filter"
									value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
								/>
								<input
									class="btn btn-link"
									type="submit"
									id="del_filter"
									name="del_filter"
									value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
								/>
								<div class="bx-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
									<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
									<span class="arrow"></span>
									<br/>
									<a href="<?= $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
	</script>
</div>