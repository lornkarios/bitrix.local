<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
/**
 * @var array $arResult
 */
?>
<div class="container">
    <form method="get" name="form">
        <div class="no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
             style="padding: 20px;margin-top: 70px">
            <div class="row">
                <?php if ($arResult['filterMode'] == "Y"): ?>
                    <div class="col-5">
                        <label for="inputState">Рубрика</label>
                        <select id="inputState" class="form-control" name="rubric">
                            <option <?php if ($arResult['tsection'] == '') {
                                echo "selected";
                            } ?> value="">Выберите...
                            </option>
                            <?php foreach ($arResult['rubrics'] as $rubric): ?>
                                <option <?php if ($arResult['tsection'] == $rubric['CODE']) {
                                    echo "selected";
                                } ?> value='<?= $rubric['CODE'] ?>'><?= $rubric['NAME'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="col-5">
                    <label for="inputState">Сортировка</label>
                    <select id="inputState" class="form-control" name="sort">
                        <option <?php if (($arResult['tsort'] == 'new') || ($arResult['tsort'] == '')) {
                            echo "selected";
                        } ?> value="new">По хронологии, сначала свежие
                        </option>
                        <option <?php if ($arResult['tsort'] == 'old') {
                            echo "selected";
                        } ?> value="old">По хронологии, сначала старые
                        </option>
                        <option <?php if ($arResult['tsort'] == 'popular') {
                            echo "selected";
                        } ?> value="popular">По популярности, сначала популярные
                        </option>
                        <option <?php if ($arResult['tsort'] == 'unpopular') {
                            echo "selected";
                        } ?> value="unpopular">По популярности, сначала не популярные
                        </option>
                    </select>
                </div>
                <div class="col-2" style="margin:auto;margin-bottom: 0px">
                    <button type="submit" class="btn btn-primary">Применить</button>
                </div>
            </div>
        </div>
    </form>
</div>
