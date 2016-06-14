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

    public function login()
    {
        if($_SESSION['role'] == 'logged'){
            Router::redirect('/manage/admin/');
        }
        if($_POST && isset($_POST['login']) && isset($_POST['password'])) {
            $user = $this->model->getByLogin($_POST['login']);
            $hash = md5($_POST['password'].Config::get('salt'));
            if($user && $hash == $user['password']) {
                Session::set('login', $user['login']);
                Session::set('role', 'logged');
                Router::redirect('/manage/admin/');
            } else {
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