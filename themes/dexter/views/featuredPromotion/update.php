<?php
/* @var $this FeaturedPromotionController */
/* @var $model FeaturedPromotion */

$this->breadcrumbs=array(
	'Featured Promotions'=>array('index'),
	$model->id_featured=>array('view','id'=>$model->id_featured),
	'Update',
);

$this->menu=array(
	array('label'=>'List FeaturedPromotion', 'url'=>array('index')),
	array('label'=>'Create FeaturedPromotion', 'url'=>array('create')),
	array('label'=>'View FeaturedPromotion', 'url'=>array('view', 'id'=>$model->id_featured)),
	array('label'=>'Manage FeaturedPromotion', 'url'=>array('admin')),
);
?>

<h1>Update FeaturedPromotion <?php echo $model->id_featured; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>