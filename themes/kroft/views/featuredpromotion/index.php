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

<div class="page-title"><h1>Featured Promotions</h1></div>

<!-- side content -->
<div id="side-content">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>
