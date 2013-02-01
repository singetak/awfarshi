<?php /* @var $this Controller */ ?>
<!DOCTYPE  html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		
		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/social-icons.css" type="text/css" media="screen" />
		<!-- ENDS CSS -->	
		
		<!--[if IE]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- ENDS JS -->
		
		<!-- JS -->
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/slider.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/slides/source/slides.min.jquery.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/quicksand.js"></script>
		
		<!-- superfish -->
		<link rel="stylesheet" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/css/superfish.css" /> 
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/superfish-1.4.8/js/hoverIntent.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/superfish-1.4.8/js/superfish.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/superfish-1.4.8/js/supersubs.js"></script>
		<!-- ENDS superfish -->

		<!-- poshytip -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/poshytip-1.0/src/tip-twitter/tip-twitter.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/poshytip-1.0/src/tip-yellowsimple/tip-yellowsimple.css" type="text/css" />
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/poshytip-1.0/src/jquery.poshytip.min.js"></script>
		<!-- ENDS poshytip -->
		
		<!-- Tweet -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.tweet.css" media="all"  type="text/css"/> 
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/tweet/jquery.tweet.js" type="text/javascript"></script> 
		<!-- ENDS Tweet -->
		
		<!-- prettyPhoto -->
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" />
		<!-- ENDS prettyPhoto -->
		
		<!-- GOOGLE FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400italic' rel='stylesheet' type='text/css'>
		

	</head>
	<body>
	
		<!-- Dynamic Background -->
		<div id="headerimgs">
			<div id="headerimg1" class="headerimg"></div>
			<div id="headerimg2" class="headerimg"></div>
		</div>
		<!-- ENDS Dynamic Background -->
		
		<!-- background nav -->
		<div id="headernav">
			<div id="back" class="btn"></div>
			<div id="next" class="btn"></div>
		</div>
		<!-- ENDS background nav -->
		
		<div id="top-gap"></div>

		<!-- wrapper -->
		<div class="wrapper">
		
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/"><img  id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/img/awfarshi_logo.png" alt="Kroft"></a>
			
			
			<!-- nav bar holder -->
			<div id="nav-bar-holder">
				<!-- Navigation -->
				<?php $this->widget('zii.widgets.CMenu',array(
				'id' => 'nav',
				'htmlOptions' => array('class'=>'sf-menu'),
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
				<!-- ENDS Navigation -->
				
				<!-- Social -->
				<ul class="social">
					<li><a href="http://www.facebook.com" class="poshytip  facebook" title="Become a fan"></a></li>
					<li><a href="http://www.twitter.com" class="poshytip  twitter" title="Follow my tweets"></a></li>
					<li><a href="http://www.dribbble.com" class="poshytip  dribbble" title="Working on..."></a></li>
				</ul>
				<!-- ENDS Social -->
			</div>
			<!-- ENDS nav bar holder -->
				
			<!-- content wrap -->	    	
	        <div id="content-wrap">
	        	
	        	<!-- Page wrap -->
	        	<div id="page-wrap">
	        		<?php echo $content; ?>
  
	        	</div>
	        	<!-- ENDS Page wrap -->
	        	
	        </div>
	        <!-- ENDS content wrap -->
	        
        </div>
		<!-- ENDS Wrapper -->
		
		<!-- FOOTER -->
		<div id="footer">
			<div class="footer-wrapper">
				
				
				<!-- footer-cols -->
				<ul id="footer-cols">
					<li>
						<h6>About the theme</h6>
						<p>Pellentesque accumsan porttitor, accumsan porttitor ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Tincidunt quis, accumsan porttitor facilisis habitant morbi tristique senectus accumsan porttitor et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam,  Aenean ultricies mi vitae est. Tincidunt quis feugiat vitae.</p> 
						<p>Accumsan porttitor ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Tincidunt quis, accumsan porttitor, <a href="http://luiszuno.com">luiszuno.com</a>.</p>
					</li>
					<li>
						<h6>Categories</h6>
						<ul>
							<li><a href="#">Webdesign in this era</a></li>
							<li><a href="#/">Wordpress core techniques</a></li>
							<li><a href="#">Photo editing</a></li>
							<li><a href="#">Code in php</a></li>
							<li><a href="#">Drawings by hand</a></li>
							<li><a href="#">Buy Themeforest items</a></li>
							<li><a href="#">Lorem ipsum dolor amet</a></li>
							<li><a href="#">Tincidunt quis, accumsan porttitor</a></li>
							<li><a href="#">Donec eu libero sit amet quam</a></li>
						</ul>
					</li>
					<li>
						<div id="tweets" class="footer-col tweet">
	         				<h6>Twitter widget</h6>
	         			</div>
					</li>
				</ul>
				<!-- ENDS footer-cols -->
				
				<div id="footer-glare"></div>
				
			</div>
		</div>
		<!-- ENDS FOOTER -->
		
		<!-- footer-bottom -->
		<div id="footer-bottom">
			<div class="bottom-wrapper">
				<div id="bottom-left">
					&copy; <?php echo date('Y'); ?> AwfarShi.com.
				</div>
				<div id="bottom-right">
					<ul id="footer-nav">
						<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/">Home</a></li>
						<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page/about">About</a>
						<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/contact">Contact</a>
					</ul>
				</div>
			</div>
		</div>
		<!-- ENDS footer-bottom -->


		
	</body>
</html>
