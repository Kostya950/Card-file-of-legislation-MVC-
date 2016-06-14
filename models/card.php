<?php
/**
 * Created by PhpStorm.
 * User: kito
 * Date: 13.06.16
 * Time: 17:52
 */

class Card extends Model
{
    public function countLaws()
    {
        $sql = "SELECT COUNT(`id`) AS cnt FROM `file_laws`";
        return $this->db->query($sql);
    }

    public function countArticles()
    {
        $sql = "SELECT COUNT(`id`) AS cnt FROM `file_articles`";
        return $this->db->query($sql);
    }

    public function countJurisprudence()
    {
        $sql = "SELECT COUNT(`id`) AS `cnt` FROM `file_jurisprudence`";
        return $this->db->query($sql);
    }

    public function updateCount($cnt)
    {
       return $this->db->query("UPDATE `count` SET `count` = '{$cnt}' WHERE `count`.`id` = 1;");
    }

    public function getCount()
    {
        $sql = "SELECT `count` FROM `count`";
        return $this->db->query($sql);
    }

    public function getAllLawsIndexes()
    {
        $sql = "SELECT `id`, `index` FROM `classifier_laws` WHERE `id` BETWEEN 28 AND 404";
        return $this->db->query($sql);
    }

    public function getAllLawsPublishers()
    {
        $sql = "SELECT `id`, `publisher` FROM `publishers_laws` ORDER BY `publisher` ASC";
        return $this->db->query($sql);
    }

    public function getAllLawsTypes()
    {
        $sql = "SELECT * FROM `type_laws_acts` ORDER BY `type` ASC";
        return $this->db->query($sql);
    }

    public function getAllLawsFolders()
    {
        $sql = "SELECT * FROM `folder_laws`";
        return $this->db->query($sql);
    }

