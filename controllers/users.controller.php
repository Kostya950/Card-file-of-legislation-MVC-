<?php
/**
 * Created by PhpStorm.
 * User: kito
 * Date: 28.05.16
 * Time: 12:13
 */

class UsersController extends Controller
{
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new User();
    }
    // раздел для вхождения в раздел для добалвения новых актов законодательства
    public function login()
    {
        if($_SESSION['role'] == 'logged'){  // если пользователь уже залогинился переводим его в раздел добавления
            Router::redirect('/manage/admin/');
        }
        // проверяем есть ли в базе пользователем с таким логином если есть проверяем правильно ли введен парель
        // если пароль и логин правильные ставим что пользователь ввошел и адресуем на страницу добавления
        if($_POST && isset($_POST['login']) && isset($_POST['password'])) {
            $user = $this->model->getByLogin($_POST['login']);
            $hash = md5($_POST['password'].Config::get('salt'));
            if($user && $hash == $user['password']) {
                Session::set('login', $user['login']);
                Session::set('role', 'logged');
                Router::redirect('/manage/admin/');
            } else {  // если неправельный логин или пароль выводим сообщение о неправельном логине или пароле
                Session::setFlash('Невірний логін або пароль!');
                $this->data['wrong_user'] = 'wrong user';
            }
        }
    }

    public function logout()
    {
        Session::destroy();
        Router::redirect('/users/login/');
    }


}