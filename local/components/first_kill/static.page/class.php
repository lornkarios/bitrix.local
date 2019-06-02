<?php

use Bitrix\Main\Context,
    Bitrix\Main\Type\DateTime,
    Bitrix\Main\Loader,
    Bitrix\Iblock;

class StaticPage extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        CModule::IncludeModule('iblock');


        return parent::onPrepareComponentParams($arParams);
    }


    public function executeComponent()
    {
        global $APPLICATION;
        global $USER;
        $this->arResult['IBLOCK_ID'] = $this->arParams['IBLOCK_ID'];
        $this->arResult['ELEMENT_ID'] = $this->arParams['ELEMENT_ID'];
        $this->arResult["IBLOCK_SECTION_ID"] = CIBlockElement::GetByID($this->arParams['ELEMENT_ID'])->GetNext()['IBLOCK_SECTION_ID'];

        $this->arResult['properties'] = $this->getProperties();
        $this->arResult['coords'] = explode(',', $this->arResult['properties']['yandexLabel']['value']);

        $this->showPanel($APPLICATION, $USER);
        $this->IncludeComponentTemplate();
    }

    private function getProperties(): array
    {
        $infoblock = $this->arParams["IBLOCK_ID"]; // Инфоблок с id 13
        $elementId = $this->arParams["ELEMENT_ID"];
        $propertyBD = CIBlockElement::GetProperty(
            $infoblock,
            $elementId
        );
        $properties = [];
        while ($property = $propertyBD->GetNext()) {
            $properties[$property['CODE']] = [
                'name' => $property['NAME'],
                'value' => $property['VALUE']
            ];
        }
        return $properties;
    }

    private function showPanel($APPLICATION, $USER)
    {
        if ($USER->IsAuthorized()) {
            if ($APPLICATION->GetShowIncludeAreas()) {
                $arReturnUrl = array(
                    "add_element" => CIBlock::GetArrayByID($this->arResult["IBLOCK_ID"], "DETAIL_PAGE_URL"),
                    "delete_element" => (
                    empty($this->arResult["SECTION_URL"]) ? $this->arResult["LIST_PAGE_URL"] : $this->arResult["SECTION_URL"]
                    ),
                );

                $arButtons = CIBlock::GetPanelButtons(
                    $this->arResult["IBLOCK_ID"],
                    $this->arResult["ELEMENT_ID"],
                    $this->arResult["IBLOCK_SECTION_ID"],
                    Array(
                        "RETURN_URL" => $arReturnUrl,
                        "SECTION_BUTTONS" => false,
                    )
                );

                if ($APPLICATION->GetShowIncludeAreas())
                    $this->addIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));

            }
        }
    }
}
