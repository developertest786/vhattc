<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Van Bich
 * Date: 26/11/2012
 * Time: 09:03
 * To change this template use File | Settings | File Templates.
 */
class FrontendAuth extends UserAuth
{
    static $urlReturn = '';
    public function init() {
        parent::init();
        if ($this->isAuthenticated()){
            $this->_setIsAuthenticated(false);
        }
    }

    public function authenticate($username, $password, $remember = false) {
        parent::authenticate($username, $password, $remember = false);
        return $this->isAuthenticated();
    }
    public function authenWith($type,$config = null){

        switch($type){
            case 'facebook':$this->authenWidthFace($type);break;
            case ('google' || 'yahoo'):$this->authenWidthOpen($type);break;
            default : ; break;
        }
        return self::$urlReturn;

    }
    public function authenWidthOpen($type){
        $opencfg['domain']     = "http://localhost/t90/www/";
        $open_links = array(
            'yahoo'=>'https://me.yahoo.com',
            'google'=>'https://www.google.com/accounts/o8/id'
        );
        Ming_Loader::import('lib.Openid.*');
        $openid = new LightOpenID($opencfg['domain']);
        $openid->identity = $open_links[$type];
        $openid->required = array('contact/email');
        $openid->optional = array(
            'namePerson',
            'namePerson/friendly',
            'namePerson/friendly',
            'contact/email',
            'namePerson',
            'birthDate',
            'person/gender',
            'contact/postalCode/home',
            'contact/country/home',
            'pref/language',
            'pref/timezone'
        );
        $openid->returnUrl = $opencfg['domain'];
        return self::$urlReturn = $openid->authUrl();
    }
    public function authenWidthFace( $type = null){
        $fbconfig = Ming_Config::load('globals.config.facebook');

        Ming_Loader::import('lib.Facebook.*');

        $facebook = new Facebook(array(
            'appId'  => $fbconfig['appId'],
            'secret' => $fbconfig['secret'],
            'cookie' => true,
        ));

        $loginUrl   = $facebook->getLoginUrl(
            array(
                //'scope'         => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
                'scope' => 'photo_upload,user_status,publish_stream,user_photos,manage_pages',
                'redirect_uri'  => $fbconfig['baseurl']
            )
        );

        self::$urlReturn = $loginUrl;
        return self::$urlReturn;
    }
}