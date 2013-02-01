<?php
/* @var $this FeaturedPromotionController */
/* @var $model FeaturedPromotion */

$this->breadcrumbs=array(
	'Featured Promotions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FeaturedPromotion', 'url'=>array('index')),
	array('label'=>'Manage FeaturedPromotion', 'url'=>array('admin')),
);
?>

<h1>Create FeaturedPromotion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>