<?php
/**
 * @version		$Id: category_item.php 1689 2012-10-05 15:18:57Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

// Define default image size (do not change)
//K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
//$fields = array();
/*foreach ($this->item->extra_fields as $key=>$extraField) {
    $name = str_replace(' ', '_', strtolower($extraField->name));
    $fields[$name] = $extraField->value;
}*/
//var_dump($this->item); exit;
$this->item->introtext = strip_tags($this->item->introtext);
if(mb_strlen($this->item->introtext) > 140) {
    $this->item->introtext = mb_substr($this->item->introtext, 0, 140) .'...';
}
?>

<div class="news-item clearfix">
    <div class="wrap-content">
        <?php if ($this->item->imageSmall) : ?>
        <a href="<?php echo $this->item->link ?>" class="thumb">
            <img src="<?php echo $this->item->imageMedium; ?>" alt="<?php echo $this->item->title; ?>">
        </a>
        <?php endif; ?>
        <h3 class="rs title" style="margin-top: 10px;"><a href="<?php echo $this->item->link ?>"><?php echo $this->item->title; ?></a></h3>
        <p class="rs date"><?php echo JHTML::_('date', $this->item->created , JText::_('K2_DATE_FORMAT_LC')); ?></p>
        <p class="rs lead-news"><?php echo $this->item->introtext; ?></p>
        <a class="view-detail" href="<?php echo $this->item->link ?>"><?php echo JText::_('K2_READ_MORE'); ?><i class="icon iPickReadR"></i></a>
    </div>
</div>