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

<div class="block<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>" id="<?php echo $module->id; ?>">
    <h3 class="title rs">
        <?php echo $module->title; ?>
    </h3>
    <div class="block-content">
        <?php if(count($items)) :?>
        <ul class="wrap-lst rs">
        <?php foreach ($items as $key=>$item) :?>
            <!-- Plugins: BeforeDisplay -->
            <?php echo $item->event->BeforeDisplay; ?>

            <!-- K2 Plugins: K2BeforeDisplay -->
            <?php echo $item->event->K2BeforeDisplay; ?>
            <li><?php echo $item->title; ?></li>
            <!-- Plugins: AfterDisplay -->
            <?php echo $item->event->AfterDisplay; ?>

            <!-- K2 Plugins: K2AfterDisplay -->
            <?php echo $item->event->K2AfterDisplay; ?>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>