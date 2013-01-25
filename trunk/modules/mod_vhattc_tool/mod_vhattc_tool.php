<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 08/01/2013
 * Time: 04:27
 * To change this template use File | Settings | File Templates.
 */
// no direct access
defined('_JEXEC') or die ;

require_once (dirname(__FILE__).DS.'helper.php');

$moduleclass_sfx = $params->get('moduleclass_sfx', '');
$module_usage = $params->get('module_usage', 0);
JHTML::_('behavior.framework');

// API
$document = JFactory::getDocument();
$app = JFactory::getApplication();

// Output
switch ($module_usage)
{

    case '0' :
        $months = modVHATTCToolHelper::getArchive($params);
        if (count($months))
        {
            require (JModuleHelper::getLayoutPath('mod_k2_tools', 'archive'));
        }
        break;

    case '1' :
        break;

    case '2' :
        $calendar = modVHATTCToolHelper::calendar($params);
        require (JModuleHelper::getLayoutPath('mod_vhattc_tool', 'calendar'));
        break;

    case '3' :
        break;

    case '4' :
        break;

    case '5' :
        break;

    case '6' :
        break;

    case '7' :
        break;

    case '8' :
        break;

    case '9':
        break;
}
