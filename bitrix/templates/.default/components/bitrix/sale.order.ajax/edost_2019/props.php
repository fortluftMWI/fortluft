<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

// ��������� ������ �������������� (edost.locations)
if (!empty($arResult['edost']['locations_installed'])) {
	$param['edost_locations'] = array(
		'ID' => $delivery_location,
		'DELIVERY_ID' => $delivery_id,
		'PROP' => $arResult['edost']['order_prop'],
		'PROP2' => $arResult['edost']['order_prop2'],

		'PARAM' => array(
//			'edost_delivery' => false, // false - ��������� ������������� ������ edost.delivery (������� �� ����� �������������� ����� ���������� ������), ������ ��� ������� �������� - ��� ����������� ������������� ��������� ��������� ���������� � ���������� !!!
			'input' => (!empty($arResult['edost']['location_input']) ? $arResult['edost']['location_input'] : 0), // ID �������������� � �������� ��������� ����� ������ (���� �� ������ ��� ����� "0", ����� ������ �������� � �������������� ������)
			'zip_in_city' => (isset($arResult['edost']['order_prop']['ZIP']) && ($arResult['edost']['order_prop']['ZIP']['value'] === '' || $warning && $address_hide) ? true : false), // true - �������� ������ � ����� � ���������������
			'address' => 'N', // ��������� ����������� ����� ���������� ('N' - ����������� ������)
			'preload_prop' => ($arParams['USE_PRELOAD_PROP'] == 'Y' ? true : false),
//			'loading' => 'loading_small_f2.gif', // ������ �������� ��� ������� �������� � �������� ������� - ����� � ����� bitrix/components/edost/locations/images/

/*
			// �������������� (���� �������, ����� �������� �������� �� ���������)
			'zip_warning' => array(
				1 => '������ ������� �� ����������!2222',
				2 => '������ �� ������������� �������!',
				'digit' => '������ ���� ������ �����!',
			),
*/
			// ����������� ����� ������ (���� �������, ����� �������� �������� �� ���������)
			'address_field' => array(
/*
				'street' => array(
					'width' => 320, // ����� ���� � ��������
				),
				'house_1' => array(
					'enter' => true, // true - �������� ����� ����� '����'
				),
*/
/*
				'city2' => array(
					'name' => '���������� �����', // �������� ����
					'width' => 200, // ����� ���� � ��������
					'max' => 50, // ���������� ���������� ��������
					'enter' => true, // true - �������� ����� ����� '����'
					'style' => 'color: #F00; width: 200px;', // ��������� �������� ��� ����� (� ����� ���������)
				),
				'street' => array(
					'delimiter' => true, // ���������� ����� ���� �����������
					'delimiter_style' => 'width: 20px', // ����������� ����� ��� �����������
				),
//				'house_1', 'house_2', 'house_3', 'house_4', 'door_1', 'door_2' // ��������� ����
*/
				'city2' => array(
					'delimiter' => false, // ���������� ����� ���� �����������
//					'enter' => false, // true - �������� ����� ����� '����'
				),
				'street' => array(
					'enter' => false, // true - �������� ����� ����� '����'
					'delimiter_style' => 'width: 0;', // ����������� ����� ��� �����������
				),
				'house_3' => array(
					'hidden' => true,
				),
				'house_4' => array(
					'hidden' => true,
				),
				'house_2' => array(
//					'delimiter' => false, // ���������� ����� ���� �����������
					'delimiter_style' => 'width: 0px', // ����������� ����� ��� �����������
				),
				'door_1' => array(
//					'delimiter_style' => 'width: 0px', // ����������� ����� ��� �����������
				),
				'door_2' => array(
					'hidden' => true,
//					'delimiter' => false, // ���������� ����� ���� �����������
//					'delimiter_style' => 'width: 0;', // ����������� ����� ��� �����������
				),

				'zip' => array(
					'enter' => false,
				),

				'passport_2' => array(
					'width' => 80, // ����� ���� � ��������
				),
				'passport_3' => array(
					'width' => 180, // ����� ���� � ��������
					'disable' => ($arParams['PASSPORT_SMALL'] == 'Y' ? true : false),
				),
				'passport_4' => array(
					'width' => 80, // ����� ���� � ��������
					'disable' => ($arParams['PASSPORT_SMALL'] == 'Y' ? true : false),
				),

				// ����������� �� ������ �����
				'city2_required' => array(
//					'value' => 'Y', // '' - �� �����������, 'Y' - ����������� (�� ���������)
				),
				'street_required' => array(
					'value' => (empty($arParams['LOCATION_AREA']) || $arParams['LOCATION_AREA'] == 'Y' ? 'A' : ''), // '' - �� �����������, 'Y' - �����������, 'A' - ������ � ������� edost.delivery � ������������ ������� ����� �� ������ ��������� ��� ������� � ����������� �������� (�� ���������)
				),
				'zip_required' => array(
//					'value' => (in_array($delivery_id, array(10, 20)) ? 'Y' : ''), // '' - ���� �� ���������, 'S' - ���� ���������, 'Y' - ������ ���� ����������� ���������, 'A' - ������ � ������� edost.delivery (�� ���������)
				),
				'metro_required' => array(
//					'value' => (in_array($delivery_id, array(10, 20)) ? 'S' : ''), // '' - ���� �� ���������, 'S' - ���� ���������, 'A' - ������ � ������� edost.delivery (�� ���������)
				),
				'passport_required' => array(
//					'value' => (in_array($delivery_id, array(10, 20)) ? 'Y' : ''), // '' - ���� �� ���������, 'Y' - ������ ���� ����������� ���������, 'A' - ������ � ������� edost.delivery (�� ���������)
				),
			),
		),
	);

?>
	<script type="text/javascript">
		function edost_SetTemplateLocation(param, data) {

			if (param === 'error') {
				loadingForm(false);
				edost.html('edost_location_city_template_div', '<div class="edost_delivery_loading" style="color: #F00;">' + data + '</div>');
			}
			else if (param === 'back') {
				edost.html('edost_location_city_template_div', '');
				edost.class('edost_location_div', ['edost_location_button_hide', ''], 1);
				edost.display('edost_location_city_div', true);
			}
			else if (param === 'set') {
				loadingForm();
				edost.html('edost_location_city_template_div', '<div class="edost_delivery_loading"><?=GetMessage('SOA_TEMPL_LOADING')?></div>');
				edost.display('edost_location_city_div', false);
			}
			else if (param === 'click') {
				var E = edost.E('edost_location_address_div');
				if (!E) {
					alert('<?=GetMessage('SOA_TEMPL_ADDRESS_ERROR')?>');
					return;
				}
				s = E.style.display;

				var c = edost.E(['.edost_city_link']);
				if (c) c.click();

				E.style.display = s;
			}
			else if (param === 'new') {
				edost.location.set('0', true);
			}
			else if (param === 'loading') {
				edost.class('edost_location_div', ['edost_location_button_hide', ''], 0);

				var E = edost.E('edost_location_city_template_div');
				var E2 = edost.E('edost_location_city_div');
				if (E && E2) {
					E.innerHTML = E2.innerHTML;
					for (var i = 0; i < E.children.length; i++) if (E.children[i].className != 'edost_flag' && E.children[i].className != 'edost_city_name') { E.removeChild(E.children[i]); i--; }
					E.style.display = 'block';
					E2.style.display = 'none';
				}
			}

		}
	</script>
<?
}


