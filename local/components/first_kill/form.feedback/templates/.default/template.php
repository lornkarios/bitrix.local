<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="col" style="padding-top: 40px;padding-right: 40px">
    <div class="jumbotron" id="myForm">
        <?= $_POST['name'] ?>
        <?php if (strlen($arResult["OK_MESSAGE"]) > 0): ?>
            <div class="alert alert-success" role="alert"><?= $arResult["OK_MESSAGE"] ?></div>
        <? endif ?>

        <form id="mainForm">
            <?= bitrix_sessid_post() ?>
            <div class="form-group">
                <label for="exampleInputName">
                    Имя<?php if (empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])): ?>
                        <span class="mf-req" style="color: red">*</span><?php endif ?>
                </label>
                <input type="text" class="form-control" name="name" id="exampleInputName" value="" maxlength="30" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail">
                    Email<?php if (empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])): ?>
                        <span class="mf-req" style="color: red">*</span><?php endif ?>
                </label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail"
                       aria-describedby="emailHelp" value="" maxlength="50" required>
                <small id="emailHelp" class="form-text text-muted">Мы не будем никому сообщать ваши данные.</small>
            </div>

            <div class="form-group">
                <label for="examplePhone">
                    Номер телефона
                </label>
                <input type="text" class="form-control" name="phone" id="examplePhone" placeholder="+7(918)-310-28-43" required>

            </div>

            <div class="form-group">
                <label for="exampleTextarea">
                    Сообщение<?php if (empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])): ?>
                        <span class="mf-req" style="color: red">*</span><?php endif ?>
                </label>
                <textarea class="form-control" id="exampleTextarea" name="message"
                          rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="File">Добавьте файл для импорта</label>
                <input class="button-primary" type="file" name="file" required>
            </div>

            <?php if ($arParams["USE_CAPTCHA"] == "Y"): ?>
                <div class="form-group">
                    <div class="mf-text">Введите код с картинки</div>
                    <input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180" height="40"
                         alt="CAPTCHA" id="imgCaptcha">
                    <div class="mf-text">Введите код CAPTCHA</div>
                    <input class="form-control" type="text" name="captcha_word" size="30" maxlength="50" value="">
                </div>
            <?php endif; ?>
            <button id="buttonSend" name="submit" class="btn btn-primary">Отправить</button>
            <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">

            <img src="/local/components/first_kill/form.feedback/images/load.gif" id="loadImg">
        </form>
        <br>
        <div class="alert alert-success" role="alert" id="success">

        </div>
        <div class="alert alert-danger" role="alert" id="errors">
        <pre id="errorsText">

        </pre>
        </div>

    </div>
</div>
