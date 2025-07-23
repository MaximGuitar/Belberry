<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
//А ПОЧ НЕ РАБОТАЕТ ТО..

foreach($arResult['ITEMS'] as &$arItem) {
    if(isset($arItem['PROPERTIES']['CUSTOM_PRICE']['VALUE']) && $arItem['PROPERTIES']['CUSTOM_PRICE']['VALUE'] > 0) {
        $customPrice = (float)$arItem['PROPERTIES']['CUSTOM_PRICE']['VALUE'];
        
        // Меняем все поля связанные с ценой
        $arItem["PRICES"]["base-price"]['VALUE'] = $customPrice;
        $arItem["PRICES"]["base-price"]['PRINT_VALUE'] = CurrencyFormat($customPrice, $arItem["PRICES"]["base-price"]['CURRENCY']);
        $arItem["PRICES"]["base-price"]['VALUE_NOVAT'] = $customPrice;
        $arItem["PRICES"]["base-price"]['PRINT_VALUE_NOVAT'] = CurrencyFormat($customPrice, $arItem["PRICES"]["base-price"]['CURRENCY']);
        $arItem["PRICES"]["base-price"]['DISCOUNT_VALUE'] = $customPrice;
        $arItem["PRICES"]["base-price"]['PRINT_DISCOUNT_VALUE'] = CurrencyFormat($customPrice, $arItem["PRICES"]["base-price"]['CURRENCY']);
        
        // Также меняем MIN_PRICE если он есть
        if(isset($arItem['MIN_PRICE'])) {
            $arItem['MIN_PRICE']['VALUE'] = $customPrice;
            $arItem['MIN_PRICE']['PRINT_VALUE'] = CurrencyFormat($customPrice, $arItem['MIN_PRICE']['CURRENCY']);
        }
        
        // Для правильного отображения в шаблоне
        $arItem['ITEM_PRICES'][] = $arItem["PRICES"]["base-price"];
    
    }
}
unset($arItem);
?>