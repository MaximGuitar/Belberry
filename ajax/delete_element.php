<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die(json_encode(['success' => false, 'error' => 'Bitrix not initialized']));
}

if (!CModule::IncludeModule('iblock')) {
    die(json_encode(['success' => false, 'error' => 'IBlock module not available']));
}

header('Content-Type: application/json');

$elementId = (int)($_POST['element_id'] ?? 0);
$iblockId = (int)($_POST['iblock_id'] ?? 0);

if ($elementId <= 0 || $iblockId <= 0) {
    die(json_encode(['success' => false, 'error' => 'Неверные параметры']));
}

// Проверяем права на удаление
if (!CIBlockElement::Delete($elementId)) {
    $error = 'Ошибка удаления: ' . $APPLICATION->GetException()->GetString();
    die(json_encode(['success' => false, 'error' => $error]));
}

die(json_encode(['success' => true]));