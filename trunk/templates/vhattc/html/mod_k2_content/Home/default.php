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
$categoriesId = $params->get('category_id');
//var_dump($items);
?>

<div class="block lst-training<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>"
     id="<?php echo $module->id; ?>" xmlns="http://www.w3.org/1999/html">
    <h3 class="title rs">
        <?php echo $module->title; ?>

        <a href="<?php echo JRoute::_(K2HelperRoute::getCategoryRoute($categoriesId[0])) ?>" class="more">
            <?php echo JText::_('K2_READ_MORE'); ?>
            <i class="icon iPickReadR"></i>
        </a>
    </h3>
    <div class="block-content">
        <?php if(count($items)) :?>
            <?php foreach ($items as $key=>$item) :
                $item->introtext = strip_tags($item->introtext);
                if (mb_strlen($item->introtext) > 140) {
                    $item->introtext = mb_substr($item->introtext, 0, 140) .'...';
                }
            ?>
            <div class="train-item">
                <h4 class="rs">
                    <?php echo $item->title; ?>
                </h4>
                <p class="rs date">
                    <?php echo JHTML::_('date', $item->created , JText::_('K2_DATE_FORMAT_LC')); ?>
                </p>
                <p class="rs desc">
                    <?php if ($item->image) : ?>
                    <a href="<?php echo $item->link ?>" class="thumb">
                        <img src="<?php echo $item->image?>">
                    </a>
                    <?php endif;?>
                    <p class="rs lead-news"><?php echo $this->item->introtext; ?></p>
                </p>

                <div class="link-action">
                    <span>
                        <a href="<?php echo $item->link ?>"><?php echo JText::_('K2_READ_MORE') ?></a>
                    </span>
                    <!--<span class="sep">|</span>
                    <span>
                        <i class="icon iComment"></i>
                        <a href="#">6 Comments</a>
                    </span>
                    <span class="sep">|</span>
                    <span>
                        <i class="icon iNote"></i>
                        <a href="#">Register</a>
                    </span>-->
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>