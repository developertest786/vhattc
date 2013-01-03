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

    /**
     * count widgets of postions
     *
     * @param string	$condition
     *
     * @return integer
     */
    public function countModules($condition) {
        $result = '';
        $words = explode(' ', $condition);
        for($i = 0; $i < count($words); $i+=2) {
            $position	= strtolower($words[$i]);
            $words[$i]	= (!isset($this->_blocks[$position]) || !is_array($this->_blocks[$position]))? 0 : sizeof($this->_blocks[$position]);
        }

        $str = 'return '.implode(' ', $words).';';
        return eval($str);
    }
}
