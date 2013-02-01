<?php
/**
 * @version		$Id: item.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

//var_dump($this->item); exit;

/*foreach ($this->item->extra_fields as $key=>$extraField) {
    $name = str_replace(' ', '_', strtolower($extraField->name));
    $fields[$name] = $extraField->value;
}*/
?>

<div id="event-detail" class="row l656 fixCenter1K">
<div class="col">
    <div class="art-full-info">
        <?php if ($this->item->imageXLarge) :?>
            <img class="desc-img" src="<?php echo $this->item->imageXLarge ?>" alt="<?php echo $this->item->title; ?>" style="max-width: 650px;">
        <?php endif; ?>
        <h2 class="rs art-title"><?php echo $this->item->title; ?></h2>
        <div class="art-ultility clearfix">
            <div class="date-created">
                <span><?php echo JHTML::_('date', $this->item->created , JText::_('K2_DATE_FORMAT_LC2')); ?></span>
                <!--<span class="sep">|</span>
                <span><?php echo $this->item->author->name; ?></span>-->
            </div>
            <div class="art-tool">
                <span class="like-fb">
                    <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $this->item->link ?>&layout=button_count&show_faces=false&width=450&action=like&font&colorscheme=light&height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:74px; height:20px;" allowTransparency="true"></iframe>
                </span>
                <span class="sep"></span>
                <span>
                    <a rel="nofollow" href="<?php echo $this->item->emailLink; ?>" onclick="window.open(this.href,'emailWindow','width=400,height=350,location=no,menubar=no,resizable=no,scrollbars=no'); return false;">
                        <i class="icon iEmail"></i>
                        <span><?php echo JText::_('K2_EMAIL'); ?></span>
                    </a>
                </span>
                <span class="sep"></span>
                <span>
                    <a onclick="window.print();return false;">
                        <i class="icon iPrinter"></i>
                        <span><?php echo JText::_('K2_PRINT_THIS_PAGE'); ?></span>
                    </a>
                </span>
            </div>
        </div>

        <div class="text-content">
            <p class="k2-news-introtext"><?php echo $this->item->introtext; ?></p>
            <p class="k2-news-fulltext"><?php echo $this->item->fulltext; ?></p>
        </div>

        <!--
        <div class="art-comment">
            <h4 class="title rs">12 Bình luận</h4>
        </div>
        -->
        <!--
        <div class="row c3">
            <div class="col">
                <div class="block relation-articles">
                    <h3 class="title">Top Hits</h3>
                    <div class="block-content">
                        <ul class="rs">
                            <li>
                                <a href="#">Addiction Messenger from ATTC Network <span class="fc-g fs11">-  1comment</span></a>
                            </li>
                            <li>
                                <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sit amet  <span class="fc-g fs11">-  12 comments</span></a>
                            </li>
                            <li>
                                <a href="#">Addiction Messenger from ATTC Network <span class="fc-g fs11">-  1comment</span></a>
                            </li>
                            <li>
                                <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sit amet  <span class="fc-g fs11">-  12 comments</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="block relation-articles">
                    <h3 class="title">Lastest news</h3>
                    <div class="block-content">
                        <ul class="rs">
                            <li>
                                <a href="#">Addiction Messenger from ATTC Network <span class="fc-g fs11">-  1comment</span></a>
                            </li>
                            <li>
                                <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sit amet  <span class="fc-g fs11">-  12 comments</span></a>
                            </li>
                            <li>
                                <a href="#">Addiction Messenger from ATTC Network <span class="fc-g fs11">-  1comment</span></a>
                            </li>
                            <li>
                                <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sit amet  <span class="fc-g fs11">-  12 comments</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        -->
    </div>
</div>
<div class="col">
    <?php
    $modules =  JModuleHelper::getModules('right');
    foreach ($modules as $module) {
        echo JModuleHelper::renderModule($module);
    }
    ?>
</div>

</div>