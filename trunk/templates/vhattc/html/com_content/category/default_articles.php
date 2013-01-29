<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.beez5
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$templateparams =$app->getTemplate(true)->params;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');

$n = count($this->items);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<?php if (empty($this->items)) : ?>

	<?php if ($this->params->get('show_no_articles', 1)) : ?>
		<div style="margin:100px 0;"><p align="center"><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p></div>
	<?php endif; ?>

<?php else : ?>
<div class="col">
    <div class="clearfix lst-news-about">
        <?php foreach ($this->items as $i => &$article) :
                $article->images = json_decode($article->images);
                if(preg_match('/<img src="([^"]*)"/i', $article->introtext, $m)) {
                    $article->images->image_intro = $m[1];
                    $article->introtext = preg_replace('/<img[^>]*>/', '', $article->introtext);
                }
        ?>
            <div class="news-item clearfix">
                <a class="thumb" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid)); ?>">
                <?php if ($article->images->image_intro) :?>
                    <img src="<?php echo $article->images->image_intro ?>" alt="<?php echo $this->escape($article->title); ?>" class="article-img">
                <?php else :?>
                    <img src="images/banners/logo dai hoc y.jpg" alt="<?php echo $this->escape($article->title); ?>"  class="article-img">
                <?php endif; ?>
                </a>
                <div class="right-info">
                    <h3 class="rs title">
                        <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid)); ?>">
                            <?php echo $this->escape($article->title); ?>
                        </a>
                    </h3>
                    <p class="rs lead-news">
                        <?php echo strip_tags($article->introtext); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php //if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
        <div class="news-paging">
            <div class="line-through"></div>
            <?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
        </div>
    <?php //endif; ?>

    <?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
    <div class="pagination">

        <?php if ($this->params->def('show_pagination_results', 1)) : ?>
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php  endif; ?>

        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
    <?php endif; ?>

</div>
<?php endif; ?>
