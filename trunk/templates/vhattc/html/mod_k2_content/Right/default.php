<?php
/**
 * @version		$Id: default.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>

<?php if(count($items)) :?>
<div class="block lastest-news-resc<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
    <h3 class="title rs"><?php echo $module->title; ?></h3>
    <div class="block-content">
        <div class="lst-lastest-news">
            <?php foreach ($items as $key=>$item) :
                $item->introtext = strip_tags($item->introtext);
                if (mb_strlen($item->introtext) > 80) {
                    $item->introtext = mb_substr($item->introtext, 0, 80) .'...';
                }
            ?>
            <div class="news-item">
                <p class="rs date"><?php echo JHTML::_('date', $item->created , JText::_('K2_DATE_FORMAT_LC')); ?></p>
                <h3 class="rs title"><a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></h3>
                <p class="rs desc"><?php echo $item->introtext; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>