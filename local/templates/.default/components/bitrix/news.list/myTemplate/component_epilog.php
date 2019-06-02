<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;

if (isset($arResult["SECTION"])) {
    $APPLICATION->AddChainItem($arResult["SECTION"]["PATH"][0]["NAME"], $arResult["SECTION"]["PATH"][0]["SECTION_PAGE_URL"]);
}
