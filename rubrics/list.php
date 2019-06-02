<?php
use NewsProject\Helpers\FilterHelper;

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

$APPLICATION->IncludeComponent(
    "first_kill:news.filter",
    "",
    [
        "IBLOCK_ID" => "9",
        "IBLOCK_TYPE" => "news",
        "SECTION_ID" => $_REQUEST["rubric"],
        "SORT_CODE" => $_REQUEST["sort"],
        "SECTIONMODE" => "N"
    ]
);

$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "myTemplate",
    [
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "/#CODE#/",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("DETAIL_PICTURE", ""),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "9",
        "IBLOCK_TYPE" => "news",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "3",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "myTemplate",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => $_REQUEST["rubric"],
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("", ""),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "Y",
        "SHOW_404" => "Y",
        "SORT_BY1" => FilterHelper::getSort($_REQUEST["sort"])[0],
        "SORT_BY2" => "",
        "SORT_ORDER1" => FilterHelper::getSort($_REQUEST["sort"])[1],
        "SORT_ORDER2" => "",
        "STRICT_SECTION_CHECK" => "Y"
    ]
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
