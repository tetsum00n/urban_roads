<?php

use models\Role;

class rolesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->validateSession();

        $this->getMessages();

        $this->_view->assign('title', 'Roles');
        $this->_view->assign('subject','Lista de Roles');
        $this->_view->assign('roles', Role::select('id','nombre')->get());
        $this->_view->render('index');
    }

    public function show($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Role::class,$id,'roles');
        $this->getMessages();

        $this->_view->assign('title', 'Roles');
        $this->_view->assign('subject','Detalle Rol');
        $this->_view->assign('role', Role::find(Filter::filterInt($id)));
        $this->_view->render('show');
    }

    /*
    * metodo GET para cargar el formulario de registro
    */ 
    public function add()
    {
        $this->validateSession();
        $this->getMessages();

        $this->_view->assign('title','Roles');
        $this->_view->assign('subject', 'Nuevo Rol');
        $this->_view->assign('button','Guardar');
        $this->_view->assign('back', 'roles/');
        $this->_view->assign('process','roles/store');
        $this->_view->assign('role', Session::get('data'));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('add');
    }

    /*
    * metodo POST para cargar el formulario de registro
    */
    public function store()
    {
        $this->validateForm('roles/add',[
            'nombre' => Filter::getText('nombre'),
        ]);

        #verificamos que el rol ingresado no este registrado
        #select id from roles where nombre = {$nombre}
        $role = Role::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($role){
            Session::set('msg_error', 'El rol ingresado ya existe... intente con otro');
            $this->redirect('roles/add');
        }

        $role = new Role;
        $role->nombre = Filter::getText('nombre');
        $role->save();

        Session::destroy('data');
        Session::set('msg_success','El rol se ha registrado correctamente');
        $this->redirect('roles');
    }

    public function edit($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Role::class,$id,'roles');
        $this->getMessages();

        $this->_view->assign('title','Roles');
        $this->_view->assign('subject', 'Editar Rol');
        $this->_view->assign('button','Editar');
        $this->_view->assign('back', 'roles/');
        $this->_view->assign('process',"roles/update/{$id}");
        $this->_view->assign('role', Role::find(Filter::filterInt($id)));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    /*
    * metodo PUT para cargar el formulario de registro
    */
    public function update($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Role::class,$id,'roles');
        $this->validatePUT();

        $this->validateForm("roles/edit/{$id}",[
            'nombre' => Filter::getText('nombre'),
        ]);

        #verificamos que el rol ingresado no este registrado
        #select id from roles where nombre = {$nombre}
        $role = Role::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($role){
            Session::set('msg_error', 'El rol ingresado ya existe... intente con otro');
            $this->redirect('roles/edit/' . $id);
        }

        $role = Role::find(Filter::filterInt($id));
        $role->nombre = Filter::getText('nombre');
        $role->save();

        Session::destroy('data');
        Session::set('msg_success','El rol se ha modificado correctamente');
        $this->redirect('roles/show/' . $id);
    }
}