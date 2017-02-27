<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.loadmask.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <link rel="icon" type="image/png" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script-->
    <?php
    Yii::app()->clientScript->registerScriptFile("http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js");
    ?>
    
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="col-xs-2 col-sm-offset-1 col-md-offset-2">
            <?php 
            $img = "<img src=\"" . Yii::app()->request->baseUrl . "/images/logo.png\" class='img-logo'>";
            echo CHtml::link($img,array('/site/index')); 
            ?>
        </div>
        <div class="col-xs-10 col-sm-8 col-md-6 top-menu">
            <ul class="pull-right ghost-center">
                <li><?php echo CHtml::link('Sobre nosotros',array('/site/page/view/about')); ?></li> 
            </ul>
        </div>
    </div>
</nav>


<div class="container-fluid">
    <?php if(Yii::app()->user->hasFlash('success')): ?>
    <div id="successMsg" class="alert alert-success col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
        <a href="#" class="close" aria-label="close">&times;</a>
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <script>
    $(document).ready(function() {
        $("#successMsg .close").click(function() {
            $("#successMsg").fadeOut("slow");
        });
    });
    </script>
    <?php elseif(Yii::app()->user->hasFlash('error')): ?>
    <div id="errorMsg" class="alert alert-danger col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
        <a href="#" class="close" aria-label="close">&times;</a>
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
    <script>
    $(document).ready(function() {
        $("#errorMsg .close").click(function() {
            $("#errorMsg").fadeOut("slow");
        });
    });
    </script>
    <?php endif; ?>
    
	<?php echo $content; ?>
    
    <footer class="row text-center">
        <div class="col-sm-2">
            <img src="<?php echo Yii::app()->request->baseUrl . "/images/logo.png"; ?>">
        </div>
        <div class="col-sm-8">
            <div class="col-sm-4">
                <?php echo CHtml::link('Sobre nosotros',array('/site/page/view/about'), array('class'=>'btn btn-link')); ?>
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
</div><!-- page -->
<?php if(Yii::app()->user->hasFlash('modal')): ?>
<script>
$(document).ready(function() {
    $('#modalMsg').modal('show');
});
</script>
<div id="modalMsg" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Atención</h4>
            </div>
            <div class="modal-body">
                <p><?php echo Yii::app()->user->getFlash('modal'); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<?php endif; ?>
</body>
</html>
