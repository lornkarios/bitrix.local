<?php

class NewsFilter extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        CModule::IncludeModule('iblock');


        return parent::onPrepareComponentParams($arParams);
    }


    public function executeComponent()
    {
        $this->arResult['rubrics'] = $this->getRubrics();
        $this->arResult['tsection'] = $this->arParams['SECTION_ID'];
        $this->arResult['tsort'] = $this->arParams['SORT_CODE'];
        $this->arResult['filterMode'] = $this->arParams['SECTIONMODE'];
        $this->IncludeComponentTemplate();
    }

    private function getRubrics(): array
    {
        $infoblock = $this->arParams["IBLOCK_ID"]; // Инфоблок с id 13
        $rsSection = CIBlockSection::GetList(array('left_margin' => 'asc'), array('IBLOCK_ID' => $infoblock, 'ACTIVE' => 'Y'));

        $rubrics = [];
        while ($arSection = $rsSection->Fetch()) {
            $rubrics[] = [  // собираем массив того, что нам нужно
                'ID' => $arSection['ID'], // id раздела
                'NAME' => $arSection['NAME'], // имя раздела (что нас собственно интересует)
                'CODE' => $arSection['CODE'],
            ];
        }

        return $rubrics;
    }
}
