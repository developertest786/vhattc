<?php
use Flywheel\Factory;

class PiApplication extends Flywheel\Application\WebApp
{
    public $languages;
    public $selectedLang;

    public function routing() {
        Factory::getRouter();
    }

    public function loadLanguage() {
        $languages = Language::findByPublished(1);
        if (!$languages) {
            throw new PiException("No language found!");
        }

        $this->languages = $languages;

        $lang = Factory::getRequest()->get('lang');

        if (null == $lang) {
            $lang = Factory::getCookie()->read('lang');
        }

        if (null != $lang) { //check language support
            foreach ($this->languages as $language) {
                /* @var Language $language */
                if ($lang == $language->sef) {
                    $_GET['lang'] = $lang;
                    Factory::getCookie()->write('lang', $lang);
                    $this->selectedLang = $language;
                    return;
                }
            }
            throw new PiException("Language with sef key '{$lang}' not support");
        }

        //load default language
        foreach ($this->languages as $language) {
            if ($language->access) {
                $this->selectedLang = $language;
                $_GET['lang'] = $lang;
                Factory::getCookie()->write('lang', $lang);
                return;
            }
        }

        throw new PiException("Not found default language.");
    }
}
