<?php if (isset($data['doc_to_print'][0])) {
    if ($data['doc_to_print'][0]['index_1']!=''){$indexes[] = $index_1 = $data['doc_to_print'][0]['index_1'];}
    if ($data['doc_to_print'][0]['index_1']!=''){$indexes[] = $index_2 = $data['doc_to_print'][0]['index_2'];}
    if ($data['doc_to_print'][0]['index_3']!=''){$indexes[] = $index_3 = $data['doc_to_print'][0]['index_3'];}
    if ($data['doc_to_print'][0]['index_4']!=''){$indexes[] = $index_4 = $data['doc_to_print'][0]['index_4'];}
    if ($data['doc_to_print'][0]['index_5']!=''){$indexes[] = $index_5 = $data['doc_to_print'][0]['index_5'];}


    $title = $data['doc_to_print'][0]['title'];
    $publisher_1 = $data['doc_to_print'][0]['publisher_1'];
    $publisher_2 = $data['doc_to_print'][0]['publisher_2'];
    $publisher_3 = $data['doc_to_print'][0]['publisher_3'];
    $publisher_4 = $data['doc_to_print'][0]['publisher_4'];
    $type = $data['doc_to_print'][0]['type'];
    $date = $data['doc_to_print'][0]['date'];
    $number = $data['doc_to_print'][0]['number'];
    $date_min = $data['doc_to_print'][0]['date_min'];
    $number_min = $data['doc_to_print'][0]['number_min'];
    $source_1 = $data['doc_to_print'][0]['source'];
    $source_2 = $data['doc_to_print'][0]['source_2'];
    $source_3 = $data['doc_to_print'][0]['source_3'];
    $source_4 = $data['doc_to_print'][0]['source_4'];
    $folder = $data['doc_to_print'][0]['folder'];


    ?>
    <form class="head_btns" method="post" action="log_out.php">
        <div class="col-sm-offset-2 col-sm-11">
            <a href="/manage/admin/"><input class="btn btn-default" type="text" value="Категорії"></a>
            <a href="/manage/admin/jurisprudence/"><input class="btn btn-default" type="text" value="Додати"></a><br>
            <a href="/users/logout/" class="btn btn-default out" type="submit" name="out" >Вийти</a>
        </div>
    </form>
    <?php
    $cnt = count($indexes);
    for ($i=1; $i<=$cnt; $i++) {
        ?>
        <table class="mrg_top2 table_print">
            <tr class="tr_print">
                <td class="indexes td_print">
                    <?php
                    foreach ($indexes as $index) {
                        echo $index;
                        echo "<br>";
                    }
                    $indexes[]=$indexes[0];
                    array_shift($indexes);
                    ?>

                </td>
                <td colspan="3" class="text-left title td_print">
                    <?php

                    $len = mb_strlen($title);

                    if($len < 500){
                        echo $title;
                    } else {
                        echo mb_substr($title, 0, 500);
                        echo '...';
                    }
                    ?>

                </td>
            </tr>
            <tr class="tr_print">
                <td colspan="2" class="publisher td_print">
                    <?php
                    $len_pub = mb_strlen($publisher_1);

                    if ($len_pub < 100) {
                        echo $publisher_1;
                    } else {
                        echo mb_substr($publisher_1, 0, 100);
                        echo '...';
                    }
                    if ($publisher_2 !=''){
                        echo " <b>...</b>";
                    }
                    ?><br><br>
                    <?=$type?>
                </td>
                <td class="folder td_print">
                    <?=$folder?>
                </td>
                <td rowspan="2" class="source td_print">
                    <?php
                    echo $source_1."<br>";
                    if($source_2 !=''){echo $source_2."<br>";}
                    if($source_3 !=''){echo $source_3."<br>";}
                    if($source_4 !=''){echo $source_4."<br>";}
                    ?>
                </td>
            </tr>
            <tr class="tr_print">
                <td colspan="2" class="number-date td_print">
                    <?=$date?><br>
                    № <?=$number?>
                </td>
                <td class="number-date-min td_print">
                    <?php if($date_min!='00.00.0000'){echo $date_min; }?><br>
                    <?=$number_min ?>
                </td>
            </tr>

            <tr class="tr_print">
                <td colspan="4" class="text-right footer td_print">
                    Картотека. Генпрокуратура. Поточне законодавство
                </td>
            </tr>
        </table>
        <?php

    }
    if(isset($indexes_2[0])){
        $cnt = count($indexes_2);
        for ($i=1; $i<=$cnt; $i++) {
            ?>
            <table class="mrg_top2 table_print">
                <tr class="tr_print">
                    <td class="indexes td_print">
                        <?php
                        foreach ($indexes_2 as $index) {
                            echo $index;
                            echo "<br>";
                        }
                        $indexes_2[]=$indexes_2[0];
                        array_shift($indexes_2);
                        ?>

                    </td>
                    <td colspan="3" class="text-left title td_print">
                        <?php

                        $len = mb_strlen($title);

                        if($len < 500){
                            echo $title;
                        } else {
                            echo mb_substr($title, 0, 500);
                            echo "...";
                        }
                        ?>
                    </td>
                </tr>
                <tr class="tr_print">
                    <td colspan="2" class="publisher td_print">
                        <?php
                        echo $publisher_1;
                        if ($publisher_2 !=''){
                            echo " <b>...</b>";
                        }
                        ?><br><br>
                        <?=$type?>
                    </td>
                    <td class="folder td_print">
                        <?=$folder?>
                    </td>
                    <td rowspan="2" class="source td_print">
                        <?php
                        echo $source_1."<br>";
                        if($source_2 !=''){echo $source_2."<br>";}
                        if($source_3 !=''){echo $source_3."<br>";}
                        if($source_4 !=''){echo $source_4."<br>";}
                        ?>
                    </td>
                </tr>
                <tr class="tr_print">
                    <td colspan="2" class="number-date td_print">
                        <?=$date?><br>
                        № <?=$number?>
                    </td>
                    <td class="number-date-min td_print">
                        <?php if($date_min!='00.00.0000'){echo $date_min; }?><br>
                        <?=$number_min ?>
                    </td>
                </tr>

                <tr class="tr_print">
                    <td colspan="4" class="text-right footer td_print">
                        Картотека. Генпрокуратура. Поточне законодавство
                    </td>
                </tr>
            </table>
            <?php

        }
    }
}
else {
    ?>
    <form method="get" action="edit_laws.php">
        <div class="col-sm-offset-2 col-sm-7 mrg_top2">
            <div class="panel panel-warning text-center">
                <div class="panel-heading"><b>Помилка!</b></div>
                <div class="panel-body text-left text-center"> <b>Щось пішло не так, поверніться на головну або у розділ додати!</b></div>
            </div>
        </div>
    </form>
    <?php
}



?>
