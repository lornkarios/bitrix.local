<?php if ($_SERVER['DOCUMENT_URI'] == "/404.php") {
    $_SERVER['REQUEST_URI'] = $_SERVER['DOCUMENT_URI'];
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("404 страница не найдена");
?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container"">
        <h1 class="display-4 " style="text-align: center">404</h1>
        <p class="lead" style="text-align: center">Такой страницы не существует(((</p>

    </div>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
