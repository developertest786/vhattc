<?php
/**
 * @version		$Id: generic.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>


<!-- Start K2 Category Layout -->
<div id="training-event" class="row l656 fixCenter1K itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
    <div class="col">
        <?php if (empty($this->items)) :?>
            <div style="margin:100px 0;"><p align="center"><?php JText::_('COM_CONTENT_NO_ARTICLES') ?></p></div>;
            <?php else : ?>
            <div class="all-event">
                <?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
                <div class="quick-filter">
                    <!--<span class="fw-b">All:</span> <a href="#">Upcoming Events</a>  /  <a href="#">Past Events</a>-->
                    <?php echo $this->category->name; ?>
                </div>
                <?php endif; ?>
                <div class="lst-event">
                    <?php foreach ($this->items as $item) : ?>
                    <?php
                    $this->item=$item;
                    $this->item->extra_fields = K2ModelItem::getItemExtraFields($this->item->extra_fields);
                    $fields = array();
                    foreach ($this->item->extra_fields as $key=>$extraField) {
                        $name = str_replace(' ', '_', strtolower($extraField->name));
                        $fields[$name] = $extraField->value;
                    }
    //                echo $this->loadTemplate('item');
                    ?>
                    <div class="event-item media">
                        <div class="duration-time"><!--left-->
                            <div class="box-time"><?php echo $fields['start_date'] ?><?php if ($fields['end_date']) : ?>
                                - <?php echo $fields['start_date'] ?>
                                <?php endif ?>
                            </div>
                            <div class="time-left">
                                <!--<span class="line-through"></span>
                                <span class="val"><span class="fw-b">12</span> days left</span>-->
                            </div>
                        </div><!--end: left-->
                        <div class="media-body">
                            <h4 class="name-event rs"><?php echo $this->item->title; ?></h4>
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

                    <!--END: event-item-->
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Pagination -->
            <?php if(count($this->pagination->getPagesLinks())): ?>
            <div class="news-paging">
                <div class="line-through"></div>
                <?php echo $this->pagination->getPagesLinks(); ?>
                <!--<div class="clr"></div>
                <?php echo $this->pagination->getPagesCounter(); ?>
                -->
            </div>
            <?php endif; ?>

        <?php endif; ?>

    </div>
    <div class="col">
        <div id="training-page">
            <?php
            $modules =  JModuleHelper::getModules('right');
            foreach ($modules as $module) {
                echo JModuleHelper::renderModule($module);
            }
            ?>
        </div>
    </div>
</div>
<!-- End K2 Category Layout -->