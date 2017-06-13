<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="es">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css">
    
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <img class="img-logo-index" src="<?php echo Yii::app()->request->baseUrl . "/images/logo.png"; ?>">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="menu">
                <div class="nav navbar-right">
                    <?php 
                    $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login-form',
                        'action'=>Yii::app()->createUrl('site/login'),
                        'htmlOptions'=>array(
                            'class'=>'navbar-form navbar-left',
                        ),
                    ));
                    $login = new LoginForm;
                    ?>

                    <div class="form-group">
                        <?php echo $form->emailField($login,'username', array('placeholder'=>'Correo', 'class'=>'form-control')); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->passwordField($login,'password', array('placeholder'=>'Contraseña', 'class'=>'form-control')); ?>
                    </div>

                    <div class="form-group">
                        <?php echo CHtml::submitButton('Iniciar Sesión', array('class'=>'btn btn-success')); ?>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="section1 row text-center">
            <h1 class="col-xs-12">Tú eliges a quien contratar <img src="<?php echo Yii::app()->request->baseUrl . "/images/icon(1).png"; ?>"></h1>
            <h1 class="col-xs-12">Tú eliges donde trabajar <img src="<?php echo Yii::app()->request->baseUrl . "/images/engineer(1).png"; ?>"></h1>
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <?php echo CHtml::link('BUSCAR EMPLEO', array('aspirantes/registro'), array('class'=>'btn btn-lg btn-success col-sm-5')); ?>
                <?php echo CHtml::link('CONTRATAR', array('empresas/registro'), array('class'=>'btn btn-lg btn-danger col-sm-offset-2 col-sm-5')); ?>
            </div>
        </div>
        <div class="section2 row">
            <div class="col-sm-offset-5 col-sm-7 col-xs-12">
                <h1>Es fácil.</h1>
                <p>En BIE tenemos las mejores ofertas, visualiza de forma sencilla pero detallada cada ofert, seguro tenemos algo para ti</p>
                
                <h1>Encuentra Empleo</h1>
                <p>Evita las contingencias de la ciudad y todo el agotamiento de buscar trabajo, selecciona las ofertas que mas te gusten y envia tu solicitud</p>
                
                <h1>Adiós papel.</h1>
                <p>En BIE podras visualizar las solicitudes de empleo y elegir el empleo que se adecue a sus necesidades ademas de guardar solicitudes en formato digital para una mejor administración</p>
            </div>
        </div>
        <div class="section3 row text-center">
            <h2 class="col-xs-12">Disfruta de BIE en tus dispositivos.</h2>
            <img src="<?php echo Yii::app()->request->baseUrl . "/images/google-play-badge.png"; ?>">
        </div>
        <footer class="row text-center">
            <div class="col-sm-2">
                <img src="<?php echo Yii::app()->request->baseUrl . "/images/logo.png"; ?>">
            </div>
            <div class="col-sm-8">
                <div class="col-sm-4">
                    <a class="btn btn-link">Sobre nosotros</a>
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-link">Información a empresa</a>
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-link">Ayuda</a>
                </div>
                <div class="col-sm-4 col-sm-offset-2">
                    Enlaces
                    <hr>
                    <?php echo CHtml::link('Términos y Condiciones', array('site/page/view/terminos'))?><br>
                    <?php echo CHtml::link('Política de Privacidad', array('site/page/view/politicas'))?>
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-link">Contacto</a>
                </div>
            </div>
            <div class="col-sm-2">
                <p class="col-xs-12">Siguenos en</p>
                <a href="https://twitter.com/biempleos"><img src="<?php echo Yii::app()->request->baseUrl . "/images/twitter-logo-button.png"; ?>"></a>
                <a href="https://www.facebook.com/biempleos/?__mref=message_bubble"><img src="<?php echo Yii::app()->request->baseUrl . "/images/facebook-logo-button.png"; ?>"></a>
            </div>
            <p class="col-xs-12">&#169; BIE 2017<br><sub>Powered by BOSON SOFTWARE DEVELOPMENT</sub></p>
        </footer>
    </div>
</body>
</html>
