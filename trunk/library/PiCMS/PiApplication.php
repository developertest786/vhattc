<?php
use Flywheel\Factory;

class PiApplication extends Flywheel\Application\WebApp
{
    public $language;

    public function routing() {
        Factory::getRouter();
    }

    public function loadLanguage() {
        $lang = Factory::getRequest()->get('lang');
        if (null == $lang) {
            $lang = Factory::getCookie()->read('lang');
        }

        if (null != $lang) { //check language support
            if ($langOm = Language::findOneBySef($lang)) {
                $_GET['lang'] = $lang;
                Factory::getCookie()->write('lang', $lang);
                $this->language = $langOm;
                return;
            }
        }

        //load default language
        $langOm = Language::findOneByAccess(1);
        if (!$langOm) {
            throw new PiException("Default language not found!");
        }
        $lang = $langOm->sef;
        $_GET['lang'] = $lang;
        Factory::getCookie()->write('lang', $lang);
        $this->language = $langOm;
    }

    public function loadBlock(Page $page) {
        $blocks = PageBlock::getReadConnection()->createQuery()
                ->from('page_block', 'p')
                ->leftJoin('p', 'module', 'm', 'm.id = p.module_id')
                ->where('p.page_id = ? AND p.active = 1')
                ->orderBy('`ordering`', 'ASC')
                ->setParameter(1, $page->id, \PDO::PARAM_INT)
                ->execute()
                ->fetchAll(\PDO::FETCH_ASSOC);

        $doc = Factory::getDocument();
        foreach($blocks as $block) {
        }
    }
}
