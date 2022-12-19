<?php

use models\Arriendo;

class arriendosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->validateSession();

        $this->getMessages();

        $this->_view->assign('title', 'Arriendos');
        $this->_view->assign('subject','Lista de Arriendos');
        $this->_view->assign('arriendos', Arriendo::select('id','nombre','created_at','user_id')->get());
        $this->_view->render('index');
    }

    public function show($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Arriendo::class,$id,'arriendos');
        $this->getMessages();

        $this->_view->assign('title', 'Arriendos');
        $this->_view->assign('subject','Detalle Arriendo');
        $this->_view->assign('arriendo', Arriendo::find(Filter::filterInt($id)));
        $this->_view->render('show');
    }

    /*
    * metodo GET para cargar el formulario de registro
    */ 
    public function add()
    {
        $this->validateSession();
        $this->getMessages();

        $this->_view->assign('title','Arriendos');
        $this->_view->assign('subject', 'Nuevo Arriendo');
        $this->_view->assign('button','Guardar');
        $this->_view->assign('back', 'arriendos/');
        $this->_view->assign('process','arriendos/store');
        $this->_view->assign('arriendo', Session::get('data'));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('add');
    }

    /*
    * metodo POST para cargar el formulario de registro
    */
    public function store()
    {
        $this->validateForm('arriendos/add',[
            'nombre' => Filter::getText('nombre'),
        ]);

        #verificamos que el rol ingresado no este registrado
        #select id from roles where nombre = {$nombre}
        $arriendo = Arriendo::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($arriendo){
            Session::set('msg_error', 'El arriendo ingresado ya existe... intente con otro');
            $this->redirect('arriendos/add');
        }

        $arriendo = new Arriendo;
        $arriendo->nombre = Filter::getText('nombre');
        $arriendo->save();

        Session::destroy('data');
        Session::set('msg_success','El arriendo se ha registrado correctamente');
        $this->redirect('arriendos');
    }

    public function edit($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Arriendo::class,$id,'arriendos');
        $this->getMessages();

        $this->_view->assign('title','Arriendos');
        $this->_view->assign('subject', 'Editar Arriendo');
        $this->_view->assign('button','Editar');
        $this->_view->assign('back', 'arriendos/');
        $this->_view->assign('process',"arriendos/update/{$id}");
        $this->_view->assign('arriendo', Arriendo::find(Filter::filterInt($id)));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    /*
    * metodo PUT para cargar el formulario de registro
    */
    public function update($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Arriendo::class,$id,'arriendos');
        $this->validatePUT();

        $this->validateForm("arriendos/edit/{$id}",[
            'nombre' => Filter::getText('nombre'),
        ]);

        #verificamos que el rol ingresado no este registrado
        #select id from roles where nombre = {$nombre}
        $arriendo = Arriendo::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($arriendo){
            Session::set('msg_error', 'El arriendo ingresado ya existe... intente con otro');
            $this->redirect('arriendos/edit/' . $id);
        }

        $arriendo = Arriendo::find(Filter::filterInt($id));
        $arriendo->nombre = Filter::getText('nombre');
        $arriendo->save();

        Session::destroy('data');
        Session::set('msg_success','El arriendo se ha modificado correctamente');
        $this->redirect('arriendos/show/' . $id);
    }
}