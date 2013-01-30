<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 08/01/2013
 * Time: 04:30
 * To change this template use File | Settings | File Templates.
 */

require_once (dirname(__FILE__).DS.'include'.DS.'exCalendar.php');

class modVHATTCToolHelper {
    public static function getArchive(&$params) {
        $mainframe = JFactory::getApplication();
        $user = JFactory::getUser();
        $aid = (int)$user->get('aid');
        $db = JFactory::getDbo();

        $jnow = JFactory::getDate();
        $now = K2_JVERSION == '15' ? $jnow->toMySQL() : $jnow->toSql();

        $nullDate = $db->getNullDate();

        $query = "SELECT DISTINCT MONTH(date_value) as m, YEAR(date_value) as y FROM #__hik2_index";

        $catid = $params->get('archiveCategory', 0);
        if ($catid > 0)
            $query .= " WHERE item_id IN (SELECT id FROM #__k2_items WHERE catid = {$catid})";

        $query .= " ORDER BY date_value DESC";

        $db->setQuery($query, 0, 12);
        $rows = $db->loadObjectList();
        $months = array(JText::_('K2_JANUARY'), JText::_('K2_FEBRUARY'), JText::_('K2_MARCH'), JText::_('K2_APRIL'), JText::_('K2_MAY'), JText::_('K2_JUNE'), JText::_('K2_JULY'), JText::_('K2_AUGUST'), JText::_('K2_SEPTEMBER'), JText::_('K2_OCTOBER'), JText::_('K2_NOVEMBER'), JText::_('K2_DECEMBER'), );
        if (count($rows))
        {

            foreach ($rows as $row)
            {
                if ($params->get('archiveItemsCounter'))
                {
                    $row->numOfItems = self::countArchiveItems($row->m, $row->y, $catid);
                }
                else
                {
                    $row->numOfItems = '';
                }
                $row->name = $months[($row->m) - 1];
                $row->catid = $catid;
                $archives[] = $row;
            }

            return $archives;

        }
    }

    public static function countArchiveItems($month, $year, $catid = 0) {
        $month = (int)$month;
        $year = (int)$year;
        $db = JFactory::getDBO();

        $query = "SELECT COUNT(DISTINCT item_id) FROM #__hik2_index WHERE MONTH(date_value) = {$month} AND YEAR(date_value) = {$year}";
        if ($catid > 0) {
            $query .= " AND item_id IN (SELECT id FROM #__k2_items WHERE catid = {$catid})";
        }

        $db->setQuery($query);
        $total = $db->loadResult();
        return $total;

    }

    public static function calendar($params)
    {
        $month = JRequest::getInt('month');
        $year = JRequest::getInt('year');

        $months = array(JText::_('K2_JANUARY'), JText::_('K2_FEBRUARY'), JText::_('K2_MARCH'), JText::_('K2_APRIL'), JText::_('K2_MAY'), JText::_('K2_JUNE'), JText::_('K2_JULY'), JText::_('K2_AUGUST'), JText::_('K2_SEPTEMBER'), JText::_('K2_OCTOBER'), JText::_('K2_NOVEMBER'), JText::_('K2_DECEMBER'), );
        $days = array(JText::_('K2_SUN'), JText::_('K2_MON'), JText::_('K2_TUE'), JText::_('K2_WED'), JText::_('K2_THU'), JText::_('K2_FRI'), JText::_('K2_SAT'), );

        $cal = new FieldCalendar;
        $cal->category = $params->get('calendarCategory', 0);
        $cal->extraField = $params->get('calendarExtraField');
        $cal->setStartDay(1);
        $cal->setMonthNames($months);
        $cal->setDayNames($days);

        if (($month) && ($year))
        {
            return $cal->getMonthView($month, $year);
        }
        else
        {
            return $cal->getCurrentMonthView();
        }
    }

    public static function filter($params) {
        $mainframe = JFactory::getApplication();
        $user = JFactory::getUser();
        $aid = (int)$user->get('aid');
        $db = JFactory::getDbo();
        print_r($params); exit;
        $query = "SELECT * FROM #__k2_extra_fields e WHERE e.id=" .$params->get('extraFieldsFilter', 0);
        $db->setQuery($query, 0, 1);
        $rows = $db->loadObjectList();
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $row->value = json_decode($row->value, true);
                return $row->value;
            }
        }
    }
}

class FieldCalendar extends ExCalendar
{

    var $category = null;
    var $extraField = array();

    function getDateLink($day, $month, $year)
    {

        $mainframe = JFactory::getApplication();
        $user = JFactory::getUser();
        $aid = $user->get('aid');
        $db = JFactory::getDBO();

//        $jnow = JFactory::getDate();
//        $now = K2_JVERSION == '15' ? $jnow->toMySQL() : $jnow->toSql();

//        $nullDate = $db->getNullDate();

//        var_dump(K2_JVERSION); exit;

        $languageCheck = '';

        $accessCheck = " access IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
        if ($mainframe->getLanguageFilter())
        {
            $languageTag = JFactory::getLanguage()->getTag();
            $languageCheck = " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
        }

        $query = "SELECT COUNT(*) FROM #__k2_items AS i
                    WHERE i.id IN (SELECT item_id FROM #__hik2_index WHERE item_id = i.id
                                    AND extra_id IN (" .implode(',', $this->extraField) .")
                                    AND YEAR(date_value) = {$year}
                                    AND MONTH(date_value) = {$month}
                                    AND DAY(date_value) = {$day})
                        AND i.published=1
                        AND (i.publish_up = '0000-00-00 00:00:00' OR i.publish_up <= NOW() )
                        AND (i.publish_down = '0000-00-00 00:00:00' OR i.publish_down >= NOW() )
                        AND i.trash=0 AND {$accessCheck} {$languageCheck}
                        AND EXISTS(SELECT * FROM #__k2_categories WHERE id= i.catid AND published=1 AND trash=0 AND {$accessCheck} {$languageCheck})";

        $catid = $this->category;
        if ($catid > 0)
            $query .= " AND catid IN (" . implode(',', $catid) .")";

//        var_dump($query); exit;
        $db->setQuery($query);
        $result = $db->loadResult();
//        var_dump($result);exit;
        if ($db->getErrorNum())
        {
            echo $db->stderr();
            return false;
        }

        if ($result > 0)
        {
            $itemID = JRequest::getInt('Itemid');
//            var_dump($itemID);
            $link = 'index.php?option=com_k2&view=itemlist&task=exfilter&y='.$year.'&m='.$month.'&d='.$day.'&Itemid='.$itemID;
            if (!empty($catid)) {
                foreach ($catid as $cid) {
                    $link .='&catid[]=' .$cid;
                }

            }

            if (!empty($this->extraField)) {
                foreach($this->extraField as $ef) {
                    $link .='&exf[]=' .$ef;
                }
            }

            return JRoute::_($link);
        }
        else
        {
            return false;
        }
    }

    function getCalendarLink($month, $year)
    {
        $catid = $this->category;
        $itemID = JRequest::getInt('Itemid');
        $link = '/index.php?option=com_k2&amp;view=ef&amp;task=calendar&amp;year='.$year.'&amp;month='.$month.'&amp;Itemid='.$itemID;
        if (!empty($catid)) {
            foreach ($catid as $cid) {
                $link .='&amp;catid[]=' .$cid;
            }

        }

        if (!empty($this->extraField)) {
            foreach($this->extraField as $ef) {
                $link .='&amp;exf[]=' .$ef;
            }
        }

        return JURI::root(true) .$link;
    }

}