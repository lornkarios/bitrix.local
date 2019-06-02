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

?>


<div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php $GLOBALS['firstElem'] = true;
            $GLOBALS['elemNum'] = 0 ?>
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <li data-target="#carouselExampleCaptions" data-slide-to="<?= $GLOBALS['elemNum'] ?>"
                    <?php if ($GLOBALS['firstElem']) {
                        echo "class='active'";
                        $GLOBALS['firstElem'] = false;
                    } ?>></li>
                <?php $GLOBALS['elemNum']++ ?>
            <?php endforeach ?>
        </ol>
        <div class="carousel-inner">


            <?php $GLOBALS['firstElem'] = true ?>
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>

                <?php
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>


                <div class="carousel-item <?php if ($GLOBALS['firstElem']) {
                    echo "active";
                    $GLOBALS['firstElem'] = false;
                } ?>">

                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                        <img
                                class="w-100"
                                border="0"
                                src="<?= $arItem['resize_image']["SRC"] ?>"
                                alt="<?= $arItem['resize_image']["ALT"] ?>"
                                title="<?= $arItem['resize_image']["TITLE"] ?>"
                                style="filter: blur(1px) invert(0.3);"
                        />
                    </a>

                    <div class="carousel-caption d-none d-md-block">
                        <h1>

                            <a
                                    href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
                                    style="color:white;text-decoration: none;"
                            >
                                <?= $arItem["NAME"] ?>
                            </a>

                        </h1>
                        <hr color="white">
                        <p style="color:white">

                            <?= $arItem["PREVIEW_TEXT"]; ?>

                        </p>
                        <a class="btn btn-primary btn-lg" href="<?= $arItem["DETAIL_PAGE_URL"] ?>" role="button">Узнать
                            больше</a>
                    </div>
                </div>


            <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
