<?php
/* @var $this FeaturedPromotionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Featured Promotions',
);

$this->menu=array(
	array('label'=>'Create FeaturedPromotion', 'url'=>array('create')),
	array('label'=>'Manage FeaturedPromotion', 'url'=>array('admin')),
);
?>

<h1>Featured Promotions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
