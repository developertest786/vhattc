<?php
use Flywheel\Factory;

class PageController extends FrontendController {
    public function executeDefault() {
        $router = Factory::getRouter();
        $url = ltrim($router->getUrl(), '/');
        if ($url == '' || $url == ($this->language->sef)) { //default
            $pageData = Page::read()->where('home_page = ?')
                        ->andWhere('lang_code = ? OR lang_code = "*"')
                        ->setMaxResults(1)
                        ->setParameter(1, 1, \PDO::PARAM_INT)
                        ->setParameter(2, $this->language->lang_code, \PDO::PARAM_STR)
                        ->execute()
                        ->fetch(\PDO::FETCH_ASSOC);
        } else {
            $slug = $this->request()->get('slug');
            if (null == $slug) {
                throw new PiException("Page not found", 404);
            }

            $pageData = Page::read()->where('`link` = ?')
                ->andWhere('`lang_code` = ? OR `lang_code` = "*"')
                ->setMaxResults(1)
                ->setParameter(1, $slug, \PDO::PARAM_STR)
                ->setParameter(2, $this->language->lang_code, \PDO::PARAM_STR)
                ->execute()
                ->fetch(\PDO::FETCH_ASSOC);
        }

        if (!$pageData)
            throw new PiException("Page not found", 404);

        $page = new Page();
        $page->setNew(false);
        $page->hydrate($pageData);

        $layout = ($page->layout)? $page->layout : 'default';
        $template = ($page->template)? $page->template : 'default';
        $this->setLayout('page-' .$layout);
        $this->setView($template);

        $pageMeta = PageMeta::findByPageId($page->id);
        $meta_data = array();
        foreach($pageMeta as $pm) {
            /* @var PageMeta $pm */
            $meta_data[$pm->field_name] = $pm->field_value;
        }

        if (!isset($meta_data['meta_title']) || $meta_data['meta_title'] == '__PAGE_NAME__') {
            $meta_data['meta_title'] = $page->name;
        }

        $viewRender = $this->view();
        $viewRender->assign('meta_data', $meta_data);

        $this->document()->title = $meta_data['meta_title'];
        $this->document()->keyword = @$meta_data['meta_keyword'];
        $this->document()->description = @$meta_data['meta_desc'];

        Base::getApp()->loadBlock($page);
    }
}
