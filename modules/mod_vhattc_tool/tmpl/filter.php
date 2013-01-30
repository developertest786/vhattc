<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Naroniacka
 * Date: 1/30/13
 * Time: 9:45 AM
 * To change this template use File | Settings | File Templates.
 */
$itemID = JRequest::getInt('Itemid');
$link = 'index.php?option=com_k2&Itemid='.$itemID;
$exf = $params->get('extraFieldsFilter', 0);
$exf = $exf[0];
//var_dump($filters, $params->get('extraFieldsFilter', 0)); exit;
?>
<span class="fw-b"><a href="<?php echo JRoute::_($link) ?>"><?php echo JText::_('K2_ALL') ?></a></span>
<?php for($i =0, $size = sizeof($filters); $i < $size; ++$i) {
    echo '<a href="' .JRoute::_($link.'&view=itemlist&task=exfilter&catid=' .$params->get('extraFieldsCategory', 0) .'&exf[]='.$exf.'&exf_val=' .$filters[$i]['value']) .'">' .$filters[$i]['name'] .'</a>';
    if ($i < $size - 1) {
        echo '  /  ';
    }
} ?>