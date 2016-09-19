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

     public function index()
     {
     }

     // раздел поиска законодательных актов
     public function search()
     {
         $this->data['categories'] = $this->model->getCategoriesLawsSearch(); // получаем все категории
         $this->data['publishers'] = $this->model->getPublishersLawsSearch(); // получаем всех издателей
         $this->data['types'] = $this->model->getTypesLawsSearch(); // получаем все виды документов
         if($_GET) {
             // если не заполнено ни одне поле для поиска выводим сообщение заполнить хоть одно поле
             if ($_GET['title'] =='' AND $_GET['category'] == '' AND $_GET['type'] =='' AND $_GET['publisher'] ==''
                 AND $_GET['date_start'] =='' AND $_GET['date_end'] =='' AND $_GET['number'] == '') {
                 $this->data['empty_fields'] = "Заповніть хоча б один критерій для пошуку";
             } else {  // если хоть одно поле для поиска заполнено ищем документы соответствующие критериям поиска
                 $this->data['count'] = $this->model->getLawsBySearchNumberOfPages($_GET); // получаем количество докум.
                 $this->data['search_result'] = $this->model->getSearchResultLaws($_GET); // получаем документы
             }
         }
     }
    // раздел для поиска актов судебной практики
     public function search_jurisprudence()
     {
         $this->data['categories'] = $this->model->getCategoriesJurisprudenceSearch(); // получаем все категории
         $this->data['types'] = $this->model->getTypesJurisprudenceSearch(); // получаем все виды

         if($_GET) {
             // если не заполнено ни одне поле для поиска выводим сообщение заполнить хоть одно поле
             if ($_GET['title'] =='' AND $_GET['category'] == '' AND $_GET['type'] =='' AND $_GET['publisher'] ==''
                 AND $_GET['date_start'] =='' AND $_GET['date_end'] =='') {
                 $this->data['empty_fields'] = "Заповніть хоча б один критерій для пошуку";
             } else { // если хоть одно поле для поиска заполнено ищем документы соответствующие критериям поиска
                 $this->data['count'] = $this->model->getJurisprudenceBySearchNumberOfPages($_GET); // колич. документов
                 $this->data['search_result'] = $this->model->getSearchResultJurisprudence($_GET); // получаем документы
             }
         }
     }
     // раздел для поиска актов судебной практики
     public function search_articles()
     {
         $this->data['categories'] = $this->model->getCategoriesArticlesSearch(); // получаем все категории
         $this->data['types'] = $this->model->getTypesArticlesSearch(); // получаем все виды
         if($_GET) {
             // если не заполнено ни одне поле для поиска выводим сообщение заполнить хоть одно поле
             if ($_GET['title'] =='' AND $_GET['category'] == ''  AND $_GET['publisher'] ==''
                 AND $_GET['date_start'] =='' AND $_GET['date_end'] =='') {
                 $this->data['empty_fields'] = "Заповніть хоча б один критерій для пошуку";
             } else {  // если хоть одно поле для поиска заполнено ищем документы соответствующие критериям поиска
                 $this->data['count'] = $this->model->getArticlesBySearchNumberOfPages($_GET); // кличество документов
                 $this->data['search_result'] = $this->model->getSearchResultArticles($_GET); // получаем документы
             }
         }
     }
     // раздел справочной информации
     public function information()
     {

     }
     // раздел новых законодательных актов
     public function new_acts()
     {
         $params = App::getRouter()->getParams();

         $this->data['numb_pages'] = $this->model->getNumbPagesNewActs(); // получаем количество документов
         if(!isset($params[0])){
             $params[0]=1;
         }
         if(isset($params[0])) {
             $this->data['range_legislative_acts'] = $this->model->getRangeNewLegislativeActs($params[0]); // получаем выбранный период законодательных актов
             // получаем новые законодательные акты
             $this->data['new_legislative_acts'] = $this->model->getNewLegislativeActs($this->data['range_legislative_acts'][0]['range_date']);

        }

     }
     // раздел для отображения законодательных актов
     public function laws()
     {
         $params = App::getRouter()->getParams();
         if(!isset($params[0])) {
             $this->data['laws_categories'] = $this->model->getLawsCategories(); // полуаем классификатор
         } elseif (isset($params[0]) AND !isset($params[1])) {
             $this->data['laws_category'] = $this->model->getLawsCategory($params[0]); // получаем выбранную категорию
             // получаем все подкатегории выбранной категории классификатора
             $this->data['laws_subcategories'] = $this->model->getLawsSubcategories($this->data['laws_category'][0]['id']);
         } elseif (isset($params[1]) AND !isset($params[2])) {
             $this->data['laws_category'] = $this->model->getLawsCategory($params[0]); // получаем выбранную категорию
             // получаем выбранную подкатегорию
             $this->data['laws_subcategory'] = $this->model->getLawsSubcategory($params[0]."/".$params[1]);
             // получаем все под-подкатегории выбранной подкатегории
             $this->data['laws_sub_subcategories'] = $this->model->getLawsSubSubcategories( $this->data['laws_subcategory'][0]['id']);
             if($_GET['id'] ==''){
                 // получаем количество документов если не выбрання под-подкатегория
                 $this->data['count'] = $this->model->getLawsBySubcategoryNumberOfPages($this->data['laws_subcategory'][0]['id']);
                 // получаем все документы выбранной подкатегории классификатора
                 $this->data['docs'] = $this->model->getAllDocsBySubcategoryId($_GET['page'], $this->data['laws_subcategory'][0]['id']);
             } else {
                 $sub_id = (int)$_GET['id'];
                 // получаем количество документов выбранной под-подкатегории
                 $this->data['count'] = $this->model->getLawsBySubSubcategoryNumberOfPages($sub_id);
                 // получаем все документы выбранной под-подкатегории
                 $this->data['docs'] = $this->model->getAllDocsBySubSubcategoryId($_GET['page'],$sub_id);
             }
         }
     }
     // раздел для отображения актов судебной практики
     public function jurisprudence()
     {
         $params = App::getRouter()->getParams();
         if(!isset($params[0])){
             $this->data['jurisprudence_categories'] = $this->model->getJurisrpudenceCategories(); // получаем классификатор
         } elseif(isset($params[0]) AND !isset($params[1])) {
             // получаем выбранную категорию
             $this->data['jurisprudence_category'] = $this->model->getJurisprudenceCategory($params[0]);
             // получаем все подкатегории выбранной категории
             $this->data['jurisprudence_subcategories'] = $this->model->getJurisprudenceSubcategories($this->data['jurisprudence_category'][0]['id']);
             if(!isset($this->data['jurisprudence_subcategories'][0]) OR $this->params[0]=='V'){
                 // если нет подкатегория для выбранной получаем количество документов
                 $this->data['count'] = $this->model->getJurisprudenceNumberOfPages($this->data['jurisprudence_category'][0]['id']);
                 // получаем документы если нет подкатегорий для выбранной категории
                 $this->data['docs'] = $this->model->getAllJurisprudenceDocsByCategoryId($_GET['page'],$this->data['jurisprudence_category'][0]['id']);
             }
         } elseif(isset($params[1]) AND !isset($params[2])) {
             // получаем выбранную категорию
             $this->data['jurisprudence_category'] = $this->model->getJurisprudenceCategory($params[0]);
             // получаем выбранную подкатегорию выбранной категории
             $this->data['jurisprudence_subcategory'] = $this->model->getJurisprudenceSubcategory($params[0]."/".$params[1]);
             // получаем под-подкатегории для выбранной подкатегории
             $this->data['jurisprudence_sub_subcategories'] = $this->model->getJurisprudenceSubSubcategories($this->data['jurisprudence_subcategory'][0]['id']);
             // получаем количество документов для выбранной под-подкатегории
             $this->data['count'] = $this->model->getJurisprudenceNumberOfPages($this->data['jurisprudence_subcategory'][0]['id']);
             // получаем документы для выбранной под-подкатегории
             $this->data['docs'] = $this->model->getAllJurisprudenceDocsByCategoryId($_GET['page'],$this->data['jurisprudence_subcategory'][0]['id']);
         } elseif(isset($params[2]) AND !isset($params[3])) {
             $this->data['jurisprudence_category'] = $this->model->getJurisprudenceCategory($params[0]);
             $this->data['jurisprudence_subcategory'] = $this->model->getJurisprudenceSubcategory($params[0]."/".$params[1]);
             $this->data['jurisprudence_sub_subcategory'] = $this->model->getJurisprudenceSubSubcategory($params[0]."/".$params[1]."/".$params[2]);
             $this->data['count'] = $this->model->getJurisprudenceNumberOfPages($this->data['jurisprudence_sub_subcategory'][0]['id']);
             $this->data['docs'] = $this->model->getAllJurisprudenceDocsByCategoryId($_GET['page'],$this->data['jurisprudence_sub_subcategory'][0]['id']);
         }

     }

     public function articles()
     {
         $params = App::getRouter()->getParams();
         if(!isset($params[0])) {
             $this->data['articles_categories'] = $this->model->getArticlesCategories();
         } elseif(isset($params[0]) AND !isset($params[1])){
             $this->data['articles_category'] = $this->model->getArticlesCategory($params[0]);
             $this->data['articles_subcategories'] = $this->model->getArticlesSubcategories($this->data['articles_category'][0]['id']);
             if(!isset($this->data['articles_subcategories'][0])){
                 $this->data['count'] = $this->model->getArticlesNumberOfPages($this->data['articles_category'][0]['id']);
                 $this->data['docs'] = $this->model->getAllArticlesDocsByCategoryId($_GET['page'], $this->data['articles_category'][0]['id']);
             }
         } elseif(isset($params[1]) AND !isset($params[2]))
         {
             $this->data['articles_category'] = $this->model->getArticlesCategory($params[0]);
             $this->data['articles_subcategory'] = $this->model->getArticlesSubcategory($params[0]."/".$params[1]);
             $this->data['count'] = $this->model->getArticlesNumberOfPages($this->data['articles_subcategory'][0]['id']);
             $this->data['docs'] = $this->model->getAllArticlesDocsByCategoryId($_GET['page'],$this->data['articles_subcategory'][0]['id']);
         }

     }

     public function admin_index()
     {
        //$this->data['pages'] = $this->model->getList();
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