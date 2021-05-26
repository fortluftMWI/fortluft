<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?PRmajor::EndMainWrap();?>
<?PRmajor::site_dir();?>
<section class="main-contacts">
	<div class="container">
		<div class="row justify-content-center justify-content-lg-between align-items-center">
			<div class="col-12 col-lg-2">
				<div class="footer-logo">
                    <?=PRmajor::DisplayLogo();?>
				</div>
			</div>
			<div class="col-6 col-lg-auto">
				<?if($PRmajorOptions['PHONE_FIRST']):?>
					<div class="contact-item">
						<div class="contact-icon">
							<svg><use xlink:href="#call"></use></svg>
						</div>
						<div class="contact-content">
							<div class="contact-title">
								<a href="tel:<?=$PRmajorOptions['PHONE_FIRST']?>"><?=$PRmajorOptions['PHONE_FIRST']?></a>
							</div>
							<?if($PRmajorOptions['PHONE_FIRST_DESC']):?>
								<div class="contact-description">
									<?=$PRmajorOptions['PHONE_FIRST_DESC']?>
								</div>
							<?endif;?>
						</div>
					</div>
				<?endif;?>
			</div>
			<div class="col-6 col-lg-auto">
				<?if($PRmajorOptions['PHONE_SECOND']):?>
					<div class="contact-item">
						<div class="contact-icon">
							<svg><use xlink:href="#call"></use></svg>
						</div>
						<div class="contact-content">
							<div class="contact-title">
								<a href="tel:<?=$PRmajorOptions['PHONE_SECOND']?>"><?=$PRmajorOptions['PHONE_SECOND']?></a>
							</div>
							<?if($PRmajorOptions['PHONE_SECOND_DESC']):?>
								<div class="contact-description">
									<?=$PRmajorOptions['PHONE_SECOND_DESC']?>
								</div>
							<?endif;?>
						</div>
					</div>
				<?endif;?>
			</div>
			<div class="col-6 col-lg-2 col-xl-auto">
				<div class="contact-item">
					<div class="contact-icon">
						<svg><use xlink:href="#at-light"></use></svg>
					</div>
					<div class="contact-content">
						<?if($PRmajorOptions['EMAIL_DEF']):?>
							<div class="contact-title">
								<a href="mailto:<?=$PRmajorOptions['EMAIL_DEF']?>"><?=$PRmajorOptions['EMAIL_DEF']?></a>
							</div>
						<?endif;?>
						<div class="contact-description">
                            <a data-fancybox="" data-type="ajax" data-touch="false" data-src="<?=SITE_DIR?>ajax/form/write-us.php?ajax=y" href="javascript:void(0);"><?=GetMessage('PRYMERY_WRITE_US');?></a>
						</div>
					</div>
				</div>
			</div>
			<?/*div class="col-6 col-lg-2 col-xl-auto">
				<div class="contact-item contact-item--map">
					<div class="contact-icon">
						<img src="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/map.png" alt="Map">
					</div>
					<div class="contact-content">
						<a data-fancybox data-src="#modal-city" href="javascript:void(0);" class="modal-city-link">Москва и Московская область</a>
					</div>
				</div>
			</div*/?>
		</div>
	</div>
</section>
<footer class="main-footer">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<section class="widget widget-contacts">
					<h3>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => SITE_DIR."include_areas/footer_contact_title.php"
                            ),
                            false
                        );?>
                    </h3>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "EDIT_TEMPLATE" => "",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => SITE_DIR."include_areas/footer_contact2.php"
                        ),
                        false
                    );?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "EDIT_TEMPLATE" => "",
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => SITE_DIR."include_areas/footer_contact.php"
                        ),
                        false
                    );?>
				</section>
				<section class="widget widget-social">
                    <?=PRmajor::DisplaySocial();?>
				</section>
			</div>
			<div class="col-6 col-md-4 col-lg">
				<div class="widget widget-navigation">
					<h3>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => SITE_DIR."include_areas/bottom_menu_1.php"
                            ),
                            false
                        );?>
                    </h3>
                    <?$APPLICATION->IncludeComponent("bitrix:menu","defMenu",Array(
                            "ROOT_MENU_TYPE" => "bottom1",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>
				</div>
			</div>
			<div class="col-6 col-sm-4 col-md-4 col-lg">
				<div class="widget widget-navigation">
					<h3>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => SITE_DIR."include_areas/bottom_menu_2.php"
                            ),
                            false
                        );?>
                    </h3>
                    <?$APPLICATION->IncludeComponent("bitrix:menu","defMenu",Array(
                            "ROOT_MENU_TYPE" => "bottom2",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>
				</div>
			</div>
			<div class="col-6 col-sm-4 col-md-4 col-lg">
				<div class="widget widget-navigation">
					<h3>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => SITE_DIR."include_areas/bottom_menu_3.php"
                            ),
                            false
                        );?>
                    </h3>
                    <?$APPLICATION->IncludeComponent("bitrix:menu","defMenu",Array(
                            "ROOT_MENU_TYPE" => "bottom3",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>
				</div>
			</div>
			<div class="col-6 col-sm-4 col-md-4 col-lg">
				<div class="widget widget-navigation">
					<h3>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => SITE_DIR."include_areas/bottom_menu_4.php"
                            ),
                            false
                        );?>
                    </h3>
                    <?$APPLICATION->IncludeComponent("bitrix:menu","defMenu",Array(
                            "ROOT_MENU_TYPE" => "bottom4",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "Y",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="row">
				<div class="col-12 col-md-7 col-lg-9">
					<div class="footer-description">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include", 
							".default", 
							array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_TEMPLATE" => "",
								"COMPONENT_TEMPLATE" => ".default",
								"PATH" => "/include_areas/footer_copyright.php"
							),
							false
						);?>
					</div>
				</div>
				<div class="col-12 col-md-5 col-lg-3">
					<div class="pyments footer-payments">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include", 
							".default", 
							array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_TEMPLATE" => "",
								"COMPONENT_TEMPLATE" => ".default",
								"PATH" => "/include_areas/footer_payment.php"
							),
							false
						);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</body>
</html>
