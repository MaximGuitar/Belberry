<?php
define("ERROR_404", "Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

CHTTP::SetStatus("404 Not Found");
$APPLICATION->SetTitle("404 - Котик потерялся!");


?>

<div class="page-404">
    <div class="page-404__container">
        <h1 class="page-404__title">404</h1>
        
        <div class="page-404__message">
            <p>Котик не нашёл эту страничку...</p>
            <p>Но нашёл много вкусных печенек! 🍪</p>
        </div>
        
        <img src="<?=SITE_TEMPLATE_PATH?>/img/cat-404.gif" alt="Грустный котик" class="page-404__image">
        
        <div class="page-404__actions">
            <a href="/" class="page-404__button">
                Вернуться на главную
            </a>
        </div>
        
        <div class="page-404__tips">
            <p>Попробуйте:</p>
            <ul class="page-404__tips-list">
                <li>• Проверить адрес на опечатки</li>
                <li>• Поискать нужное через меню</li>
                <li>• Угостить котика сметанкой</li>
            </ul>
        </div>
    </div>
</div>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>