    public function createOrReplaceLawsView()
    {
        return $this->db->query("CREATE OR REPLACE VIEW file_laws_all_info AS SELECT fl.id, fl.number, fl.date, fl.title,
            fl.number_min, fl.date_min, fl.source_1, fl.source_2, fl.source_3, fl.source_4, fl.validity, fl.link,
            tp.type, tp.id AS type_id, pl_1.publisher AS publisher_1, pl_2.publisher AS publisher_2,
            pl_3.publisher AS publisher_3, pl_4.publisher AS publisher_4, pl_1.id AS publisher_id_1,
            pl_2.id AS publisher_id_2, pl_3.id AS publisher_id_3, pl_4.id AS publisher_id_4, fo.folder,
            cl_1.index AS n_id_1, cl_2.index AS n_id_2, cl_3.index AS n_id_3, cl_4.index AS n_id_4,
            cl_5.index AS n_id_5, cl_6.index AS n_id_6, cl_7.index AS n_id_7, cl_8.index AS n_id_8,
            cl_9.index AS n_id_9, cl_10.index AS n_id_10, cl_11.index AS n_id_11, cl_12.index AS n_id_12,
            cl_13.index AS n_id_13, cl_14.index AS n_id_14, cl_15.index AS n_id_15, sub_cl_1.title AS n_1_sub_id,
            sub_cl_2.title AS n_2_sub_id, sub_cl_3.title AS n_3_sub_id, sub_cl_4.title AS n_4_sub_id,
            sub_cl_5.title AS n_5_sub_id, sub_cl_6.title AS n_6_sub_id, sub_cl_7.title AS n_7_sub_id,
            sub_cl_8.title AS n_8_sub_id, sub_cl_9.title AS n_9_sub_id, sub_cl_10.title AS n_10_sub_id,
            sub_cl_11.title AS n_11_sub_id, sub_cl_12.title AS n_12_sub_id, sub_cl_13.title AS n_13_sub_id,
            sub_cl_14.title AS n_14_sub_id, sub_cl_15.title AS n_15_sub_id, fl.id_1, fl.id_2, fl.id_3,
            fl.id_4, fl.id_5, fl.id_6, fl.id_7, fl.id_8, fl.id_9, fl.id_10, fl.id_11, fl.id_12, fl.id_13, fl.id_14,
            fl.id_15, fl.sub_id_1, fl.sub_id_2, fl.sub_id_3, fl.sub_id_4, fl.sub_id_5, fl.sub_id_6,
            fl.sub_id_7, fl.sub_id_8, fl.sub_id_9, fl.sub_id_10, fl.sub_id_11, fl.sub_id_12,
            fl.sub_id_13, fl.sub_id_14, fl.sub_id_15 FROM file_laws fl
            LEFT JOIN folder_laws fo ON fl.folder=fo.id
            LEFT JOIN publishers_laws pl_1 ON fl.publisher_1 = pl_1.id
            LEFT JOIN publishers_laws pl_2 ON fl.publisher_2 = pl_2.id
            LEFT JOIN publishers_laws pl_3 ON fl.publisher_3 = pl_3.id
            LEFT JOIN publishers_laws pl_4 ON fl.publisher_4 = pl_4.id
            LEFT JOIN type_laws_acts tp ON fl.type = tp.id
            LEFT JOIN classifier_laws cl_1 ON fl.id_1 = cl_1.id
            LEFT JOIN classifier_laws cl_2 ON fl.id_2 = cl_2.id
            LEFT JOIN classifier_laws cl_3 ON fl.id_3 = cl_3.id
            LEFT JOIN classifier_laws cl_4 ON fl.id_4 = cl_4.id
            LEFT JOIN classifier_laws cl_5 ON fl.id_5 = cl_5.id
            LEFT JOIN classifier_laws cl_6 ON fl.id_6 = cl_6.id
            LEFT JOIN classifier_laws cl_7 ON fl.id_7 = cl_7.id
            LEFT JOIN classifier_laws cl_8 ON fl.id_8 = cl_8.id
            LEFT JOIN classifier_laws cl_9 ON fl.id_9 = cl_9.id
            LEFT JOIN classifier_laws cl_10 ON fl.id_10 = cl_10.id
            LEFT JOIN classifier_laws cl_11 ON fl.id_11 = cl_11.id
            LEFT JOIN classifier_laws cl_12 ON fl.id_12 = cl_12.id
            LEFT JOIN classifier_laws cl_13 ON fl.id_13 = cl_13.id
            LEFT JOIN classifier_laws cl_14 ON fl.id_14 = cl_14.id
            LEFT JOIN classifier_laws cl_15 ON fl.id_15 = cl_15.id
            LEFT JOIN classifier_laws sub_cl_1 ON fl.sub_id_1 = sub_cl_1.id
            LEFT JOIN classifier_laws sub_cl_2 ON fl.sub_id_2 = sub_cl_2.id
            LEFT JOIN classifier_laws sub_cl_3 ON fl.sub_id_3 = sub_cl_3.id
            LEFT JOIN classifier_laws sub_cl_4 ON fl.sub_id_4 = sub_cl_4.id
            LEFT JOIN classifier_laws sub_cl_5 ON fl.sub_id_5 = sub_cl_5.id
            LEFT JOIN classifier_laws sub_cl_6 ON fl.sub_id_6 = sub_cl_6.id
            LEFT JOIN classifier_laws sub_cl_7 ON fl.sub_id_7 = sub_cl_7.id
            LEFT JOIN classifier_laws sub_cl_8 ON fl.sub_id_8 = sub_cl_8.id
            LEFT JOIN classifier_laws sub_cl_9 ON fl.sub_id_9 = sub_cl_9.id
            LEFT JOIN classifier_laws sub_cl_10 ON fl.sub_id_10 = sub_cl_10.id
            LEFT JOIN classifier_laws sub_cl_11 ON fl.sub_id_11 = sub_cl_11.id
            LEFT JOIN classifier_laws sub_cl_12 ON fl.sub_id_12 = sub_cl_12.id
            LEFT JOIN classifier_laws sub_cl_13 ON fl.sub_id_13 = sub_cl_13.id
            LEFT JOIN classifier_laws sub_cl_14 ON fl.sub_id_14 = sub_cl_14.id
            LEFT JOIN classifier_laws sub_cl_15 ON fl.sub_id_15 = sub_cl_15.id");
    }

    public function getAllArticlesIndexes()
    {
        $sql = "SELECT `index`, id FROM classifier_articles WHERE id NOT IN (1,3,4,5,6,7,8,10,12,13,14,15,16,26,28,30)";
        return $this->db->query($sql);
    }

    public function getAllArticlesTypes()
    {
        $sql = "SELECT * FROM `type_articles_acts` ORDER BY `type` ASC";
        return $this->db->query($sql);
    }

    public function createOrReplaceArticlesView()
    {
        return $this->db->query("CREATE OR REPLACE VIEW file_articles_all_info AS SELECT fa.id, fa.date, fa.title, fa.source, fa.publisher_1,
            fa.publisher_2, ta.type, fa.type AS type_id, ca_1.index AS index_1, ca_2.index AS index_2,
            ca_3.index AS index_3, ca_4.index AS index_4, ca_5.index AS index_5, fa.id_1 AS n_id_1, fa.id_2 AS n_id_2, fa.id_3 AS n_id_3,
            fa.id_4 AS n_id_4, fa.id_5 AS n_id_5 FROM file_articles fa
            LEFT JOIN type_articles_acts ta ON fa.type=ta.id
            LEFT JOIN classifier_articles ca_1 ON fa.id_1=ca_1.id
            LEFT JOIN classifier_articles ca_2 ON fa.id_2=ca_2.id
            LEFT JOIN classifier_articles ca_3 ON fa.id_3=ca_3.id
            LEFT JOIN classifier_articles ca_4 ON fa.id_4=ca_4.id
            LEFT JOIN classifier_articles ca_5 ON fa.id_5=ca_5.id");
    }

    public function getAllJurisprudenceIndexes()
    {
        $sql = "SELECT `index`, `id` FROM `classifier_jurisprudence` WHERE `id` NOT BETWEEN 2 AND 13";
        return $this->db->query($sql);
    }

    public function getAllJurisprudenceTypes()
    {
        $sql = "SELECT * FROM `type_jurisprudence_acts` ORDER BY `type` ASC";
        return $this->db->query($sql);
    }

    public function createOrReplaceJurisprudenceView()
    {
        return $this->db->query("CREATE OR REPLACE VIEW file_jurisprudence_all_info AS SELECT fj.id, fj.date, fj.title, fj.source, fj.publisher_1,
            tj.type, fj.type AS type_id, ca_1.index AS index_1, ca_2.index AS index_2,
            ca_3.index AS index_3, ca_4.index AS index_4, ca_5.index AS index_5, fj.id_1 AS n_id_1, fj.id_2 AS n_id_2, fj.id_3 AS n_id_3,
            fj.id_4 AS n_id_4, fj.id_5 AS n_id_5 FROM file_jurisprudence fj
            LEFT JOIN type_jurisprudence_acts tj ON fj.type=tj.id
            LEFT JOIN classifier_jurisprudence ca_1 ON fj.id_1=ca_1.id
            LEFT JOIN classifier_jurisprudence ca_2 ON fj.id_2=ca_2.id
            LEFT JOIN classifier_jurisprudence ca_3 ON fj.id_3=ca_3.id
            LEFT JOIN classifier_jurisprudence ca_4 ON fj.id_4=ca_4.id
            LEFT JOIN classifier_jurisprudence ca_5 ON fj.id_5=ca_5.id");
    }



}