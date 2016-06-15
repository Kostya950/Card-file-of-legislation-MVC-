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
    // главная страница управления(добавления актов)
    public function index()
    {
        $this->data['count_laws'] = $this->model->countLaws(); // получаем количество законодательных актов
        $this->data['count_articles'] = $this->model->countArticles(); // получаем количество статтей
        $this->data['count_jurisprudence'] = $this->model->countJurisprudence(); // получаем количество судебных актов
        $this->data['count_all'] = $this->data['count_laws'][0]['cnt'] + $this->data['count_articles'][0]['cnt'] +
            $this->data['count_jurisprudence'][0]['cnt']; // сумма всех документов в базе
        $this->model->updateCount($this->data['count_all']); // добавляем запись с количеством документов в базу
        Config::set('count', $this->data['count_all']);
    }
    // раздел добавления законодательных актов
    public function laws()
    {
        $this->data['indexes'] = $this->model->getAllLawsIndexes(); //получаем все индексы из класификатора
        $this->data['publishers'] = $this->model->getAllLawsPublishers();// получаем всех издателей документов
        $this->data['types'] = $this->model->getAllLawsTypes(); // получаем все виды документов
        $this->data['folders'] = $this->model->getAllLawsFolders(); // получаем папки в котороых может хранится докум.
        $this->model->createOrReplaceLawsView(); // создаем или заменяем вид (сводная таблица всех данных)
        // функция для вывода всех индексов для выбора
        function index($indexes)
        {
            foreach ($indexes as $key => $index) {
                echo "<option value='{$index['id']}'>{$index['index']}</option>";
            }
        }
        // функция для вывода всех издателей для выбора
        function publisher($publishers)
        {
            foreach ($publishers as $publisher) {
                echo "<option value='{$publisher['id']}'>{$publisher['publisher']}</option>";
            }
        }
        // функция для вывода всех видов документов для выбора
        function types($types)
        {
            foreach ($types as $type) {
                echo "<option value='{$type['id']}'>{$type['type']}</option>";
            }
        }
        // функция для вывода всех папок для выбора
        function folders($folders)
        {
            foreach ($folders as $folder) {
                echo "<option value='{$folder['id']}'>{$folder['folder']}</option>";
            }
        }
    }
    // раздел для редактирования законодательных актов
    public function edit_laws()
    {
        $params = App::getRouter()->getParams();
        $this->data['indexes'] = $this->model->getAllLawsIndexes(); // получаем все индексы из класификатора
        $this->data['subcategories'] = $this->model->getAllLawsSubcategories(); // получаем все подкатегории выбранной
        // категории
        $this->data['publishers'] = $this->model->getAllLawsPublishers(); // получаем всех издателей документов
        $this->data['types'] = $this->model->getAllLawsTypes(); // получаем все виды документов
        $this->data['folders'] = $this->model->getAllLawsFolders(); // получаем все папки где могут храниться документы
        $this->data['editable_card'] = $this->model->getLawsCard($params[0]); // получаем документ для редактирования
        // функция для отображения индекса документа для редактирования
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
        // функция для отображения подкатегории документа для редактирования
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
        // функция для отображения издателя документа для редактирования
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
        // функция для отображения папки документа для редактирования
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
        // функция для отображения вида документа для редактирования
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
    // раздел для отображения сохранения/удаления/редактирования документа
    public function success_edit_laws()
    {
        $params = App::getRouter()->getParams();
        if (isset($_POST['submit'])) {
            $this->model->saveLaws($_POST); // сохраняем новый документ в базу
            $this->data['saved_doc'] = $this->model->getSavedLawsDoc($_POST); // получаем сохраненный документ из базы
        }
        if ($_POST['yes']) {
            $this->model->deleteLaws($params[0]); // если получаем пост (да) удаляем указанный документ из баззы
        }
        if (isset($_POST['edit'])) {
            $this->model->editLaws($_POST, $params[0]); // если пост(редактировать) редактируем нужный документ в базе
            $this->data['saved_doc'] = $this->model->getSavedLawsDoc($_POST); // получаем редактированный документ из базы
        }
    }
    // раздел для печати карточек законодательных актов
    public function print_card_laws()
    {
        $params = App::getRouter()->getParams();
        $this->data['doc_to_print'] = $this->model->getDocToPrint($params[0]); // получаем документ для печати карточек
    }
    // раздел для добавления публикций с правовой тематики
    public function articles()
    {
        $this->data['indexes'] = $this->model->getAllArticlesIndexes(); //получаем все индексы для публикаций
        $this->data['types'] = $this->model->getAllArticlesTypes(); // получаем типы публикаций (статья)
        $this->model->createOrReplaceArticlesView(); // создаем или заменяем вид (сводная таблица всех данных)
        // функция для вывода всех индексов для выбора
        function index($indexes)
        {
            foreach ($indexes as $key => $index) {
                echo "<option value='{$index['id']}'>{$index['index']}</option>";
            }
        }
        // функция для вывода всех типов (статья)
        function types($types)
        {
            foreach ($types as $type) {
                echo "<option value='{$type['id']}'>{$type['type']}</option>";
            }
        }

        if (isset($_POST['submit'])) {
            $this->model->saveArticles($_POST); // если есть POST['submit'] сохраняем статью в базу данных
            $this->data['saved_doc'] = $this->model->getSavedArticlesDoc($_POST); // получаем сохраненную статью из базы
        }
    }
    // раздел для редактирования статьей
    public function edit_articles()
    {
        $params = App::getRouter()->getParams();
        $this->data['indexes'] = $this->model->getAllArticlesIndexes(); // получаем все индексы публикаций
        $this->data['types'] = $this->model->getAllArticlesTypes(); // получаей все типы публикаций (статья)
        $this->data['editable_card'] = $this->model->getArticlesCard($params[0]); // получаем данные статьи которую
        // нужно отредактировать
        // функция для отображения индекса статьи для редактирования
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
        // функция для отображения вида документа для редактирования
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
    // раздел для отображения редактирования/удаления статьи из базы
    public function success_edit_articles()
    {
        $params = App::getRouter()->getParams();
        if ($_POST['yes']) {
            $this->model->deleteArticles($params[0]); // удаляем статью из базы
        }
        if (isset($_POST['edit'])) {
            $this->model->editArticles($_POST, $params[0]);
            $this->data['saved_doc'] = $this->model->getArticlesCard($params[0]); // редактируем статью в базе
        }

    }
    // раздел для добавленя актов судебной практики
    public function jurisprudence()
    {
        $this->data['indexes'] = $this->model->getAllJurisprudenceIndexes(); // получаем все индексы актов суд. практики
        $this->data['types'] = $this->model->getAllJurisprudenceTypes(); // получаем все виды актов суд. практики
        $this->model->createOrReplaceJurisprudenceView(); // создаем или заменяем вид (сводная таблица всех данных)
        // функция для отображения всех индексов классификатора для выбора
        function index($indexes)
        {
            foreach ($indexes as $index) {
                echo "<option value='{$index['id']}'>{$index['index']}</option>";
            }
        }
        // функция для отображения всех видов актов для выбора
        function types($types)
        {
            foreach ($types as $type) {
                echo "<option value='{$type['id']}'>{$type['type']}</option>";
            }
        }

        if (isset($_POST['submit'])) {
            $this->model->saveJurisprudence($_POST); // если отправлен запрос сохраняем акт сдуебной практики в базу
            $this->data['saved_doc'] = $this->model->getSavedJurisprudenceDoc($_POST); // получаем сохраненный акт
        }
    }
    // раздел для редактирования актов судебной практики
    public function edit_jurisprudence()
    {
        $params = App::getRouter()->getParams();
        $this->data['indexes'] = $this->model->getAllJurisprudenceIndexes(); // получаем все индексы актов суд. практик.
        $this->data['types'] = $this->model->getAllJurisprudenceTypes(); // получаем все виды актов судебной практики
        $this->data['editable_card'] = $this->model->getJurisprudenceCard($params[0]); // получаем акт для редактирован.
        // функция для отображения индекса выбранного акта  и всех остальных индексов для редактирования
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
        // функция для отображения вида выбранного акта и всех остальных видов для редактирования
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
    // раздел для отображения успешного редактирования/удаления актов судебной практики
    public function success_edit_jurisprudence()
    {
        $params = App::getRouter()->getParams();
        if ($_POST['yes']) {
            $this->model->deleteJurisprudence($params[0]); // удаляем акт судебной практики из базы
        }
        if (isset($_POST['edit'])) {
            $this->model->editJurisprudence($_POST, $params[0]); // редактируем акт судебной практики в базе
            $this->data['saved_doc'] = $this->model->getJurisprudenceCard($params[0]); // получаем отредакт. акт
        }

    }
    // раздел добавления новых законодательных актов
    public function new_acts()
    {
        $params = App::getRouter()->getParams();
        // если в параметре нет периода добавления до выводим форму для добавления нового периода законодатльных актов
        if(!isset($params[0])) {
            $this->data['new_acts_range'] = $this->model->getNewActsRange(); // получаем все периоды нов. закон. актов

            if (isset($_POST['add_range'])) {
                if ($_POST['range'] != '') {
                    $this->model->addNewActsRange($_POST); // если не пустое поле ввода периода то добавляем его в базу
                }
            }
            // сохраняем в папку /files/ новые законодательные акты в формате word.doc и ложим в базу путь к файлу
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
        } else{ // если есть параметр с периодом для новых законодательных актов выводим форму для добавления документов
            $this->data['types'] = $this->model->getNewActsTypes(); // получаем все виды документов
            $this->data['publishers'] =  $this->model->getNewActsPublishers(); // получаем всех издателей
            $this->data['range_dates'] =  $this->model->getNewActsRangeDates(); // получаем все периоды новых зак. актов
            if(isset($_POST['submit'])){
                if(($_POST['publisher']!='') AND ($_POST['type']!='') AND ($_POST['date']!='') AND ($_POST['number']!='')
                    AND ($_POST['title']!='')){
                    $this->model->saveNewAct($_POST, $this->data['range_dates'], $params[0]); // если все поля заполнены
                    // сохраняем документ в базу
                }
            }

        }
    }
    // раздел для регистрации нового работника отдела
    public function registration()
    {
        if(isset($_POST['sign_up'])){
            $this->data['user_exists'] = $this->model->getByLogin($_POST['login']);
            // проверяем не занят ли выбранный логин если не занят регистрируем нового пользователя
            if(!isset($this->data['user_exists'][0])){
                $salt = Config::get('salt');
                $this->model->saveNewUser($_POST, $salt);
            }
        }

    }
}
