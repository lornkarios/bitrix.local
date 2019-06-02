<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
foreach ($arResult["ITEMS"] as $key => $arItem) {

    $groupsBD = CIBlockElement::GetElementGroups($arItem['ID'], true);
    $rubrics = [];
    while ($ar_Section = $groupsBD->Fetch()) {
        $rubrics[$ar_Section['NAME']] = $ar_Section;
    }
    $arResult["ITEMS"][$key]['rubrics'] = $rubrics;

    $image = [];

    $file = CFile::ResizeImageGet(
        $arItem["DETAIL_PICTURE"],
        array('width' => 300, 'height' => 300),
        BX_RESIZE_IMAGE_EXACT,
        true
    );

    $image["SRC"] = $file['src'];
    $image["WIDTH"] = $file['WIDTH'];
    $image["HEIGHT"] = $file['HEIGHT'];
    $image["ALT"] = $arItem["DETAIL_PICTURE"]["ALT"];
    $image["TITLE"] = $arItem["DETAIL_PICTURE"]["TITLE"];
    $arResult["ITEMS"][$key]['resize_image'] = $image;
}
