<?php
/* @var PiApplication $app */
$app = \Flywheel\Base::getApp();
$languages = $app->languages;
$selected = $app->selectedLang;

$view = \Flywheel\Factory::getView();
$view->assign('languages', $languages);
$view->assign('selected_language', $selected);

$view->display($app->getTemplatePath().'/module/language_switcher');