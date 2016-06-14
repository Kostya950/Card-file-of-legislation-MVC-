<?php
/**
 * Created by PhpStorm.
 * User: kito
 * Date: 13.06.16
 * Time: 17:50
 */

class AdminController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Card();
    }

    public function index()
    {
        $this->data['count_laws'] = $this->model->countLaws();
        $this->data['count_articles'] = $this->model->countArticles();
        $this->data['count_jurisprudence'] = $this->model->countJurisprudence();
        $this->data['count_all'] = $this->data['count_laws'][0]['cnt'] + $this->data['count_articles'][0]['cnt'] +
            $this->data['count_jurisprudence'][0]['cnt'];
        $this->model->updateCount($this->data['count_all']);
        Config::set('count', $this->data['count_all']);
    }

    public function laws()
    {
        $this->data['indexes'] = $this->model->getAllLawsIndexes();
        $this->data['publishers'] = $this->model->getAllLawsPublishers();
        $this->data['types'] = $this->model->getAllLawsTypes();
        $this->data['folders'] = $this->model->getAllLawsFolders();
        $this->model->createOrReplaceLawsView();

        function index($indexes) {
            foreach ($indexes as $key => $index) {
                echo "<option value='{$index['id']}'>{$index['index']}</option>";
            }
        }
        function publisher($publishers) {
            foreach ($publishers as $publisher) {
                echo "<option value='{$publisher['id']}'>{$publisher['publisher']}</option>";
            }
        }
        function types($types) {
            foreach ($types as $type) {
                echo "<option value='{$type['id']}'>{$type['type']}</option>";
            }
        }

        function folders($folders) {
            foreach ($folders as $folder) {
                echo "<option value='{$folder['id']}'>{$folder['folder']}</option>";
            }
        }
    }

    public function articles()
    {
        $this->data['indexes'] = $this->model->getAllArticlesIndexes();
        $this->data['types'] = $this->model->getAllArticlesTypes();
        $this->model->createOrReplaceArticlesView();

        function index($indexes) {
            foreach ($indexes as $key => $index) {
                echo "<option value='{$index['id']}'>{$index['index']}</option>";
            }
        }
        function types($types) {
            foreach ($types as $type) {
                echo "<option value='{$type['id']}'>{$type['type']}</option>";
            }
        }

    }

    public function jurisprudence()
    {
        $this->data['indexes'] = $this->model->getAllJurisprudenceIndexes();
        $this->data['types'] = $this->model->getAllJurisprudenceTypes();
        $this->model->createOrReplaceJurisprudenceView();

        function index($indexes) {
            foreach ($indexes as $index) {
                echo "<option value='{$index['id']}'>{$index['index']}</option>";
            }
        }
        function types($types) {
            foreach ($types as $type) {
                echo "<option value='{$type['id']}'>{$type['type']}</option>";
            }
        }


    }

    public function new_acts()
    {

    }
}
