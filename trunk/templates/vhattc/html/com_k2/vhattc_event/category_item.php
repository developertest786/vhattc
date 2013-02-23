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
$fields = array();
//xdebug_var_dump($this->item); exit;
foreach ($this->item->extra_fields as $key=>$extraField) {
    $name = str_replace(' ', '_', strtolower($extraField->name));
    $fields[$name] = $extraField->value;
}
$this->item->introtext = strip_tags($this->item->introtext, '<br><a><p>');
?>

<!-- Plugins: BeforeDisplay -->
<?php echo $this->item->event->BeforeDisplay; ?>

<!-- K2 Plugins: K2BeforeDisplay -->
<?php echo $this->item->event->K2BeforeDisplay; ?>

<div class="event-item media">
    <div class="duration-time"><!--left-->
        <div class="box-time"><?php echo $fields['start_date'] ?><?php if (isset($fields['end_date'])) : ?>
            - <?php echo $fields['end_date'] ?>
            <?php endif ?>
        </div>
        <div class="time-left">
            <!--<span class="line-through"></span>
            <span class="val"><span class="fw-b">12</span> days left</span>-->
        </div>
    </div><!--end: left-->
    <div class="media-body">
        <h4 class="name-event rs">
            <a href="<?php echo $this->item->link ?>"><?php echo $this->item->title; ?></a>
        </h4>
        <?php if(count($this->item->extra_fields)): ?>
        <p class="desc-event rs">
            <?php echo @$fields['type'] ?> - <?php echo @$fields['venue'] ?>
        </p>
        <?php endif; ?>
        <p class="desc-event rs">
            <?php echo $this->item->introtext; ?>
        </p>
        <p class="rs link-action">
            <!-- <a href="<?php echo $this->item->link; ?>">Read more</a>
            <span class="sep">|</span>
            <a href="#">Comment</a>
            <span class="sep">|</span>
            <a href="#"><i class="icon iNote"></i>Register Now</a> -->
        </p>
    </div>
</div>