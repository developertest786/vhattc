<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.beez5
 * @copyright	Copyright (C) 2005 - 2009 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$app = JFactory::getApplication();
$templateparams =$app->getTemplate(true)->params;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$pageClass = $this->params->get('pageclass_sfx');
?>
<div class="category-list<?php echo $this->pageclass_sfx;?>">
<?php if ($this->params->get('show_page_heading')) : ?>
<?php if ($this->params->get('show_page_heading') and ($this->params->get('show_category_title') or $this->params->get('page_subheading'))) : ?>
<hgroup>
<?php endif; ?>
<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
<?php endif; ?>

<?php if ($this->params->get('show_category_title') or $this->params->get('page_subheading')) : ?>
<h2 class="rs title-page">
	<?php echo $this->escape($this->params->get('page_subheading')); ?>
	<?php if ($this->params->get('show_category_title'))
	{
		echo '<span class="_hoangnm_ subheading-category">'.$this->category->title.'</span>';
	}
	?>
</h2>
<?php if ($this->params->get('show_page_heading') and ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading'))) : ?>
</hgroup>
<?php endif; ?>
<?php endif; ?>

<?php if (is_array($this->children[$this->category->id]) && count($this->children[$this->category->id]) > 0 && $this->params->get('maxLevel') !=0) : ?>
		<div class="cat-children">

	 <?php if ($this->params->get('show_category_title') or $this->params->get('page_subheading'))
	 {  echo '<h3>' ;}
	 else

	{echo '<h2>' ;} ?>

<?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
 <?php if ($this->params->get('show_category_title') or $this->params->get('page_subheading'))
	 {  echo '</h3>' ;}
	 else

	{echo '</h2>' ;} ?>
			<?php echo $this->loadTemplate('children'); ?>
		</div>
	<?php endif; ?>

	<div class="cat-items">
		<?php echo $this->loadTemplate('articles'); ?>
	</div>

</div>

