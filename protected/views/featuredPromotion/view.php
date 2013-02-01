<?php
/* @var $this FeaturedPromotionController */
/* @var $model FeaturedPromotion */

$this->breadcrumbs=array(
	'Featured Promotions'=>array('index'),
	$model->id_featured,
);

$this->menu=array(
	array('label'=>'List FeaturedPromotion', 'url'=>array('index')),
	array('label'=>'Create FeaturedPromotion', 'url'=>array('create')),
	array('label'=>'Update FeaturedPromotion', 'url'=>array('update', 'id'=>$model->id_featured)),
	array('label'=>'Delete FeaturedPromotion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_featured),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FeaturedPromotion', 'url'=>array('admin')),
);
?>

<h1>View FeaturedPromotion "<?php echo $model->promotion->title; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'id_promotion',
			'value'=>$model->promotion->title,
		),
		'start_date',
		'end_date',
		'featured_image',
		'featured_teaser',
		array(
			'name'=>'active',
			'value'=>$model->activeList[$model->active],
		),
	),
)); ?>
