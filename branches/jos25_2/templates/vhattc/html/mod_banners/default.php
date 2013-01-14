<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_banners
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

require_once JPATH_ROOT . '/components/com_banners/helpers/banner.php';
$baseurl = JURI::base();
?>

<div id="slide-partner-org" class="<?php echo $moduleclass_sfx ?>">
    <div class="fixCenter1K">
        <div class="block">
            <?php if ($module->showtitle) : ?>
                <h3 class="title"><?php echo $module->title; ?></h3>
            <?php endif; ?>

            <div class="block-content">
                <div id="slider_partner">
                    <a class="buttons prev" href="#">
                        <i class="iconB iPrev"></i>
                    </a>
                    <a class="buttons next" href="#">
                        <i class="iconB iNext"></i>
                    </a>
                    <div class="viewport">
                        <ul class="rs overview clearfix">

                            <?php foreach($list as $item):?>
                            <?php
                                $link = JRoute::_('index.php?option=com_banners&task=click&id='. $item->id);
                                $imageurl = $item->params->get('imageurl');
                            ?>
                            <?php if ($item->type != 1 && BannerHelper::isImage($imageurl)) : ?>
                                <?php $alt = $item->params->get('alt');?>
                                <?php $alt = $alt ? $alt : $item->name ;?>
                                <?php $alt = $alt ? $alt : JText::_('MOD_BANNERS_BANNER') ;?>
                                <li>
                                    <div class="partner-item">
                                        <div class="center-thumb">
                                            <span class="vertical-hold"><!--for IE6,7--></span>
                                            <?php if ($item->clickurl) :?>
                                            <a href="<?php echo $link; ?>" title="<?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8');?>" class="thumb" target="_blank">
                                                <img src="<?php echo $baseurl . $imageurl;?>" alt="<?php echo $alt ?>">
                                            </a>
                                            <?php else :?>
                                            <img src="<?php echo $baseurl . $imageurl;?>" alt="<?php echo $alt ?>">
                                            <?php endif; ?>
                                        </div>
                                        <p class="rs name"><?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8');?></p>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php endforeach ?>

                        </ul>
                    </div>
                </div>
            </div><!--end: ...-->
        </div>

    </div>
</div>