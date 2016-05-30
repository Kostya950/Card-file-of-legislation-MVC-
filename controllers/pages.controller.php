<?php
/**
 * Created by PhpStorm.
 * User: kito
 * Date: 22.05.16
 * Time: 17:14
 */

 class PagesController extends Controller
 {

     public function __construct($data = array())
     {
         parent::__construct($data);
         $this->model = new Page();
     }

     public function search()
     {
         $this->data['categories'] = $this->model->getCategoriesLawsSearch();
         $this->data['publishers'] = $this->model->getPublishersLawsSearch();
         $this->data['types'] = $this->model->getTypesLawsSearch();

         if($_GET) {
         $title = $_GET['title'];
         $category = $_GET['category'];
         $type = $_GET['type'];
         $publisher = $_GET['publisher'];
         $date_start = $_GET['date_start'];
         $date_end = $_GET['date_end'];
         $number = $_GET['number'];
         if($date_start=='' AND $date_end!=''){
             $date_start = '1900-01-01';
         } elseif ($date_start!='' AND $date_end==''){
             $date_end = date("Y-m-d");
         }
         if ($title =='' AND $category == '' AND $type =='' AND $publisher =='' AND $date_start =='' AND
             $date_end =='' AND $number == '') {
             $this->data['empty_fields'] = "Заповніть хоча б один критерій для пошуку";
         }
             if ($title != '' AND $category == '' AND $type == '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%'";
             } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}')";
             } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}'";
             } elseif ($title != '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}')";
             } elseif ($title != '' AND $category == '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title != '' AND $category == '' AND $type == '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}'";
             } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}')";
             } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}')";
             } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}' AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title != '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category == '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') ";
             } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND  date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}'  AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}'  AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}'  AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "title LIKE '%{$title}%' AND (id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}'";
             } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}'";
             } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}')";
             } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') ";
             } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND  date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "(id_1 = '{$category}' OR id_2 = '{$category}' OR id_3 = '{$category}' OR
            id_4 = '{$category}' OR id_5 = '{$category}' OR id_6 = '{$category}' OR id_7 = '{$category}' OR id_8 = '{$category}' OR
            id_9 = '{$category}' OR id_10 = '{$category}' OR id_11 = '{$category}' OR id_12 = '{$category}' OR id_13 = '{$category}' OR
            id_14 = '{$category}' OR id_15 = '{$category}') AND type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "type_id = '{$type}'";
             } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}')";
             } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "type_id = '{$type}' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "type_id = '{$type}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "type_id = '{$type}' AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "type_id = '{$type}' AND (publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number == '') {
                 $search_content = "(publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}' OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}')";
             } elseif ($title == '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "(publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title == '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "(publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "(publisher_id_1 = '{$publisher}' OR publisher_id_2 = '{$publisher}'
            OR publisher_id_3 = '{$publisher}' OR publisher_id_4 = '{$publisher}') AND date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category == '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number == '') {
                 $search_content = "date BETWEEN '{$date_start}' AND '{$date_end}'";
             } elseif ($title == '' AND $category == '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '' AND $number != '') {
                 $search_content = "date BETWEEN '{$date_start}' AND '{$date_end}' AND number LIKE '{$number}%'";
             } elseif ($title == '' AND $category == '' AND $type == '' AND $publisher == '' AND $date_start == '' AND $date_end == '' AND $number != '') {
                 $search_content = "number LIKE '{$number}%'";
             }
             $this->data['search_result'] = $this->model->getSearchResultLaws($search_content);
         }
     }

     public function search_jurisprudence()
     {
         $this->data['categories'] = $this->model->getCategoriesJurisprudenceSearch();
         $this->data['types'] = $this->model->getTypesJurisprudenceSearch();
     }

     public function search_articles()
     {
         $this->data['categories'] = $this->model->getCategoriesArticlesSearch();
         $this->data['types'] = $this->model->getTypesArticlesSearch();
     }



     public function index(){
         $this->data['classifier'] = $this->model->getClassifier();

     }

     public function view() {
         $params = App::getRouter()->getParams();

         if (isset($params[0])){

             $this->data = $this->model->getSubcategory($params[0]);

         }
     }

     public function admin_index()
     {
        $this->data['pages'] = $this->model->getList();
     }

     public function admin_add()
     {
         if ($_POST) {



             $result = $this->model->save($_POST);
             if ($result) {
                 Session::setFlash('Page was saved');
             } else {
                 Session::setFlash('Error.');
             }
             Router::redirect('/admin/pages/');
         }
     }

     public function admin_edit()
     {

         if ($_POST) {
             $id = isset($_POST['id']) ? $_POST['id'] : null;
             $result = $this->model->save($_POST, $id);
             if ($result) {
                 Session::setFlash('Page was saved');
             } else {
                 Session::setFlash('Error.');
             }
             Router::redirect('/admin/pages/');
         }

         if(isset($this->params[0])) {
             $this->data['page'] = $this->model->getById($this->params[0]);
         } else {
             Session::setFlash('Wrong page id.');
             Router::redirect('/admin/pages/');
         }

     }

     public function admin_delete(){
         if (isset($this->params[0])) {
             $result = $this->model->delete($this->params[0]);
             if ($result) {
                 Session::setFlash('Page was saved');
             } else {
                 Session::setFlash('Error.');
             }
             Router::redirect('/admin/pages/');

         }

     }

 }