<?php
/**
 * Created by PhpStorm.
 * User: kito
 * Date: 22.05.16
 * Time: 21:09
 */

class Page extends  Model
{

    public function getCategoriesLawsSearch()
    {
        $sql = "SELECT id, `index`, title FROM classifier_laws WHERE id BETWEEN 28 AND 404";
        return $this->db->query($sql);
    }

    public function getPublishersLawsSearch()
    {
        $sql = "SELECT * FROM publishers_laws ORDER BY publisher";
        return $this->db->query($sql);
    }

    public function getTypesLawsSearch()
    {
        $sql = "SELECT * FROM type_laws_acts ORDER BY type";
        return $this->db->query($sql);
    }

    public function getCategoriesJurisprudenceSearch()
    {
        $sql = "SELECT * FROM classifier_jurisprudence";
        return $this->db->query($sql);
    }

    public function getTypesJurisprudenceSearch()
    {
        $sql = "SELECT * FROM type_jurisprudence_acts ORDER BY type";
        return $this->db->query($sql);
    }

    public function getCategoriesArticlesSearch()
    {
        $sql = "SELECT id, `index`, title FROM classifier_articles WHERE id NOT IN (1,3,4,5,6,7,8,10,12,13,14,15,16,26,28,30)";
        return $this->db->query($sql);
    }

    public function getTypesArticlesSearch()
    {
        $sql = "SELECT * FROM type_articles_acts ORDER BY type";
        return $this->db->query($sql);
    }

