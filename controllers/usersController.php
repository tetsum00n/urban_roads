<?php

use models\User;
use models\Role;
use models\Comuna;
use models\Telefono;

class usersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->validateSession();

        $this->getMessages();

        $this->_view->assign('title', 'Usuarios');
        $this->_view->assign('subject','Lista de Usuarios');
        $this->_view->assign('users', User::with(['comuna','role'])->get());
        $this->_view->render('index');
    }

    public function show($id = null)
    {
        $this->validateSession();
        Validate::validateModel(User::class,$id,'users');
        $this->getMessages();

        $this->_view->assign('title', 'Usuarios');
        $this->_view->assign('subject','Detalle Usuario');
        $this->_view->assign('user', User::with(['comuna','role'])->find(Filter::filterInt($id)));
        $this->_view->assign('telefonos', Telefono::select('id', 'numero')->where('telefonoable_id', Filter::filterInt($id))->where('telefonoable_type', 'User')->get());
        $this->_view->render('show');
    }

    public function edit($id = null)
    {
        $this->validateSession();

        Validate::validateModel(User::class, $id, 'users');
        $this->getMessages();

        $this->_view->assign('title','Usuarios');
        $this->_view->assign('subject','Editar Usuario');
        $this->_view->assign('button','Editar');
        $this->_view->assign('back', "users/");
        $this->_view->assign('process', "users/update/{$id}");
        $this->_view->assign('user', User::with(['comuna','role'])->find(Filter::filterInt($id)));
        $this->_view->assign('roles', Role::select('id','nombre')->get());
        $this->_view->assign('comunas', Comuna::select('id','nombre')->get());
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    public function update($id = null)
    {
        $this->validateSession();
        Validate::validateModel(User::class, $id, 'users');

        $this->validatePUT();

        $this->validateForm("users/edit/{$id}",[
            'nombre' => Filter::getText('nombre'),
            'rut' => Filter::getText('rut'),
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'status' => Filter::getText('status'),
            'direccion' => Filter::getText('direccion'),
            'comuna' => Filter::getText('comuna'),
            'role' => Filter::getText('role')
        ]);

        if(!$this->validateRut(Filter::getText('rut'))){
            Session::set('msg_error', 'El RUT es inválido... inténtelo de nuevo');
            $this->redirect('users/edit/' . $id);
        }

        $user = User::find(Filter::filterInt($id));
        $user->nombre = Filter::getSql('nombre');
        $user->rut = Filter::getText('rut');
        $user->email = Filter::getPostParam('email');
        $user->status = Filter::getInt('status');
        $user->direccion = Filter::getText('direccion');
        $user->comuna_id = Filter::getInt('comuna');
        $user->role_id = Filter::getInt('role');
        $res = $user->save();

        Session::destroy('data');
        Session::set('msg_success','El usuario se ha modificado correctamente');
        $this->redirect('users/view/' . $id);
    }

    public function add()
    {
        $this->getMessages();

        $this->_view->assign('title','Usuarios');
        $this->_view->assign('subject','Nuevo Usuario');
        $this->_view->assign('button','Guardar');
        $this->_view->assign('back', 'users/');
        $this->_view->assign('process','users/store');
        $this->_view->assign('roles', Role::select('id','nombre')->get());
        $this->_view->assign('comunas', Comuna::select('id','nombre')->get());
        $this->_view->assign('user', Session::get('data'));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('add');
    }

    public function store()
    {
        $this->validateForm('users/add',[
            'nombre' => Filter::getText('nombre'),
            'rut' => Filter::getText('rut'),
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'direccion' => Filter::getText('direccion'),
            'comuna' => Filter::getText('comuna'),
            'role' => Filter::getText('role')
        ]);

        if(!$this->validateRut(Filter::getText('rut'))){
            Session::set('msg_error', 'El RUT es inválido... inténtelo de nuevo');
            $this->redirect('users/add/');
        }

        if (strlen(Filter::getSql('password')) < 8) {
            Session::set('msg_error', 'El password debe contener al menos 8 caracteres');
            $this->redirect('users/add');
        }

        if (Filter::getSql('password') != Filter::getSql('password_confirm')) {
            Session::set('msg_error', 'Los passwords no coinciden');
            $this->redirect('users/add');
        }

        $user = User::select('id')
            ->where('email', Filter::getPostParam('email'))
            ->where('rut', Filter::getText('rut'))
            ->first();

        if ($user) {
            Session::set('msg_error', 'El usuario ingresado ya existe... intente con otro');
            $this->redirect('users/add');
        }

        $user = new User;
        $user->nombre = Filter::getSql('nombre');
        $user->rut = Filter::getText('rut');
        $user->email = Filter::getPostParam('email');
        $user->status = 1;
        $user->password = Helper::encryptPassword(Filter::getSql('password'));
        $user->direccion = Filter::getText('direccion');
        $user->comuna_id = Filter::getInt('comuna');
        $user->role_id = Filter::getInt('role');
        $res = $user->save();

        Session::destroy('data');
        Session::set('msg_success','El usuario se ha registrado correctamente');
        $this->redirect('users/');
    }
}