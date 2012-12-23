<?php 
/**
 * Page
 *  This class has been auto-generated at 23/12/2012 16:41:36
 * @version		$Id$
 * @package		Model
 */

require_once dirname(__FILE__) .'/Base/PageBase.php';
class Page extends \PageBase {
    protected function _beforeSave() {
        if (null == $this->created_time && $this->isNew()) {
            $this->created_time = $this->modified_time = time();
        } else if ($this->isColumnModified('modified_time')) {
            $this->modified_time = time();
        }

        parent::_beforeSave();
    }
}