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
$this->setFrameMode(true); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!--    fixed-top-->
    <a class="navbar-brand" href="/">Новости</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if ((substr_count($_SERVER['REQUEST_URI'], "/about/") == 0) && (substr_count($_SERVER['REQUEST_URI'], "/rubrics/") == 0)) {
                echo "active";
            } ?>">
                <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if (substr_count($_SERVER['REQUEST_URI'], "/about/") > 0) {
                echo "active";
            } ?>">
                <a class="nav-link" href="/about/">Контакты</a>
            </li>
            <li class="nav-item <?php if (substr_count($_SERVER['REQUEST_URI'], "/rubrics/") > 0) {
                echo "active";
            } ?>">
                <a class="nav-link" href="/rubrics/">Рубрики</a>
            </li>
        </ul>

        <?php
        $INPUT_ID = trim($arParams["~INPUT_ID"]);
        if (strlen($INPUT_ID) <= 0)
            $INPUT_ID = "title-search-input";
        $INPUT_ID = CUtil::JSEscape($INPUT_ID);

        $CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
        if (strlen($CONTAINER_ID) <= 0)
            $CONTAINER_ID = "title-search";
        $CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

        if ($arParams["SHOW_INPUT"] !== "N"):?>
            <div id="<?= $CONTAINER_ID ?>">
                <form class="form-inline my-2 my-lg-0" action="<?= $arResult["FORM_ACTION"] ?>">
                    <input
                            class="form-control mr-sm-2"
                            id="<?= $INPUT_ID ?>"
                            type="text"
                            name="q"
                            value=""
                            size="40"
                            maxlength="50"
                            autocomplete="off"
                            aria-label="Search"
                            style="width: 400px"
                            placeholder="Введите название новости..."
                    >
                    <button name="s" class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
                </form>
            </div>
        <?php endif ?>
    </div>
</nav>
<script>
    BX.ready(function () {
        new JCTitleSearch({
            'AJAX_PAGE': '<?= CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
            'CONTAINER_ID': '<?= $CONTAINER_ID?>',
            'INPUT_ID': '<?= $INPUT_ID?>',
            'MIN_QUERY_LEN': 2
        });

    });
</script>
