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
    'manage' => ''
));
Config::set('default_route', 'default');
Config::set('default_language', 'ua');
Config::set('default_controller', 'pages');
Config::set('default_action', 'index');
Config::set('db.host', 'mysql.hostinger.com.ua');
Config::set('db.user', 'u457181443_pravo');
Config::set('db.password', '0442007547');
Config::set('db.db_name', 'u457181443_legis');
Config::set('salt','Hello World');

