<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>

<div style="width:350px;margin:auto;margin-bottom: 100px">
    <nav aria-label="...">
        <ul class="pagination">
            <?php if ($arResult["NavPageNomer"] > 1): ?>

                <?php if ($arResult["bSavePage"]): ?>

                    <li class="page-item">
                        <a class="page-link"
                           href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("nav_prev") ?></a>
                    </li>

                <?php else: ?>


                    <?php if ($arResult["NavPageNomer"] > 2): ?>
                        <li class="page-item">
                            <a class="page-link"
                               href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("nav_prev") ?></a>
                        </li>
                    <?php else: ?>
                        <li class="page-item">
                            <a class="page-link"
                               href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= GetMessage("nav_prev") ?></a>
                        </li>
                    <?php endif ?>

                <?php endif ?>

            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link"><?= GetMessage("nav_prev") ?>&nbsp;</span>
                </li>
            <?php endif ?>

            <?php while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>

                <?php if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                    <li class="page-item active" aria-current="page">
                          <span class="page-link">
                            <?= $arResult["nStartPage"] ?>
                            <span class="sr-only">(current)</span>
                          </span>
                    </li>
                <?php elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
                    </li>
                <?php endif ?>
                <?php $arResult["nStartPage"]++ ?>
            <?php endwhile ?>


            <?php if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
                <li class="page-item">
                    <a class="page-link"
                       href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= GetMessage("nav_next") ?></a>&nbsp;
                </li>

            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link"><?= GetMessage("nav_next") ?>&nbsp;&nbsp;</span>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</div>
