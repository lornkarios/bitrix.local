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
<div class="container">
    <div class="news-detail">
        <h3 style="margin-top: 50px;margin-bottom: 25px">
            <?= $arResult["NAME"] ?>
        </h3>


        <div class="mb-1 text-muted">
            <?= $arResult["DISPLAY_ACTIVE_FROM"] ?>
        </div>


        <div class="row">
            <?php foreach ($arResult['rubrics'] as $rubric): ?>
                <div class="col-2">
                    <span class="badge badge-info" style="width: 100px">
                        <a href="/rubrics/<?= $rubric['CODE'] ?>/" style="color:white;text-decoration: none;">
                            <?= $rubric['NAME'] ?>
                        </a>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>


        <img
                border="0"
                src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                width="100%"
                height="auto"
                alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
        />


        <div class="bg-white shadow-sm mx-auto" style="width: 100%;border-radius: 21px 21px 0 0; padding: 50px">
            <?= $arResult["DETAIL_TEXT"] ?>
        </div>

        <br/>

    </div>
</div>
