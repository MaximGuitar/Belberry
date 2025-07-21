<?
    define('NEWS_IBLOCK_ID', 1);
    
    AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "autoCalculateReadTime");
    AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "autoCalculateReadTime");

    /**
     * Автоматически рассчитывает время чтения для элементов конкретного инфоблока
     * @param array &$arFields - массив полей элемента
     */
    function autoCalculateReadTime(&$arFields) {

        if ($arFields["IBLOCK_ID"] == NEWS_IBLOCK_ID) {
            // Получаем текст
            $text = $arFields["DETAIL_TEXT"] ?? '';
                  
            if (($text)) {
                $cleanText = trim(strip_tags($text));
                $cleanText = preg_replace('/\s+/', ' ', $cleanText);
                $wordCount = count(preg_split('/\s+/u', $cleanText, -1, PREG_SPLIT_NO_EMPTY));
                $minutes = max(1, ceil($wordCount / 180)); // Минимум 1 минута
                $arFields["PROPERTY_VALUES"]["TIME_TO_READ"] = $minutes;
                
            }
        }
    }

?>