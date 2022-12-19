<?php
use models\Suscriptor;
use models\Comuna;
use models\Nacionalidad;
use models\Telefono;

class suscriptoresController extends Controller
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

        $this->_view->assign('title', 'Suscriptores');
        $this->_view->assign('subject','Lista de Suscriptores');
        $this->_view->assign('suscriptores', Suscriptor::with(['comuna','nacionalidad'])->get());
        $this->_view->render('index');
    }

    public function add()
    {
        $this->getMessages();

        $this->_view->assign('title','Suscriptores');
        $this->_view->assign('subject', 'Nuevo suscriptor');
        $this->_view->assign('button','Guardar');
        $this->_view->assign('back', 'suscriptores/');
        $this->_view->assign('process','suscriptores/store');
        $this->_view->assign('suscriptor', Session::get('data'));
        $this->_view->assign('send', $this->encrypt($this->getForm()));
        $this->_view->assign('comunas', Comuna::select('id','nombre')->orderBy('nombre')->get());
        $this->_view->assign('nacionalidades', Nacionalidad::select('id','nombre')->orderBy('nombre')->get());

        $this->_view->render('add');
    }

    public function store()
    {
        $this->validateForm('suscriptores/add',[
            'nombre' => Filter::getText('nombre'),
            'rut' => Filter::getText('rut'),
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'direccion' => Filter::getText('direccion'),
            'comuna' => Filter::getText('comuna'),
            'nacionalidad' => Filter::getText('nacionalidad')
        ]);

        if (!$this->validateRut(Filter::getText('rut'))) {
            Session::set('msg_error', 'El RUT es inválido... inténtelo de nuevo');
            $this->redirect('suscriptores/add');
        }

        $suscriptor = Suscriptor::select('id')
            ->where('email', Filter::getPostParam('email'))
            ->where('rut', Filter::getText('rut'))
            ->first();

        if ($suscriptor) {
            Session::set('msg_error', 'El suscriptor ingresado ya existe... intente con otro');
            $this->redirect('suscriptores/add');
        }

        $suscriptor = new Suscriptor;
        $suscriptor->nombre = Filter::getText('nombre');
        $suscriptor->rut = Filter::getText('rut');
        $suscriptor->direccion = Filter::getText('direccion');
        $suscriptor->email = Filter::getPostParam('email');
        $suscriptor->activo = 1;
        $suscriptor->comuna_id = Filter::getInt('comuna');
        $suscriptor->nacionalidad_id = Filter::getInt('nacionalidad');
        $suscriptor->save();

        Session::destroy('data');
        Session::set('msg_success','El suscriptor se ha registrado correctamente');
        $this->redirect('suscriptores');
    }

    public function show($id = null)
    {
        Validate::validateModel(Suscriptor::class,$id,'suscriptores');
        $this->getMessages();

        $this->_view->assign('title', 'Suscriptores');
        $this->_view->assign('subject','Detalle Suscriptor');
        $this->_view->assign('suscriptor', Suscriptor::find(Filter::filterInt($id)));
        $this->_view->assign('telefonos', Telefono::select('id','numero')->where('telefonoable_id', Filter::filterInt($id))->where('telefonoable_type','Suscriptor')->get());
        $this->_view->render('show');
    }

    public function edit($id = null)
    {
        Validate::validateModel(Suscriptor::class,$id,'suscriptores');
        $this->getMessages();

        $this->_view->assign('title','Suscriptores');
        $this->_view->assign('subject', 'Editar suscriptor');
        $this->_view->assign('button','Editar');
        $this->_view->assign('back', 'suscriptores/');
        $this->_view->assign('process','suscriptores/update/' . $id);
        $this->_view->assign('suscriptor', Suscriptor::with(['comuna','nacionalidad'])->find(Filter::filterInt($id)));
        $this->_view->assign('send', $this->encrypt($this->getForm()));
        $this->_view->assign('comunas', Comuna::select('id','nombre')->orderBy('nombre')->get());
        $this->_view->assign('nacionalidades', Nacionalidad::select('id','nombre')->orderBy('nombre')->get());

        $this->_view->render('edit');
    }

    public function update($id = null)
    {
        Validate::validateModel(Suscriptor::class,$id,'suscriptores');
        $this->validatePUT();

        $this->validateForm('suscriptores/add',[
            'nombre' => Filter::getText('nombre'),
            'rut' => Filter::getText('rut'),
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'direccion' => Filter::getText('direccion'),
            'comuna' => Filter::getText('comuna'),
            'nacionalidad' => Filter::getText('nacionalidad'),
            'activo' => Filter::getText('activo')
        ]);

        if (!$this->validateRut(Filter::getText('rut'))) {
            Session::set('msg_error', 'El RUT es inválido... inténtelo de nuevo');
            $this->redirect('suscriptores/add');
        }

        $suscriptor = Suscriptor::find(Filter::filterInt($id));
        $suscriptor->nombre = Filter::getText('nombre');
        $suscriptor->rut = Filter::getText('rut');
        $suscriptor->direccion = Filter::getText('direccion');
        $suscriptor->email = Filter::getPostParam('email');
        $suscriptor->activo = Filter::getInt('activo');
        $suscriptor->comuna_id = Filter::getInt('comuna');
        $suscriptor->nacionalidad_id = Filter::getInt('nacionalidad');
        $suscriptor->save();

        Session::destroy('data');
        Session::set('msg_success','El suscriptor se ha modificado correctamente');
        $this->redirect('suscriptores/show/' . $id);
    }
}
