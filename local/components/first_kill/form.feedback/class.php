<?php

use NewsProject\Utils\CaptchaInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class FormFeedback extends CBitrixComponent
{
    /**
     * @var CaptchaInterface
     * @var ValidateInterface
     */

    private $captchaService;
    private $validateService;
    private $logService;
    public function onPrepareComponentParams($arParams)
    {
        CModule::IncludeModule('iblock');
        $this->captchaService = new \NewsProject\Utils\CaptchaService();
        $this->logService = new \Monolog\Logger('myLog');

        return parent::onPrepareComponentParams($arParams);
    }


    public function executeComponent()
    {
        try {
            global $USER;
            global $APPLICATION;
            $this->arParams["USE_CAPTCHA"] = (($this->arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");


            if ($this->request->isAjaxRequest()) {
                $code = $this->request->getPost('captcha_word');
                $sid = $this->request->getPost('captcha_sid');
                $email = $this->request->getPost('email');
                $phone = $this->request->getPost('phone');
                $name = $this->request->getPost('name');
                $message = $this->request->getPost('message');
                $file = $this->request->getFile('file');
                $this->arParams["EVENT_NAME"] = "FEEDBACK_FORM";

                $this->validateService = new \NewsProject\Utils\ValidateForm($email, $phone, $message, $name, $file);
                if ($this->validateService->isValid()) {
                    if (($this->arParams["USE_CAPTCHA"] == 'N') || ($this->captchaService->check($code, $sid))) {

                        $APPLICATION->RestartBuffer();
                        $result = [
                            "success" => true,
                            "errors" => [[]],
                        ];


                        if ($this->arParams["USE_CAPTCHA"] == "Y") {
                            $result["captchaId"] = $this->captchaService->getSid();
                        }
                        $elementId = $this->saveToInfoBlock($this->validateService);
                        $fileId = $this->getFileId($this->arParams['IBLOCK_ID'], $elementId);


                        $this->sendEmail($this->validateService, $fileId);
                        echo json_encode($result, JSON_UNESCAPED_UNICODE);
                        die();

                    } else {

                        $APPLICATION->RestartBuffer();
                        $result = [
                            "success" => false,
                            "errors" => [
                                ["field" => "captcha_word",
                                    "text" => "Капча введена неверно"]
                            ]
                        ];
                        http_response_code(422);
                        echo json_encode($result, JSON_UNESCAPED_UNICODE);
                        die();

                    }
                } else {
                    $APPLICATION->RestartBuffer();
                    $result = [
                        "success" => false,
                        "errors" => $this->validateService->getErrors()
                    ];
                    http_response_code(422);
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    die();
                }

            } else {

                if ($this->arParams["USE_CAPTCHA"] == "Y")
                    $this->arResult["capCode"] = $this->captchaService->getSid();
                $this->IncludeComponentTemplate();


            }
        } catch (RuntimeException $runtimeException) {
            $APPLICATION->RestartBuffer();
            http_response_code(500);
            $result = [
                "success" => false,
                "errors" => "Ошибка на сервере. Уже ведутся работы скоро будет исправлено!"
            ];
            echo json_encode($result, JSON_UNESCAPED_UNICODE);


            $this->logService->pushHandler(new \Monolog\Handler\StreamHandler($_SERVER["DOCUMENT_ROOT"] . '/local/log/error.log', Logger::DEBUG));
            $this->logService->error($runtimeException->getMessage());

            $this->sendError($runtimeException->getMessage());
            die();
        }
    }

    private function getFileId(int $iblockId, int $elementId): string
    {

        $paramsBD = CIBlockElement::GetProperty($iblockId, $elementId, array("sort" => "asc"), array("CODE" => "file"));
        return $paramsBD->GetNext()['VALUE'];

    }

    private function saveToInfoBlock(\NewsProject\Utils\ValidateForm $validateForm): string
    {

        $el = new CIBlockElement;

        $params = [
            "name" => $validateForm->getName(),
            "email" => $validateForm->getEmail(),
            "message" => $validateForm->getMessage(),
            "phoneNumber" => $validateForm->getPhone(),
            "file" => $validateForm->getFile()
        ];

        $arLoadProductArray = [
            "MODIFIED_BY" => "",
            "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
            "IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
            "PROPERTY_VALUES" => $params,
            "NAME" => "Отзыв",
            "ACTIVE" => "Y",            // активен
        ];
        if ($elementId = $el->Add($arLoadProductArray)) {
            return $elementId;
        } else {
            throw new \RuntimeException('ошибка записи в инфоблок отзывов: ' . $el->LAST_ERROR);
        }
    }

    private function sendEmail(\NewsProject\Utils\ValidateForm $validateForm, int $fileId)
    {
        $sendParams = [
            "AUTHOR" => $validateForm->getName(),
            "AUTHOR_EMAIL" => $validateForm->getEmail(),
            "EMAIL_TO" => $this->arParams["EMAIL_TO"],
            "TEXT" => $validateForm->getMessage(),
            "PHONE" => $validateForm->getPhone()
        ];

        if (!empty($this->arParams["EVENT_MESSAGE_ID"])) {
            foreach ($this->arParams["EVENT_MESSAGE_ID"] as $v) {
                if (IntVal($v) > 0) {
                    if( !CEvent::Send($this->arParams["EVENT_NAME"], SITE_ID, $sendParams, "N", IntVal($v), [$fileId])){
                        throw new \RuntimeException('ошибка отправки письма: ');
                    }
                }
            }
        } else {
            if( !CEvent::Send($this->arParams["EVENT_NAME"], SITE_ID, $sendParams)){
                throw new \RuntimeException('ошибка отправки письма: ');
            }
        }
    }

    private function sendError(string $error)
    {
        $sendParams = [
            "EMAIL_TO" => $this->arParams["EMAIL_TO"],
            "ERROR" => $error
        ];
       if( !CEvent::Send("ERROR", SITE_ID, $sendParams, "N")){
           throw new \RuntimeException('ошибка отправки письма: ');
       }
    }


}
