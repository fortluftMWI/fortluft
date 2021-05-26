<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if($arResult['TYPE_LIST']):?>
	<div class="row">
		<div class="col-12">
			<div class="catalog-sorting d-flex align-items-center flex-wrap">
				<ul class="tabs tabs-shadow">
					<?$k=0;foreach($arResult['TYPES'] as $code=>$tab):?>
						<li class="tab-link<?if($k==0):?> current<?endif;?>" data-tab="tab-<?=$tab['ID']?>"><?=$tab['VALUE']?></li>
					<?$k++;endforeach;?>
				</ul>
			</div>
			<div class="tab-container">
				<?$k=0;foreach($arResult['TYPES'] as $code=>$tab):?>
					<div id="tab-<?=$tab['ID']?>" class="tab-content<?if($k==0):?> current<?endif;?>">
						<div class="row">
							<?foreach($arResult['TYPE_LIST'][$tab['ID']] as $arSection):?>
								<div class="col-12 col-md-6 col-lg-3">
									<a href="<?=$arSection['SECTION_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="category">
										<div class="content">
											<div class="title"><?=$arSection['NAME']?></div>
										</div>
										<div class="thumb">
											<img src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection['NAME']?>">
										</div>
									</a>

								</div>
							<?endforeach;?>
						</div>
					</div>
				<?$k++;endforeach;?>
				
			</div>
		</div>
	</div>
<?elseif($arResult['NOTYPE_LIST']):?>
	<div class="row">
		<div class="col-12">
			<div class="tab-container">
				<div class="row">
					<?foreach($arResult['NOTYPE_LIST'] as $arSection):?>
						<div class="col-12 col-md-6 col-lg-3">
							<a href="<?=$arSection['SECTION_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="category">
								<div class="content">
									<div class="title"><?=$arSection['NAME']?></div>
								</div>
								<div class="thumb">
									<img src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection['NAME']?>">
								</div>
							</a>

						</div>
					<?endforeach;?>
				</div>
			</div>
		</div>
	</div>
<?endif;?>