<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.beez5
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// check modules
$mainContentId = '';
if ($this->countModules('user1')) {
    $mainContentId = 'contact-us';
}

$showRightColumn	= ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$showbottom			= ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$showleft			= ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

if ($showRightColumn==0 and $showleft==0) {
	$showno = 0;
}

JHtml::_('behavior.framework', true);

// get params
#$color			= $this->params->get('templatecolor');
#$logo			= $this->params->get('logo');
#$navposition	= $this->params->get('navposition');
$app			= JFactory::getApplication();
$doc			= JFactory::getDocument();
$templateparams	= $app->getTemplate(true)->params;

$doc->addScript($this->baseurl.'/templates/'.$this->template.'/javascript/md_stylechanger.js', 'text/javascript', true);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
		<jdoc:include type="head" />
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

	</head>

	<body>

<div id="all" class="main-layout">
    <!-- header -->
    <div id="header" class="clearfix">
        <h1 class="rs">
            <a href="<?php echo $this->baseurl ?>">
                <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/logo.png" alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>">
            </a>
        </h1>
        <div class="right-panel">&nbsp;
            <div class="clearfix">
                <jdoc:include type="modules" name="position-0" />
                <!-- <div class="language">
                    <div class="current-lang">
                        <img src="images/en.png" alt="$LANG_NAME">
                        <span>English</span>
                        <i class="icon iPickDownW"></i>
                    </div>
                    <ul id="sys-lst-language" class="rs">
                        <li>
                            <img src="images/en.png" alt="$LANG_NAME">
                            <span>English</span>
                        </li>
                        <li>
                            <img src="images/en.png" alt="$LANG_NAME">
                            <span>Vietnamese</span>
                        </li>
                    </ul>
                    <form id="sys_choose_lang" style="display: none">
                        <select name="lang" id="sys_language_select">
                            <option value="1">Eng</option>
                            <option value="2">Vie</option>
                        </select>
                    </form>

                </div>
                <!--
                <div class="sign-in">
                    <a href="#">Sign in</a>
                    <span class="sep">|</span>
                    <a href="#">Sign out</a>
                </div>
                -->
            </div>
            <h3 class="rs small-logo">
                <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/logo-small.png" alt="Đại Học Y Hà Nội">
            </h3>
        </div>
    </div>

    <div id="main-menu">
        <?php if ($this->countModules('main-menu')): ?>
        <div class="fixCenter1K clearfix">
            <jdoc:include type="modules" name="main-menu" />
        </div>
        <?php endif; ?>
    </div>

    <?php if ($this->countModules('slideshow')) :?>
    <div id="main-slide">
        <div class="fixCenter1K">
            <jdoc:include type="modules" name="slideshow" />
        </div>
    </div>
    <?php endif; ?>

    <div <?php if ($mainContentId) { ?> id="<?php echo $mainContentId ?>" <?php } ?> class="fixCenter1K">
        <?php if ($this->countModules('about-us')): ?>
        <jdoc:include type="modules" name="about-us" />
        <?php endif; ?>

        <?php if ($this->countModules('user1')): ?>
        <jdoc:include type="modules" name="user1" />
        <?php endif; ?>

        <jdoc:include type="message" />
        <jdoc:include type="component" />
    </div>

    <!-- BEGIN SLIDE PARTNERS -->
    <?php if ($this->countModules('partners-list')) : ?>
    <jdoc:include type="modules" name="partners-list" />
    <div id="slide-partner-org">
        <div class="fixCenter1K">
            <div class="block">
                <h3 class="title">Partner organizations</h3>
                <div class="block-content">
                    <div id="slider_partner">
                        <a class="buttons prev" href="#">
                            <i class="iconB iPrev"></i>
                        </a>
                        <a class="buttons next" href="#">
                            <i class="iconB iNext"></i>
                        </a>
                        <div class="viewport">
                            <ul class="rs overview clearfix">
                                <li>
                                    <div class="partner-item">
                                        <div class="center-thumb">
                                            <span class="vertical-hold"><!--for IE6,7--></span>
                                            <a href="#" class="thumb">
                                                <img src="images/ex/th-226x122.png" alt="$PARTNER_NAME">
                                            </a>
                                        </div>
                                        <p class="rs name">VAAC</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="partner-item">
                                        <div class="center-thumb">
                                            <span class="vertical-hold"><!--for IE6,7--></span>
                                            <a href="#" class="thumb">
                                                <img src="images/ex/th-logo1.png" alt="$PARTNER_NAME">
                                            </a>
                                        </div>
                                        <p class="rs name">AXSC</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="partner-item">
                                        <div class="center-thumb">
                                            <span class="vertical-hold"><!--for IE6,7--></span>
                                            <a href="#" class="thumb">
                                                <img src="images/ex/th-logo2.png" alt="$PARTNER_NAME">
                                            </a>
                                        </div>
                                        <p class="rs name">DWAC</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="partner-item">
                                        <div class="center-thumb">
                                            <span class="vertical-hold"><!--for IE6,7--></span>
                                            <a href="#" class="thumb">
                                                <img src="images/ex/th-logo2.png" alt="$PARTNER_NAME">
                                            </a>
                                        </div>
                                        <p class="rs name">AXSC</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="partner-item">
                                        <div class="center-thumb">
                                            <span class="vertical-hold"><!--for IE6,7--></span>
                                            <a href="#" class="thumb">
                                                <img src="images/ex/th-logo1.png" alt="$PARTNER_NAME">
                                            </a>
                                        </div>
                                        <p class="rs name">AXSC</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="partner-item">
                                        <div class="center-thumb">
                                            <span class="vertical-hold"><!--for IE6,7--></span>
                                            <a href="#" class="thumb">
                                                <img src="images/ex/th-logo2.png" alt="$PARTNER_NAME">
                                            </a>
                                        </div>
                                        <p class="rs name">DWAC</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="partner-item">
                                        <div class="center-thumb">
                                            <span class="vertical-hold"><!--for IE6,7--></span>
                                            <a href="#" class="thumb">
                                                <img src="images/ex/th-logo2.png" alt="$PARTNER_NAME">
                                            </a>
                                        </div>
                                        <p class="rs name">AXSC</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="partner-item">
                                        <div class="center-thumb">
                                            <span class="vertical-hold"><!--for IE6,7--></span>
                                            <a href="#" class="thumb">
                                                <img src="images/ex/th-logo1.png" alt="$PARTNER_NAME">
                                            </a>
                                        </div>
                                        <p class="rs name">AXSC</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="partner-item">
                                        <div class="center-thumb">
                                            <span class="vertical-hold"><!--for IE6,7--></span>
                                            <a href="#" class="thumb">
                                                <img src="images/ex/th-logo.png" alt="$PARTNER_NAME">
                                            </a>
                                        </div>
                                        <p class="rs name">CLGT</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!--end: ...-->
            </div>

        </div>
    </div>
    <?php endif; ?>
    <!-- END SLIDE PARTNERS -->

    <!-- BEGIN FOOTER -->
    <div id="footer">
        <div class="fixCenter1K">
            <div class="top-thumb">
                <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ex/th-logo.png" alt="" height="50">
                <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ex/th-227x50.png" alt="">
                <a href="http://www.samhsa.gov/index.aspx" target="_blank">
                    <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ex/th-227x50-1.png" alt="">
                </a>
                <a href="http://uclaisap.org" target="_blank">
                    <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/ex/th-227x50-2.png" alt="">
                </a>
            </div>
            <div class="clearfix">
                <div class="col-type1">
                    <?php if ($this->countModules('user-17')) :?>
                    <div class="wrap-foot-item">
                        <jdoc:include type="modules" name="user-17" />
                    </div>
                    <?php endif; ?>
                </div><!--end: col-type1 -->
                <div class="col-type1">
                    <?php if ($this->countModules('user-18')) :?>
                    <div class="wrap-foot-item">
                        <jdoc:include type="modules" name="user-18" />
                    </div>
                    <?php endif; ?>
                </div><!--end: col-type1 -->
                <div class="col-type1">
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
                </div><!--end: col-type1 -->
                <div class="col-type2">
                    <div class="wrap-foot-item">
                        <h5 class="rs title">Connect with us</h5>
                        <div class="social-contact">
                            <a href="#">
                                <i class="icon iFb"></i>
                            </a>
                            <a href="#">
                                <i class="icon iTw"></i>
                            </a>
                        </div>
                        <h5 class="rs title">Email to Subcrible</h5>
                        <form class="email-subcrible clearfix" name="email">
                            <label for="email-subcrible">
                                <input type="text" id="email-subcrible" placeholder="Your email">
                                <i class="icon iPickRightW"></i>
                            </label>
                            <input type="submit" value="Send">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END FOOTER -->
    <jdoc:include type="modules" name="debug" />
	</body>
</html>
