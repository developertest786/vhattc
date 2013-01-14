<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams ('com_media');
?>

<div class="row contact-form">
    <div class="col-type1">
        <?php if ($this->contact->name && $this->params->get('show_name')) : ?>
        <h3>
            <span class="contact-name"><?php echo $this->contact->name; ?></span>
        </h3>
        <?php endif;  ?>

        <?php echo $this->contact->misc ?>

        <?php if ($this->params->get('show_contact_category') == 'show_no_link') : ?>
        <h5>
            <span class="contact-category"><?php echo $this->contact->category_title; ?></span>
        </h5>
        <?php endif; ?>

        <?php if ($this->params->get('show_contact_category') == 'show_with_link') : ?>
        <?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid);?>
        <h5>
        <span class="contact-category"><a href="<?php echo $contactLink; ?>">
            <?php echo $this->escape($this->contact->category_title); ?></a>
        </span>
        </h5>
        <?php endif; ?>

        <?php if ($this->params->get('show_contact_list') && count($this->contacts) > 1) : ?>
        <form action="#" method="get" name="selectForm" id="selectForm">
            <?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?>
            <?php echo JHtml::_('select.genericlist',  $this->contacts, 'id', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link);?>
        </form>
        <?php endif; ?>

        <!--<?php  if ($this->params->get('presentation_style')!='plain') { ?>
            <?php  echo  JHtml::_($this->params->get('presentation_style').'.start', 'contact-slider'); ?>
            <?php  echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_DETAILS'), 'basic-details');
        } ?>

        <?php if ($this->params->get('presentation_style')=='plain'):?>
        <?php  echo '<h3>'. JText::_('COM_CONTACT_DETAILS').'</h3>';  ?>
        <?php endif; ?>

        <?php if ($this->contact->image && $this->params->get('show_image')) : ?>
        <div class="contact-image">
            <?php echo JHtml::_('image', $this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), array('align' => 'middle')); ?>
        </div>
        <?php endif; ?>

        <?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
            <p class="contact-position"><?php echo $this->contact->con_position; ?></p>
        <?php endif; ?>

        <?php echo $this->loadTemplate('address'); ?>

        <?php if ($this->params->get('allow_vcard')) :	?>
            <?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
            <a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id='.$this->contact->id . '&amp;format=vcf'); ?>">
                <?php echo JText::_('COM_CONTACT_VCARD');?>
            </a>
        <?php endif; ?>
        -->
    </div>

    <div class="col-type2">
            <?php if ($this->params->get('show_page_heading', 1)) : ?>
            <h3 class="rs title">
                <?php echo $this->escape($this->params->get('page_heading')); ?>
            </h3>
            <?php endif; ?>
            <?php  echo $this->loadTemplate('form');  ?>
    </div>
</div>