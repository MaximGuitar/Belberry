<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

// Проверяем что Bitrix корректно подключился
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die(json_encode(['success' => false, 'error' => 'Bitrix not initialized']));
}

// Подключаем модуль инфоблоков
if (!CModule::IncludeModule('iblock')) {
    die(json_encode(['success' => false, 'error' => 'IBlock module not available']));
}


// Проверяем параметры
$elementId = (int)($_POST['element_id'] ?? 0);
$iblockId = (int)($_POST['iblock_id'] ?? 0);

if ($elementId <= 0 || $iblockId <= 0) {
    die(json_encode(['success' => false, 'error' => 'Invalid parameters']));
}

try {
    // Получаем текущее значение свойства
    $currentValue = 0;
    $res = CIBlockElement::GetProperty($iblockId, $elementId, [], ['CODE' => 'AJAX_CLICK']);
    if ($prop = $res->Fetch()) {
        $currentValue = (int)$prop['VALUE'];
    }

    // Увеличиваем значение
    $newValue = $currentValue + 1;

    // Обновляем свойство
    CIBlockElement::SetPropertyValuesEx($elementId, $iblockId, ['AJAX_CLICK' => $newValue]);

    // Возвращаем ответ
    echo json_encode([
        'success' => true,
        'new_value' => $newValue
    ]);
    
} catch (Exception $e) {
    die(json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]));
}