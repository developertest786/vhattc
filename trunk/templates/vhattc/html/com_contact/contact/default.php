<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams ('com_media');
?>

<div class="row contact-form">
    <div class="col-type1">
        <p>Integer risus enim, imperdiet vel interdum at, molestie eget enim. Integer in nisl non massa faucibus placerat. Aenean enim lorem, rutrum a placerat eu, congue eu justo. Pellentesque vulputate, orci et elementum malesuada, dolor odio volutpat augue, in fringilla dui elit vitae diam. Suspendisse libero lorem, pharetra vel facilisis et, scelerisque ultricies tortor. In a ligula purus. Fusce in risus leo. Curabitur lacinia felis a nisl posuere convallis.</p>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas facilisis malesuada sagittis. Sed vitae lacus quam. Morbi consequat varius lacinia. odales tellus non eros consectetur rhoncus.</p>
    </div>
    <div class="col-type2">
            <?php if ($this->params->get('show_page_heading', 1)) : ?>
            <h3 class="rs title">
                <?php echo $this->escape($this->params->get('page_heading')); ?>
            </h3>
            <?php endif; ?>
            <?php  echo $this->loadTemplate('form');  ?>
    </div>
</div>