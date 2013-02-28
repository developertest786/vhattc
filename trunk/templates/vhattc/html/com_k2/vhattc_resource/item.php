<?php
/**
 * @version		$Id: item.php 1766 2012-11-22 14:10:24Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="row l656 fixCenter1K">
    <div class="col">
        <div class="resource-detail">
            <div class="left-info">
                <?php if ($this->item->image) :?>
                    <img class="thumb-img" src="<?php echo $this->item->image ?>" alt="<?php echo $this->item->title; ?>">
                <?php endif; ?>
                <?php foreach ($this->item->attachments as $attachment): ?>
                    <a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>" class="btn-download">
                        <?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS') ?>
                        <i class="icon iArrowBlack"></i>
                    </a>
                <?php endforeach; ?>
                <div class="file-info">
                    <!--<p class="rs"><span class="fw-b">File size:</span> 4MBs</p> -->
                    <p class="rs"><span class="fw-b"><?php echo JText::_('K2_DOWNLOAD') ?>:</span>
                        <?php foreach ($this->item->attachments as $attachment): ?>
                            <?php echo $attachment->hits; ?>
                        <?php endforeach; ?>
                    </p>
                </div>
            </div>
            <div class="right-info">
                <h3 class="title-file"><?php echo $this->item->title; ?></h3>
                <div class="art-ultility clearfix">
                    <div class="date-created">
                        <?php if($this->item->params->get('itemDateCreated')): ?>
                            <?php echo JHTML::_('date', $this->item->created , JText::_('K2_DATE_FORMAT_LC2')); ?>
                        <?php endif; ?>
                    </div>
                    <div class="art-tool">
                        <span class="like-fb">
                            <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $this->item->link; ?>&amp;layout=button_count&amp;show_faces=false&amp;width=450&amp;action=like&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:74px; height:20px;" allowtransparency="true"></iframe>
                        </span>
                        <span class="sep"></span>
                        <span>
                            <a class="itemEmailLink" rel="nofollow" href="<?php echo $this->item->emailLink; ?>" onclick="window.open(this.href,'emailWindow','width=400,height=350,location=no,menubar=no,resizable=no,scrollbars=no'); return false;">
                                <i class="icon iEmail"></i>
                                <?php echo JText::_('K2_EMAIL'); ?>
                            </a>
                        </span>

                        <!--<span>
                            <i class="icon iEmail"></i>
                            Email
                        </span>-->
                    </div>
                </div>
                <?php if(!empty($this->item->fulltext)): ?>
                      <?php if($this->item->params->get('itemIntroText')): ?>
                      <p class="lead-intro fw-b">
                        <?php echo $this->item->introtext; ?>
                      </p>
                      <?php endif; ?>
                      <?php if($this->item->params->get('itemFullText')): ?>
                      <div class="text-content">
                        <?php echo $this->item->fulltext; ?>
                      </div>
                      <?php endif; ?>
                      <?php else: ?>
                      <!-- Item text -->
                      <div class="text-content">
                        <?php echo $this->item->introtext; ?>
                      </div>
                  <?php endif; ?>
            </div>
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
<!-- End K2 Item Layout -->
