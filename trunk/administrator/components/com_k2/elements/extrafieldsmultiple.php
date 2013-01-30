<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 08/01/2013
 * Time: 05:04
 * To change this template use File | Settings | File Templates.
 */

// no direct access
defined('_JEXEC') or die ;

require_once (JPATH_ADMINISTRATOR.'/components/com_k2/elements/base.php');

class K2ElementExtraFieldsMultiple extends K2Element
{

    function fetchElement($name, $value, &$node, $control_name)
    {
        $params = JComponentHelper::getParams('com_k2');
        $document = JFactory::getDocument();
        if (version_compare(JVERSION, '1.6.0', 'ge'))
        {
            JHtml::_('behavior.framework');
        }
        else
        {
            JHTML::_('behavior.mootools');
        }
        K2HelperHTML::loadjQuery();

        $db = JFactory::getDBO();
        $query = 'SELECT m.* FROM #__k2_extra_fields m WHERE m.published = 1 AND m.type IN ("select", "multipleSelect") ORDER BY m.ordering, m.group';
        $db->setQuery($query);
        $mitems = $db->loadObjectList();
        $options = array();
        if ($mitems)
        {
            foreach ($mitems as $v)
            {
                $options[] = JHTML::_('select.option', 'name', $v->id);
            }
        }
        $size = sizeof($options) + 3;
        if($size > 10) {
            $size = 10;
        }
        $output = JHTML::_('select.genericlist', $options, $name.'[]', 'class="inputbox" multiple="multiple" size=" ' .$size .'"', 'value', 'text', $value);
        return $output;
    }
}

class JFormFieldExtraFieldsMultiple extends K2ElementExtraFieldsMultiple
{
    var $type = 'extrafieldsmultiple';
}

class JElementExtraFieldsMultiple extends K2ElementExtraFieldsMultiple
{
    var $_name = 'extrafieldsmultiple';
}