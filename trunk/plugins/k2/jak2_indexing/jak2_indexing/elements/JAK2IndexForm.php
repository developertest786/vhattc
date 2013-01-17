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
defined('_JEXEC') or die( 'Restricted access' );

class JElementJAK2IndexForm extends JElement
{
	/*
	 * Category name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'JAK2IndexForm';
	
	function fetchTooltip( $label, $description, &$node, $control_name, $name )
	{
		return "";
	}		
	
	/**
	 * fetch Element 
	 */
	function fetchElement($name, $value, &$node, $control_name)
	{	
		global $mainframe;	 
		if (!defined ('_JAK2INDEXFORM_')) {
			define ('_JAK2INDEXFORM_', 1);
			$uri = str_replace(DS,"/",str_replace( JPATH_SITE, JURI::base (), dirname(__FILE__) ));
			$uri = str_replace("/administrator", "", $uri);
			
			JHTML::stylesheet('jak2indexform.css', $uri."/");
			JHTML::script('jak2indexform.js', $uri."/");
		}
		$db = &JFactory::getDBO();
		$db->setQuery("SELECT COUNT(id) FROM #__k2_items WHERE trash=0 ");
		$total = $db->loadResult();
		if ($total>0)
		{
			$html	='<script type="text/javascript" >
			var url="'.JURI::root().'plugins/k2/jak2_indexing/jak2_reindex.php'.'";
			</script>';
			$html	.='<h3>'.JText::_('Total items')."  ".$total .'</h3>';
			
			$html	.='<form action="index.php" method="POST" id="ja_reindex">';
			$html	.='<label for="num_item">'.JText::_('Number of items to index per step ').'</label>';
			$html	.='<select name="num_item" id="num_item" >
						<option value="20" selected>20</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="150">150</option>
						<option value="200">200</option>
					</select>';
			$html	.='<input type="button" class="button" onclick="ja_reindex(0)" value="'.JText::_('Start re-indexing').'" />';
			$html	.='<input type="button" class="button" onclick="form_cancel()" value="Cancel" />';
			$html	.='</form>					';
			$html	.='<div id="loadingspan" style="display:none">Loading...</div>';
			$html	.='<div id="update-status">	</div>';
		}
		else $html = JText::_('K2-items not found');
		
		return $html;
	}	
}

?>