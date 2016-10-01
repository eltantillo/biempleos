<?php

class EmpresasController extends Controller
{
	private $_model;

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('registro'),
				'users'=>array('?'),
			),
			array('allow',
				'actions'=>array('actualizar','index','suscripcion'),
				'users'=>array('@'),
			),
            array('deny',
                'actions'=>array('registro'),
				'users'=>array('@'),
                'deniedCallback'=>function(){ 
                    Yii::app()->controller->redirect(array('empresas/index'));
                }
			),
		);
	}

	public function actionRegistro()
	{
		$empresa = new empresas;
		$usuario = new usuarios_empresas('registrar');
        
		if(isset($_POST['empresas'], $_POST['usuarios_empresas']))
		{
			$empresa->attributes = $_POST['empresas'];
			$usuario->attributes = $_POST['usuarios_empresas'];

			$valid = $empresa->validate();
			$valid = $usuario->validate() && $valid;

			if ($valid){
                $exito = true;
				$exito = $exito && $empresa->save();
				$usuario->id_empresa = $empresa->id;
				$usuario->contrasena = md5($usuario->contrasena);
                $usuario->repeatPassword = md5($usuario->repeatPassword);
				$exito = $exito && $usuario->save();
				if($exito) {
                    //autologin http://www.yiiframework.com/forum/index.php/topic/9525-auto-login-after-registration-fake-login/
                    Yii::app()->user->login(UserIdentity::createAuthenticatedIdentity($usuario->usuario),60*20);
                    $this->redirect(array('empresas/suscripcion'));
                }
			}
		}

		$this->render('registro',array(
			'empresa'=>$empresa,
			'usuario'=>$usuario
		));
	}
    
    public function actionSuscripcion() {
        $this->render('suscripcion',array(
		));
    }

	public function actionActualizar()
	{
		$usuario = usuarios_empresas::model()->findByAttributes(array('id'=>Yii::app()->user->id));
        	$usuario->setScenario('actualizar');
		$empresa = $this->loadModel($usuario->id_empresa);
        
		if(isset($_POST['usuarios_empresas']))
		{
			$usuario->attributes=$_POST['usuarios_empresas'];
            if($usuario->validate()){
                $usuario->contrasena = md5($usuario->newPassword);
                if($usuario->save()) {
                    Yii::app()->user->setFlash('success', "Se ha cambiado la contraseña");
                    $this->redirect(array('actualizar','msg'=>'successfully changed password'));
                } else {
                    Yii::app()->user->setFlash('error', "Ocurrio un error al cambiar la contraseña");
                    $this->redirect(array('actualizar','msg'=>'password not changed'));
                }
            }
		}

		$this->render('actualizar',array(
			'empresa'=>$empresa,
			'usuario'=>$usuario,
		));
	}
    
    public function actionIndex()
    {
        /*$usuario = usuarios_empresas::model()->findByAttributes(array('id'=>Yii::app()->user->id));
		$empresa = $this->loadModel($usuario->id_empresa);
        $dataProvider=new CActiveDataProvider('localidades', array(
            'criteria'=>array('condition'=>'id_empresa=' . $usuario->id_empresa),
		));*/
        
        $this->render('index',array(
			/*'empresa'=>$empresa,
			'usuario'=>$usuario,
            'dataProvider'=>$dataProvider,*/
		));
    }

	public function loadModel($id_empresa)
	{
		if($this->_model===null)
		{
			$this->_model=empresas::model()->findbyPk($id_empresa);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
