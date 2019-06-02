<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


$groupsBD = CIBlockElement::GetElementGroups($arResult['ID'], true);
$rubrics = [];
while ($ar_Section = $groupsBD->Fetch()) {
    $rubrics[$ar_Section['NAME']] = $ar_Section;
}
$arResult['rubrics'] = $rubrics;
