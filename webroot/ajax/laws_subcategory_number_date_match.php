<?php
include "../../lib/config.class.php";
include "../../config/config.php";
include "../../lib/db.class.php";
$db =  new DB(Config::get('db.host'), Config::get('db.user'), Config::get('db.password'), Config::get('db.db_name'));

if(isset($_POST['get_option']))
{
        $id_1 = $_POST['get_option'];
        $sql = "SELECT * FROM classifier_laws WHERE `parent_id`= '{$id_1}' ORDER BY title";
        $cat = $db->query($sql);
    echo "<option></option>";
        foreach($cat as $item) {
            echo "<option value='{$item['id']}'>{$item['title']}</option>";
        }
    exit;
}
if(isset($_POST['number']) OR isset($_POST['date'])){
    $number = $_POST['number'];
    $date = $_POST['date'];
    $sql = "SELECT * FROM `file_laws_all_info` WHERE `date`='{$date}' AND `number` = '{$number}'";
    $docs = $db->query($sql);
    if(isset($docs['0'])) {
        ?>

            <div  class="panel panel-danger text-center">
                <div class="panel-heading"><b>ІСНУЄ ДОКУМЕНТ З ТАКИМ НОМЕРОМ І ДАТОЮ</b></div>
                <div class="panel-body  text-left">
                    <?php foreach ($docs as $doc) {
                        echo "<b>";
                        echo $doc['n_id_1']; if(isset($doc['n_id_2'])){echo ', '.$doc['n_id_2'];}
                        if(isset($doc['n_id_3'])){echo ', '.$doc['n_id_3'];} if(isset($doc['n_id_4'])){echo ', '.$doc['n_id_4'];}
                        if(isset($doc['n_id_5'])){echo ', '.$doc['n_id_5'];} if(isset($doc['n_id_6'])){echo ', '.$doc['n_id_6'];}
                        if(isset($doc['n_id_7'])){echo ', '.$doc['n_id_7'];} if(isset($doc['n_id_8'])){echo ', '.$doc['n_id_8'];}
                        if(isset($doc['n_id_9'])){echo ', '.$doc['n_id_9'];} if(isset($doc['n_id_10'])){echo ', '.$doc['n_id_10'];}
                        if(isset($doc['n_id_11'])){echo ', '.$doc['n_id_11'];} if(isset($doc['n_id_12'])){echo ', '.$doc['n_id_12'];}
                        if(isset($doc['n_id_13'])){echo ', '.$doc['n_id_13'];} if(isset($doc['n_id_14'])){echo ', '.$doc['n_id_14'];}
                        if(isset($doc['n_id_15'])){echo ', '.$doc['n_id_15'];}
                        echo "</b>";
                        echo "<br>";
                        echo "<b>{$doc['type']} від {$doc['date']} № {$doc['number']} </b><br>";
                        echo $doc['title'];
                        echo "<br>";
                        echo "<b>";
                        echo $doc['publisher_1']; if(isset($doc['publisher_2'])){echo ', '.$doc['publisher_2'];}
                        if(isset($doc['publisher_3'])){echo ', '.$doc['publisher_3'];}
                        if(isset($doc['publisher_4'])){echo ', '.$doc['publisher_4'];}
                        echo "</b>";
                        $numb = number_format($doc['id'], 0, ',', ' ');
                        echo "<form method='get' action='/manage/admin/edit_laws/{$numb}'>
                            <span class='text-muted'> змінити документ № </span><input type='submit' class='btn btn-default btn-sm' value='{$numb}'></form>";

                        echo "<form method='get' action='print_card_laws.php'>
                            <input hidden name='card_id' value='{$doc['id']}'>
                            <input type='submit' class='btn btn-default btn-sm' value='Друк'></form>";
                        echo"<br>";
                        echo"<br>";
                    } ?></div>
            </div>
<?php

    }
}
