<?php

use models\Comuna;

class comunasController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->validateSession();

        $this->getMessages();

        $this->_view->assign('title', 'Comunas');
        $this->_view->assign('subject','Lista de Comunas');
        $this->_view->assign('comunas', Comuna::select('id','nombre')->get());
        $this->_view->render('index');
    }

    public function show($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Comuna::class,$id,'comunas');
        $this->getMessages();

        $this->_view->assign('title', 'Comunas');
        $this->_view->assign('subject','Detalle Comuna');
        $this->_view->assign('comuna', Comuna::find(Filter::filterInt($id)));
        $this->_view->render('show');
    }

    /*
    * metodo GET para cargar el formulario de registro
    */ 
    public function add()
    {
        $this->validateSession();
        $this->getMessages();

        $this->_view->assign('title','Comunas');
        $this->_view->assign('subject', 'Nueva Comuna');
        $this->_view->assign('button','Guardar');
        $this->_view->assign('back', 'comunas/');
        $this->_view->assign('process','comunas/store');
        $this->_view->assign('comuna', Session::get('data'));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('add');
    }

    /*
    * metodo POST para cargar el formulario de registro
    */
    public function store()
    {
        $this->validateForm('comunas/add',[
            'nombre' => Filter::getText('nombre'),
        ]);

        #verificamos que el rol ingresado no este registrado
        #select id from roles where nombre = {$nombre}
        $comuna = Comuna::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($comuna){
            Session::set('msg_error', 'La comuna ingresada ya existe... intente con otra');
            $this->redirect('comunas/add');
        }

        $comuna = new Comuna;
        $comuna->nombre = Filter::getText('nombre');
        $comuna->save();

        Session::destroy('data');
        Session::set('msg_success','La comuna se ha registrado correctamente');
        $this->redirect('comunas');
    }

    public function edit($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Comuna::class,$id,'comunas');
        $this->getMessages();

        $this->_view->assign('title','Comunas');
        $this->_view->assign('subject', 'Editar Comuna');
        $this->_view->assign('button','Editar');
        $this->_view->assign('back', 'comunas/');
        $this->_view->assign('process',"comunas/update/{$id}");
        $this->_view->assign('comuna', Comuna::find(Filter::filterInt($id)));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    /*
    * metodo PUT para cargar el formulario de registro
    */
    public function update($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Comuna::class,$id,'comunas');
        $this->validatePUT();

        $this->validateForm("comunas/edit/{$id}",[
            'nombre' => Filter::getText('nombre'),
        ]);

        #verificamos que el rol ingresado no este registrado
        #select id from roles where nombre = {$nombre}
        $comuna = Comuna::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($comuna){
            Session::set('msg_error', 'La comuna ingresada ya existe... intente con otra');
            $this->redirect('comunas/edit/' . $id);
        }

        $comuna = Comuna::find(Filter::filterInt($id));
        $comuna->nombre = Filter::getText('nombre');
        $comuna->save();

        Session::destroy('data');
        Session::set('msg_success','La comuna se ha modificado correctamente');
        $this->redirect('comunas/show/' . $id);
    }
}