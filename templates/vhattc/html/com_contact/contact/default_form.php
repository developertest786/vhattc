<?php

 /**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
 if (isset($this->error)) : ?>
 <div class="contact-error" xmlns="http://www.w3.org/1999/html">
		<?php echo $this->error; ?>
	</div>
<?php endif; ?>

	<form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate">
        <p class="rs note"><?php echo JText::_('COM_CONTACT_FORM_LABEL'); ?></p>
        <div class="form-input">
            <p class="wrap clearfix">
                <?php echo $this->form->getLabel('contact_name'); ?>
                <?php echo $this->form->getInput('contact_name'); ?>
            </p>

            <p class="wrap clearfix">
                <?php echo $this->form->getLabel('contact_email'); ?>
                <?php echo $this->form->getInput('contact_email'); ?>
            </p>

            <p class="wrap clearfix">
                <?php echo $this->form->getLabel('contact_subject'); ?>
                <?php echo $this->form->getInput('contact_subject'); ?>
            </p>

            <p class="wrap clearfix">
                <?php echo $this->form->getLabel('contact_message'); ?>
                <?php echo $this->form->getInput('contact_message'); ?>
            </p>

            <p>
            <?php //Dynamically load any additional fields from plugins. ?>
            <?php foreach ($this->form->getFieldsets() as $fieldset): ?>
            <?php if ($fieldset->name != 'contact'):?>
                <?php $fields = $this->form->getFieldset($fieldset->name);?>
                <?php foreach($fields as $field): ?>
                    <?php if ($field->hidden): ?>
                        <?php echo $field->input;?>
                        <?php else:?>
                        <dt>
                            <?php echo $field->label; ?>
                            <?php if (!$field->required && $field->type != "Spacer"): ?>
                            <span class="optional"><?php echo JText::_('COM_CONTACT_OPTIONAL');?></span>
                            <?php endif; ?>
                        </dt>
                        <dd><?php echo $field->input;?></dd>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endif ?>
            <?php endforeach;?>
            </p>

            <p class="wrap-submit clearfix">
            <?php 	if ($this->params->get('show_email_copy')){ ?>
                <?php echo $this->form->getLabel('contact_email_copy'); ?>
                <?php echo $this->form->getInput('contact_email_copy'); ?>
            <?php } ?>
                <button class="button validate" type="submit"><?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?></button>
                <input type="hidden" name="option" value="com_contact" />
                <input type="hidden" name="task" value="contact.submit" />
                <input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
                <input type="hidden" name="id" value="<?php echo $this->contact->slug; ?>" />
                <?php echo JHtml::_( 'form.token' ); ?>
            </p>
        </div>
	</form>
</div>
