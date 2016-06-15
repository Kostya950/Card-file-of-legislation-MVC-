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

        function index($indexes)
        {
            foreach ($indexes as $key => $index) {
                echo "<option value='{$index['id']}'>{$index['index']}</option>";
            }
        }

        function publisher($publishers)
        {
            foreach ($publishers as $publisher) {
                echo "<option value='{$publisher['id']}'>{$publisher['publisher']}</option>";
            }
        }

        function types($types)
        {
            foreach ($types as $type) {
                echo "<option value='{$type['id']}'>{$type['type']}</option>";
            }
        }

        function folders($folders)
        {
            foreach ($folders as $folder) {
                echo "<option value='{$folder['id']}'>{$folder['folder']}</option>";
            }
        }
    }

    public function edit_laws()
    {
        $params = App::getRouter()->getParams();
        $this->data['indexes'] = $this->model->getAllLawsIndexes();
        $this->data['subcategories'] = $this->model->getAllLawsSubcategories();
        $this->data['publishers'] = $this->model->getAllLawsPublishers();
        $this->data['types'] = $this->model->getAllLawsTypes();
        $this->data['folders'] = $this->model->getAllLawsFolders();
        $this->data['editable_card'] = $this->model->getLawsCard($params[0]);

        function indexId($editable_card, $indexes, $id)
        {
            foreach ($editable_card as $card) {
                if ($card["$id"] != 0) {
                    foreach ($indexes as $index) {
                        if ($index['id'] == $card["$id"]) {
                            echo "<option value='{$index['id']}'>{$index['index']}</option>";
                        }
                    }
                }
                echo "<option></option>";
                foreach ($indexes as $index) {
                    echo "<option value='{$index['id']}'>{$index['index']}</option>";
                }
            }
        }

        function subIndexId($editable_card, $subcategory, $sub_id)
        {
            foreach ($editable_card as $card) {
                if ($card["$sub_id"] != 0) {
                    foreach ($subcategory as $subcateg) {
                        if ($subcateg['id'] == $card["$sub_id"]) {
                            echo "<option value='{$subcateg['id']}'>{$subcateg['title']}</option>";
                        }
                    }
                }
            }
        }

        function publisher($editable_card, $publishers, $publ_id)
        {
            foreach ($editable_card as $card) {
                if ($card["$publ_id"] != 0) {
                    foreach ($publishers as $publisher) {
                        if ($publisher['id'] == $card["$publ_id"]) {
                            echo "<option value='{$publisher['id']}'>{$publisher['publisher']}</option>";
                        }
                    }
                }
                echo "<option></option>";
                foreach ($publishers as $publisher) {
                    echo "<option value='{$publisher['id']}'>{$publisher['publisher']}</option>";
                }

            }
        }

        function folder($editable_card, $folders)
        {
            foreach ($editable_card as $card) {
                if ($card['folder'] != 0) {
                    foreach ($folders as $folder) {
                        if ($folder['id'] == $card['folder']) {
                            echo "<option value='{$folder['id']}'>{$folder['folder']}</option>";
                        }
                    }
                }
                echo "<option></option>";
                foreach ($folders as $folder) {
                    echo "<option value='{$folder['id']}'>{$folder['folder']}</option>";

                }
            }
        }

        function types($editable_card, $types)
        {
            foreach ($editable_card as $card) {
                if ($card['type'] != 0) {
                    foreach ($types as $type) {
                        if ($type['id'] == $card['type']) {
                            echo "<option value='{$type['id']}'>{$type['type']}</option>";
                        }
                    }
                }
                echo "<option></option>";
                foreach ($types as $type) {
                    echo "<option value='{$type['id']}'>{$type['type']}</option>";
                }
            }
        }
    }

    public function success_edit_laws()
    {
        $params = App::getRouter()->getParams();
        if (isset($_POST['submit'])) {
            $this->model->saveLaws($_POST);
            $this->data['saved_doc'] = $this->model->getSavedLawsDoc($_POST);
        }
        if ($_POST['yes']) {
            $this->model->deleteLaws($params[0]);
        }
        if (isset($_POST['edit'])) {
            $this->model->editLaws($_POST, $params[0]);
            $this->data['saved_doc'] = $this->model->getSavedLawsDoc($_POST);
        }
    }

    public function print_card_laws()
    {
        $params = App::getRouter()->getParams();
        $this->data['doc_to_print'] = $this->model->getDocToPrint($params[0]);
    }

    public function articles()
    {
        $this->data['indexes'] = $this->model->getAllArticlesIndexes();
        $this->data['types'] = $this->model->getAllArticlesTypes();
        $this->model->createOrReplaceArticlesView();

        function index($indexes)
        {
            foreach ($indexes as $key => $index) {
                echo "<option value='{$index['id']}'>{$index['index']}</option>";
            }
        }

        function types($types)
        {
            foreach ($types as $type) {
                echo "<option value='{$type['id']}'>{$type['type']}</option>";
            }
        }

        if (isset($_POST['submit'])) {
            $this->model->saveArticles($_POST);
            $this->data['saved_doc'] = $this->model->getSavedArticlesDoc($_POST);
        }
    }

    public function edit_articles()
    {
        $params = App::getRouter()->getParams();
        $this->data['indexes'] = $this->model->getAllArticlesIndexes();
        $this->data['types'] = $this->model->getAllArticlesTypes();
        $this->data['editable_card'] = $this->model->getArticlesCard($params[0]);

        function indexId($editable_card, $indexes, $id)
        {
            foreach ($editable_card as $card) {
                if ($card["$id"] != 0) {
                    foreach ($indexes as $index) {
                        if ($index['id'] == $card["$id"]) {
                            echo "<option value='{$index['id']}'>{$index['index']}</option>";
                        }
                    }
                }
                echo "<option value='132'></option>";
                foreach ($indexes as $index) {
                    echo "<option value='{$index['id']}'>{$index['index']}</option>";
                }
            }
        }

        function types($editable_card, $types)
        {
            foreach ($editable_card as $card) {
                if ($card['type'] != 0) {
                    foreach ($types as $type) {
                        if ($type['id'] == $card['type']) {
                            echo "<option value='{$type['id']}'>{$type['type']}</option>";
                        }
                    }
                }
                echo "<option></option>";
                foreach ($types as $type) {
                    echo "<option value='{$type['id']}'>{$type['type']}</option>";
                }
            }
        }
    }

    public function success_edit_articles()
    {
        $params = App::getRouter()->getParams();
        if ($_POST['yes']) {
            $this->model->deleteArticles($params[0]);
        }
        if (isset($_POST['edit'])) {
            $this->model->editArticles($_POST, $params[0]);
            $this->data['saved_doc'] = $this->model->getArticlesCard($params[0]);
        }

    }

    public function jurisprudence()
    {
        $this->data['indexes'] = $this->model->getAllJurisprudenceIndexes();
        $this->data['types'] = $this->model->getAllJurisprudenceTypes();
        $this->model->createOrReplaceJurisprudenceView();

        function index($indexes)
        {
            foreach ($indexes as $index) {
                echo "<option value='{$index['id']}'>{$index['index']}</option>";
            }
        }

        function types($types)
        {
            foreach ($types as $type) {
                echo "<option value='{$type['id']}'>{$type['type']}</option>";
            }
        }

        if (isset($_POST['submit'])) {
            $this->model->saveJurisprudence($_POST);
            $this->data['saved_doc'] = $this->model->getSavedJurisprudenceDoc($_POST);
        }
    }

    public function edit_jurisprudence()
    {
        $params = App::getRouter()->getParams();
        $this->data['indexes'] = $this->model->getAllJurisprudenceIndexes();
        $this->data['types'] = $this->model->getAllJurisprudenceTypes();
        $this->data['editable_card'] = $this->model->getJurisprudenceCard($params[0]);

        function indexId($editable_card, $indexes, $id){
            foreach ($editable_card as $card){
                if ($card["$id"] !=0) {
                    foreach($indexes as $index) {
                        if ($index['id'] == $card["$id"]) {
                            echo "<option value='{$index['id']}'>{$index['index']}</option>";
                        }
                    }
                }
                echo "<option></option>";
                foreach($indexes as $index){
                    echo "<option value='{$index['id']}'>{$index['index']}</option>";
                }
            }
        }
        function types($editable_card, $types)
        {
            foreach ($editable_card as $card) {
                if($card['type']!=0) {
                    foreach ($types as $type) {
                        if ($type['id'] == $card['type']) {
                            echo "<option value='{$type['id']}'>{$type['type']}</option>";
                        }
                    }
                }
                echo "<option></option>";
                foreach ($types as $type) {
                    echo "<option value='{$type['id']}'>{$type['type']}</option>";
                }
            }
        }
    }

    public function success_edit_jurisprudence()
    {
        $params = App::getRouter()->getParams();
        if ($_POST['yes']) {
            $this->model->deleteJurisprudence($params[0]);
        }
        if (isset($_POST['edit'])) {
            $this->model->editJurisprudence($_POST, $params[0]);
            $this->data['saved_doc'] = $this->model->getJurisprudenceCard($params[0]);
        }

    }

    public function new_acts()
    {
        $params = App::getRouter()->getParams();
        if(!isset($params[0])) {
            $this->data['new_acts_range'] = $this->model->getNewActsRange();

            if (isset($_POST['add_range'])) {
                if ($_POST['range'] != '') {
                    $this->model->addNewActsRange($_POST);
                }
            }

            if (isset($_POST['upload'])) {
                if ($_POST['ch_range'] != '') {
                    if ($_FILES && isset ($_FILES['new_doc'])) {
                        $link = 'files/new_legislative_acts/new_legislative_acts_' . $_POST['ch_range'] . '.doc';
                        move_uploaded_file($_FILES['new_doc']['tmp_name'], $link);
                        echo 1;
                        $this->model->saveDocForNewActsRange($_POST['ch_range'], $link);
                    }
                }
            }
        } else{
            $this->data['types'] = $this->model->getNewActsTypes();
            $this->data['publishers'] =  $this->model->getNewActsPublishers();
            $this->data['range_dates'] =  $this->model->getNewActsRangeDates();
            if(isset($_POST['submit'])){
                if(($_POST['publisher']!='') AND ($_POST['type']!='') AND ($_POST['date']!='') AND ($_POST['number']!='') AND ($_POST['title']!='')){
                    $this->model->saveNewAct($_POST, $this->data['range_dates'], $params[0]);
                }
            }

        }
    }
    public function registration()
    {

        if(isset($_POST['sign_up'])){
            $this->data['user_exists'] = $this->model->getByLogin($_POST['login']);
            if(!isset($this->data['user_exists'][0])){
                $salt = Config::get('salt');
                $this->model->saveNewUser($_POST, $salt);
            }
        }

    }
}
