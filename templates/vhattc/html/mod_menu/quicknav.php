<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
?>
<ul class="quick-nav menu <?php echo $class_sfx;?>"<?php
    $tag = '';
    if ($params->get('tag_id')!=NULL) {
        $tag = $params->get('tag_id').'';
        echo ' id="'.$tag.'"';
    }
    ?>>
    <?php
    foreach ($list as $i => &$item) :
        $class = '';
        if ($item->id == $active_id) {
            $class .= ' current';
        }

        if (in_array($item->id, $path)) {
            $class .= ' active';
        }
        elseif ($item->type == 'alias') {
            $aliasToId = $item->params->get('aliasoptions');
            if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
                $class .= ' active';
            }
            elseif (in_array($aliasToId, $path)) {
                $class .= ' alias-parent-active';
            }
        }

        if ($item->deeper) {
            $class = ' deeper';
        }

        if ($item->parent) {
            $class .= ' parent';
        }

        if (!empty($class)) {
            $class = ' class="'.trim($class) .'"';
        }

        echo '<li'.$class.'>';

        // Render the menu item.
        switch ($item->type) :
            case 'separator':
            case 'url':
            case 'component':
                require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
                break;

            default:
                require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
                break;
        endswitch;

        // The next item is deeper.
        if ($item->deeper) {
            echo '<ul>';
        }
        // The next item is shallower.
        elseif ($item->shallower) {
            echo '</li>';
            echo str_repeat('</ul></li>', $item->level_diff);
        }
        // The next item is on the same level.
        else {
            echo '</li>';
        }
    endforeach;
    ?>
</ul>

<div class="quick-nav">
<div class="grp-lst-nav">
    <h4 class="rs title"><a href="#">Who we are</a></h4>
</div><!--end: div.grp-lst-nav -->
<div class="grp-lst-nav">
    <h4 class="rs title"><a href="#">What we do</a></h4>
    <ul class="rs lst-nav">
        <li><a href="#">Technology tranfer</a></li>
        <li><a href="#">Training</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
    </ul>
</div><!--end: div.grp-lst-nav -->
<div class="grp-lst-nav">
    <h4 class="rs title"><a href="#">Who we service</a></h4>
    <ul class="rs lst-nav">
        <li><a href="#">Technology tranfer</a></li>
        <li><a href="#">Training</a></li>
        <li><a href="#">Lorem ipsum dolor</a></li>
    </ul>
</div><!--end: div.grp-lst-nav -->
<div class="grp-lst-nav">
    <h4 class="rs title"><a href="#">Partnered</a></h4>
</div><!--end: div.grp-lst-nav -->
<div class="grp-lst-nav">
    <h4 class="rs title"><a href="#">Organizations</a></h4>
</div><!--end: div.grp-lst-nav -->
</div>