<?php 
/**
 * @version		$Id: archive.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>
<?php
/**
 * @version		$Id: archive.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>
<div class="block articles-archive">
    <h3 class="title">
        <?php echo $module->title ?>
    </h3>
    <div class="block-content">
        <div class="wrap-lst clearfix">
            <?php foreach ($months as $month): ?>
            <div class="rs item">
                <div>
                    <a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&task=exfilter&m='.$month->m.'&y='.$month->y.(($month->catid)? '&catid[]=' .$month->catid : '')); ?>">
                        <span class="fw-b"><?php echo $month->name ?> - <?php echo $month->y ?></span> <?php if ($params->get('archiveItemsCounter')) echo '('.$month->numOfItems.')'; ?>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>