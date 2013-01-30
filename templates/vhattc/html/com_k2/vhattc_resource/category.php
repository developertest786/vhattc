<?php
// no direct access
defined('_JEXEC') or die;
?>

<!--<pre>
<?php
/*    var_dump($this); die;
    */?>
</pre>-->


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

<div class="row l656 fixCenter1K">
    <div class="col">
    <div class="block block-resc">
        <h3 class="title">
            <?php echo $this->category->name; ?>
        </h3>
        <div class="block-content">
            <div class="lst-resource-page">
                <div class="wrap-inside">
                    <div class="wrap-lst clearfix">
                        <?php foreach($this->leading as $key=>$item): ?>
                            <?php
                                // Load category_item.php by default
                                $this->item=$item;
                                echo $this->loadTemplate('item');
                            ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="news-paging" style="display: none">
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
    </div>


    </div>
    <div class="col">
        <div id="training-page">
        <?php
            $modules =  JModuleHelper::getModules('right');
            foreach ($modules as $module) {
                echo JModuleHelper::renderModule($module);
            }
        ?>
        </div>
    </div>
</div>
<!-- End K2 Category Layout -->


<!---->
<!---->
<!--<div class="row l656 fixCenter1K">-->
<!--    <div class="col">-->
<!--        <div class="block block-resc">-->
<!--            <h3 class="title">Resource</h3>-->
<!--            <div class="block-content">-->
<!--                <div class="lst-resource-page">-->
<!--                    <div class="wrap-inside">-->
<!--                        <div class="wrap-lst clearfix">-->
<!--                            <div class="resc-item">-->
<!--                                <div class="resc-info">-->
<!--                                    <a href="#" class="thumb">-->
<!--                                        <img src="../images/ex/th-91x91.png" alt="$TITLE">-->
<!--                                    </a>-->
<!--                                    <div class="right-info">-->
<!--                                        <h3 class="rs resc-title">-->
<!--                                            <a href="#">Comprehensive Comunity Mental Health Service for Children and Their Families Program, Evaluation</a>-->
<!--                                        </h3>-->
<!--                                        <div class="clearfix wrap-btn-down">-->
<!--                                            <a href="#" class="btn-download">-->
<!--                                                Download-->
<!--                                                <i class="icon iArrowDown"></i>-->
<!--                                            </a>-->
<!--                                            <span class="file-size"><span class="fw-b">5</span>MBs</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div><
<!--                            <div class="resc-item">-->
<!--                                <div class="resc-info">-->
<!--                                    <a href="#" class="thumb">-->
<!--                                        <img src="../images/ex/th-91x91.png" alt="$TITLE">-->
<!--                                        <i class="icon iPlay"></i>-->
<!--                                    </a>-->
<!--                                    <div class="right-info">-->
<!--                                        <h3 class="rs resc-title">-->
<!--                                            <a href="#">Comprehensive Comunity Mental Health Service for Children and Their Families Program, Evaluation</a>-->
<!--                                        </h3>-->
<!--                                        <div class="clearfix wrap-btn-down">-->
<!--                                            <a href="#" class="btn-download">-->
<!--                                                View-->
<!--                                                <i class="icon iArrowRight"></i>-->
<!--                                            </a>-->
<!--                                            <span class="file-size"><span class="fw-b">5</span>MBs</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="news-paging">-->
<!--                    <div class="line-through"></div>-->
<!--                    <span class="wrap-pager">-->
<!--                        <a href="#" class="nobor">Prev</a>-->
<!--                        <a href="#">1</a>-->
<!--                        <a href="#">...</a>-->
<!--                        <a href="#">3</a>-->
<!--                        <a href="#" class="active">4</a>-->
<!--                        <a href="#">5</a>-->
<!--                        <a href="#">...</a>-->
<!--                        <a href="#" class="nobor">Next</a>-->
<!--                    </span>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col">-->
<!--        --><?php
//            $modules = JModuleHelper::getModules('right');
//            foreach ($modules as $module) {
//                echo JModuleHelper::renderModule($module);
//            }
//        ?>
<!--    </div>-->
<!--</div>-->