if (!function_exists('DrawInput')) {
	function DrawInput($v, $fast = false, $submit = false, $change = false) {
		$type = $inputmode = '';
		$a = ($fast || isset($v['REQUIED_FORMATED']) && $v['REQUIED_FORMATED'] === 'Y' ? true : false);
		if ($a) {
			if ($v['IS_PROFILE_NAME'] == 'Y' || $v['CODE'] == 'FIO' || $v['CODE'] == 'COMPANY') $type = ($v['CODE'] == 'COMPANY' ? 'organization' : 'name');
			else if ($v['IS_EMAIL'] == 'Y' || $v['CODE'] == 'EMAIL') $type = 'email';
			else if ($v['IS_PHONE'] == 'Y' || $v['CODE'] == 'PHONE') $type = 'tel';

			if ($type == '') $type = 'field';
		}

		if ($submit) $change = 'submitForm()';
		else if ($change) $change = 'submitProp(this)';
		$onchange = ($change ? 'onchange="'.$change.'"' : '');

		$onfocus = $img = '';
		if ($fast) $onfocus = 'onfocus="window.edost.input(\'focus\', this)" onblur="window.edost.input(\'blur\', this)"';
?>
		<div class="edost_prop_error"></div>
		<input type="<?=($type == 'tel' ? $type : 'text')?>" <?=(!empty($v['inputmode']) ? 'inputmode="'.$v['inputmode'].'"' : '')?> <?=(in_array($type, array('email', 'tel', 'name', 'organization')) ? 'autocomplete="'.$type.'"' : '')?> autocorrect="off" spellcheck="false" <?=($type == 'email' ? 'autocapitalize="off"' : '')?> maxlength="250" size="<?=$v['SIZE1']?>" value="<?=$v['VALUE']?>" <?=($fast ? 'data-name="'.$v['FIELD_NAME'].'"' : 'name="'.$v['FIELD_NAME'].'" id="'.$v['FIELD_NAME'].'"')?> data-type="<?=$type?>" oninput="window.edost.input('update', this, event)" <?=$onchange?> <?=$onfocus?>>
<?
	}
}

