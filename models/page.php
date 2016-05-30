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

    public function getSearchResultLaws($search_content)
    {
        $sql = "SELECT number, DATE_FORMAT(date,'%d.%m.%Y') AS nice_date, title, link, type, publisher_1,
                    publisher_2, publisher_3, publisher_4, source_1, source_2, source_3, source_4, folder FROM file_laws_all_info
                    WHERE {$search_content} ORDER BY date DESC";
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


    public function getList($only_published = false)
    {
        $sql = "SELECT * FROM pages where 1";
        if ($only_published) {
            $sql .= " AND is_published = 1";
        }
        return $this->db->query($sql);
    }

    public function getByAlias($alias)
    {
        $alias = $this->db->escape($alias);
        $sql = "SELECT * FROM pages where alias = '{$alias}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function getById($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM pages where id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function save($data, $id = null)
    {
        if (!isset($data['alias']) || !isset($data['title'])  || !isset($data['content'])) {
            return false;
        }
        $id = (int)$id;
        $alias = $this->db->escape($data['alias']);
        $title  = $this->db->escape($data['title']);
        $content = $this->db->escape($data['content']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        if ( !$id ) { // Add new record
            $sql = "
                    INSERT INTO pages
                    set alias = '{$alias}',
                        title = '{$title}',
                        content = '{$content }',
                        is_published = '{$is_published}'
            ";
        } else {// Update existing record
            $sql = "
                    UPDATE pages
                    set alias = '{$alias}',
                        title = '{$title}',
                        content = '{$content }',
                        is_published = '{$is_published}'
                    WHERE id = '{$id}'
            ";
        }

        return $this->db->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM pages WHERE id = '{$id}'";
        return $this->db->query($sql);
    }


}