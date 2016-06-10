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

     public function index(){
         $this->data['classifier'] = $this->model->getClassifier();

     }

     public function search()
     {
         $this->data['categories'] = $this->model->getCategoriesLawsSearch();
         $this->data['publishers'] = $this->model->getPublishersLawsSearch();
         $this->data['types'] = $this->model->getTypesLawsSearch();
         if($_GET) {
             if ($_GET['title'] =='' AND $_GET['category'] == '' AND $_GET['type'] =='' AND $_GET['publisher'] ==''
                 AND $_GET['date_start'] =='' AND $_GET['date_end'] =='' AND $_GET['number'] == '') {
                 $this->data['empty_fields'] = "Заповніть хоча б один критерій для пошуку";
             } else {
                 $this->data['count'] = $this->model->getLawsBySearchNumberOfPages($_GET);
                 $this->data['search_result'] = $this->model->getSearchResultLaws($_GET);
             }
         }
     }

     public function search_jurisprudence()
     {
         $this->data['categories'] = $this->model->getCategoriesJurisprudenceSearch();
         $this->data['types'] = $this->model->getTypesJurisprudenceSearch();

         if($_GET) {
             if ($_GET['title'] =='' AND $_GET['category'] == '' AND $_GET['type'] =='' AND $_GET['publisher'] ==''
                 AND $_GET['date_start'] =='' AND $_GET['date_end'] =='') {
                 $this->data['empty_fields'] = "Заповніть хоча б один критерій для пошуку";
             } else {
                 $this->data['count'] = $this->model->getJurisprudenceBySearchNumberOfPages($_GET);
                 $this->data['search_result'] = $this->model->getSearchResultJurisprudence($_GET);
             }
         }
     }

     public function search_articles()
     {
         $this->data['categories'] = $this->model->getCategoriesArticlesSearch();
         $this->data['types'] = $this->model->getTypesArticlesSearch();
         if($_GET) {
             if ($_GET['title'] =='' AND $_GET['category'] == ''  AND $_GET['publisher'] ==''
                 AND $_GET['date_start'] =='' AND $_GET['date_end'] =='') {
                 $this->data['empty_fields'] = "Заповніть хоча б один критерій для пошуку";
             } else {
                 $this->data['count'] = $this->model->getArticlesBySearchNumberOfPages($_GET);
                 $this->data['search_result'] = $this->model->getSearchResultArticles($_GET);
             }
         }
     }

     public function information()
     {

     }

     public function new_acts()
     {
         $params = App::getRouter()->getParams();

         $this->data['numb_pages'] = $this->model->getNumbPagesNewActs();
         if(!isset($params[0])){
             $params[0]=1;
         }
         if(isset($params[0])) {
             $this->data['range_legislative_acts'] = $this->model->getRangeNewLegislativeActs($params[0]);
             $this->data['new_legislative_acts'] = $this->model->getNewLegislativeActs($this->data['range_legislative_acts'][0]['range_date']);

        }

     }

     public function laws()
     {
         $params = App::getRouter()->getParams();
         if(!isset($params[0])) {
             $this->data['laws_categories'] = $this->model->getLawsCategories();
         } elseif (isset($params[0]) AND !isset($params[1])) {
             $this->data['laws_category'] = $this->model->getLawsCategory($params[0]);
             $this->data['laws_subcategories'] = $this->model->getLawsSubcategories($this->data['laws_category'][0]['id']);
         } elseif (isset($params[1]) AND !isset($params[2])) {
             $this->data['laws_category'] = $this->model->getLawsCategory($params[0]);
             $this->data['laws_subcategory'] = $this->model->getLawsSubcategory($params[0]."/".$params[1]);
             $this->data['laws_sub_subcategories'] = $this->model->getLawsSubSubcategories( $this->data['laws_subcategory'][0]['id']);
             if($_GET['id'] ==''){
                 $this->data['count'] = $this->model->getLawsBySubcategoryNumberOfPages($this->data['laws_subcategory'][0]['id']);
                 $this->data['docs'] = $this->model->getAllDocsBySubcategoryId($_GET['page'], $this->data['laws_subcategory'][0]['id']);
             } else {
                 $sub_id = (int)$_GET['id'];
                 $this->data['count'] = $this->model->getLawsBySubSubcategoryNumberOfPages($sub_id);
                 $this->data['docs'] = $this->model->getAllDocsBySubSubcategoryId($_GET['page'],$sub_id);
             }

         }
     }

     public function jurisprudence()
     {
         $this->data['jurisprudence_categories'] = $this->model->getJurisrpudenceCategories();
     }

     public function articles()
     {
         $this->data['articles_categories'] = $this->model->getArticlesCategories();
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