<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
	<?php 
		Yii::app()->getClientScript()->registerCoreScript('jquery.ui'); 
		Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
	?>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header" class="clearfix">
  	<a id="logo" title="Home" href="<?php echo Yii::app()->request->baseUrl; ?>/">
    <img alt="Home" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logosmall.png">
    </a>
		<div id="site-name-slogan"><img alt="One stop... All offers" src="<?php echo Yii::app()->request->baseUrl; ?>/images/slogan.png"></div>
	</div><!-- header -->
	<div id="pageBody">
    <div id="mainmenu" class="clearfix">
      <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
          array('label'=>'Home', 'url'=>array('/site/index')),
          array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
          array('label'=>'Contact', 'url'=>array('/site/contact')),
          array('label'=>'Promotion', 'url'=>array('/promotion/'), 'visible'=>!Yii::app()->user->isGuest),
          array('label'=>'Featured Promotion', 'url'=>array('/featuredpromotion/'), 'visible'=>!Yii::app()->user->isGuest),
          array('label'=>'Category', 'url'=>array('/category/'), 'visible'=>!Yii::app()->user->isGuest),
          array('label'=>'Company', 'url'=>array('/company/'), 'visible'=>!Yii::app()->user->isGuest),
          //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
          //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
        ),
      )); ?>
    </div><!-- mainmenu -->
    <?php if(isset($this->breadcrumbs)):?>
      <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
      )); ?><!-- breadcrumbs -->
    <?php endif?>
  
    <?php echo $content; ?>
  
    <div class="clear"></div>
  
    <div id="footer">
      Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
      All Rights Reserved.<br/>
    </div><!-- footer -->
	</div><!-- pageBody -->
</div><!-- page -->
</body>
</html>
