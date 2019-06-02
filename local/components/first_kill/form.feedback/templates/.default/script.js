$(document).ready(function (e) {
    // Переменная куда будут располагаться данные файлов
    $("#loadImg").hide();
    $("#success").hide();
    $("#errors").hide();
    var files;
    var result
    // Вешаем функцию на событие
    // Получим данные файлов и добавим их в переменную

    $('input[name=file]').change(function () {
        files = this.files;
    });

    $("#mainForm").submit(function () {
        $("#success").hide();
        $("#errors").hide();
        $('input[name=file]').css("border", "1px solid black");
        $('input[name=name]').css("border", "1px solid black");
        $('input[name=email]').css("border", "1px solid black");
        $('textarea[name=message]').css("border", "1px solid black");
        $('input[name=phone]').css("border", "1px solid black");
        $('input[name=captcha_word]').css("border", "1px solid black");
        event.stopPropagation(); // Остановка происходящего
        event.preventDefault();  // Полная остановка происходящего

        //не забывайти проверить поля на заполнение
        //код проверки полей опустим, он к статье не имеет отнашение

        //присоединяем наш файл
        var formData = new FormData();
        if (files != null) {
            $.each(files, function (i, file) {
                formData.append("file", file);
            });
        }
        //присоединяем остальные поля
        formData.append('name', $('input[name=name]').val());
        formData.append('email', $('input[name=email]').val());
        formData.append('phone', $('input[name=phone]').val());
        formData.append('message', $('textarea[name=message]').val());
        formData.append('captcha_sid', $('input[name=captcha_sid]').val());
        formData.append('captcha_word', $('input[name=captcha_word]').val());

        startLoadingAnimation();
        //отправляем через ajax
        $.ajax({
            url: "/about/index.php",
            type: "POST",
            //dataType : "json",
            cache: false,
            contentType: false,
            processData: false,
            data: formData, //указываем что отправляем
            success: function (data) {
                result = JSON.parse(data);
                showResult(result);
                stopLoadingAnimation();
            },
            beforeSend: function () {

            },
            error: function (jqXHR, textStatus, errorThrown) {
                result = JSON.parse(jqXHR.responseText);
                if (jqXHR.status == 422) {
                    showResult(result);
                } else {
                    if (jqXHR.status == 500) {
                        $("#errors").show();
                        $("#errors").text(result['errors']);
                    }
                }
                stopLoadingAnimation();
                console.log('ОШИБКИ AJAX запроса: ' + textStatus);
            }
        });
    });
});

function startLoadingAnimation() // - функция запуска анимации
{
    // найдем элемент с изображением загрузки и уберем невидимость:
    var imgObj = $("#loadImg");
    imgObj.show();

    // вычислим в какие координаты нужно поместить изображение загрузки,
    // чтобы оно оказалось в серидине страницы:
    var position = $("#myForm").offset();
    var centerY = position.top;
    var centerX = position.left;
    // поменяем координаты изображения на нужные:
    imgObj.offset({top: centerY, left: centerX});
}

function stopLoadingAnimation() // - функция останавливающая анимацию
{
    $("#loadImg").hide();
}

function showResult($jsonResult) {
    if ($jsonResult["success"]) {
        $("#success").show();
        $("#success").text("Сообщение доставлено!");
        $('input[name=captcha_sid]').val($jsonResult["captchaId"]);
        $('#imgCaptcha').attr("src","/bitrix/tools/captcha.php?captcha_sid="+$jsonResult["captchaId"]);
    } else {
        $("#errors").show();
        var errors = "";
        $jsonResult['errors'].forEach(function (item, i, arr) {
            errors += item['text'] + "\n";
            if (item['field'] == 'message') {
                $('textarea[name=' + item['field'] + ']').css("border", "1px solid red");
            } else {
                $('input[name=' + item['field'] + ']').css("border", "1px solid red");
            }
        });
        $("#errorsText").text(errors);
    }
}