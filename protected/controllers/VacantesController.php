<?php

class VacantesController extends Controller
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
				'actions'=>array('index','view','admin','delete'),
				'users'=>array('@'),
			),
            array('allow',
                'actions'=>array('create','update'),
				'expression'=>"localidades::model()->findByAttributes(array('id_empresa'=>Yii::app()->user->empresa->id, 'activa'=>true)) != null",
                'users'=>array('@'),
			),
            array('deny',
                'actions'=>array('create','update'),
                'users'=>array('@'),
                'deniedCallback'=>function(){
                    Yii::app()->user->setFlash('modal', "Para crear vacantes debes añadir al menos una localidad");
                    Yii::app()->controller->redirect(array('localidades/create'));
                }
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
		$localidades = localidades::model()->findAllByAttributes(array('id_empresa'=>Yii::app()->user->empresa->id));
		$model       = new vacantes;

		$model->id_empresa = Yii::app()->user->empresa->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['vacantes']))
		{
			$model->attributes=$_POST['vacantes'];
			if($model->save())
                Yii::app()->user->setFlash('success', "La vacante se ha sido creada");
            else
                Yii::app()->user->setFlash('error', "Ocurrio un problema y no se pudo guardar la vacante.<br>Intentalo más tarde.");
				
            $this->redirect(array('empresas/index'));
		}

		$this->render('create',array(
			'model'=>$model,
			'localidades'=>$localidades,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$usuario     = usuarios_empresas::model()->findByAttributes(array('id'=>Yii::app()->user->id));
		$localidades = localidades::model()->findAllByAttributes(array('id_empresa'=>$usuario->id_empresa));

		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['vacantes']))
		{
			$model->attributes=$_POST['vacantes'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'localidades'=>$localidades,
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
			$vacante = $this->loadModel();
			$vacante->activa = false;
			$vacante->save();

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
		$dataProvider=new CActiveDataProvider('vacantes', array(
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
		$model=new vacantes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['vacantes']))
			$model->attributes=$_GET['vacantes'];

		$this->render('admin',array(
			'model'=>$model,
		));
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
				$this->_model=vacantes::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='vacantes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
