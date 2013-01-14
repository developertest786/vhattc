<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 05/01/2013
 * Time: 05:56
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php if (!empty($images)) :?>
<!-- begin slide here here -->
<div id="main-slider-code">
    <a href="#" class="buttons prev">left</a>
    <div class="viewport">
        <ul class="overview rs">
        <?php for ($i=0; $i< count($images); $i++): ?>
            <li><img src="<?php echo $images[$i];?>"/></li>
        <?php endfor; ?>
        </ul>
    </div>
    <a href="#" class="buttons next">right</a>

    <div class="wrap-pager">
        <span class="mack"></span>
        <ul class="pager rs">
            <?php for ($i=0; $i< count($images); $i++): ?>
            <li><a rel="<?php echo $i ?>" class="pagenum" href="#"><?php echo $i+1 ?></a></li>
            <?php endfor; ?>
        </ul>
    </div>
</div>
<?php endif; ?>