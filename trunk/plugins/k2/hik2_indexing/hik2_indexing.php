<?php
/*
# ------------------------------------------------------------------------
# JA K2Extra fields plugin
# ------------------------------------------------------------------------
# Copyright (C) 2004-2010 JoomlArt.com. All Rights Reserved.
# @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Author: JoomlArt.com
# Websites: http://www.joomlart.com - http://www.joomlancers.com.
# ------------------------------------------------------------------------
*/

defined('_JEXEC') or die('Restricted access');


jimport('joomla.plugin.plugin');

class plgK2HIK2_Indexing extends JPlugin 
{

	function plgK2HIK2_Indexing(&$subject, $config) 
	{

		parent::__construct($subject, $config);
		$this->loadLanguage ( null, JPATH_ADMINISTRATOR);
	}

	// Extend user forms with K2 fields
	function onAfterK2Save(&$row, $isNew)
	{
		$db = & JFactory::getDBO();
		
		$sql = 'CREATE TABLE IF NOT EXISTS `#__hik2_index` (
  `item_id` int(11) NOT NULL,
  `extra_id` int(11) NOT NULL,
  `extra_key` varchar(255) NOT NULL,
  `bool_value` tinyint(1) NOT NULL,
  `text_value` text NOT NULL,
  `number_value` text NOT NULL,
  `date_value` datetime NOT NULL,
  `type` varchar(255) NOT NULL,
  KEY `extra_id` (`extra_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
		// create table if not exist
		$db->setQuery($sql);
		$db->query();

        //DELETE old indexing
        $query = "DELETE FROM #__hik2_index WHERE item_id = " .$row->id;
        $db->setQuery($query);
        $db->query();

        $objs = json_decode($row->extra_fields);
		
		// get extrafields list for itemid

        foreach ($objs as $obj) {
            $query = "SELECT * FROM #__k2_extra_fields WHERE id = " .$obj->id;
            $db->setQuery($query);
            $ef = $db->loadObject();
            $ef->value = json_decode($ef->value);

            if ($ef->type == 'select' || 'radio' == $ef->type) {
                foreach ($ef->value as $v) {
                    if ($v->value == $obj->value) {
                        $index = new stdClass();
                        $index->item_id = $row->id;
                        $index->number_value = $ef->value;
                        $index->extra_id = $ef->id;
                        $index->text_value = $v->name;
                        $index->extra_key = str_replace(' ', '_', strtolower($ef->name));
                        $db->insertObject('#__hik2_index', $index);
                    }
                }
            } else if ($ef->type == 'multipleSelect' ) {
                $select_value = array();
                foreach ($ef->value as $v) {
//                    print_r($v);
                    foreach ($obj->value as $obv) {
                        if ($v->value == $obv) {
                            $index = new stdClass();
                            $index->item_id = $row->id;
                            $index->number_value = $v->value;
                            $index->extra_id = $ef->id;
                            $index->text_value = $v->name;
                            $index->extra_key = str_replace(' ', '_', strtolower($ef->name));
                            $db->insertObject('#__hik2_index', $index);
                        }
                    } //end foreach $obj->value
                }//end foreach $ef->value
            } else {
                $index = new stdClass();
                $index->item_id = $row->id;
                $index->extra_id = $ef->id;
                $index->extra_key = str_replace(' ', '_', strtolower($ef->name));
                switch ($ef->type) {
                    case "date":
                        $index->date_value = $obj->value;
                        break;
                    default:
                        $index->text_value = $obj->value;
                }
                $db->insertObject('#__hik2_index', $index);
            }
        }
	}

	function K2Extrafield_reindex($start,$numitems)
	{
		$db = & JFactory::getDBO();
		$db->setQuery("SELECT COUNT(id) FROM #__k2_items WHERE trash=0 ");
		$total = $db->loadResult();
		if (!$total ||($total<$start))return '1';
		
		$query = "SELECT id, extra_fields FROM #__k2_items WHERE trash=0 LIMIT $start , $numitems ";
		$db->setQuery($query);
		$list = $db->loadObjectList();
        print_r($list); exit;
		if (!$list) return '1';
		
		foreach ($list as $item)
		{
            echo 'ok';
            self::onAfterK2Save($item, false); continue;
		}
		$n=count($list);
		return ($start +$n).','.$start;
	}
	function getSearchValue($id, $currentValue){

		$db = JFactory::getDBO();
		$db->setQuery("SELECT * FROM #__k2_extra_fields WHERE id = {$id}");
		$row =$db->loadObject();

		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'JSON.php');
		$json=new Services_JSON;
		$jsonObject=$json->decode($row->value);

		$value='';
		if ( $row->type=='textfield'|| $row->type=='textarea' || $row->type=='labels'){
			$value=$currentValue;
		}
		else if ($row->type=='multipleSelect'){
			foreach ($jsonObject as $option){
				if (in_array($option->value,$currentValue))
				$value.=$option->name.' ';
			}
		}
		else if ($row->type=='link'){
			$value.=$currentValue[0].' ';
			$value.=$currentValue[1].' ';
		}
		else {
			foreach ($jsonObject as $option){
				if ($option->value==$currentValue)
				$value.=$option->name;
			}
		}
		return $value;
	}

}
