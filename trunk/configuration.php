<?php
define('MY_LOG_PATH', __DIR__ .'/log');
define('MY_TEMP_PATH', __DIR__ .'/tmp');
class JConfig {
	public $offline = '0';
	public $offline_message = 'Trang web này đang được bảo trì.</br>Xin quay trở lại sau. ';
	public $display_offline_message = '1';
	public $offline_image = '';
	public $sitename = 'VHATTC';
	public $editor = 'tinymce';
	public $captcha = '0';
	public $list_limit = '20';
	public $access = '1';
	public $debug = '1';
	public $debug_lang = '0';
	public $dbtype = 'mysqli';
	public $host = 'localhost';
	public $user = 'vhattc';
	public $password = '628LkOqpN';
	public $db = 'vhattc_dev';
	public $dbprefix = 'jos_';
	public $live_site = '';
	public $secret = 'rjggfxZY7mtM8ilF';
	public $gzip = '1';
	public $error_reporting = 'default';
	public $helpurl = 'http://help.joomla.org/proxy/index.php?option=com_help&keyref=Help{major}{minor}:{keyref}';
	public $ftp_host = '';
	public $ftp_port = '';
	public $ftp_user = '';
	public $ftp_pass = '';
	public $ftp_root = '';
	public $ftp_enable = '0';
	public $offset = 'Asia/Ho_Chi_Minh';
	public $mailer = 'mail';
	public $mailfrom = 'tronghieu.luu@gmail.com';
	public $fromname = 'VHATTC';
	public $sendmail = '/usr/sbin/sendmail';
	public $smtpauth = '0';
	public $smtpuser = '';
	public $smtppass = '';
	public $smtphost = 'localhost';
	public $smtpsecure = 'none';
	public $smtpport = '25';
	public $caching = '0';
	public $cache_handler = 'file';
	public $cachetime = '15';
	public $MetaDesc = '';
	public $MetaKeys = '';
	public $MetaTitle = '1';
	public $MetaAuthor = '1';
	public $MetaVersion = '0';
	public $robots = '';
	public $sef = '1';
	public $sef_rewrite = '0';
	public $sef_suffix = '0';
	public $unicodeslugs = '0';
	public $feed_limit = '10';
	public $log_path = MY_LOG_PATH;
	public $tmp_path = MY_TEMP_PATH;
	public $lifetime = '15';
	public $session_handler = 'database';
	public $MetaRights = '';
	public $sitename_pagetitles = '0';
	public $force_ssl = '0';
	public $feed_email = 'author';
	public $cookie_domain = '';
	public $cookie_path = '';
}