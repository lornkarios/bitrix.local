<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arCurrentValues */

if (!CModule::IncludeModule("iblock"))
    return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(array("-" => " "));

$arIBlocks = array();
$db_iblock = CIBlock::GetList(array("SORT" => "ASC"), array("SITE_ID" => $_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"] != "-" ? $arCurrentValues["IBLOCK_TYPE"] : "")));
while ($arRes = $db_iblock->Fetch())
    $arIBlocks[$arRes["ID"]] = "[" . $arRes["ID"] . "] " . $arRes["NAME"];

$site = ($_REQUEST["site"] <> '' ? $_REQUEST["site"] : ($_REQUEST["src_site"] <> '' ? $_REQUEST["src_site"] : false));
$arFilter = Array("TYPE_ID" => "FEEDBACK_FORM", "ACTIVE" => "Y");
if ($site !== false)
    $arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList($by = "ID", $order = "DESC", $arFilter);
while ($arType = $dbType->GetNext())
    $arEvent[$arType["ID"]] = "[" . $arType["ID"] . "] " . $arType["SUBJECT"];

$arComponentParameters = array(
    "PARAMETERS" => array(
        "IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => "Тип информационного блока",
            "TYPE" => "LIST",
            "VALUES" => $arTypesEx,
            "DEFAULT" => "news",
            "REFRESH" => "Y",
        ),
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => "Код информационного блока",
            "TYPE" => "LIST",
            "VALUES" => $arIBlocks,
            "DEFAULT" => '={$_REQUEST["ID"]}',
            "ADDITIONAL_VALUES" => "Y",
            "REFRESH" => "Y",
        ),
        "USE_CAPTCHA" => Array(
            "NAME" => "Капча",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
            "PARENT" => "BASE",
        ),
        "OK_TEXT" => Array(
            "NAME" => "Текст при успешной отправке",
            "TYPE" => "STRING",
            "DEFAULT" => "Успешно отправлено",
            "PARENT" => "BASE",
        ),
        "EMAIL_TO" => Array(
            "NAME" => "Email получателя",
            "TYPE" => "STRING",
            "DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")),
            "PARENT" => "BASE",
        ),
        "REQUIRED_FIELDS" => Array(
            "NAME" => "Поля, которые необходимо заполнить",
            "TYPE" => "LIST",
            "MULTIPLE" => "Y",
            "VALUES" => Array("NONE" => "Все", "NAME" => "Имя", "EMAIL" => "E-mail", "MESSAGE" => "сообщение"),
            "DEFAULT" => "",
            "COLS" => 25,
            "PARENT" => "BASE",
        ),

        "EVENT_MESSAGE_ID" => Array(
            "NAME" => "Срабатываемое событие",
            "TYPE" => "LIST",
            "VALUES" => $arEvent,
            "DEFAULT" => "",
            "MULTIPLE" => "Y",
            "COLS" => 25,
            "PARENT" => "BASE",
        ),

    )
);
