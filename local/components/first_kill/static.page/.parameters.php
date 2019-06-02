<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arCurrentValues */

if (!CModule::IncludeModule("iblock"))
    return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(array("-" => " "));

$arIBlocks = array();
$db_iblock = CIBlock::GetList(
    array("SORT" => "ASC"),
    array(
        "SITE_ID" => $_REQUEST["site"],
        "TYPE" => ($arCurrentValues["IBLOCK_TYPE"] != "-" ? $arCurrentValues["IBLOCK_TYPE"] : "")
    )
);

while ($arRes = $db_iblock->Fetch())
    $arIBlocks[$arRes["ID"]] = "[" . $arRes["ID"] . "] " . $arRes["NAME"];

$arSorts = array(
    "ASC" => GetMessage("T_IBLOCK_DESC_ASC"),
    "DESC" => GetMessage("T_IBLOCK_DESC_DESC")
);


$arSortFields = array(
    "ID" => GetMessage("T_IBLOCK_DESC_FID"),
    "NAME" => GetMessage("T_IBLOCK_DESC_FNAME"),
    "ACTIVE_FROM" => GetMessage("T_IBLOCK_DESC_FACT"),
    "SORT" => GetMessage("T_IBLOCK_DESC_FSORT"),
    "TIMESTAMP_X" => GetMessage("T_IBLOCK_DESC_FTSAMP")
);

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(
    array(
        "sort" => "asc",
        "name" => "asc"
    ),
    array(
        "ACTIVE" => "Y",
        "IBLOCK_ID" => (isset($arCurrentValues["IBLOCK_ID"]) ? $arCurrentValues["IBLOCK_ID"] : $arCurrentValues["ID"])
    )
);


while ($arr = $rsProp->Fetch()) {
    $arProperty[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
    if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S"))) {
        $arProperty_LNS[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
    }
}

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(

        "IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => "Тип информационного блока",
            "TYPE" => "LIST",
            "VALUES" => $arTypesEx,
            "DEFAULT" => "news",
            "REFRESH" => "Y",
        ),

        "SET_TITLE" => array(),

        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => "Код информационного блока",
            "TYPE" => "LIST",
            "VALUES" => $arIBlocks,
            "DEFAULT" => '={$_REQUEST["ID"]}',
            "ADDITIONAL_VALUES" => "Y",
            "REFRESH" => "Y",
        ),

        "ELEMENT_ID" => array(
            "PARENT" => "BASE",
            "NAME" => "Код элемента",
            "TYPE" => "String",
            "MULTIPLE" => "N",
            "DEFAULT" => "288",
        ),
    ),
);
