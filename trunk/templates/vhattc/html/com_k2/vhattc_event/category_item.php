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
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);
//var_dump($this->item); exit;
?>

<!-- Plugins: BeforeDisplay -->
<?php echo $this->item->event->BeforeDisplay; ?>

<!-- K2 Plugins: K2BeforeDisplay -->
<?php echo $this->item->event->K2BeforeDisplay; ?>

<div class="event-item media">
    <div class="duration-time"><!--left-->
        <div class="box-time">12 Dec 2012 - 15 Dec 2012</div>
        <div class="time-left">
            <span class="line-through"></span>
            <!--<span class="val"><span class="fw-b">12</span> days left</span>-->
        </div>
    </div><!--end: left-->
    <div class="media-body">
        <h4 class="name-event rs"><?php echo $this->item->title; ?></h4>
        <?php if(count($this->item->extra_fields)): ?>
        <p class="desc-event rs">
            <?php foreach ($this->item->extra_fields as $key=>$extraField) {
                var_dump($extraField); exit; ?>
            <?php if ($extraField->name == 'Venue') :?>
            <strong><?php echo $extraField->value; ?></strong><br />
            <?php endif; ?>
            <?php if ($extraField->name == 'Type') :?>
                <strong><?php echo $extraField->value; ?></strong><br />
            <?php endif; ?>
            <?php } ?>
        </p>
        <?php endif; ?>
        <p class="desc-event rs">
            <?php echo $this->item->introtext; ?>
        </p>
        <!--<p class="rs link-action">
            <a href="<?php echo $this->item->link; ?>">Read more</a>
            <span class="sep">|</span>
            <a href="#">Comment</a>
            <span class="sep">|</span>
            <a href="#"><i class="icon iNote"></i>Register Now</a>
        </p>-->
    </div>
</div>