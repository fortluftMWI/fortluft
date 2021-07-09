<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if($arResult["ITEMS"]):?>
	<section class="section-instagram">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="section-title text-center"><?=GetMessage('PRYMERY_INSTA_TITLE')?></div>
				</div>
			</div>	
			<div class="instagram-feed">
				<div class="row justify-content-center align-items-end">
					<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						if($key == 2):?>
							<div class="col-12 col-sm-10 col-md instagram-thumb-container">
								<a class="instagram-thumb" href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" target="_blank">
									<img src="<?=SITE_TEMPLATE_PATH?>/assets/img/instagram/instagram-phone.png" alt="">
									<div class="instagram-thumb-inner" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);"></div>
									<a class="instagram-action" href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" target="_blank">
										<img src="<?=SITE_TEMPLATE_PATH?>/assets/img/instagram/instagram-btn.png" alt="<?=$arItem['NAME']?>">
									</a>
								</a>
							</div>
                            <? elseif($key == 0):?>
                                <div class="col-6 col-sm-3 col-md">
                                    <div class="instagram-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                            <div class="caption caption-like" style="background-color: #e30613">
                                                <img src="/images/drive2.svg" style="height: 41px; border-radius: 10px;">
                                            </div>
                                        <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>"  target="_blank">
                                            <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                                        </a>
                                    </div>
                                </div>
                                <? elseif($key == 1):?>
                                    <div class="col-6 col-sm-3 col-md">
                                        <div class="instagram-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                                <div class="caption caption-thumb" style="background-color: #415e9b"><svg><use xlink:href="#facebook-f"></use></svg></div>
                                            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" target="_blank">
                                                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                                            </a>
                                        </div>
                                    </div>
                                    <? elseif($key == 3):?>
                                        <div class="col-6 col-sm-3 col-md">
                                            <div class="instagram-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                                    <div class="caption caption-thumb" style="background-color: #2787f5;"><svg><use xlink:href="#vk"></use></svg></div>
                                                <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>"  target="_blank">
                                                    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                                                </a>
                                            </div>
                                        </div>
                                        <? elseif($key == 4):?>
                                            <div class="col-6 col-sm-3 col-md">
                                                <div class="instagram-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                                        <div class="caption caption-like"><svg><use xlink:href="#youtube"></use></svg></div>
                                                    <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>"  target="_blank">
                                                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                                                    </a>
                                                </div>
                                            </div>

						<?endif;?>
					<?endforeach;?>
				</div>
			</div>
		</div>
	</section>
<?endif;?>