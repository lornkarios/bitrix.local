<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
foreach ($arResult["ITEMS"] as $key => $arItem) {

    $image = [];

    $file = CFile::ResizeImageGet(
        $arItem["DETAIL_PICTURE"],
        array('width' => 1920, 'height' => 500),
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
