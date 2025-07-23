<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult['ITEMS'] as &$arItem) {
    var_dump($arItem["PRICES"]["base-price"]);
    // var_dump($arItem['PROPERTIES']['CUSTOM_PRICE']['VALUE']);
    // Обработка CUSTOM_PRICE
    if(isset($arItem['PROPERTIES']['CUSTOM_PRICE']['VALUE'])) {
        var_dump($price);
        $price = (int)$arItem['PROPERTIES']['CUSTOM_PRICE']['VALUE'];
        $arItem["PRICES"]["base-price"]['VALUE']=1;
          $arItem["PRICES"]["base-price"] ["PRINT_VALUE_NOVAT"]=1;
        
    }
    var_dump($arItem["PRICES"]["base-price"]);
        var_dump($arItem["PRICES"]["base-price"]);
}
unset($arItem);
?>