<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
?>
<html>

<head>
	<? $APPLICATION->ShowHead(); ?>
	<title><? $APPLICATION->ShowTitle() ?></title>
	<? $assets = \Bitrix\Main\Page\Asset::getInstance();
	$assets->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
	$assets->addJs(SITE_TEMPLATE_PATH . '/js/main.js');
	?>
</head>


<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#FFFFFF">

	<? $APPLICATION->ShowPanel() ?>

	<? if ($USER->IsAdmin()): ?>


	<? endif ?>

	<header>
		<? $APPLICATION->IncludeComponent(
			"bitrix:menu",
			"bootstrap_v4",
			array(
				"ALLOW_MULTI_SELECT" => "N",
				"CHILD_MENU_TYPE" => "top",
				"DELAY" => "N",
				"MAX_LEVEL" => "1",
				"MENU_CACHE_GET_VARS" => array(),
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_TYPE" => "A",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"MENU_THEME" => "site",
				"ROOT_MENU_TYPE" => "left",
				"USE_EXT" => "Y",
				"COMPONENT_TEMPLATE" => "bootstrap_v4"
			),
			false
		); ?>

	</header>