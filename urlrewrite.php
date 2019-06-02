<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/rubrics/([0-9a-zA-Z-]+)/([^/]*)#',
    'RULE' => 'rubric=$1&sort=""',
    'ID' => 'bitrix:news.list',
    'PATH' => '/rubrics/list.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/([0-9a-zA-Z-]+)/([^/]*)#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => 'bitrix:news.detail',
    'PATH' => '/detail.php',
    'SORT' => 150,
  ),
);
