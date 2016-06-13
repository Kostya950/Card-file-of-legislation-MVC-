<?php
/**
 * Created by PhpStorm.
 * User: kito
 * Date: 22.05.16
 * Time: 15:51
 */

Config::set('site_name','Картотека');



// Routes. Route name => method prefix

Config::set('routes', array (
    'default' => '',
    'admin' => 'admin_',
));

Config::set('default_route', 'default');
Config::set('default_language', 'ua');
Config::set('default_controller', 'pages');
Config::set('default_action', 'index');
Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '111111');
Config::set('db.db_name', 'legis_mvc');
Config::set('documents', 214);

Config::set('salt','jd7sj3sdkd964he7e');