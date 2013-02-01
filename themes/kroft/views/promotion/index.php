<?php
/* @var $this PromotionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Promotions',
);

$this->menu=array(
	array('label'=>'Create Promotion', 'url'=>array('create')),
	array('label'=>'Manage Promotion', 'url'=>array('admin')),
);
?>

<div class="page-title"><h1>Promotions</h1></div>

<!-- side content -->
<div id="side-content">

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/promotion/_view',
)); ?>
</div>