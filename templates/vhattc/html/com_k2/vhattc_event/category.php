<?php
/**
 * @version		$Id: category.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
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
        <div class="all-event">
            <?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
            <div class="quick-filter">
                <?php $modules = JModuleHelper::getModules('event-type');
                if (!empty($modules)) {
                    foreach ($modules as $module) {
                        echo JModuleHelper::renderModule($module);
                    }
                } ?>
                <!--<span class="fw-b">All:</span> <a href="#">Upcoming Events</a>  /  <a href="#">Past Events</a>-->
                <!--<?php echo $this->category->name; ?>-->
            </div>
            <?php endif; ?>
            <div class="lst-event">
                <?php foreach ($this->leading as $leading) : ?>
                <?php
                    $this->item=$leading;
                    if (is_scalar($this->item->extra_fields)) {
//                        var_dump($this->item);
                        $model = K2Model::getInstance('Item', 'K2Model');
                        $this->item->extra_fields = $model->getItemExtraFields($this->item->extra_fields, $this->item);
//                        var_dump($this->item); exit;
                    }

                    echo $this->loadTemplate('item');
                ?>
                <!--END: event-item-->
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Pagination -->
        <?php if(count($this->pagination->getPagesLinks())): ?>
        <div class="news-paging">
            <div class="line-through"></div>
            <?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
            <!--<div class="clr"></div>
            <?php if($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?>
            -->
        </div>
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
