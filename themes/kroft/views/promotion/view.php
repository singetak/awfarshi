<?php
/* @var $this PromotionController */
/* @var $model Promotion */

$this->breadcrumbs=array(
	'Promotions'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Promotion', 'url'=>array('index')),
	array('label'=>'Create Promotion', 'url'=>array('create')),
	array('label'=>'Update Promotion', 'url'=>array('update', 'id'=>$model->id_promotion)),
	array('label'=>'Delete Promotion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_promotion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Promotion', 'url'=>array('admin')),
);
?>
<div class="page-title"><h1>Promotion</h1></div>

<!-- side content -->
<div id="side-content">

	<!-- single -->
	<div class="single-post">
		<div class="post">
			<div class="post-feature-img">
				<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/promotion/image/'.$model->display_image,"Cover Image",array("width"=>590,"height"=>260,"class"=>"promotionCoverImage")); ?>
			</div>
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/feature-post-shadow.png" alt="shadow" />
			
			<h4><?php echo $model->title; ?></h4>
			<div class="meta">Posted by <?php echo $model->users->displayName; ?><!--, in category 1, category 2--></div>
			<div class="content">
				<?php echo $model->description; ?>	
			</div>
			
			
			<div class="meta-date">
				<span class="meta-day"><?php echo date('d', strtotime($model->start_date)); ?></span><span class="meta-month"><?php echo date('M', strtotime($model->start_date)); ?></span><span class="meta-year"><?php echo date('Y', strtotime($model->start_date)); ?></span>
			</div>
			
		</div>
			
	</div>	
	<!-- ENDS single -->
	
	<?php 
	$this->widget('ext.sharebox.EShareBox', array(
		// url to share, required.
		'url' => $this->createAbsoluteUrl('/'),
		
		// A title to describe your link, required.
		// Some services will ignore this value.
		'title'=> 'My Awesome web site !!',
		
		// Size of the icons to display, in pixels.
		// Default is 24px, available sizes : 16, 24, 32, 48.
		//'iconSize' => 32,
		
		// Whether to animate the links.
		// Default is true
		//'animate' => false,
		
		// Social networks to include, excluding all others.
		// The exclude filter is still run.
		//'include' => array('technorati', 'digg'),
		
		// Social networks to exclude from display.
		// By default none are excluded.
		//'exclude' => array('technorati', 'digg'),
		
		// Use your own icons! Note that you will need to have
		// a subfolder of the appropriate icons sizes.
		// ie: /myimages/social/16px /myimages/social/24px ...
		//'iconPath' => '/myimages/social',
		
		// HTML options for the UL element.
		//'ulHtmlOptions' => array('class' => 'myCustomUlClass'),
		
		// HTML options for all the LI elements.
		//'liHtmlOptions' => array('class' => 'myCustomLiClass'),
		));
	?>

</div>
<!-- ENDS side content -->
