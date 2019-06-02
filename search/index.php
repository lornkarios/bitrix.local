<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");


$APPLICATION->IncludeComponent(
    "bitrix:search.page",
    "news",
    Array(
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "COLOR_NEW" => "000000",
        "COLOR_OLD" => "C8C8C8",
        "COLOR_TYPE" => "Y",
        "DEFAULT_SORT" => "rank",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "FILTER_NAME" => "",
        "FONT_MAX" => "50",
        "FONT_MIN" => "10",
        "NO_WORD_LOGIC" => "N",
        "PAGER_SHOW_ALWAYS" => "Y",
        "PAGER_TEMPLATE" => "myTemplate",
        "PAGER_TITLE" => "Результаты поиска",
        "PAGE_RESULT_COUNT" => "4",
        "PATH_TO_USER_PROFILE" => "#SITE_DIR#people/user/#USER_ID#/",
        "PERIOD_NEW_TAGS" => "",
        "RESTART" => "Y",
        "SHOW_CHAIN" => "Y",
        "SHOW_RATING" => "Y",
        "SHOW_WHEN" => "N",
        "SHOW_WHERE" => "Y",
        "TAGS_INHERIT" => "Y",
        "TAGS_PAGE_ELEMENTS" => "20",
        "TAGS_PERIOD" => "",
        "TAGS_SORT" => "NAME",
        "TAGS_URL_SEARCH" => "",
        "USE_LANGUAGE_GUESS" => "Y",
        "USE_TITLE_RANK" => "N",
        "WIDTH" => "100%",
        "arrFILTER" => array("iblock_news"),
        "arrFILTER_iblock_news" => array("9"),
        "arrWHERE" => array("iblock_news")
    )
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
