<?php
use models\Telefono;
use models\User;
use models\Suscriptor;

class telefonosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Telefono::class,$id,'telefonos');
        $this->getMessages();

        $telefono = Telefono::find(Filter::filterInt($id));

        if ($telefono->telefonoable_type == 'User') {
            $route = 'users/show/' . $telefono->telefonoable_id;
            $propietario = User::select('id','nombre')->find($telefono->telefonoable_id);
        }else {
            $route = 'suscriptores/show/' . $telefono->telefonoable_id;
            $propietario = Suscriptor::select('id','nombre')->find($telefono->telefonoable_id);
        }

        $this->_view->assign('title', 'Teléfonos');
        $this->_view->assign('subject','Detalle Teléfono');
        $this->_view->assign('telefono', $telefono);
        $this->_view->assign('propietario', $propietario);
        $this->_view->assign('back', $route);
        $this->_view->assign('send', $this->encrypt($this->getForm()));
        $this->_view->render('show');
    }

    public function add($model_id = null, $model_type = null)
    {
        //print_r($model_id);exit;
        $this->validateSession();
        $this->getMessages();

        if ($model_type == 'user') {
            $route = 'users/show/' . $model_id;
            Validate::validateModel(User::class, $model_id, 'users');
        }elseif ($model_type == 'suscriptor') {
            $route = 'suscriptores/show/' . $model_id;
            Validate::validateModel(Suscriptor::class, $model_id, 'suscriptores');
        }else{
            $this->redirect('home');
        }

        $this->_view->assign('title','Telefonos');
        $this->_view->assign('subject', 'Nuevo Teléfono');
        $this->_view->assign('button','Guardar');
        $this->_view->assign('back', $route);
        $this->_view->assign('process', "telefonos/store/{$model_id}/{$model_type}");
        $this->_view->assign('telefono', Session::get('data'));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('add');

    }

    public function store($model_id, $model_type)
    {
        if ($model_type == 'user') {
            $route = 'users/show/' . $model_id;
        }elseif ($model_type == 'suscriptor') {
            $route = 'suscriptores/show/' . $model_id;
        }

        $this->validateForm("telefonos/add/{$model_id}/{$model_type}",[
            'numero' => Filter::getText('numero'),
            'movil' => Filter::getText('movil')
        ]);

        if (strlen(Filter::getInt('numero')) < 9 || strlen(Filter::getInt('numero')) > 9) {
            Session::set('msg_error', 'El teléfono debe tener 9 dígitos');
            $this->redirect("telefonos/add/{$model_id}/{$model_type}");
        }

        $phone = Telefono::select('id')
            ->where('numero', Filter::getInt('numero'))
            ->first();

        if($phone){
            Session::set('msg_error', 'El teléfono ingresado ya existe... intente con otro');
            $this->redirect("telefonos/add/{$model_id}/{$model_type}");
        }

        $telefono = new Telefono;
        $telefono->numero = Filter::getInt('numero');
        $telefono->movil = Filter::getInt('movil');
        $telefono->telefonoable_id = Filter::filterInt($model_id);
        $telefono->telefonoable_type = ucfirst($model_type);
        $telefono->save();

        Session::destroy('data');
        Session::set('msg_success','El teléfono se ha registrado correctamente');
        $this->redirect($route);
    }

    public function edit($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Telefono::class,$id,'telefonos');
        $this->getMessages();

        $this->_view->assign('title','Telefonos');
        $this->_view->assign('subject', 'Editar Teléfono');
        $this->_view->assign('button','Editar');
        $this->_view->assign('back', "telefonos/show/{$id}");
        $this->_view->assign('process',"telefonos/update/{$id}");
        $this->_view->assign('telefono', Telefono::find(Filter::filterInt($id)));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    public function update($id = null)
    {
        $this->validateSession();
        Validate::validateModel(Telefono::class,$id,'users');
        $this->validatePUT();

        $this->validateForm("telefonos/edit/{$id}",[
            'numero' => Filter::getText('numero'),
            'movil' => Filter::getText('movil')
        ]);

        if (strlen(Filter::getText('numero')) < 9) {
            Session::set('msg_error', 'El teléfono debe tener al menos 9 dígitos' );
            $this->redirect("telefonos/edit/{id}");
        }

        $phone = Telefono::select('id')
            ->where('numero', Filter::getInt('numero'))
            ->where('movil', Filter::getInt('movil'))
            ->first();

        if($phone){
            Session::set('msg_error', 'El teléfono ingresado ya existe... modifique alguno de los datos para continuar');
            $this->redirect("telefonos/edit/{$id}");
        }

        $telefono = Telefono::find(Filter::filterInt($id));
        $telefono->numero = Filter::getInt('numero');
        $telefono->movil = Filter::getInt('movil');
        $telefono->save();

        Session::destroy('data');
        Session::set('msg_success','El teléfono se ha modificado correctamente');
        $this->redirect('telefonos/show/' . $id);
    }

    public function destroy($id = null)
    {
        if ($this->decrypt(Filter::getAlphaNum('send')) != $this->getForm()) {
            $this->redirect('error/denied');
        }
        $this->validateDelete();

        Validate::validateModel(Telefono::class, $id, 'users');

        $telefono = Telefono::find(Filter::filterInt($id));

        if ($telefono->telefonoable_type == 'User') {
            $route = 'users/show/' . $telefono->telefonoable_id;
        }else{
            $route = 'suscriptores/show/' . $telefono->telefonoable_id;
        }

        $telefono->delete(); //delete from telefonos where id = ?

        Session::set('msg_success','El teléfono se ha eliminado correctamente');

        $this->redirect($route);
    }
}