<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
/**
 * @var array $arResult
 */
$this->addExternalJS('https://api-maps.yandex.ru/2.1/?lang=ru_RU');
?>

<div class="row">
    <div class="col">
    </div>
    <div class="col-6" style="padding-top: 40px">


        <h1 style="margin-bottom: 50px"><?= $arResult['properties']['headline']['value'] ?></h1>
        <address>
            <strong><?= $arResult['properties']['address']['name'] ?></strong><br>
            <?= $arResult['properties']['address']['value'] ?><br>
            <abbr title="<?= $arResult['properties']['phoneNumber']['name'] ?>">т:</abbr> <?= $arResult['properties']['phoneNumber']['value'] ?>
        </address>
        <address>
            <strong><?= $arResult['properties']['name']['value'] ?></strong><br>
            <?= $arResult['properties']['email']['name'] ?>:<a
                    href="mailto:<?= $arResult['properties']['email']['value'] ?>"><?= $arResult['properties']['email']['value'] ?></a>
        </address>
        <div id="map" style="width: 600px; height: 400px"></div>

        <script>
            ymaps.ready(init);
            var myMap;

            function init() {
                // Создание карты.
                myMap = new ymaps.Map("map", {
                    // Координаты центра карты.
                    // Порядок по умолчанию: «широта, долгота».
                    // Чтобы не определять координаты центра карты вручную,
                    // воспользуйтесь инструментом Определение координат.
                    center: [<?=$arResult['coords'][0]?>, <?=$arResult['coords'][1]?>],
                    // Уровень масштабирования. Допустимые значения:
                    // от 0 (весь мир) до 19.
                    zoom: 15
                });
                // Создание геообъекта с типом точка (метка).
                var myGeoObject = new ymaps.GeoObject({
                    geometry: {
                        type: "Point", // тип геометрии - точка
                        coordinates: [<?=$arResult['coords'][0]?>, <?=$arResult['coords'][1]?>] // координаты точки
                    }
                });

                // Размещение геообъекта на карте.
                myMap.geoObjects.add(myGeoObject);
            }

        </script>

    </div>
