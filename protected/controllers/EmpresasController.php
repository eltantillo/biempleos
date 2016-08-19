<?php

class EmpresasController extends Controller
{
	public $layout='//layouts/column2';
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
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('actualizar','index'),
				'users'=>array('@'),
			),
		);
	}

	public function actionRegistro()
	{
		if(!Yii::app()->user->isGuest){
			$usuario = usuarios_empresas::model()->findByAttributes(array('id'=>Yii::app()->user->id));
			$this->redirect(array('actualizar','id'=>$usuario->id_empresa));
		}
		$empresa = new empresas;
		$usuario = new usuarios_empresas('registrar');
        
		if(isset($_POST['empresas'], $_POST['usuarios_empresas']))
		{
			$empresa->attributes = $_POST['empresas'];
			$usuario->attributes = $_POST['usuarios_empresas'];

			$valid = $empresa->validate();
			$valid = $usuario->validate() && $valid;

			if ($valid){
                
                Yii::app()->user->setFlash('success','Registro Exitoso');
                
				$empresa->save(false);
				$usuario->id_empresa = $empresa->id;
				$usuario->contrasena = md5($usuario->contrasena);
				$usuario->save(false);
				//$this->redirect(array('/'));
                $empresa = new empresas;
                $usuario = new usuarios_empresas('registrar');
			}
		}

		$this->render('registro',array(
			'empresa'=>$empresa,
			'usuario'=>$usuario
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
                if($usuario->save())
				    $this->redirect(array('actualizar','msg'=>'successfully changed password'));
                else
                    $this->redirect(array('actualizar','msg'=>'password not changed'));
            }
		}

		$this->render('actualizar',array(
			'empresa'=>$empresa,
			'usuario'=>$usuario,
		));
	}
    
    public function actionIndex()
    {
        $usuario = usuarios_empresas::model()->findByAttributes(array('id'=>Yii::app()->user->id));
		$empresa = $this->loadModel($usuario->id_empresa);
        $dataProvider=new CActiveDataProvider('localidades', array(
            'criteria'=>array('condition'=>'id_empresa=' . $usuario->id_empresa),
		));
        
        $this->render('index',array(
			'empresa'=>$empresa,
			'usuario'=>$usuario,
            'dataProvider'=>$dataProvider,
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
