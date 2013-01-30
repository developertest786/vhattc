<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Naroniacka
 * Date: 1/30/13
 * Time: 9:45 AM
 * To change this template use File | Settings | File Templates.
 */
$link = 'index.php?option=com_k2&view=itemlist&catid=' .$params->get('extraFieldsCategory', 0);
?>
<span class=""><a href="<?php echo JRoute::_($link) ?>">' .JText::_('K2_ALL') .'</a></span>
<?php foreach ($filters as $filter) {
    echo '<a href="' .JRoute::_($link.'&exf='.$params->get('extraFieldsFilter', 0).'&exf_val=' .$filter['value']) .'">' .$filter['name'] .'</a>';
} ?>