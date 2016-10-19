<?php
include "../../lib/config.class.php";
include "../../config/config.php";
include "../../lib/db.class.php";
$db =  new DB(Config::get('db.host'), Config::get('db.user'), Config::get('db.password'), Config::get('db.db_name'));

if(isset($_POST['publisher']) OR isset($_POST['date'])){

    $publisher = $_POST['publisher'];
    if($publisher == ''){$publisher = 1;}
    $date = $_POST['date'];
    $sql = "SELECT * FROM file_jurisprudence_all_info WHERE `publisher_1`='{$publisher}' AND `date` = '{$date}'";
    $docs = $db->query($sql);
    if(isset($docs['0'])) {
        ?>
            <div class="panel panel-danger text-center">
                <div class="panel-heading"><b>В БАЗІ ВЖЕ ІСНУЄ CХОЖИЙ ДОКУМЕНТ</b></div>
                <div class="panel-body  text-left">
                    <?php foreach ($docs as $doc) {
                        echo "<b>";
                        echo $doc['index_1']; if(isset($doc['index_2']) AND $doc['index_2']!=''){echo ', '.$doc['index_2'];}
                        if(isset($doc['index_3']) AND $doc['index_3']!=''){echo ', '.$doc['index_3'];}
                        if(isset($doc['index_4']) AND $doc['index_4']!=''){echo ', '.$doc['index_4'];}
                        if(isset($doc['index_5']) AND $doc['index_5']!=''){echo ', '.$doc['index_5'];}
                        echo "</b>";
                        echo "<br>";
                        echo "<b>{$doc['type']} від {$doc['date']}<br></b>";
                        echo $doc['title'];
                        echo "<br><b>";
                        echo $doc['publisher_1']; if(isset($doc['publisher_2']) AND $doc['publisher_2']!=''){echo ', '.$doc['publisher_2'];}
                        echo "<form method='get' action='/manage/admin/edit_jurisprudence/{$doc['id']}'><span class='text-muted'> змінити документ № </span><input type='submit' class='btn btn-default btn-sm' value='{$doc['id']}'></form>";
                        echo"<br>";
                        echo"<br>";
                    } ?></div>
            </div>

        <?php

    }
}
