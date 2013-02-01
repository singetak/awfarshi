<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<h1>Featured Promotions</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$featuredPromotionDataProvider,
	'itemView'=>'_viewfeatured',
	'enablePagination'=>false,
	'summaryText'=>false,
)); ?>
<h1>Recent Promotions</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$promotionDataProvider,
	'itemView'=>'/promotion/_view',
	'enablePagination'=>false,
	'summaryText'=>false,
)); ?>