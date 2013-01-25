<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 1/25/13
 * Time: 6:03 AM
 * To change this template use File | Settings | File Templates.
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');
class K2ControllerEf extends K2Controller {
    function calendar() {
        require_once (JPATH_SITE.DS.'modules'.DS.'mod_vhattc_tool'.DS.'include'.DS.'exCalendar.php');
        require_once (JPATH_SITE.DS.'modules'.DS.'mod_vhattc_tool'.DS.'helper.php');
        $mainframe = JFactory::getApplication();
        $month = JRequest::getInt('month');
        $year = JRequest::getInt('year');
        $months = array(JText::_('K2_JANUARY'), JText::_('K2_FEBRUARY'), JText::_('K2_MARCH'), JText::_('K2_APRIL'), JText::_('K2_MAY'), JText::_('K2_JUNE'), JText::_('K2_JULY'), JText::_('K2_AUGUST'), JText::_('K2_SEPTEMBER'), JText::_('K2_OCTOBER'), JText::_('K2_NOVEMBER'), JText::_('K2_DECEMBER'), );
        $days = array(JText::_('K2_SUN'), JText::_('K2_MON'), JText::_('K2_TUE'), JText::_('K2_WED'), JText::_('K2_THU'), JText::_('K2_FRI'), JText::_('K2_SAT'), );
        $cal = new FieldCalendar();
        $cal->setMonthNames($months);
        $cal->setDayNames($days);
        $cal->category = JRequest::getVar('catid');
        $cal->extraField = JRequest::getVar('exf');
        $cal->setStartDay(1);
        if (($month) && ($year))
        {
            echo $cal->getMonthView($month, $year);
        }
        else
        {
            echo $cal->getCurrentMonthView();
        }
        $mainframe->close();
    }
}