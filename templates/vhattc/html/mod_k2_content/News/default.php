<?php
/**
 * @version		$Id: default.php 1766 2012-11-22 14:10:24Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="_k2ItemsBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">

    <?php if(count($items)): ?>
    <div class="slide-top-news" id="sys_slide_top_news">
        <?php if($params->get('itemPreText')): ?>
            <h2 class="slide-title rs">
                <a href="<?php echo $params->get('itemCustomLinkURL'); ?>">
                    <?php echo $params->get('itemPreText'); ?>
                </a>
            </h2>
        <?php endif; ?>

        <div class="top-news">
            <a class="buttons prev" href="#">«</a>
            <span class="dis-btn p"></span>
            <a class="buttons next" href="#">»</a>
            <span class="dis-btn n"></span>
            <div class="viewport">
                <ul class="rs clearfix overview lst-top-news">
                    <?php foreach ($items as $key=>$item):	?>
                    <li><!--218-->
                        <div class="wrap-content">
                            <h3 class="rs news-title">
                                <a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
                            </h3>
                            <?php if (isset($item->image)) :?>
                            <a href="<?php echo $item->link; ?>" class="thumb">
                                <img src="<?php echo $item->image ?>" alt="<?php echo $item->title; ?>">
                            </a>
                            <?php else: ?>
                                <?php
                                    $item->introtext = strip_tags($item->introtext);
                                    if (mb_strlen($item->introtext) > 140) {
                                        $item->introtext = mb_substr($item->introtext, 0, 140) .'...';
                                    }
                                ?>
                                <p class="rs"><span style="font-size: 91.7%"><?php echo $item->introtext ?></span></p>
                            <?php endif; ?>
                        </div>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
