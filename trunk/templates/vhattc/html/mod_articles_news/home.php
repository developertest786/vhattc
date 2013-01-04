<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_news
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
var_dump($list); die;
?>
<div class="lst-top-about">
    <div class="row c3">
        <?php foreach ($list as $item) :?>
        <div class="col">
            <div class="artcle-about">
                <h2 class="rs title">
                    <a href="<?php echo $item->link;?>">
                    <?php echo $item->title;?></a>
                </h2>

                <?php if (!$params->get('intro_only')) :
                    echo $item->afterDisplayTitle;
                endif; ?>

                <?php echo $item->beforeDisplayContent; ?>

                <p class="rs desc"><?php echo strip_tags($item->introtext, '<br />'); ?></p>

                <p class="rs viewmore">
                    <a class="readmore" href="<?php echo $item->link ?>"><?php echo $item->linkText ?></a>
                    <i class="icon iPickReadR"></i>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
