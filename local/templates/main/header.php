<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html class="h-100">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php $APPLICATION->ShowHead()?>
    <title><?php $APPLICATION->ShowTitle()?></title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/local/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

</head>

<body class="d-flex flex-column h-100">
<main role="main" class="flex-shrink-0 " style="padding-bottom:60px;">
<div id="panel">
    <?php $APPLICATION->ShowPanel();?>
</div>


<?php $APPLICATION->IncludeComponent(
    "bitrix:search.title",
    "news",
    [
        "CATEGORY_0" => array("iblock_news"),
        "CATEGORY_0_TITLE" => "",
        "CATEGORY_0_iblock_news" => array("9"),
        "CHECK_DATES" => "N",
        "CONTAINER_ID" => "title-search",
        "INPUT_ID" => "title-search-input",
        "NUM_CATEGORIES" => "3",
        "ORDER" => "date",
        "PAGE" => "#SITE_DIR#search/index.php",
        "SHOW_INPUT" => "Y",
        "SHOW_OTHERS" => "N",
        "TOP_COUNT" => "5",
        "USE_LANGUAGE_GUESS" => "Y"
    ]
);
