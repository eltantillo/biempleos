<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		/*if(!Yii::app()->user->isGuest) {
            /*$usuario = usuarios_empresas::model()->findByAttributes(array("id" => Yii::app()->user->id));
            $localidades = localidades::model()->findByAttributes(array("id_empresa" => $usuario->id_empresa));
            
            if ($localidades != null)
                $this->render('indexEmpresa');
            else
                $this->redirect(Yii::app()->request->baseUrl . '/localidades/create');
            $this->render('/empresas/index');
        } else {*/
            $this->renderPartial('index');
        //}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				if ($usuario = Yii::app()->user->tipo == 'empresa'){
					$this->redirect(array('empresas/index'));
				}
				else{
					$this->redirect(array('aspirantes/index'));
				}
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    
    /**
    *  Recover Password
    */
    public function actionRecover() {
        $model=new usuarios_empresas('recover');
        $this->render('recover',array('model'=>$model));
    }
    
    /**
    *  Post Recover Password
    */
    public function actionPostRecover() {
    	foreach ($_POST["usuarios_empresas"] as $mail) {
    		$email = $mail;
			$usuario = usuarios_empresas::model()->findByAttributes(array('usuario'=>$email));
    	}

		if ($usuario != null){
			Mailer::sendMail(
				"Restablecimiento de la cuenta",
				$email ,
				"BiEmpleos",
				"noreply@biempleos.com",
				'<html>
		        <body>
		        <h1>Estimado usuario</h1>
		        <p>Usted ha indicado que ha olvidado su contrase&ntilde;a, por favor utilice el siguiente enlace para cambiarla</p>
		        <p><a href="' . Yii::app()->request->baseUrl . "/site/recover?id=" . md5($usuario->usuario . $usuario->contrasena) . '">' . Yii::app()->request->baseUrl . "/site/recover?id=" . md5($usuario->usuario . $usuario->contrasena) . '</a></p>
		        <p>Si usted no solicit&oacute; el cambio de contrase&ntilde;a, por favor ignore este correo electr&oacute;nico</p>
		        <p>Gracias por utilizar nuestros servicios.<br>With Love: BiEmpleos &hearts;</p>
		        </body>
		        </html>');
        	$this->render('postRecover');
		}
		else{
			echo "El usuario no existe";
		}
    }
}