if (!function_exists('DrawPropHead')) {
	function DrawPropHead($mono, $head = '', $required = false, $hide = false, $id = '', $top = false, $class = '') {
		if ($mono) return;
		if (!empty($head)) {
			$required = ($required === true || $required === 'Y' ? true : false);
			echo '<div class="edost_prop_div'.($class ? ' '.$class : '').'"'.($id != '' ? ' id="'.$id.'"' : '').($hide ? ' style="display: none;"' : '').'>
			<div class="edost_prop_head"'.($top !== false ? ' style="vertical-align: top; padding-top: '.$top.'px;"' : '').'>'.$head.($required ? '<span>*</span>' : '').'</div>
			<div class="edost_prop">';
		}
		else echo '</div></div>';
	}
}

if (!function_exists('PrintPropsForm')) {
	function PrintPropsForm($head, $field, $arResult = false, $arParams = false, $param) {

		$arSource = array();

		$head_compact = '';
		if (is_array($head)) {
			$head_compact = $head[1];
			$head = $head[0];
		}

		$field = array_fill_keys($field, false);
		$count = 0;
		foreach ($field as $f_key => $f) {
			if ($f_key == 'profile') {
			}
			if ($f_key == 'person_type') {
			}
			if ($f_key == 'props_Y') {
				if (empty($arResult['ORDER_PROP']['USER_PROPS_Y'])) unset($field[$f_key]);
				else {
					$field[$f_key] = $arResult['ORDER_PROP']['USER_PROPS_Y'];
					$count += count($field[$f_key]);
				}
			}
			if ($f_key == 'props_N') {
				if (empty($arResult['ORDER_PROP']['USER_PROPS_N'])) unset($field[$f_key]);
				else {
					$field[$f_key] = $arResult['ORDER_PROP']['USER_PROPS_N'];
					$count += count($field[$f_key]);
				}
			}
			if ($f_key == 'props_related') {
				if (empty($arResult['ORDER_PROP']['RELATED'])) unset($field[$f_key]);
				else {
					$field[$f_key] = $arResult['ORDER_PROP']['RELATED'];
					$count += count($field[$f_key]);
				}
			}
			if ($f_key == 'location') {
				if (!$param['edost_locations']) unset($field[$f_key]);
			}
			if ($f_key == 'address') {
				if (!$param['edost_locations'] || !isset($arResult['edost']['order_prop']['ADDRESS'])) unset($field[$f_key]);
			}
			if ($f_key == 'passport') {
				if (!$param['edost_locations'] || !isset($arResult['edost']['order_prop']['PASSPORT'])) unset($field[$f_key]);
			}
		}

		if (empty($field)) return;

		if (isset($param['mono'])) $mono = $param['mono'];
		else $mono = (count($field) == 1 && $count <= 1 ? true : false);

		$locationTemplate = (!empty($arParams['TEMPLATE_LOCATION']) ? $arParams['TEMPLATE_LOCATION'] : '.default');
		$preload_prop = (empty($arParams['USE_PRELOAD_PROP']) || $arParams['USE_PRELOAD_PROP'] == 'Y' ? true : false);

		$id = (!empty($param['id']['main']) ? $param['id']['main'] : '');
		if ($id == '' && $mono) foreach ($field as $f_key => $f) if ($f_key == 'passport') $id = 'edost_location_passport_div_main';

?>
	<div class="edost_main edost_template_div<?=(!empty($param['class']['main']) ? ' '.$param['class']['main'] : '')?><?=($id == 'edost_location_div' && $param['delivery_location'] === false ? ' edost_active_no' : '')?>"<?=($id != '' ? ' id="'.$id.'"' : '')?> style="<?=(!empty($param['hide']['main']) ? 'display: none;' : '')?><?=(!$param['edost_locations'] ? ' overflow: visible' : '')?>">
<?		if ($id == 'edost_location_div')
			if ($param['delivery_location'] === false) $head = '';
			else if ($param['compact'] != '') { ?>
		<div class="edost_window_hide edost_compact_hide">
			<div class="edost_button_big edost_button_head" onclick="edost_SetTemplateLocation('click')">
				<span><?=GetMessage('SOA_TEMPL_CHANGE_BUTTON')?></span>
			</div>
		</div>
<?			}

		if (!empty($head)) { ?>
		<h4 <?=(!empty($head_compact) ? 'class="edost_compact_head"' : '')?>><?=$head?></h4>
<?		if (!empty($head_compact)) { ?>
		<h4 class="edost_compact_head2"><?=$head_compact?></h4>
<?		} ?>
<?		} ?>
		<div class="edost_div">
<?
		foreach ($field as $f_key => $f) {
			$arSource = (in_array($f_key, array('props_Y', 'props_N', 'props_related')) ? $f : false);

			$id = '';
			if ($f_key == 'passport') $id = 'edost_location_passport_div_main';

			$hide = (!empty($param['hide'][$f_key]) ? true : false);

			// ������� ����������
			if ($f_key == 'profile' && !empty($arResult['ORDER_PROP']['USER_PROFILES'])) { $hide = ($arParams['ALLOW_USER_PROFILES'] != 'Y' ? true : false); ?>
<?				if ($arParams['ALLOW_NEW_PROFILE'] == 'Y') {
				DrawPropHead($mono, GetMessage('SOA_TEMPL_PROP_CHOOSE'), false, $hide); ?>
					<select name="PROFILE_ID" id="ID_PROFILE_ID" onChange="SetContact(this.value)">
						<option value="0"><?=GetMessage('SOA_TEMPL_PROP_NEW_PROFILE')?></option>
<?						foreach($arResult['ORDER_PROP']['USER_PROFILES'] as $arUserProfiles) { ?>
							<option value="<?=$arUserProfiles['ID']?>"<?=($arUserProfiles['CHECKED'] == 'Y' ? ' selected' : '')?>><?=$arUserProfiles['NAME']?></option>
<?						} ?>
					</select>
<?				DrawPropHead($mono);
				} else {
				DrawPropHead($mono, GetMessage('SOA_TEMPL_EXISTING_PROFILE'), false, $hide);
					if (count($arResult['ORDER_PROP']['USER_PROFILES']) == 1) {
						foreach($arResult['ORDER_PROP']['USER_PROFILES'] as $arUserProfiles) { ?>
							<strong><?=$arUserProfiles['NAME']?></strong>
							<input type="hidden" name="PROFILE_ID" id="ID_PROFILE_ID" value="<?=$arUserProfiles['ID']?>">
<?						}
					} else { ?>
						<select name="PROFILE_ID" id="ID_PROFILE_ID" onChange="SetContact(this.value)">
<?							foreach($arResult['ORDER_PROP']['USER_PROFILES'] as $arUserProfiles) { ?>
								<option value="<?=$arUserProfiles['ID']?>"<?=($arUserProfiles['CHECKED'] == 'Y' ? ' selected' : '')?>><?=$arUserProfiles['NAME']?></option>
<?							} ?>
						</select>
<?					}
				DrawPropHead($mono);
				}
			}

			// ��� �����������
			if ($f_key == 'person_type') { $hide = (count($arResult['PERSON_TYPE']) <= 1 ? true : false);
				DrawPropHead($mono, GetMessage('SOA_TEMPL_PERSON_TYPE'), false, $hide);
				if (count($arResult['PERSON_TYPE']) > 1) {
					foreach($arResult['PERSON_TYPE'] as $v) { ?>
						<div class="edost_person_type<?=($v['CHECKED'] == 'Y' ? ' edost_person_type_active' : '')?>" onclick="this.children[0].checked = true; submitForm();">
							<input type="radio" id="PERSON_TYPE_<?=$v['ID']?>" name="PERSON_TYPE" value="<?=$v['ID']?>"<?=($v['CHECKED'] == 'Y' ? ' checked="checked"' : '')?>> <label for="PERSON_TYPE_<?=$v['ID']?>"><?=$v['NAME']?></label>
						</div>
<?					} ?>
					<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult['USER_VALS']['PERSON_TYPE_ID']?>">
<?				} else {
					if (intval($arResult['USER_VALS']['PERSON_TYPE_ID']) > 0) { ?>
						<input type="text" name="PERSON_TYPE" value="<?=intval($arResult['USER_VALS']['PERSON_TYPE_ID'])?>">
						<input type="text" name="PERSON_TYPE_OLD" value="<?=intval($arResult['USER_VALS']['PERSON_TYPE_ID'])?>">
<?					} else foreach($arResult['PERSON_TYPE'] as $v) { ?>
						<input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v['ID']?>">
						<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v['ID']?>">
<?					}
				}
				DrawPropHead($mono);
			}

			// �������������� (edost.locations)
			if ($f_key == 'location') {
				$a = ($param['delivery_location'] !== false ? true : false); ?>
				<div>
					<div class="<?=($a ? 'edost_supercompact_hide edost_resize_button edost_change_button2 edost_button_big2' : 'edost_button_big edost_button_big_red edost_button_big_active')?>" onclick="edost_SetTemplateLocation('<?=($a ? 'click' : 'new')?>')">
						<span><?=GetMessage($a ? 'SOA_TEMPL_CHANGE_LOCATION' : 'SOA_TEMPL_SET_LOCATION')?></span>
					</div>
				</div>

				<div id="edost_location_city_template_div" style="display: none;"></div>
<?				$GLOBALS['APPLICATION']->IncludeComponent('edost:locations', '', array('MODE' => 'city') + $param['edost_locations'], null, array('HIDE_ICONS' => 'Y'));

				if ($a) { ?>
				<div class="edost_resize_button2 edost_supercompact_hide">
					<div class="edost_change_button edost_button_big2" onclick="edost_SetTemplateLocation('click')">
						<span><?=GetMessage('SOA_TEMPL_CHANGE_LOCATION')?></span>
					</div>
				</div>
<?				}
			}

			// ����� (edost.locations)
			if ($f_key == 'address') {
				DrawPropHead($mono, GetMessage('SOA_TEMPL_ADDRESS_HEAD'), true, $hide, '', 25);
				echo '<div class="edost_prop_error"></div>';
				$GLOBALS['APPLICATION']->IncludeComponent('edost:locations', '', array('MODE' => 'address') + $param['edost_locations'], null, array('HIDE_ICONS' => 'Y'));
				DrawPropHead($mono);
			}

			// ���������� ������ (edost.locations)
			if ($f_key == 'passport') {
				DrawPropHead($mono, GetMessage('SOA_TEMPL_PASSPORT_HEAD'), true, $hide, 'edost_location_passport_div_main', 15);
				echo '<div class="edost_prop_error"></div>';
				$GLOBALS['APPLICATION']->IncludeComponent('edost:locations', '', array('MODE' => 'passport') + $param['edost_locations'], null, array('HIDE_ICONS' => 'Y'));
				echo '<div style="font-size: 13px; color: #800; padding-top: 5px;">'.GetMessage('SOA_TEMPL_PASSPORT_WARNING').'</div>';
				DrawPropHead($mono);
			}

			// ����������� � ������
			if ($f_key == 'comment') {
				DrawPropHead($mono, GetMessage('SOA_TEMPL_SUM_COMMENTS'), false, false, '', 0);
				echo '<textarea name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION" style="width: 100%; max-width: 100%; min-height: 120px;" '.($preload_prop ? 'onchange="submitProp(this)"' : '').'>'.$arResult['USER_VALS']['ORDER_DESCRIPTION'].'</textarea>';
				DrawPropHead($mono);
			}

			$zip_warning = (empty($arResult['edost']['locations_installed']) && !empty($arResult['edost']['format']['warning']) ? $arResult['edost']['format']['warning'] : false);
			if (!empty($arSource)) foreach ($arSource as $v) {
				if (!empty($param['disable']) && in_array($v['CODE'], $param['disable'])) continue;
				if (!empty($param['enable']) && !in_array($v['CODE'], $param['enable'])) continue;

				$top = false;
				if ($v['TYPE'] == 'TEXTAREA') $top = 0;
				if ($v['IS_ZIP'] == 'Y' && $zip_warning) $top = 5;
				if ($v['TYPE'] == 'LOCATION') $top = 9;
				DrawPropHead($mono, $v['NAME'], $v['REQUIED_FORMATED'], false, '', $top, $v['TYPE'] == 'LOCATION' ? 'bitrix_location' : '');

				if ($v['TYPE'] == 'CHECKBOX') { ?>
					<input type="hidden" name="<?=$v['FIELD_NAME']?>" value="">
					<input type="checkbox" name="<?=$v['FIELD_NAME']?>" id="<?=$v['FIELD_NAME']?>" value="Y"<?=($v['CHECKED']=='Y' ? ' checked' : '')?>>
<?				}
				else if ($v['TYPE'] == 'TEXT') {
					$a = ($v['IS_ZIP'] == 'Y' && empty($arResult['edost']['locations_installed']) ? true : false);
					if ($a && isset($arResult['edost']['location']['country']) && in_array($arResult['edost']['location']['country'], array(0, 85, 21, 14, 108))) $v['inputmode'] = 'numeric';
					DrawInput($v, false, $a, $preload_prop);
					if ($v['IS_ZIP'] == 'Y' && $zip_warning) echo '<div class="edost_warning" style="padding-top: 2px;">'.$zip_warning.'</div>';
				}
				else if ($v['TYPE'] == 'SELECT') { ?>
					<select name="<?=$v['FIELD_NAME']?>" id="<?=$v['FIELD_NAME']?>" size="<?=$v['SIZE1']?>">
<?						foreach($v['VARIANTS'] as $arVariants) { ?>
							<option value="<?=$arVariants['VALUE']?>"<?=($arVariants['SELECTED'] == 'Y' ? ' selected' : '')?>><?=$arVariants['NAME']?></option>
<?						} ?>
					</select>
<?				}
				else if ($v['TYPE'] == 'MULTISELECT') { ?>
					<select multiple name="<?=$v['FIELD_NAME']?>" id="<?=$v['FIELD_NAME']?>" size="<?=$v['SIZE1']?>">
<?						foreach($v["VARIANTS"] as $arVariants) { ?>
							<option value="<?=$arVariants['VALUE']?>"<?=($arVariants['SELECTED'] == 'Y' ? ' selected' : '')?>><?=$arVariants['NAME']?></option>
<?						} ?>
					</select>
<?  			}
				else if ($v['TYPE'] == 'TEXTAREA') {
					$rows = ($v['SIZE2'] > 10) ? 4 : $v['SIZE2']; ?>
					<textarea rows="<?=$rows?>" cols="<?=$v['SIZE1']?>" name="<?=$v['FIELD_NAME']?>" id="<?=$v['FIELD_NAME']?>" <?=($preload_prop ? 'onchange="submitProp(this)"' : '')?>><?=$v['VALUE']?></textarea>
<?				}
				else if ($v['TYPE'] == 'DATE') { ?>
					<input type="text" name="<?=$v['FIELD_NAME']?>" id="<?=$v['FIELD_NAME']?>" value="<?=$v['VALUE']?>" readonly onclick="BX.calendar({node:this, field:'<?=$v['FIELD_NAME']?>', form:'', bTime:false, bHideTime:false});">
<?				}
				else if ($v['TYPE'] == 'LOCATION') {
					$value = 0;
					if (is_array($v['VARIANTS']) && count($v['VARIANTS']) > 0) foreach ($v['VARIANTS'] as $arVariant) if ($arVariant['SELECTED'] == 'Y') { $value = $arVariant['ID']; break; }

					$locationTemplateP = $locationTemplate == 'popup' ? 'search' : 'steps';
					$locationTemplateP = $_REQUEST['PERMANENT_MODE_STEPS'] == 1 ? 'steps' : $locationTemplateP;

					if ($locationTemplateP == 'steps') { ?>
						<input type="hidden" id="LOCATION_ALT_PROP_DISPLAY_MANUAL[<?=intval($v['ID'])?>]" name="LOCATION_ALT_PROP_DISPLAY_MANUAL[<?=intval($v['ID'])?>]" value="<?=($_REQUEST['LOCATION_ALT_PROP_DISPLAY_MANUAL'][intval($v['ID'])] ? '1' : '0')?>" />
<?					} ?>

<?					CSaleLocation::proxySaleAjaxLocationsComponent(array(
						'AJAX_CALL' => 'N',
						'COUNTRY_INPUT_NAME' => 'COUNTRY',
						'REGION_INPUT_NAME' => 'REGION',
						'CITY_INPUT_NAME' => $v['FIELD_NAME'],
						'CITY_OUT_LOCATION' => 'Y',
						'LOCATION_VALUE' => $value,
						'ORDER_PROPS_ID' => $v['ID'],
						'ONCITYCHANGE' => ($v['IS_LOCATION'] == 'Y' || $v['IS_LOCATION4TAX'] == 'Y') ? 'submitForm()' : '',
						'SIZE1' => $v['SIZE1'],
					),
					array(
						'ID' => $value,
						'CODE' => '',
						'SHOW_DEFAULT_LOCATIONS' => 'Y',
						'JS_CALLBACK' => 'submitFormProxy',
						'JS_CONTROL_DEFERRED_INIT' => intval($v['ID']),
						'JS_CONTROL_GLOBAL_ID' => intval($v['ID']),
						'DISABLE_KEYBOARD_INPUT' => 'Y',
						'PRECACHE_LAST_LEVEL' => 'Y',
						'PRESELECT_TREE_TRUNK' => 'Y',
						'SUPPRESS_ERRORS' => 'Y'
					),
					$locationTemplateP, true, 'location-block-wrapper');

					if (strlen(trim($v['DESCRIPTION'])) > 0) { ?>
						<div class="bx_description"><?=$v['DESCRIPTION']?></div>
<?					}
				}
				elseif ($v['TYPE'] == 'RADIO') {
					if (is_array($v['VARIANTS'])) foreach($v['VARIANTS'] as $arVariants) { ?>
						<input type="radio" name="<?=$v['FIELD_NAME']?>" id="<?=$v['FIELD_NAME']?>_<?=$arVariants['VALUE']?>" value="<?=$arVariants['VALUE']?>" <?=($arVariants['CHECKED'] == 'Y' ? ' checked' : '')?>>
						<label for="<?=$v['FIELD_NAME']?>_<?=$arVariants['VALUE']?>"><?=$arVariants['NAME']?></label><br>
<?					}
				}
				else if ($v['TYPE'] == 'FILE') {
					$s = '';
					$name = 'ORDER_PROP_'.$v['ID'];
					if ($v['MULTIPLE'] == 'N') {
						$s = "<label for=\"\"><input type=\"file\" size=\"".$v["SIZE1"]."\" value=\"".$v["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
					}
					else {
						$s = '
						<script type="text/javascript">
							function addControl(item) {
								var current_name = item.id.split("[")[0],
									current_id = item.id.split("[")[1].replace("[", "").replace("]", ""),
									next_id = parseInt(current_id) + 1;

								var newInput = document.createElement("input");
								newInput.type = "file";
								newInput.name = current_name + "[" + next_id + "]";
								newInput.id = current_name + "[" + next_id + "]";
								newInput.onchange = function() { addControl(this); };

								var br = document.createElement("br");
								var br2 = document.createElement("br");

								BX(item.id).parentNode.appendChild(br);
								BX(item.id).parentNode.appendChild(br2);
								BX(item.id).parentNode.appendChild(newInput);
							}
						</script>
						';

						$s .= "<label for=\"\"><input type=\"file\" size=\"".$v["SIZE1"]."\" value=\"".$v["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
						$s .= "<br/><br/>";
						$s .= "<label for=\"\"><input type=\"file\" size=\"".$v["SIZE1"]."\" value=\"".$v["VALUE"]."\" name=\"".$name."[1]\" id=\"".$name."[1]\" onChange=\"javascript:addControl(this);\"></label>";
					}
					echo $s;
				}

				DrawPropHead($mono);

				if (empty($param['edost_locations'])) if ($v['TYPE'] == 'LOCATION' || intval($v['IS_ALTERNATE_LOCATION_FOR']) || intval($v['CAN_HAVE_ALTERNATE_LOCATION']) || $v['IS_ZIP'] == 'Y') {
					$propertyAttributes = array('type' => $v['TYPE'], 'valueSource' => $v['SOURCE'] == 'DEFAULT' ? 'default' : 'form');

					if(intval($v['IS_ALTERNATE_LOCATION_FOR'])) $propertyAttributes['isAltLocationFor'] = intval($v['IS_ALTERNATE_LOCATION_FOR']);
					if(intval($v['CAN_HAVE_ALTERNATE_LOCATION'])) $propertyAttributes['altLocationPropId'] = intval($v['CAN_HAVE_ALTERNATE_LOCATION']);
					if($v['IS_ZIP'] == 'Y') $propertyAttributes['isZip'] = true;
?>
					<script>
						(window.top.BX || BX).saleOrderAjax.addPropertyDesc(<?=CUtil::PhpToJSObject(array('id' => intval($v['ID']), 'attributes' => $propertyAttributes))?>);
					</script>
<?				}

			}
	    }

?>
	</div>
</div>
<?

	}
}
?>