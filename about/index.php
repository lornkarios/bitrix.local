<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Контакты");

$APPLICATION->IncludeComponent(
    "first_kill:static.page",
    "",
    [
        "ELEMENT_ID" => "288",
        "IBLOCK_ID" => "10",
        "IBLOCK_TYPE" => "pages",
        "SET_TITLE" => "Y",
    ]
);

$APPLICATION->IncludeComponent(
	"first_kill:form.feedback", 
	".default", 
	array(
		"EMAIL_TO" => "lornkar@mail.ru",
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"OK_TEXT" => "Успешно отправлено",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "EMAIL",
			2 => "MESSAGE",
		),
		"USE_CAPTCHA" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "pages",
		"IBLOCK_ID" => "11"
	),
	false
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
