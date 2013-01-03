<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 03/01/2013
 * Time: 22:48
 * To change this template use File | Settings | File Templates.
 */
abstract class PiController extends Flywheel\Controller\WebController {

    /**
     * @return PiDocument
     */
    public function document() {
        return PiCms::getDocument();
    }

    public function _($category,$message,$params=array(),$source=null,$language=null) {
        return PiCms::_($category,$message,$params ,$source , $language);
    }

    public function loadBlock(Page $page) {
        $blocks = PageBlock::getReadConnection()->createQuery()
            ->from('page_block', 'p')
            ->where('p.page_id = ? AND p.active = 1')
            ->orderBy('p.ordering', 'ASC')
            ->addOrderBy('p.created_time', 'ASC')
            ->setParameter(1, $page->id, \PDO::PARAM_INT)
            ->execute()
            ->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($blocks as $b) {
            $block = new PageBlock();
            $block->hydrate($b);
            $block->setNew(false);
            $module = Modules::retrieveByPk($block->module_id);
            if (!$module || !$module->active) {
                continue;
            }

            $this->document()->setBlock($module, $block);
        }
    }
}