    public function getSearchResultLaws($data)
    {
        if($_GET) {
            $title = $data['title'];
            $category = $data['category'];
            $type = $data['type'];
            $publisher = $data['publisher'];
            $date_start = $data['date_start'];
            $date_end = $data['date_end'];
            $number = $data['number'];
            if($date_start=='' AND $date_end!=''){
                $date_start = '1900-01-01';
            } elseif ($date_start!='' AND $date_end==''){
                $date_end = date("Y-m-d");
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
            $sql = "SELECT number, DATE_FORMAT(date,'%d.%m.%Y') AS nice_date, title, link, type, publisher_1,
                    publisher_2, publisher_3, publisher_4, source_1, source_2, source_3, source_4, folder FROM file_laws_all_info
                    WHERE {$search_content} ORDER BY date DESC";
        }

        return $this->db->query($sql);
    }

    public function getSearchResultJurisprudence($data)
    {
        if($_GET) {
            $title = $data['title'];
            $category = $data['category'];
            $type = $data['type'];
            $publisher = $data['publisher'];
            $date_start = $data['date_start'];
            $date_end = $data['date_end'];
            if ($date_start == '' AND $date_end != '') {
                $date_start = '1900-01-01';
            } elseif ($date_start != '' AND $date_end == '') {
                $date_end = date("Y-m-d");
            }

            if ($title != '' AND $category == '' AND $type == '' AND $publisher == '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%'";
            } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}')";
            } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}'";
            } elseif ($title != '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%' AND publisher_1 LIKE '%{$publisher}%'";
            } elseif ($title != '' AND $category == '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND type_id = '{$type}'";
            } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND publisher_1 LIKE '%{$publisher}%'";
            } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}' AND publisher_1 LIKE '%{$publisher}%'";
            } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title != '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND publisher_1 LIKE '%{$publisher}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND type_id = '{$type}' AND publisher_1 LIKE '%{$publisher}%'";
            } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND type_id = '{$type}' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title != '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND publisher_1 LIKE '%{$publisher}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title != '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND type_id = '{$type}' AND publisher_1 LIKE '%{$publisher}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title != '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND type_id = '{$type}' AND publisher_1 LIKE '%{$publisher}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start == '' AND $date_end == '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}')";
            } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND type_id = '{$type}'";
            } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND publisher_1 LIKE '%{$publisher}%'";
            } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND type_id = '{$type}' AND publisher_1 LIKE '%{$publisher}%'";
            } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND type_id = '{$type}' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category != '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND publisher_1 LIKE '%{$publisher}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category != '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND type_id = '{$type}' AND publisher_1 LIKE '%{$publisher}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start == '' AND $date_end == '') {
                $search_content = "type_id = '{$type}'";
            } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "type_id = '{$type}' AND publisher_1 LIKE '%{$publisher}%'";
            } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "type_id = '{$type}' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category == '' AND $type != '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "type_id = '{$type}' AND publisher_1 LIKE '%{$publisher}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "publisher_1 LIKE '%{$publisher}%'";
            } elseif ($title == '' AND $category == '' AND $type == '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "publisher_1 LIKE '%{$publisher}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category == '' AND $type == '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "date BETWEEN '{$date_start}' AND '{$date_end}'";
            }
            $sql = "SELECT id, DATE_FORMAT(date,'%d.%m.%Y') AS nice_date, title, source, publisher_1,
                   type, index_1, index_2, index_3, index_4, index_5 FROM file_jurisprudence_all_info WHERE {$search_content}
                   ORDER BY date DESC";
        }
        return $this->db->query($sql);
    }

    public function getSearchResultArticles($data){
        if($_GET) {
            $title = $data['title'];
            $category = $data['category'];
            $publisher = $data['publisher'];
            $date_start = $data['date_start'];
            $date_end = $data['date_end'];
            if ($date_start == '' AND $date_end != '') {
                $date_start = '1900-01-01';
            } elseif ($date_start != '' AND $date_end == '') {
                $date_end = date("Y-m-d");
            }
            if ($title != '' AND $category == '' AND $publisher == '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%'";
            } elseif ($title != '' AND $category != '' AND $publisher == '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}')";
            } elseif ($title != '' AND $category == '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%' AND (publisher_1 LIKE '%{$publisher}%' OR publisher_2 LIKE '%{$publisher}%')";
            } elseif ($title != '' AND $category == '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title != '' AND $category != '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND (publisher_1 LIKE '%{$publisher}%' OR publisher_2 LIKE '%{$publisher}%')";
            } elseif ($title != '' AND $category != '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title != '' AND $category == '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND (publisher_1 LIKE '%{$publisher}%' OR publisher_2 LIKE '%{$publisher}%')  AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title != '' AND $category != '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "title LIKE '%{$title}%' AND (n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND (publisher_1 LIKE '%{$publisher}%' OR publisher_2 LIKE '%{$publisher}%')  AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category != '' AND $publisher == '' AND $date_start == '' AND $date_end == '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}')";
            } elseif ($title == '' AND $category != '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND (publisher_1 LIKE '%{$publisher}%' OR publisher_2 LIKE '%{$publisher}%')";
            } elseif ($title == '' AND $category != '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category != '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "(n_id_1 = '{$category}' OR n_id_2 = '{$category}' OR n_id_3 = '{$category}' OR
            n_id_4 = '{$category}' OR n_id_5 = '{$category}') AND (publisher_1 LIKE '%{$publisher}%' OR publisher_2 LIKE '%{$publisher}%')  AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            } elseif ($title == '' AND $category == '' AND $publisher != '' AND $date_start == '' AND $date_end == '') {
                $search_content = "(publisher_1 LIKE '%{$publisher}%' OR publisher_2 LIKE '%{$publisher}%')";
            }elseif ($title == '' AND $category == '' AND $publisher != '' AND $date_start != '' AND $date_end != '') {
                $search_content = "(publisher_1 LIKE '%{$publisher}%' OR publisher_2 LIKE '%{$publisher}%')  AND date BETWEEN '{$date_start}' AND '{$date_end}'";
            }elseif ($title == '' AND $category == '' AND $publisher == '' AND $date_start != '' AND $date_end != '') {
                $search_content = "date BETWEEN '{$date_start}' AND '{$date_end}'";
            }

            $sql = "SELECT id, DATE_FORMAT(date,'%d.%m.%Y') AS nice_date, title, source, publisher_1, publisher_2,
                   type, index_1, index_2, index_3, index_4, index_5 FROM file_articles_all_info WHERE {$search_content}
                   ORDER BY date DESC";
        }
        return $this->db->query($sql);
    }

    public function getRangeNewLegislativeActs($id)
    {
        $limitStart = $id - 1;
        $sql = "SELECT * FROM `new_legislative_acts_range_date`ORDER BY `id` DESC LIMIT {$limitStart}, 1";
        return $this->db->query($sql);
    }

    public function getNewLegislativeActs($range_date)
    {
        $sql = "SELECT n.name, n.number, n.link, n.notice, rd.range_date, pbl.publisher, type.type, DATE_FORMAT(date,'%d.%m.%Y') AS date FROM new_legislative_acts n JOIN new_legislative_acts_range_date rd ON n.id_range_data=rd.id
JOIN new_legislative_acts_publishers pbl ON n.id_publisher=pbl.id
JOIN type_laws_acts type ON n.id_type=type.id WHERE rd.range_date = '{$range_date}'";
        return $this->db->query($sql);
    }

    public function getNumbPagesNewActs()
    {
        $sql = "SELECT COUNT(id) AS cnt FROM new_legislative_acts_range_date";
        return $this->db->query($sql);
    }



    public function getClassifier()
    {
       $sql = "SELECT * FROM classifier_laws WHERE parent_id = 0";
        return $this->db->query($sql);
    }

    public function getSubcategory($subcategory)
    {
        $sql = "SELECT * FROM classifier_laws WHERE `index`= '{$subcategory}'";
        return $this->db->query($sql);
    }



}