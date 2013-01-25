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

foreach ($this->item->extra_fields as $key=>$extraField) {
    $name = str_replace(' ', '_', strtolower($extraField->name));
    $fields[$name] = $extraField->value;
}
?>

<div id="event-detail" class="row l656 fixCenter1K">
<div class="col">
    <div class="art-full-info">
        <h2 class="rs art-title"><?php echo $this->item->title; ?></h2>
        <div class="art-ultility clearfix">
            <div class="date-created">
                <span><?php echo @$fields['type'] ?></span>
                <?php if (@$fields['contact_name']) :?>
                <span class="sep">|</span>
                <span><?php echo @$fields['contact_name'] ?></span>
                <?php endif; ?>
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
        <div class="event-fixed-time">
            <i class="icon iClock"></i>
            <?php echo $fields['start_date'] ?><?php if (isset($fields['end_date'])) : ?> - <?php echo $fields['end_date'] ?><?php endif;?>
        </div>
        <div class="event-fixed-time">
            <i class="icon iPlace"></i><?php echo @$fields['venue'] ?>
        </div>

        <div class="text-content">
            <p><?php if(!empty($this->item->fulltext)): ?>
                <!-- Item introtext -->
                <?php echo $this->item->introtext; ?><br />
                <?php echo $this->item->fulltext; ?>

            <?php endif; ?>
        </p>

        </div>

        <!-- <p class="rs">
            <a href="#" class="view-more">
                View more<i class="icon iPickDownR"></i>
            </a>
        </p> -->
        <!--<a href="#" class="view-more active">
            Collapse<i class="icon iPickDownR"></i>
        </a>-->
        <!--<div class="art-comment">
            <h4 class="title rs">12 Bình luận</h4>
            <img src="images/ex/th-656x605.png" alt="">
        </div> -->
    </div>



    <!--<div class="block">

        <h3 class="title">Other Events</h3>
        <div class="block-content">
            <ul class="rs lst-other-event">
                <li>
                    <a href="#">
                        20 Dec 2012 to 21 Dec 2012<br />
                        <span class="fw-b">Addiction Messenger from ATTC Network</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        20 Dec 2012 to 21 Dec 2012<br />
                        <span class="fw-b">Body in the bag spy's mystery links to oligarch</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        20 Dec 2012 to 21 Dec 2012<br />
                        <span class="fw-b">Revealed: 3 in 4 of Britain's danger doctors are trained abroad</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        20 Dec 2012 to 21 Dec 2012<br />
                        <span class="fw-b">Addiction Messenger from ATTC Network</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>-->
</div>
<div class="col">
    <!--<div class="place-maps">
        <img src="images/ex/th-312x220.png" alt="$MAPS">
    </div>-->
    <p class="fw-b">Contact Infomation</p>
    <p class="rs"><?php echo @$fields['contact_name'] ?></p>
    <p class="rs">Phone: <span class="fw-b"><?php echo @$fields['contact_phone'] ?></span></p>
    <p class="rs">Fax: <span class="fw-b"><?php echo @$fields['contact_fax'] ?></span></p>
    <?php if (isset($fields['contact_email']) && $fields['contact_email'] != '') : ?>
        <p class="rs">Email: <a href="<?php echo @$fields['contact_email'] ?></span>"><?php echo @$fields['contact_email'] ?></span></a></p>
    <?php endif; ?>

    <!--<p>
        <a class="btn-regiter" href="#">
            <span>Registration here</span>
        </a>
    </p>-->
</div>

</div>