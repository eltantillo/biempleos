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
    
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo CHtml::link(Yii::app()->name,array('/site/index'),array('class'=>'navbar-brand')); ?>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><?php echo CHtml::link('Acerca de',array('/site/page/view/about')); ?></li> 
                <?php if(!Yii::app()->user->isGuest):?>
                <li><?php echo CHtml::link('Perfil',array('/empresas/index'));?></li>
                <li><?php echo CHtml::link('Cerrar Sesión',array('/site/logout')); ?></li>
                <? else:?>
                <li class="dropdown hidden-xs">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Iniciar Sesión</a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php $this->renderPartial('/site/login',array('model'=>new LoginForm),false,true);?>
                        </li>
                    </ul>
                </li>
                <li class="visible-xs-block">
                    <a data-toggle="collapse" data-target="#sesion" href="#">Iniciar Sesión</a>
                    <div class="collapse" id="sesion">
                        <?php /*$this->renderPartial('/site/login',array('model'=>new LoginForm),false,true);*/?>
                    </div>
                </li>
                <?php endif?>
            </ul>
        </div>
    </div>
</nav>


<div class="container" id="page">
	<?php if(isset($this->breadcrumbs)):?>
		<?php /*$this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		));*/ ?><!-- breadcrumbs -->
	<?php endif?>

    
    
	<?php echo $content; ?>

	<div class="clear"></div>

	<!--div id="footer">
		Copyright &copy; <!--?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<!--?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

<script>
    $(".btn-group > .btn").click(function(){
        $(this).addClass("focus").siblings().removeClass("focus");
    });
    
    $('#myNavbar a.dropdown-toggle').click(function() {
        $('.dropdown-menu').first().stop(true, true).slideToggle('fast');
    });
</script>
