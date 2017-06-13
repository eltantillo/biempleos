<?php
Yii::import('ext.MYPDF');
Yii::import('ext.ireport.*');
class AspirantesController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('registro'),
				'users'=>array('?'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','update','pdf', 'solicitud'),
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
	public function actionRegistro()
	{
		$model = new usuarios_aspirantes;
		$data  = new aspirantes;
		$model->id_aspirante = 0;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['usuarios_aspirantes']))
		{
			$model->attributes=$_POST['usuarios_aspirantes'];
			if ($model->validate() && $data->save()){
				$model->id_aspirante = $data->id;
				$model->contrasena = md5($model->contrasena);
				$model->repeatPassword = md5($model->repeatPassword);
				if($model->save()){
					$this->redirect(array('index'));
					//Yii::app()->user->login(UserIdentity::createAuthenticatedIdentityAspirante($model->correo),0);
				}
			}
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

		if(isset($_POST['Aspirantes']))
		{
			$model->attributes=$_POST['Aspirantes'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
			$this->loadModel()->delete();

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
		$dataProvider=new CActiveDataProvider('usuarios_aspirantes');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new usuarios_aspirantes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Aspirantes']))
			$model->attributes=$_GET['Aspirantes'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    
    public function actionPdf(){
        $pdf = new PDFAspirante();
        if(!isset($_GET['id']))
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        
        
        $pdf->downloadPDF($_GET['id']);
        
        
        
        /*define('CELL_SIZE', 170);
        
        $model = $this->loadModel();
 
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        spl_autoload_register(array('YiiBase','autoload'));
 
        // set document information
        $pdf->SetCreator(PDF_CREATOR);  
 
        $pdf->SetTitle("Aspirante - " . $model->nombre);
        $pdf->SetMargins(20, 15, 20);
        $pdf->SetHeaderMargin(1);
        $pdf->SetFooterMargin(3);
        $pdf->SetAutoPageBreak(TRUE, 8);
        $pdf->SetFont('times', 'B', 18);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->AddPage();
        
        $pdf->SetFillColor(192, 192, 192);
        $html = '<p style="font-size: 10px; font-weight: normal; line-height: 12px;">
        Puesto: <br>
        Fecha: <br>
        Sueldo aprobado: <br>
        Fecha de contratación: 
        </p>';
        $pdf->writeHTMLCell(75, 0, 40, 18, $html, 1, 1, true);
        $pdf->Image(K_PATH_IMAGES . '/icon(1).png', 163, 10, 30, 30, 'PNG');
        $pdf->Cell(0, 5, '', 0, 1, '', false, '', 1, true);
        
        $BORDER_TITLE = array(
            'L' => array('width' => 1, 'color'=>array(0,0,0), 'dash'=>0, 'cap'=>'butt'),
        );
        $pdf->SetCellPaddings(3, 0, 0, 0);
        $pdf->Cell(10);
        $pdf->Cell(0, 0, 'Datos Personales', 'L', 1);
        
        $nombre = explode(" ", $model->nombre);
        //$pdf->SetCellPaddings(6, 1, 0, 1);
        $pdf->SetFont('times', '', 8);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Apellido Paterno', 'LT', 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Apellido Materno', 'T', 0);
        $pdf->Cell(5 * CELL_SIZE / 16, 0, 'Nombre(s)', 'T', 0);
        $pdf->Cell(3 * CELL_SIZE / 16, 0, 'Edad', 'T', 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $nombre[count($nombre) - 2], 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $nombre[count($nombre) - 1], 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((5 * CELL_SIZE / 16) - 3, 0, $nombre[0] . (count($nombre) > 3 ? (' ' . $nombre[1]):''), 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((3 * CELL_SIZE / 16) - 3, 0, 'EDAD años', 0, 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell(3 * CELL_SIZE / 8, 0, 'Domicilio', 'L', 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Colonia', 0, 0);
        $pdf->Cell(CELL_SIZE / 8, 0, 'Código Postal', 0, 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Sexo', 0, 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell((3 * CELL_SIZE / 8) - 3, 0, $model->calle . ' #' . $model->numero, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->colonia, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 8) - 3, 0, $model->codigo_postal, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, ($model->sexo ? 'Masculino':'Femenino'), 0, 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell(CELL_SIZE / 2, 0, 'Lugar de nacimiento', 'L', 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Fecha de nacimiento', 0, 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Nacionalidad', 0, 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell((CELL_SIZE / 2) - 3, 0, 'Lugar Nacimiento*', 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, date_format(new datetime($model->fecha_nacimiento), 'd/m/Y'), 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->nacionalidad, 0, 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell(CELL_SIZE / 2, 0, 'Estado Civil', 'L', 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Estatura', 0, 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Peso', 0, 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell((CELL_SIZE / 2) - 3, 0, $model->estado_civil, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->estatura . 'm', 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->peso . 'kg', 0, 1);
        
        $pdf->Cell(0, 5, '', 0, 1, '', false, '', 1, true);
        
        
        
        $pdf->SetFont('times', 'B', 18);
        $pdf->SetCellPaddings(3, 0, 0, 0);
        $pdf->Cell(10);
        $pdf->SetFontSize(18);
        $pdf->Cell(0, 0, 'Documentación', 'L', 1);
        
        //$pdf->SetCellPaddings(6, 1, 0, 1);
        $pdf->SetFont('times', '', 8);
        $pdf->Cell(CELL_SIZE / 2, 0, 'Clave Única del Registro de Población', 'LT', 0);
        $pdf->Cell(CELL_SIZE / 2, 0, 'AFORE', 'T', 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell((CELL_SIZE / 2) - 3, 0, $model->curp, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 2) - 3, 0, $model->afore, 0, 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Reg. Federal de Contribuyentes', 'L', 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Número de Seguro Social', 0, 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Cartilla Servicio Militar Nº', 0, 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Pasaporte Nº', 0, 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->rfc, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->nss, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->cartilla_militar, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->pasaporte, 0, 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Licencia', 'L', 0);
        $pdf->Cell(0, 0, 'Clase y Número de Licencia', 0, 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, ($model->licencia ? 'Activa':'Inactiva'), 0, 0);
        $pdf->Cell(3);
        $pdf->Cell(0, 0, $model->clase_licencia . ' ' . $model->numero_licencia, 0, 1);
        
        $pdf->Cell(0, 5, '', 0, 1, '', false, '', 1, true);
        
        
        
        $pdf->SetFont('times', 'B', 18);
        $pdf->SetCellPaddings(3, 0, 0, 0);
        $pdf->Cell(10);
        $pdf->SetFontSize(18);
        $pdf->Cell(0, 0, 'Estado de Salud y Hábitos Personales', 'L', 1);
        
        //$pdf->SetCellPaddings(6, 1, 0, 1);
        $pdf->SetFont('times', '', 8);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Estado de Salud Actual', 'LT', 0);
        $pdf->Cell(3 * CELL_SIZE / 4, 0, 'Enfermedad Crónica', 'T', 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, 'Estado de Salud Actual', 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((3 * CELL_SIZE / 4) - 3, 0, 'Enfermedad Crónica', 0, 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Reg. Federal de Contribuyentes', 'L', 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Número de Seguro Social', 0, 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Cartilla Servicio Militar Nº', 0, 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Pasaporte Nº', 0, 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->rfc, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->nss, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->cartilla_militar, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->pasaporte, 0, 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Deporte Practicado', 'L', 0);
        $pdf->Cell(CELL_SIZE / 4, 0, 'Club Social o Deportivo', 0, 0);
        $pdf->Cell(CELL_SIZE / 2, 0, 'Pasatiempo Favorito', 0, 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->deporte, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 4) - 3, 0, $model->club, 0, 0);
        $pdf->Cell(3);
        $pdf->Cell((CELL_SIZE / 2) - 3, 0, $model->pasatiempo, 0, 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell(0, 0, 'Meta en la vida', 'L', 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(0, 0, $model->meta, 0, 1);
        
        $pdf->Cell(0, 5, '', 0, 1, '', false, '', 1, true);
        
        
        
        $pdf->SetFont('times', 'B', 18);
        $pdf->SetCellPaddings(3, 0, 0, 0);
        $pdf->SetFontSize(18);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Escolaridad', 1, 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Conocimientos Generales', 1, 1);
        
        //$pdf->SetCellPaddings(6, 1, 0, 1);
        $pdf->SetFont('times', '', 8);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Último grado de estudio', 'LR', 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Idioma(s)', 'LR', 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(((CELL_SIZE - 20) / 2) - 3, 0, $model->estudio, 'R', 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(((CELL_SIZE - 20) / 2) - 3, 0, $model->idioma . ' ' . $model->porcentaje . '%', 'R', 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Escuela', 'LR', 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Funciones de Oficina', 'LR', 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(((CELL_SIZE - 20) / 2) - 3, 0, $model->escuela, 'R', 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(((CELL_SIZE - 20) / 2) - 3, 0, $model->funciones_oficina, 'R', 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Inicio - Finalización', 'LR', 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Maquinaria de Oficina', 'LR', 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(((CELL_SIZE - 20) / 2) - 3, 0, date_format(new datetime($model->inicio), 'd/m/Y') . ' - ' . date_format(new datetime($model->finalizacion), 'd/m/Y'), 'R', 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(((CELL_SIZE - 20) / 2) - 3, 0, $model->maquinaria_oficina, 'R', 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Título Recibido', 'LR', 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Software', 'LR', 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(((CELL_SIZE - 20) / 2) - 3, 0, $model->titulo, 'R', 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(((CELL_SIZE - 20) / 2) - 3, 0, $model->software, 'R', 1);
        
        $pdf->SetFontSize(8);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Estudiante*', 'LR', 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell((CELL_SIZE - 20) / 2, 0, 'Otras funciones', 'LR', 1);
        $pdf->SetFontSize(12);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(((CELL_SIZE - 20) / 2) - 3, 0, 'Estudia s/n con datos si s', 'R', 0);
        $pdf->Cell(20, 0, '', 0, 0);
        $pdf->Cell(3, 0, '', 'L');
        $pdf->Cell(((CELL_SIZE - 20) / 2) - 3, 0, $model->otras_funciones, 'R', 1);*/
        
        
        /*$pdf->Cell(0, 10, 'Datos Personales:', 1, 1, '', true);
        
        $nombre = explode(" ", $model->nombre);
        $html = '<p style="font-size: 12px; font-weight: normal; line-height: 20px;">
        Apellido Paterno: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $nombre[count($nombre) - 2]. '</span> 
        Apellido Materno: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $nombre[count($nombre) - 1]. '</span> 
        Nombre(s): <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $nombre[0] . (count($nombre) > 3 ? (' ' . $nombre[1]):'') . '</span><br>
        Sexo: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . ($model->sexo ? 'Hombre':'Mujer') . '</span>
        Nacionalidad: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->nacionalidad . '</span>
        Estatura: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->estatura . '</span>
        Peso: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->peso . '</span>
        <br>
        Estado Civil: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->estado_civil . '</span>
        Calle: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->calle . '</span>
        Numero: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->numero . '</span>
        Colonia: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->colonia . '</span>
        C.P. <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->codigo_postal . '</span>
        <br>
        Ciudad: <span style="background-color:rgb(235,235,235); line-height: 15px;">Cd. Juárez</span>
        Estado: <span style="background-color:rgb(235,235,235); line-height: 15px;">Chihuahua</span>
        CURP: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->curp . '</span>
        RFC: <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->rfc . '</span>
        </p>';
        $pdf->writeHTMLCell(0, 0, 7, 46.5, $html, 1, 1, false, false, '', false);
        
        $pdf->Cell(0, 2, '', 0, 1, '', false, '', 1, true);
        $pdf->Cell(0, 10, 'Documentación', 1, 1, '', true);
        
        $html = '<p style="font-size: 12px; font-weight: normal; line-height: 20px;">
        No. Seguro Social <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->nss . '</span>
        Afore <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->afore . '</span>
        No. Servicio Militar <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->cartilla_militar . '</span>
        No. Pasaporte <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->pasaporte . '</span>
        <br>
        ¿Tiene licencia de manejo? <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->licencia . '</span>
        Clase de licencia <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->clase_licencia . '</span>
        No. Licencia <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->numero_licencia . '</span>
        </p>';
        $pdf->writeHTMLCell(0, 0, 7, 87.5, $html, 1, 1, false, false, '', false);
        
        $pdf->Cell(0, 2, '', 0, 1, '', false, '', 1, true);
        $pdf->Cell(0, 10, 'Habitos Personales', 1, 1, '', true);
        
        $html = '<p style="font-size: 12px; font-weight: normal; line-height: 20px;">
        ¿Practica algún deporte? <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->deportista . '</span>
        ¿Cuál deporte? <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->deporte . '</span>
        ¿Pertenece a algún club social o deportivo? <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->club . '</span>
        <br>
        ¿Cuál es su pasatiempo favorito? <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->pasatiempo . '</span>
        ¿Cuál es su meta de la vida? <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->meta . '</span>
        </p>';
        $pdf->writeHTMLCell(0, 0, 7, 114.5, $html, 1, 1, false, false, '', false);
        
        $pdf->Cell(0, 2, '', 0, 1, '', false, '', 1, true);
        $pdf->Cell(0, 10, 'Escolaridad', 1, 1, '', true);
        
        $html = '<p style="font-size: 12px; font-weight: normal; line-height: 20px;">
        Último grado de estudio <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->estudio . '</span>
        Nombre de escuela <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->escuela . '</span>
        Inicio <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->inicio . '</span>
        Finalizacion <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->finalizacion . '</span>
        Titulo <span style="background-color:rgb(235,235,235); line-height: 15px;">' . $model->titulo . '</span>
        </p>';
        $pdf->writeHTMLCell(0, 0, 7, 141.5, $html, 1, 1, false, false, '', false);
        
        $pdf->Cell(0, 2, '', 0, 1, '', false, '', 1, true);
        $pdf->Cell(0, 10, 'Conocimientos Generales', 1, 1, '', true);*/
        
        // reset pointer to the last page
        $pdf->lastPage();
 
        //Close and output PDF document
        $pdf->Output($model->curp . '.pdf', 'D');
        Yii::app()->end();
 
    }
    
    public function actionSolicitud(){
		$model = Yii::app()->user->aspirante;

		if(isset($_POST['aspirantes']))
		{
			$model->attributes = $_POST['aspirantes'];

            $model->nombre             = ucwords($model->nombre);
            $model->nacionalidad       = ucwords($model->nacionalidad);
            $model->calle              = ucwords($model->calle);
            $model->colonia            = ucwords($model->colonia);
            $model->curp               = strtoupper($model->curp);
            $model->rfc                = strtoupper($model->rfc);
            $model->nss                = strtoupper($model->nss);
            $model->afore              = strtoupper($model->afore);
            $model->cartilla_militar   = strtoupper($model->cartilla_militar);
            $model->pasaporte          = strtoupper($model->pasaporte);
            $model->clase_licencia     = ucwords($model->clase_licencia);
            $model->numero_licencia    = strtoupper($model->numero_licencia);
            $model->deporte            = ucwords($model->deporte);
            $model->pasatiempo         = ucwords($model->pasatiempo);
            $model->meta               = ucwords($model->meta);
            $model->escuela            = ucwords($model->escuela);
            $model->idioma             = ucwords($model->idioma);
            $model->funciones_oficina  = ucfirst($model->funciones_oficina);
            $model->maquinaria_oficina = ucfirst($model->maquinaria_oficina);
            $model->software           = ucfirst($model->software);
            $model->otras_funciones    = ucfirst($model->otras_funciones);
            $model->compania           = ucfirst($model->otras_funciones);
            $model->direccion          = ucwords($model->otras_funciones);
            $model->puesto             = ucwords($model->puesto);
            $model->motivo_separacion  = ucwords($model->motivo_separacion);
            $model->nombre_jefe        = ucwords($model->nombre_jefe);
            $model->puesto_jefe        = ucwords($model->puesto_jefe);
            $model->nombre_ref1        = ucwords($model->nombre_ref1);
            $model->domicilio_ref1     = ucwords($model->domicilio_ref1);
            $model->ocupacion_ref1     = ucwords($model->ocupacion_ref1);
            $model->tiempo_ref1        = ucwords($model->tiempo_ref1);
            $model->nombre_ref2        = ucwords($model->nombre_ref1);
            $model->domicilio_ref2     = ucwords($model->domicilio_ref1);
            $model->ocupacion_ref2     = ucwords($model->ocupacion_ref1);
            $model->tiempo_ref2        = ucwords($model->tiempo_ref1);
            $model->nombre_ref3        = ucwords($model->nombre_ref1);
            $model->domicilio_ref3     = ucwords($model->domicilio_ref1);
            $model->ocupacion_ref3     = ucwords($model->ocupacion_ref1);
            $model->tiempo_ref3        = ucwords($model->tiempo_ref1);

			Functions::emptyToNull($model);
			if($model->save())
				$this->redirect(array('index'));
		}

		$model = Yii::app()->user->aspirante;
		$this->render('solicitud',array(
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
				$this->_model = aspirantes::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuarios-aspirantes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
