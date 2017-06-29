<?php

class LocalidadesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view','admin','delete','activo'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new localidades;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['localidades']))
		{
			$usuario = Yii::app()->user->usuario;
			$model->attributes=$_POST['localidades'];
            $model->id_empresa = $usuario->id_empresa;
			if($model->save())
                Yii::app()->user->setFlash('success', "Se ha agregado el local con éxito");
            else
                Yii::app()->user->setFlash('error', "Ocurrio un problema y no se guardo el local.<br>Intentalo más tarde.");
            
            $this->redirect(array('empresas/index'));//$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['localidades']))
		{
			$model->attributes=$_POST['localidades'];
			if($model->save())
                Yii::app()->user->setFlash('success', "Se ha agregado el local con éxito");
            else
                Yii::app()->user->setFlash('error', "Ocurrio un problema y no se guardo el local.<br>Intentalo más tarde.");
            
            $this->redirect(array('empresas/index'));//$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$localidad = $this->loadModel();
			$localidad->activa = false;
			$localidad->save();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$usuario = usuarios_empresas::model()->findByAttributes(array('id'=>Yii::app()->user->id));
		$dataProvider=new CActiveDataProvider('localidades', array(
		'criteria'=>array('condition'=>'id_empresa=' . $usuario->id_empresa . ' AND activa=true'),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new localidades('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['localidades']))
			$model->attributes=$_GET['localidades'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    public function actionActivo() {
        $model = $this->loadModel();
        $model->activo = !$model->activo;
        if(!$model->save())
            throw new CHttpException(500,'Ocurrio un problema al guardarlo en la base de datos.');
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=localidades::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='localidades-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
