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

<h1>View Promotion "<?php echo $model->title; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'description',
		array(
			'name'=>'id_company',
			'value'=>$model->company->name,
		),
		'creation_date',
		'start_date',
		'end_date',
		array(
			'name'=>'is_continous',
			'value'=>$model->continueList[$model->is_continous],
		),
		'display_image',
		array(
			'name'=>'userID',
			'value'=>$model->users->displayName,
		),
		array(
			'name'=>'active',
			'value'=>$model->activeList[$model->active],
		),
	),
)); 

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
