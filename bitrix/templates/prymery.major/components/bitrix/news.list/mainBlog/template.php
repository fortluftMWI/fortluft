<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if($arResult["ITEMS"]):?>
<section class="section-news bg-white">
	<div class="container">
		<div class="section-heading">
			<div class="row justify-content-between align-items-center">
				<div class="col-12 col-md-auto">
					<div class="section-title"><?=GetMessage('PRYMERY_BLOG_TITLE')?></div>
				</div>
				<div class="col-12 col-md-auto">
					<div class="section-action">
						<a href="<?=SITE_DIR?>blog/" class="adp-btn adp-btn-light"><?=GetMessage('PRYMERY_BLOG_LINK')?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="post-slider">
					<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						if(!$arItem['SHOW_COUNTER']){$arItem['SHOW_COUNTER'] = 0;}
						?>
						<div class="slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="post<?if($arItem['PROPERTIES']['TYPE']['VALUE'] == GetMessage('PRYMERY_BLOG_TYPE')):?> post-video<?else:?> post-text<?endif;?>">
								<div class="thumb">
									<?if($arItem['PROPERTIES']['TYPE']['VALUE']):?>
										<div class="post-category">
											<div class="icon icon-sm">
												<?if($arItem['PROPERTIES']['TYPE']['VALUE'] == GetMessage('PRYMERY_BLOG_TYPE')):?>
													<svg><use xlink:href="#caret-right"></use></svg>
												<?else:?>
													<svg><use xlink:href="#align-center"></use></svg>
												<?endif;?>
											</div>
											<?=$arItem['PROPERTIES']['TYPE']['VALUE']?>
										</div>
									<?endif;?>
									<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
										<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
									</a>
								</div>
								<div class="meta">
									<div class="meta-item date">
										<div class="icon icon-sm"><svg><use xlink:href="#clock"></use></svg></div>
										<?=$arItem['DATE_CREATE']?>
									</div>
									<div class="meta-item views">
										<div class="icon icon-sm"><svg><use xlink:href="#eye"></use></svg></div>
										<?=$arItem['SHOW_COUNTER']?> <?=PRmajor::endingsForm($arItem['SHOW_COUNTER'],GetMessage('PRYMERY_BLOG_FORM'),GetMessage('PRYMERY_BLOG_FORM2'),GetMessage('PRYMERY_BLOG_FORM3'));?>
									</div>
								</div>
								<div class="content">
									<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="title"><?=$arItem['NAME']?></a>
									<div class="description"><?=PRmajor::cut_string($arItem['~PREVIEW_TEXT'],150)?></div>
								</div>
							</div>
						</div>
					<?endforeach;?>
				</div>
			</div>
		</div>
	</div>
</section>
<?endif;?>