<?php
class CategoryController extends BackendController {
    public function executeDefault() {
        $categories = Taxonomy::getTermsBySlug('article_category');

        $this->view()->assign('categories', $categories);
        if ($this->request()->isXmlHttpRequest()) {
            return $this->renderPartial();
        }

        return $this->renderComponent();
    }

    public function executeEdit() {
        $this->validAjaxRequest();
    }

    public function executeAdd() {}

    protected function _save() {}
}
