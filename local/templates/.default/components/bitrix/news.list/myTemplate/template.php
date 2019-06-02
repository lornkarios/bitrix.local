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

use NewsProject\Helpers\InfoBlockHelper;

?>


<div class="container">
    <h1>
        <?= $arResult["SECTION"]["PATH"][0]["NAME"] ?>
    </h1>

    <?php foreach ($arResult["ITEMS"] as $arItem): ?>

        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>


        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">

                <h3 class="mb-0">
                            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" style="color:black;text-decoration: none;">
                                <?= $arItem["NAME"] ?>
                            </a>
                </h3>
                <div class="mb-1 text-muted">
                        <?= $arItem['ACTIVE_FROM']?>
                </div>
                <p class="mb-auto">

                        <?= $arItem["PREVIEW_TEXT"]; ?>

                </p>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">Продолжить чтение</a>
                <br/>
                <div class="row">
                    <?php foreach ($arItem['rubrics'] as $rubric): ?>
                        <div class="col-2">
                            <span class="badge badge-info" style="width: 100px">
                                <a
                                        href="/rubrics/<?= $rubric['CODE'] ?>/"
                                        style="color:white;text-decoration: none;"
                                >
                                    <?= $rubric['NAME'] ?>
                                </a>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-auto d-none d-lg-block">

                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                            <img

                                    border="0"
                                    src="<?= $arItem["resize_image"]["SRC"] ?>"
                                    width="auto"
                                    height="100%"
                                    alt="<?= $arItem["resize_image"]["ALT"] ?>"
                                    title="<?= $arItem["resize_image"]["TITLE"] ?>"
                                    style=" margin: 0 auto;vertical-align: middle;"
                            />
                        </a>


            </div>


        </div>


    <?php endforeach; ?>
    <?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <?php endif; ?>

</div>
