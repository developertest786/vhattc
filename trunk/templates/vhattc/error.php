<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.beez5
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
    <title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/style.css" type="text/css">
    <!--[if lte IE 7]>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie7.css">
    <![endif]-->
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.tinycarousel.js"></script>
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/script.js"></script>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-6749980-5']);
        _gaq.push(['_setDomainName', 'vhattc.org.vn']);
        _gaq.push(['_setAllowLinker', true]);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
<style type="text/css">
			<!--
			#errorboxbody
			{margin:30px}
			#errorboxbody h2
			{font-weight:normal;
			font-size:1.5em}
			#searchbox
			{background:#eee;
			padding:10px;
			margin-top:20px;
			border:solid 1px #ddd
			}
			-->
</style>
</head>

<body>

<div id="all" class="main-layout">
<!-- header -->
<div id="header" class="clearfix">
    <h1 class="rs">
        <a href="<?php echo $this->baseurl ?>">
            <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/logo.png" alt="">
        </a>
    </h1>
    <div class="right-panel">&nbsp;
        <h3 class="rs small-logo">
            <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/logo-small.png" alt="Đại Học Y Hà Nội">
        </h3>
    </div>
</div>

<div id="main-menu">
    <div class="fixCenter1K clearfix">
        <?php $module = JModuleHelper::getModule( 'menu' );
        echo JModuleHelper::renderModule( $module);	?>
    </div>
</div>


<div class="fixCenter1K">
    <div id="errorboxbody">
        <h2><?php echo JText::_('JERROR_AN_ERROR_HAS_OCCURRED'); ?><br />
            <?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h2>
        <?php if (JModuleHelper::getModule( 'search' )) : ?>
        <div id="searchbox">
            <h3 class="unseen"><?php echo JText::_('TPL_BEEZ5_SEARCH'); ?></h3>
            <p><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></p>
            <?php $module = JModuleHelper::getModule( 'search' );
            echo JModuleHelper::renderModule( $module);	?>
        </div>
        <?php endif; ?>
        <div>
            <p><a href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>"><?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
        </div>

        <h3><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></h3>

        <h2>#<?php echo $this->error->getCode() ; ?>&nbsp;<?php echo $this->error->getMessage();?></h2><br />

    </div><!-- end wrapper -->
</div>

    <?php if ($this->debug) :
    echo $this->renderBacktrace();
endif; ?>

<!-- BEGIN FOOTER -->
<div id="footer">
    <div class="fixCenter1K">
        <div class="top-thumb">
            <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ex/th-227x50.png" alt="">
            <a href="http://www.samhsa.gov/index.aspx" target="_blank">
                <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ex/th-227x50-1.png" alt="">
            </a>
            <a href="http://uclaisap.org" target="_blank">
                <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ex/th-227x50-2.png" alt="">
            </a>
        </div>
        <div class="clearfix">
            <div class="wrap-foot-item">
                <h5 class="rs title">Contact Us</h5>
                <p class="rs desc-contact">
                    <!-- Vietnam HIV Addiction Technology Transfer Center
                    Center for Research and Training on HIV/AIDS -->
                    Room 522, A1 Building, Hanoi Medical University, No. 1A Ton That Tung Street, Dong Da Dist, Hanoi, Vietnam
                </p>

                <p class="rs item-info">
                    <span class="lbl">TEL:</span>
                    <span class="val">(+844)35741596</span>
                </p>

                <p class="rs item-info">
                    <span class="lbl">FAX:</span>
                    <span class="val">(+844)35741596</span>
                </p>
                <p class="rs item-info">
                    <span class="lbl">Email:</span>
                    <a href="mailto:creata@hmu.edu.vn" class="val fc-w">creata@hmu.edu.vn</a>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- END FOOTER -->
<jdoc:include type="modules" name="debug" />
</body>
</html>
