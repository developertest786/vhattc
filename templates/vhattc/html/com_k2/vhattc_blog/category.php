<?php
/**
 * @version        $Id: category.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
 * @package        K2
 * @author        JoomlaWorks http://www.joomlaworks.net
 * @copyright    Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license        GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>
<!-- Start K2 Category Layout -->
<div id="news-list" class="row l656 fixCenter1K itemListView<?php if ($this->params->get('pageclass_sfx')) echo ' ' . $this->params->get('pageclass_sfx'); ?>">
    <div class="col">
        <div>
            <?php
            $modules = JModuleHelper::getModules('other-news');
            if (!empty($modules)) : ?>
                <?php foreach ($modules as $module) {
                    echo JModuleHelper::renderModule($module);
                }
                ?>
            <?php endif; ?>
        </div>
        <div class="lst-rating-project">

            <!--demo truong hoop anh-->
            <div class="news-item">
                <a href="#" class="thumb">
                    <img src="images/banners/th-111x111.jpg" alt="$NEWS_TITLE">
                </a>
                <div class="wrap-content">
                    <h3 class="rs title">
                        <a href="/vhattc/vi/danh-gia-du-an/item/58-dự-án-nghiên-cứu-hệ-thống-chính-sách-phòng-chống-ma-tuý-và-đánh-giá-hiệu-quả-thực-hiện-một-số-chính-sách-ma-tuý-tại-thành-phố-hải-phòng-từ-2012-đến-2014-dự-án-fhi-ap">Dự án Nghiên cứu hệ thống chính sách phòng chống ma tuý và đánh giá hiệu quả thực hiện một số chính sách ma tuý tại thành phố Hải Phòng  từ 2012 đến 2014 (Dự án FHI-AP)</a>
                        <span class="date">- [29-01-2013]</span>
                    </h3>
                    <p class="rs lead-news">Trung tâm nghiên cứu và đào tạo HIV/AIDS (CREATA), Trường Đại Học Y Hà Nội hiện đang tiến hành triển khai dự án “Nghiên cứu hệ thống chính s...</p>
                    <p class="rs ta-r fs11">
                        <a class="view-detail" href="/vhattc/vi/danh-gia-du-an/item/58-dự-án-nghiên-cứu-hệ-thống-chính-sách-phòng-chống-ma-tuý-và-đánh-giá-hiệu-quả-thực-hiện-một-số-chính-sách-ma-tuý-tại-thành-phố-hải-phòng-từ-2012-đến-2014-dự-án-fhi-ap">Xem thêm <i class="icon iPickReadR"></i></a>
                    </p>
                </div>
            </div><!--end: demo -->

            <?php if (!empty($this->leading)) : ?>
            <?php foreach ($this->leading as $leading) : ?>
                <?php $this->item = $leading;
                if (is_scalar($this->item->extra_fields)) {
                    $model = K2Model::getInstance('Item', 'K2Model');
                    $this->item->extra_fields = $model->getItemExtraFields($this->item->extra_fields, $this->item);
                }
                echo $this->loadTemplate('item');
                ?>
                <?php endforeach; ?>
            <?php else : ?>
            <p style="text-align: center; margin: 20px 0; font-weight: bold;"><?php echo JText::_('K2_NOT_FOUND_CONTENT'); ?></p>
            <?php endif; ?>
            <!--END: event-item-->
        </div>

        <!-- Pagination -->
        <?php if (count($this->pagination->getPagesLinks())): ?>
        <div class="news-paging">
            <div class="line-through"></div>
            <?php if ($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
            <?php if ($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?>
        </div>
        <?php endif; ?>

    </div>
    <div class="col">
        <div id="training-page">
            <?php
            $modules = JModuleHelper::getModules('right');
            foreach ($modules as $module) {
                echo JModuleHelper::renderModule($module);
            }
            ?>
        </div>
    </div>
</div>
<!-- End K2 Category Layout -->
