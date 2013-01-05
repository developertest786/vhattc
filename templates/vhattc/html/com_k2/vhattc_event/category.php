<?php
/**
 * @version		$Id: category.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>
<!-- Start K2 Category Layout -->
<div id="training-event" class="row l656 fixCenter1K itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
    <div class="col">
        <div class="all-event">
            <?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
            <div class="quick-filter">
                <!--<span class="fw-b">All:</span> <a href="#">Upcoming Events</a>  /  <a href="#">Past Events</a>-->
                <?php echo $this->category->name; ?>
            </div>
            <?php endif; ?>
            <div class="lst-event">
                <?php foreach ($this->leading as $leading) : ?>
                <?php
                    $this->item=$leading;
                    echo $this->loadTemplate('item');
                ?>
                <!--END: event-item-->
                <?php endforeach; ?>
            </div>
        </div>
        <div class="news-paging">
            <div class="line-through"></div>
                <span class="wrap-pager">
                    <a href="#" class="nobor">Prev</a>
                    <a href="#">1</a>
                    <a href="#">...</a>
                    <a href="#">3</a>
                    <a href="#" class="active">4</a>
                    <a href="#">5</a>
                    <a href="#">...</a>
                    <a href="#" class="nobor">Next</a>
                </span>
        </div>
    </div>
    <div class="col">
        <div id="datepicker_custom"></div>

        <form class="search-box-common clearfix">
            <label for="keyword">
                <input id="keyword" type="text" placeholder="Search article...">
            </label>
            <input type="submit" value="find">
        </form>

        <div class="block articles-archive">
            <h3 class="title">Archive</h3>
            <div class="block-content">
                <div class="wrap-lst clearfix">
                    <div class="rs item">
                        <div>
                            <a href="#"><span class="fw-b">December 2012</span> (2)</a>
                        </div>
                    </div>
                    <div class="rs item">
                        <div>
                            <a href="#"><span class="fw-b">November  2012</span> (11)</a>
                        </div>
                    </div>
                    <div class="rs item">
                        <div>
                            <a href="#"><span class="fw-b">October </span> (28)</a>
                        </div>
                    </div>
                    <div class="rs item">
                        <div>
                            <a href="#"><span class="fw-b">September  2012</span> (21)</a>
                        </div>
                    </div>
                    <div class="rs item">
                        <div>
                            <a href="#"><span class="fw-b">August 2012</span> (21)</a>
                        </div>
                    </div>
                    <div class="rs item">
                        <div>
                            <a href="#"><span class="fw-b">July  2012</span> (21)</a>
                        </div>
                    </div>
                    <div class="rs item">
                        <div>
                            <a href="#"><span class="fw-b">June  2012</span> (21)</a>
                        </div>
                    </div>
                    <div class="rs item">
                        <div>
                            <a href="#"><span class="fw-b">May  2012</span> (21)</a>
                        </div>
                    </div>
                    <div class="rs item">
                        <div>
                            <a href="#"><span class="fw-b">April  2012</span> (21)</a>
                        </div>
                    </div>
                    <div class="rs item">
                        <div>
                            <a href="#"><span class="fw-b">March  2012</span> (21)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End K2 Category Layout -->
