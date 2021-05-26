<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$count_orders=0;
global $USER;
if($USER->IsAuthorized()):?>
	<div class="personal-area">
		<?if(!empty($arResult['ERRORS']['FATAL'])):?>
			<?foreach($arResult['ERRORS']['FATAL'] as $error):?>
				<?=ShowError($error)?>
			<?endforeach?>
		<?else:?>
			<?if(!empty($arResult['ERRORS']['NONFATAL'])):?>
				<?foreach($arResult['ERRORS']['NONFATAL'] as $error):?>
					<?=ShowError($error)?>
				<?endforeach?>
			<?endif?>
			<div class="personal-container">
				<div class="personal-tip">
					<svg class="icon"><use xlink:href="#personal-registration"></use></svg>
					<div><?=GetMessage('PRYMERY_INFO_ORDERS');?></div>
				</div>
			</div>
			
			<div class="personal__orders">
				<?if(!empty($arResult['ORDERS'])):?>
					<ul class="orders__sorting">
						<li<?if(!$_REQUEST['cur'] && !$_REQUEST['end']):?> class="current"<?endif;?>><a href="<?=SITE_DIR?>personal/history-of-orders/"><?=GetMessage('PRYMERY_ALL_ORDERS');?></a></li>
						<li<?if($_REQUEST['cur']=='y'):?> class="current"<?endif;?>><a href="<?=SITE_DIR?>personal/history-of-orders/?cur=y"><?=GetMessage('PRYMERY_CURRENT_ORDERS');?><i></i></a></li>
						<li<?if($_REQUEST['end']=='y'):?> class="current"<?endif;?>><a href="<?=SITE_DIR?>personal/history-of-orders/?end=y"><?=GetMessage('PRYMERY_END_ORDERS');?></a></li>
					</ul>
				<?endif;?>
				<div class="orders__list">
					<?if(!empty($arResult['ORDERS'])):?>
						<?if($_REQUEST['cur']):?>
							<?foreach($arResult["ORDERS"] as $key => $order):
								$explode_date = explode('.',$order['ORDER']['DATE_INSERT_FORMATED']);
								if($order['STATUS_ID'] != 'F'):
									$count_orders++;?>
									<div class="personal-container">
										<div class="personal-order__list">
											<div class="personal-order__item">
												<div class="personal-order__title">
													<?=GetMessage('SPOL_ORDER');?> <?=GetMessage('SPOL_NUM_SIGN');?><?=$order["ORDER"]["ACCOUNT_NUMBER"]?> 
													<?=GetMessage('SPOL_FROM');?> <?=$explode_date[0]?> <?=FormatDate("F", MakeTimeStamp($order['ORDER']['DATE_INSERT_FORMATED']))?> <?=$explode_date[2]?>, 
													<?=count($order['BASKET_ITEMS']);?>
													<?=PRmajor::endingsForm(count($order['BASKET_ITEMS']), GetMessage('ENDINGS_FORM_1'),GetMessage('ENDINGS_FORM_2'),GetMessage('ENDINGS_FORM_5'));?>
													<?=GetMessage('SPOL_SUM');?> <?=$order['ORDER']['FORMATED_PRICE'];?>
												</div>
												<div class="personal-order__content">
													<div class="personal-order__group">
														<div class="personal-order__subtitle"><?=GetMessage('SPOL_PAYMENT_TITLE');?></div>
														<div class="personal-order__pay"><?=GetMessage('SPOL_PAYMENT_METHODE_TITLE');?> <?=$order['PAYMENT'][0]['PAY_SYSTEM_NAME']?></div>
														<div class="personal-order__status"><?=GetMessage('SPOL_STATUS_TITLE');?> <?=$arResult['STATUS_INFO'][$order['ORDER']['STATUS_ID']]['NAME']?></div>
														<div class="personal-order__total"><?=GetMessage('SPOL_PAY_SUM');?> <?=$order['ORDER']['FORMATED_PRICE'];?></div>
													</div>
													<div class="personal-order__group">
														<div class="personal-order__subtitle"><?=GetMessage('SPOL_DELIVERY_TITLE');?></div>
														<div class="personal-order__bill"><?=GetMessage('SPOL_DELIVERY_STATUS');?> <?=$order['SHIPMENT'][0]['FORMATED_DELIVERY_PRICE']?></div>
														<div class="personal-order__status"><?=GetMessage('SPOL_DELIVERY_RESULT');?> <?=$order['SHIPMENT'][0]['DELIVERY_STATUS_NAME']?></div>
													</div>
													<div class="personal-order__group personal-order__action">
														<a href="<?=$order['ORDER']['URL_TO_DETAIL']?>" class="order-detail__link adp-btn adp-btn-info"><?=GetMessage('SPOL_ORDER_DETAIL');?></a>
														<a href="/order/?ORDER_ID=<?=$order['ORDER']['ID'];?>" class="order-detail__link adp-btn adp-btn-primary"><?=GetMessage('SPOL_PAY_LINK');?></a>
													</div>
												</div>
												<div class="personal-order__footer">
													<a href="<?=$order['ORDER']['URL_TO_CANCEL']?>" class="btn-link order-cancel"><svg class="icon"><use xlink:href="#times"></use></svg> <span><?=GetMessage('SPOL_CANCEL_ORDER');?></span></a>
													<a href="<?=$order['ORDER']['URL_TO_COPY']?>" class="btn-link"><svg class="icon"><use xlink:href="#redo"></use></svg> <span><?=GetMessage('SPOL_REPEAT_ORDER');?></span></a>
												</div>
											</div>
										</div>
									</div>
								<?endif;?>
							<?endforeach?>
						<?elseif($_REQUEST['end']):?>
							<?foreach($arResult["ORDERS"] as $key => $order):
								$explode_date = explode('.',$order['ORDER']['DATE_INSERT_FORMATED']);
								if($order['STATUS_ID'] == 'F'):
									$count_orders++;?>
									<div class="personal-container">
										<div class="personal-order__list">
											<div class="personal-order__item">
												<div class="personal-order__title">
													<?=GetMessage('SPOL_ORDER');?> <?=GetMessage('SPOL_NUM_SIGN');?><?=$order["ORDER"]["ACCOUNT_NUMBER"]?> 
													<?=GetMessage('SPOL_FROM');?> <?=$explode_date[0]?> <?=FormatDate("F", MakeTimeStamp($order['ORDER']['DATE_INSERT_FORMATED']))?> <?=$explode_date[2]?>, 
													<?=count($order['BASKET_ITEMS']);?>
													<?=PRmajor::endingsForm(count($order['BASKET_ITEMS']), GetMessage('ENDINGS_FORM_1'),GetMessage('ENDINGS_FORM_2'),GetMessage('ENDINGS_FORM_5'));?>
													<?=GetMessage('SPOL_SUM');?> <?=$order['ORDER']['FORMATED_PRICE'];?>
												</div>
												<div class="personal-order__content">
													<div class="personal-order__group">
														<div class="personal-order__subtitle"><?=GetMessage('SPOL_PAYMENT_TITLE');?></div>
														<div class="personal-order__pay"><?=GetMessage('SPOL_PAYMENT_METHODE_TITLE');?> <?=$order['PAYMENT'][0]['PAY_SYSTEM_NAME']?></div>
														<div class="personal-order__status"><?=GetMessage('SPOL_STATUS_TITLE');?> <?=$arResult['STATUS_INFO'][$order['ORDER']['STATUS_ID']]['NAME']?></div>
														<div class="personal-order__total"><?=GetMessage('SPOL_PAY_SUM');?> <?=$order['ORDER']['FORMATED_PRICE'];?></div>
													</div>
													<div class="personal-order__group">
														<div class="personal-order__subtitle"><?=GetMessage('SPOL_DELIVERY_TITLE');?></div>
														<div class="personal-order__bill"><?=GetMessage('SPOL_DELIVERY_STATUS');?> <?=$order['SHIPMENT'][0]['FORMATED_DELIVERY_PRICE']?></div>
														<div class="personal-order__status"><?=GetMessage('SPOL_DELIVERY_RESULT');?> <?=$order['SHIPMENT'][0]['DELIVERY_STATUS_NAME']?></div>
													</div>
													<div class="personal-order__group personal-order__action">
														<a href="<?=$order['ORDER']['URL_TO_DETAIL']?>" class="order-detail__link adp-btn adp-btn-info"><?=GetMessage('SPOL_ORDER_DETAIL');?></a>
														<a href="/order/?ORDER_ID=<?=$order['ORDER']['ID'];?>" class="order-detail__link adp-btn adp-btn-primary"><?=GetMessage('SPOL_PAY_LINK');?></a>
													</div>
												</div>
												<div class="personal-order__footer">
													<a href="<?=$order['ORDER']['URL_TO_CANCEL']?>" class="btn-link order-cancel"><svg class="icon"><use xlink:href="#times"></use></svg> <span><?=GetMessage('SPOL_CANCEL_ORDER');?></span></a>
													<a href="<?=$order['ORDER']['URL_TO_COPY']?>" class="btn-link"><svg class="icon"><use xlink:href="#redo"></use></svg> <span><?=GetMessage('SPOL_REPEAT_ORDER');?></span></a>
												</div>
											</div>
										</div>
									</div>
								<?endif;?>
							<?endforeach?>
						<?else:?>
							<?foreach($arResult["ORDERS"] as $key => $order):
								$explode_date = explode('.',$order['ORDER']['DATE_INSERT_FORMATED']);
								$count_orders++;?>
								<div class="personal-container">
									<div class="personal-order__list">
										<div class="personal-order__item">
											<div class="personal-order__title">
												<?=GetMessage('SPOL_ORDER');?> <?=GetMessage('SPOL_NUM_SIGN');?><?=$order["ORDER"]["ACCOUNT_NUMBER"]?> 
												<?=GetMessage('SPOL_FROM');?> <?=$explode_date[0]?> <?=FormatDate("F", MakeTimeStamp($order['ORDER']['DATE_INSERT_FORMATED']))?> <?=$explode_date[2]?>, 
												<?=count($order['BASKET_ITEMS']);?>
												<?=PRmajor::endingsForm(count($order['BASKET_ITEMS']), GetMessage('ENDINGS_FORM_1'),GetMessage('ENDINGS_FORM_2'),GetMessage('ENDINGS_FORM_5'));?>
												<?=GetMessage('SPOL_SUM');?> <?=$order['ORDER']['FORMATED_PRICE'];?>
											</div>
											<div class="personal-order__content">
												<div class="personal-order__group">
													<div class="personal-order__subtitle"><?=GetMessage('SPOL_PAYMENT_TITLE');?></div>
													<div class="personal-order__pay"><?=GetMessage('SPOL_PAYMENT_METHODE_TITLE');?> <?=$order['PAYMENT'][0]['PAY_SYSTEM_NAME']?></div>
													<div class="personal-order__status"><?=GetMessage('SPOL_STATUS_TITLE');?> <?=$arResult['STATUS_INFO'][$order['ORDER']['STATUS_ID']]['NAME']?></div>
													<div class="personal-order__total"><?=GetMessage('SPOL_PAY_SUM');?> <?=$order['ORDER']['FORMATED_PRICE'];?></div>
												</div>
												<div class="personal-order__group">
													<div class="personal-order__subtitle"><?=GetMessage('SPOL_DELIVERY_TITLE');?></div>
													<div class="personal-order__bill"><?=GetMessage('SPOL_DELIVERY_STATUS');?> <?=$order['SHIPMENT'][0]['FORMATED_DELIVERY_PRICE']?></div>
													<div class="personal-order__status"><?=GetMessage('SPOL_DELIVERY_RESULT');?> <?=$order['SHIPMENT'][0]['DELIVERY_STATUS_NAME']?></div>
												</div>
												<div class="personal-order__group personal-order__action">
													<a href="<?=$order['ORDER']['URL_TO_DETAIL']?>" class="order-detail__link adp-btn adp-btn-info"><?=GetMessage('SPOL_ORDER_DETAIL');?></a>
													<a href="/order/?ORDER_ID=<?=$order['ORDER']['ID'];?>" class="order-detail__link adp-btn adp-btn-primary"><?=GetMessage('SPOL_PAY_LINK');?></a>
												</div>
											</div>
											<div class="personal-order__footer">
												<a href="<?=$order['ORDER']['URL_TO_CANCEL']?>" class="btn-link order-cancel"><svg class="icon"><use xlink:href="#times"></use></svg> <span><?=GetMessage('SPOL_CANCEL_ORDER');?></span></a>
												<a href="<?=$order['ORDER']['URL_TO_COPY']?>" class="btn-link"><svg class="icon"><use xlink:href="#redo"></use></svg> <span><?=GetMessage('SPOL_REPEAT_ORDER');?></span></a>
											</div>
										</div>
									</div>
								</div>
							<?endforeach?>
						<?endif;?>
						<?if($count_orders==0):?>
							<div class="emptyOrders order__item mh-auto">
								<?if($_REQUEST['cur']):?>
									<?=GetMessage('PRYMERY_CURRENT_ORDERS');?> 
								<?else:?>
									<?=GetMessage('PRYMERY_END_ORDERS');?> 
								<?endif;?>
								<?=GetMessage('PRYMERY_END_NO_FOUND_ORDERS');?> 
							</div>
						<?endif;?>
					<?else:?>
						<div class="emptyOrders order__item mh-auto"><?=GetMessage('PRYMERY_NO_ORDERS');?></div>
					<?endif;?>
				</div>
			</div>
			<?/*if(strlen($arResult['NAV_STRING'])):?>
				<?=$arResult['NAV_STRING']?>
			<?endif?*/?>
		<?endif?>
	</div>
<?endif?>

