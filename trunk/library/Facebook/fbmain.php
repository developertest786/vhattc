<?php

    $fbconfig['appid' ]     = "410368649036135";
    $fbconfig['secret']     = "83163f27eef66352e59cf97ec4865e50";
    $fbconfig['baseurl']    = "http://alimama.vn";

    $user            =   null; //facebook user uid
    
    include_once "facebook.php";
    
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));

    //Facebook Authentication part
    $user       = $facebook->getUser();
    $loginUrl   = $facebook->getLoginUrl(
            array(
                'scope'         => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
                'redirect_uri'  => $fbconfig['baseurl']
            )
    );
    $logoutUrl  = $facebook->getLogoutUrl();
   
?>
