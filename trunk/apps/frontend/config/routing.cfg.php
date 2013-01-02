<?php
return array(
    '__urlSuffix__' => '.html',

    /* default component
     *  the controllers process and response frontpage of project
     */

    /* remap if optional config, when router can not find controllers
     *  '__remap__' => array(
     *      'controllers' => 'path/to/controllers'
     *      'action'    => action_name
     *      'param'     => [p1, p2, p3],
     *   ),
     *  exp: request ming.vn/tronghieu1012, we all know that no controllers is tronghieu1012
     *  , this is username and right controllers is user
     *  '__remap__' = array(
     *      'controllers' => 'user',
     *      'action'    => 'default'
     *   ),
     * 'tronghieu1012' will be set as first param
     */
    '__remap__' => array('route' => 'page/default'),

    /*
     * rules description
     * exp
     *  'pattern' => array(
     *      'route' => 'path/to/controllers/action', path to controller and action
     *      'params' => [p1, p2, p3], optional parameters
     *      'filter' => array(
     *          'method' => 'ANY' //filter by request method POST, GET, PUT, DELETE or all
     *      ),
     *      'options' => array(
     *          'suffix' => '' //url suffix
     *      ),
     *  );
     */
    //default controller
    '/' => array(
        'route' => 'page/default'
    ),
    '{lang:(en|vi)}' => array(
        'route' => 'page/default'
    ),
    'p-{slug:[a-zA-Z0-9-]+}' => array(
        'route' => 'page/default'
    ),
    '{lang:(en|vi)}/p-{slug:[a-zA-Z0-9-]+}' => array(
        'route' => 'page/default'
    ),
    '{action:(sign_in|sign_out)}' => array(
        'route' => 'auth/{action}',
    ),
    '{controller}/{action}' => array(
        'route' => '{controller}/{action}'
    ),

    /*'{main_cat:[a-zA-Z0-9-]+}' => array(
        'route' => 'category/default'
    ),
    '{main_cat:[a-zA-Z0-9-]+}/{sub_cat:[a-zA-Z0-9-]+}' => array(
        'route' => 'category/default'
    ),*/
);