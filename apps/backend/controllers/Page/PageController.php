<?php
class PageController extends BackendController {
    public function executeDefault() {
        var_dump($_GET);
    }

    public function executeNew() {
        $this->setView('form');
        $page = new Page();
        if($this->request()->isPostRequest()) {
            if ($this->_save($page)) {
            }
        }
    }

    public function executeEdit() {
        $this->setView('form');
        $page = Page::findOneById($this->request()->get('page_id', 'INT'));
        if (!$page) {
        }

        if($this->request()->isPostRequest()) {
            if ($this->_save($page)) {
            }
        }
    }

    public function executeAddBlock() {
    }

    private function _save(Page &$page) {
        $failures = array();
        $attribute = $this->request()->post('page', 'ARRAY');
        $page->hydrate($attribute);

        //@TODO replace staff id
        if ($page->isNew()) {
            $page->created_by = $page->modified_by = 1;
        } else {
            $page->modified_by = 1;
        }

        $db = \Flywheel\Db\Manager::getConnection();
        $db->beginTransaction();
        try {
            if ($page->save()) {
                //Page meta data
                $meta_data = $this->request()->post('meta_data', 'ARRAY');
                foreach ($meta_data as $meta => $value) {
                    $pageMeta = PageMeta::findOneByPageIdAndFieldName($page->id, $meta);
                    if (!$pageMeta) {
                        $pageMeta = new PageMeta();
                    }
                    $pageMeta->field_value = $value;
                    $pageMeta->save();
                }
                return true;
            } else {
                $failures = array_merge_recursive($failures, $page->getValidationFailures());
            }
            $this->view()->assign('error', $failures);
            return false;
        } catch (\Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }
}
