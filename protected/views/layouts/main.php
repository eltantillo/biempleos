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
    
    <link rel="icon" type="image/png" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png">
    
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
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
                <li><?php echo CHtml::link('Acerca de',array('/site/page/view/about')); ?></li> 
            </ul>
        </div>
    </div>
</nav>


<div class="container-fluid">
	<?php echo $content; ?>
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
