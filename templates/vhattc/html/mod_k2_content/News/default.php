<?php
/**
 * @version		$Id: default.php 1766 2012-11-22 14:10:24Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="_k2ItemsBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">

    <div class="slide-top-news" id="sys_slide_top_news">
        <h2 class="slide-title rs">News top</h2>
        <div class="top-news">
            <a class="buttons prev" href="#">«</a>
            <a class="buttons next" href="#">»</a>
            <div class="viewport">
                <ul class="rs clearfix overview lst-top-news">
                    <li><!--218-->
                        <div class="wrap-content">
                            <h3 class="rs news-title">
                                <a href="#">Hội thảo "Các rối loạn do sử dụng chất gây nghiện và HIV ở Việt Nam" (16-18 tháng Ba, 2012)</a>
                            </h3>
                            <a style="display: none" href="#" class="thumb">
                                <img src="images/banners/th-111x111.jpg" alt="$NEWS_TITLE">
                            </a>
                            <p class="rs">Rối loạn sử dụng chất gây nghiện từ lâu đã trở thành một vấn đề sức khỏe toàn ...</p>
                        </div>
                    </li>
                    <li><!--218-->
                        <div class="wrap-content">
                            <h3 class="rs news-title">
                                <a href="#">Hội thảo "Các rối loạn do sử dụng chất gây nghiện và HIV ở Việt Nam" (16-18 tháng Ba, 2012)</a>
                            </h3>
                            <a href="#" class="thumb">
                                <img src="images/banners/th-111x111.jpg" alt="$NEWS_TITLE">
                            </a>
                        </div>
                    </li>
                    <li><!--218-->
                        <div class="wrap-content">
                            <h3 class="rs news-title">
                                <a href="#">Hội thảo "Các rối loạn do sử dụng chất gây nghiện và HIV ở Việt Nam" (16-18 tháng Ba, 2012)</a>
                            </h3>
                            <a href="#" class="thumb">
                                <img src="images/banners/th-111x111.jpg" alt="$NEWS_TITLE">
                            </a>
                        </div>
                    </li>
                    <li><!--218-->
                        <div class="wrap-content">
                            <h3 class="rs news-title">
                                <a href="#">Hội thảo "Các rối loạn do sử dụng chất gây nghiện và HIV ở Việt Nam" (16-18 tháng Ba, 2012)</a>
                            </h3>
                            <a href="#" class="thumb">
                                <img src="images/banners/th-111x111.jpg" alt="$NEWS_TITLE">
                            </a>
                        </div>
                    </li>
                    <li><!--218-->
                        <div class="wrap-content">
                            <h3 class="rs news-title">
                                <a href="#">Hội thảo "Các rối loạn do sử dụng chất gây nghiện và HIV ở Việt Nam" (16-18 tháng Ba, 2012)</a>
                            </h3>
                            <a href="#" class="thumb">
                                <img src="images/banners/th-111x111.jpg" alt="$NEWS_TITLE">
                            </a>
                        </div>
                    </li>
                    <li><!--218-->
                        <div class="wrap-content">
                            <h3 class="rs news-title">
                                <a href="#">Hội thảo "Các rối loạn do sử dụng chất gây nghiện và HIV ở Việt Nam" (16-18 tháng Ba, 2012)</a>
                            </h3>
                            <a href="#" class="thumb">
                                <img src="images/banners/th-111x111.jpg" alt="$NEWS_TITLE">
                            </a>
                        </div>
                    </li>
                    <li><!--218-->
                        <div class="wrap-content">
                            <h3 class="rs news-title">
                                <a href="#">Hội thảo "Các rối loạn do sử dụng chất gây nghiện và HIV ở Việt Nam" (16-18 tháng Ba, 2012)</a>
                            </h3>
                            <a href="#" class="thumb">
                                <img src="images/banners/th-111x111.jpg" alt="$NEWS_TITLE">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <?php if($params->get('itemPreText')): ?>
    <p class="modulePretext"><?php echo $params->get('itemPreText'); ?></p>
    <?php endif; ?>

    <?php if(count($items)): ?>
    <ul>
        <?php foreach ($items as $key=>$item):	?>
        <li class="<?php echo ($key%2) ? "odd" : "even"; if(count($items)==$key+1) echo ' lastItem'; ?>">

            <!-- Plugins: BeforeDisplay -->
            <?php echo $item->event->BeforeDisplay; ?>

            <!-- K2 Plugins: K2BeforeDisplay -->
            <?php echo $item->event->K2BeforeDisplay; ?>

            <?php if($params->get('itemTitle')): ?>
            <a class="moduleItemTitle" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
            <?php endif; ?>

            <?php if($params->get('itemAuthor')): ?>
            <div class="moduleItemAuthor">
                <?php echo K2HelperUtilities::writtenBy($item->authorGender); ?>

                <?php if(isset($item->authorLink)): ?>
                <a rel="author" title="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" href="<?php echo $item->authorLink; ?>"><?php echo $item->author; ?></a>
                <?php else: ?>
                <?php echo $item->author; ?>
                <?php endif; ?>

                <?php if($params->get('userDescription')): ?>
                <?php echo $item->authorDescription; ?>
                <?php endif; ?>

            </div>
            <?php endif; ?>

            <!-- Plugins: AfterDisplayTitle -->
            <?php echo $item->event->AfterDisplayTitle; ?>

            <!-- K2 Plugins: K2AfterDisplayTitle -->
            <?php echo $item->event->K2AfterDisplayTitle; ?>

            <!-- Plugins: BeforeDisplayContent -->
            <?php echo $item->event->BeforeDisplayContent; ?>

            <!-- K2 Plugins: K2BeforeDisplayContent -->
            <?php echo $item->event->K2BeforeDisplayContent; ?>

            <?php if($params->get('itemImage') || $params->get('itemIntroText')): ?>
            <div class="moduleItemIntrotext">
                <?php if($params->get('itemImage') && isset($item->image)): ?>
                <a class="moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
                    <img src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>"/>
                </a>
                <?php endif; ?>

                <?php if($params->get('itemIntroText')): ?>
                <?php echo $item->introtext; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="clr"></div>



            <!-- Plugins: AfterDisplayContent -->
            <?php echo $item->event->AfterDisplayContent; ?>

            <!-- K2 Plugins: K2AfterDisplayContent -->
            <?php echo $item->event->K2AfterDisplayContent; ?>

            <?php if($params->get('itemDateCreated')): ?>
            <span class="moduleItemDateCreated"><?php echo JText::_('K2_WRITTEN_ON') ; ?> <?php echo JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC2')); ?></span>
            <?php endif; ?>

            <?php if($params->get('itemCategory')): ?>
            <?php echo JText::_('K2_IN') ; ?> <a class="moduleItemCategory" href="<?php echo $item->categoryLink; ?>"><?php echo $item->categoryname; ?></a>
            <?php endif; ?>

            <?php if($params->get('itemTags') && count($item->tags)>0): ?>
            <div class="moduleItemTags">
                <b><?php echo JText::_('K2_TAGS'); ?>:</b>
                <?php foreach ($item->tags as $tag): ?>
                <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if($params->get('itemReadMore') && $item->fulltext): ?>
            <a class="moduleItemReadMore" href="<?php echo $item->link; ?>">
                <?php echo JText::_('K2_READ_MORE'); ?>
            </a>
            <?php endif; ?>

            <!-- Plugins: AfterDisplay -->
            <?php echo $item->event->AfterDisplay; ?>

            <!-- K2 Plugins: K2AfterDisplay -->
            <?php echo $item->event->K2AfterDisplay; ?>

            <div class="clr"></div>
        </li>
        <?php endforeach; ?>
        <li class="clearList"></li>
    </ul>
    <?php endif; ?>

    <?php if($params->get('itemCustomLink')): ?>
    <a class="moduleCustomLink" href="<?php echo $params->get('itemCustomLinkURL'); ?>" title="<?php echo K2HelperUtilities::cleanHtml($itemCustomLinkTitle); ?>"><?php echo $itemCustomLinkTitle; ?></a>
    <?php endif; ?>

    <?php if($params->get('feed')): ?>
    <div class="k2FeedIcon">
        <a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&format=feed&moduleID='.$module->id); ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
            <span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
        </a>
        <div class="clr"></div>
    </div>
    <?php endif; ?>

</div>
