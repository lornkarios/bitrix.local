<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Рубрики");

$APPLICATION->IncludeComponent(
    "bitrix:breadcrumb",
    "myTemplate",
    [
        "PATH" => "",
        "SITE_ID" => "s1",
        "START_FROM" => "0"
    ]
);
?>
    <div class="container" style="padding-top: 30px">
        <h1 style="margin-bottom: 50px">Рубрики</h1>
    </div>
<?php
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "myTemplate",
    [
        "ADD_SECTIONS_CHAIN" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COUNT_ELEMENTS" => "Y",
        "IBLOCK_ID" => "9",
        "IBLOCK_TYPE" => "news",
        "SECTION_CODE" => "",
        "SECTION_FIELDS" => array("", ""),
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => array("", ""),
        "SHOW_PARENT_NAME" => "Y",
        "TOP_DEPTH" => "2",
        "VIEW_MODE" => "LINE"
    ]
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
