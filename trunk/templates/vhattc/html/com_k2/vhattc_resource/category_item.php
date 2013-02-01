<?php
/**
 * @version		$Id: category_item.php 1766 2012-11-22 14:10:24Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);

?>

<!--<pre>
<?php
/*    var_dump($this->item->feedItemAttachments); die;
    */?>
</pre>-->
<div class="resc-item">
    <div class="resc-info">
        <?php if ($this->item->image) :?>
        <a href="<?php echo $this->item->link; ?>" class="thumb">
            <img src="<?php echo $this->item->imageLarge ;?>" alt="<?php echo $this->item->title; ?>">
        </a>
        <?php endif; ?>
        <div class="right-info">
            <h3 class="rs resc-title">
                <?php if ($this->item->params->get('catItemTitleLinked')): ?>
                    <a href="<?php echo $this->item->link; ?>">
                    <?php echo $this->item->title; ?>
                </a>
                <?php else: ?>
                <?php echo $this->item->title; ?>
                <?php endif; ?>
            </h3>
            <div class="clearfix wrap-btn-down" >
            <?php foreach ($this->item->attachments as $attachment): ?>
                    <a href="<?php echo $attachment->link; ?>" class="btn-download" title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>">
                        <?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS') ?>
                        <i class="icon iArrowDown"></i>
                    </a>
                <!--<span class="file-size" style="display: none;"><span class="fw-b">5</span>MBs</span>-->
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>