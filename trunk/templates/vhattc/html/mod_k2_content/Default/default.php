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

<div class="block lst-training<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>" id="<?php echo $module->id; ?>">
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
            <!-- Plugins: BeforeDisplay -->
            <?php echo $item->event->BeforeDisplay; ?>

            <!-- K2 Plugins: K2BeforeDisplay -->
            <?php echo $item->event->K2BeforeDisplay; ?>

            <?php if(is_scalar($item->extra_fields)) $item->extra_fields = K2Model::getInstance('Item', 'K2Model')->getItemExtraFields($item->extra_fields, $item);

                $fields = array();
                foreach ($item->extra_fields as $key=>$extraField) {
                    $name = str_replace(' ', '_', strtolower($extraField->name));
                    $fields[$name] = $extraField->value;
                }
            ?>

            <div class="train-item">
                <h4 class="rs">
                    <?php echo $item->title; ?>
                </h4>
                <p class="rs date">
                    <?php echo ($fields['type']) ?> , <?php echo JText::_('FROM') ?>
                    <?php echo(@$fields['start_date']); ?><?php if (isset($fields['end_date'])) {?> <?php echo JText::_('TO') ?> <?php echo @$fields['end_date']; } ?>,
                    <?php echo JText::_('AT') ?> <?php echo ($fields['venue']) ?>
                </p>
                <p class="rs desc"><?php echo $item->introtext; ?></p>

                <!--<div class="link-action">
                                    <span>
                                        <a href="#">Read more</a>
                                    </span>
                    <span class="sep">|</span>
                                    <span>
                                        <i class="icon iComment"></i>
                                        <a href="#">6 Comments</a>
                                    </span>
                    <span class="sep">|</span>
                                    <span>
                                        <i class="icon iNote"></i>
                                        <a href="#">Register</a>
                                    </span>
                </div>-->
            </div><!--end: train-item-->
            <!-- Plugins: AfterDisplay -->
            <?php echo $item->event->AfterDisplay; ?>

            <!-- K2 Plugins: K2AfterDisplay -->
            <?php echo $item->event->K2AfterDisplay; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>