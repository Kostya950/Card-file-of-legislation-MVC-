<?php
/**
 * Created by PhpStorm.
 * User: kito
 * Date: 22.05.16
 * Time: 15:36
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT.DS.'views');

require_once (ROOT.DS.'lib'.DS.'init.php');
include 'count.php';

try {
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    App::run($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    Router::redirect('/pages/');
    //echo $e->getMessage();

}
