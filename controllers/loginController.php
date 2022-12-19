<?php
use models\User;

class loginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    #metodo GET que carga el formulario de login
    public function login()
    {
        if (Session::get('autenticate')) {
            $this->redirect('home');
        }

        $this->getMessages();
        //print_r($_POST);exit;
        $this->_view->assign('title','Login de Usuario');
        $this->_view->assign('subject','Login de Usuario');
        $this->_view->assign('process', 'login/store');
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('login');
    }

    #metodo POST que crea el login y la sesion
    public function store()
    {
        $this->validateForm('login/login',[
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'password' => Filter::getSql('password')
        ]);

        $user = User::with('role')
            ->where('email', Filter::getPostParam('email'))
            ->where('password', Helper::encryptPassword(Filter::getSql('password')))
            ->where('status', 1)
            ->first();

        // echo '<pre>';
        // print_r($user);exit;
        // echo '</pre>';

        if (!$user) {
            Session::set('msg_error', 'El email o el password no están registrados... intente nuevamente');
            $this->redirect('login/login');
        }

        Session::set('autenticate', true);
        Session::set('user_id', $user->id);
        Session::set('user_nombre', $user->nombre);
        Session::set('user_role', $user->role_id->nombre);
        Session::set('time', time());
        Session::set('msg_success','Bienvenid@ ' . $user->nombre);

        $this->redirect('home');
    }

    public function logout()
    {
        Session::destroy();


        $this->redirect();
    }
}