<?php
class PiDocument extends Flywheel\Document\Html
{
    public function setBlock(Modules $module, PageBlock $pageBlock) {
        if (!isset($this->_blocks[$pageBlock->position])) {
            $this->_blocks[$pageBlock->position] = array();
        }

        $this->_blocks[$pageBlock->position][] = array ('folder' => $module->folder,
            'data' => json_decode($pageBlock->data),
            'config' => json_decode($module->setting));
    }
}
