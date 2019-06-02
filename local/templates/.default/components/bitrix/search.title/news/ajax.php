<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult["CATEGORIES"])):?>

    <table class="table table-hover" style="background-color: white;width: 400px">

        <tbody>

        <?php foreach ($arResult["CATEGORIES"] as $category_id => $arCategory):?>
            <?php foreach ($arCategory["ITEMS"] as $i => $arItem):?>
                <tr>

                    <td>
                        <?php if ($category_id === "all"):?>
                            <a style="color:black;text-decoration: none;" href="<?= $arItem["URL"] ?>">
                                <?= $arItem["NAME"] ?>
                            </a>
                        <?php elseif (isset($arItem["ICON"])): ?>
                            <a style="color:black;text-decoration: none;" href="<?= $arItem["URL"] ?>">
                                <img src="<?= $arItem["ICON"] ?>">
                                <?= $arItem["NAME"] ?>
                            </a>
                        <?php else: ?>
                            <a style="color:black;text-decoration: none;" href="<?= $arItem["URL"] ?>">
                                <?= $arItem["NAME"] ?>
                            </a>
                        <?php endif; ?>
                    </td>

                </tr>

            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="title-search-fader"></div>
<?php endif;
