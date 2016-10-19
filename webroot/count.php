<?php
$db =  new DB(Config::get('db.host'), Config::get('db.user'), Config::get('db.password'), Config::get('db.db_name'));
$sql = "SELECT `count` FROM `count`";
$count = $db->query($sql);
Config::set('count',$count[0]['count']);

