<?php

use models\Nacionalidad;

class nacionalidadesController extends Controller
{
    public function __construct()
    {
        $this->validateSession();
        Session::time();
        parent::__construct();
    }

    public function index()
    {
        $this->getMessages();

        $this->_view->assign('title', 'Nacionalidades');
        $this->_view->assign('subject','Lista de Nacionalidades');
        $this->_view->assign('nacionalidades', Nacionalidad::select('id','nombre')->get());
        $this->_view->render('index');
    }

    public function show($id = null)
    {
        Validate::validateModel(Nacionalidad::class,$id,'nacionalidades');
        $this->getMessages();

        $this->_view->assign('title', 'Nacionalidades');
        $this->_view->assign('subject','Detalle Nacionalidad');
        $this->_view->assign('nacionalidad', Nacionalidad::find(Filter::filterInt($id)));
        $this->_view->render('show');
    }

    public function add()
    {
        $this->getMessages();

        $this->_view->assign('title','Nacionalidad');
        $this->_view->assign('subject', 'Nueva Nacionalidad');
        $this->_view->assign('button','Guardar');
        $this->_view->assign('back', 'nacionalidades/');
        $this->_view->assign('process','nacionalidades/store');
        $this->_view->assign('nacionalidad', Session::get('data'));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('add');
    }

    public function store()
    {
        $this->validateForm('nacionalidades/add',[
            'nombre' => Filter::getText('nombre'),
        ]);

        $nacionalidad = Nacionalidad::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($nacionalidad){
            Session::set('msg_error', 'La nacionalidad ingresada ya existe... intente con otra');
            $this->redirect('nacionalidades/add');
        }

        $nacionalidad = new Nacionalidad;
        $nacionalidad->nombre = Filter::getText('nombre');
        $nacionalidad->save();

        Session::destroy('data');
        Session::set('msg_success','La nacionalidad se ha registrado correctamente');
        $this->redirect('nacionalidades');
    }

    public function edit($id = null)
    {
        Validate::validateModel(Nacionalidad::class,$id,'nacionalidades');
        $this->getMessages();

        $this->_view->assign('title','Nacionalidades');
        $this->_view->assign('subject', 'Editar Nacionalidad');
        $this->_view->assign('button','Editar');
        $this->_view->assign('back', 'nacionalidades/');
        $this->_view->assign('process',"nacionalidades/update/{$id}");
        $this->_view->assign('nacionalidad', Nacionalidad::find(Filter::filterInt($id)));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    public function update($id = null)
    {
        Validate::validateModel(Nacionalidad::class,$id,'nacionalidades');
        $this->validatePUT();

        $this->validateForm("nacionalidades/edit/{$id}",[
            'nombre' => Filter::getText('nombre'),
        ]);

        $nacionalidad = Nacionalidad::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($nacionalidad){
            Session::set('msg_error', 'La nacionalidad ingresada ya existe... intente con otra');
            $this->redirect('nacionalidades/edit/' . $id);
        }

        $nacionalidad = Nacionalidad::find(Filter::filterInt($id));
        $nacionalidad->nombre = Filter::getText('nombre');
        $nacionalidad->save();

        Session::destroy('data');
        Session::set('msg_success','La nacionalidad se ha modificado correctamente');
        $this->redirect('nacionalidades/show/' . $id);
    }
}
