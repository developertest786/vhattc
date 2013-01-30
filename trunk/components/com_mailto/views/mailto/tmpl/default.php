<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_mailto
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>
<style type="text/css">
        /*hoang*/
        /*hoang*/
    article,aside,details,figcaption,figure,footer,header,hgroup,nav,section {
        display: block;
    }

    fieldset {
        border: none;
        margin: 0;
        padding: 5px 0;
    }

    audio,
    canvas,
    video {
        display: inline-block;
        *display: inline;
        *zoom: 1;
    }
    audio:not([controls]) {
        display: none;
    }
    @font-face {
        font-family: 'MyriadPro-Cond';
        src: url('../font/myriadpro-cond.eot');
        src: url('../font/myriadpro-cond.eot?#iefix') format('embedded-opentype'), url('../font/myriadpro-cond.woff') format('woff'), url('../font/myriadpro-cond.ttf') format('truetype'), url('../font/myriadpro-cond.svg#myriadpro-cond') format('svg');
        font-weight: normal;
        font-style: normal;
    }
    html {
        font-size: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        font-size: 0.75em;
        line-height: 1.5em;
        color: #333333;
        background-color: #ffffff;
    }
    .rs,
    h1.rs,
    h2.rs,
    h3.rs,
    h4.rs,
    h5.rs,
    h6.rs {
        margin: 0;
        padding: 0;
    }
    ul.rs,
    ol.rs {
        list-style: none;
    }
    a {
        color: #195189;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    a:hover,
    a:active {
        outline: 0;
    }
    sub,
    sup {
        position: relative;
        font-size: 75%;
        line-height: 0;
        vertical-align: baseline;
    }
    sup {
        top: -0.5em;
    }
    sub {
        bottom: -0.25em;
    }
    img {
        /* Responsive images (ensure images don't scale beyond their parents) */

        max-width: 100%;
        /* Part 1: Set a maxium relative to the parent */

        /*width: auto\9; */
        /* IE7-8 need help adjusting responsive images */

        height: auto;
        /* Part 2: Scale the height according to the width, otherwise you get stretching */

        vertical-align: middle;
        border: 0;
        -ms-interpolation-mode: bicubic;
    }
    button,
    input,
    select,
    textarea {
        margin: 0;
        vertical-align: middle;
        font-family: arial, sans-serif;
        font-size: inherit;
    }
    button,
    input {
        *overflow: visible;
        line-height: normal;
    }
    button::-moz-focus-inner,
    input::-moz-focus-inner {
        padding: 0;
        border: 0;
    }
    button,
    html input[type="button"],
    input[type="reset"],
    input[type="submit"] {
        -webkit-appearance: button;
        cursor: pointer;
    }
    label,
    select,
    button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"],
    input[type="radio"],
    input[type="checkbox"] {
        cursor: pointer;
    }
    input[type="search"] {
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        -webkit-appearance: textfield;
    }
    input[type="search"]::-webkit-search-decoration,
    input[type="search"]::-webkit-search-cancel-button {
        -webkit-appearance: none;
    }
    textarea {
        overflow: auto;
        vertical-align: top;
    }
    .clearfix,
    .row {
        *zoom: 1;
    }
    .clearfix:before,
    .row:before,
    .clearfix:after,
    .row:after {
        display: table;
        content: "";
        line-height: 0;
    }
    .clearfix:after,
    .row:after {
        clear: both;
    }

    #mailto-window{
        padding: 0 10px;
    }
    #mailto-window h2.title{
        font-size: 1.667em;
        line-height: 2.2em;
    }
    #mailto-window .mailto-close{
        padding-bottom: 10px;
        text-align: right;
    }
    #mailto-window .mailto-close a{
        color: #15C;
    }
    #mailto-window .formelm{
        padding-bottom: 10px;
    }
    #mailto-window .formelm label{
        float: left;
        padding-top: 5px;
        width: 150px;
    }
    #mailto-window .formelm input{
        float: left;
        border: 1px solid #999;
        padding: 5px;
        width: 190px;
        outline: 0;
    }
    #mailto-window .wrap-btn-action{
        padding: 10px 0;
        text-align: right;
    }
    #mailto-window .wrap-btn-action button{
        padding: 4px 10px;
        margin-right: 5px;
        background: #eee;
        border: 1px solid #999;
    }
    #mailto-window .wrap-btn-action button:hover{
        background: #e9f3fc;
        border: 1px solid #7fb4ea;
    }
    #mailto-window .wrap-btn-action button:active{
        background: #cee5fc;
        border: 1px solid #579ee5;
    }
</style>
<script type="text/javascript">
	Joomla.submitbutton = function(pressbutton) {
		var form = document.getElementById('mailtoForm');

		// do field validation
		if (form.mailto.value == "" || form.from.value == "") {
			alert('<?php echo JText::_('COM_MAILTO_EMAIL_ERR_NOINFO'); ?>');
			return false;
		}
		form.submit();
	}
</script>
<?php
$data	= $this->get('data');
?>

<div id="mailto-window">
	<h2 class="title rs">
		<?php echo JText::_('COM_MAILTO_EMAIL_TO_A_FRIEND'); ?>
	</h2>
	<div class="mailto-close">
		<a href="javascript: void window.close()" title="<?php echo JText::_('COM_MAILTO_CLOSE_WINDOW'); ?>">
		 <span><?php echo JText::_('COM_MAILTO_CLOSE_WINDOW'); ?> </span></a>
	</div>

	<form action="<?php echo JURI::base() ?>index.php" id="mailtoForm" method="post">
		<div class="formelm clearfix">
			<label for="mailto_field"><?php echo JText::_('COM_MAILTO_EMAIL_TO'); ?></label>
			<input type="text" id="mailto_field" name="mailto" class="inputbox" size="25" value="<?php echo $this->escape($data->mailto); ?>"/>
		</div>
		<div class="formelm clearfix">
			<label for="sender_field">
			<?php echo JText::_('COM_MAILTO_SENDER'); ?></label>
			<input type="text" id="sender_field" name="sender" class="inputbox" value="<?php echo $this->escape($data->sender); ?>" size="25" />
		</div>
		<div class="formelm clearfix">
			<label for="from_field">
			<?php echo JText::_('COM_MAILTO_YOUR_EMAIL'); ?></label>
			<input type="text" id="from_field" name="from" class="inputbox" value="<?php echo $this->escape($data->from); ?>" size="25" />
		</div>
		<div class="formelm clearfix">
			<label for="subject_field">
			<?php echo JText::_('COM_MAILTO_SUBJECT'); ?></label>
			<input type="text" id="subject_field" name="subject" class="inputbox" value="<?php echo $this->escape($data->subject); ?>" size="25" />
		</div>
		<p class="wrap-btn-action rs">
			<button class="button" onclick="return Joomla.submitbutton('send');">
				<?php echo JText::_('COM_MAILTO_SEND'); ?>
			</button>
			<button class="button" onclick="window.close();return false;">
				<?php echo JText::_('COM_MAILTO_CANCEL'); ?>
			</button>
		</p>
		<input type="hidden" name="layout" value="<?php echo $this->getLayout();?>" />
		<input type="hidden" name="option" value="com_mailto" />
		<input type="hidden" name="task" value="send" />
		<input type="hidden" name="tmpl" value="component" />
		<input type="hidden" name="link" value="<?php echo $data->link; ?>" />
		<?php echo JHtml::_('form.token'); ?>

	</form>
</div>
