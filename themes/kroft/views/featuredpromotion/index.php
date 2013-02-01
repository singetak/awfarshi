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

<?php //print_r($arraycategories); //$this->widget('zii.widgets.CListView', array('dataProvider'=>$dataProvider,'itemView'=>'_view',)); ?>

<!-- Gallery holder -->
<div id="gallery-holder">

	<!-- filter -->
	<ul class="gallery-filter">
		<?php foreach($arraycategories as $category): ?>
		<li>
			<?php echo CHtml::link(CHtml::encode($category), $category); ?>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>
	<!-- filter -->

	<!-- Thumbnails -->
	<ul class="work-thumbs" >
		<?php 
			$data = $dataProvider->getData();
			foreach($data as $i => $item){
				Yii::app()->controller->renderPartial('_viewfeatured',array('index' => $i, 'data' => $item, 'widget' => $this));
			}
			?>
	</ul>
	<div class="clear"></div>	
    <!-- ENDS Thumbnails -->
    
    <!-- pager 
	<ul class='pager'>
		<li class='first-page'><a href='#'>&laquo;</a></li>
		<li><a href='#' >&lsaquo;</a></li>
		<li><a href='#' >2</a></li>
		<li><a href='#' >3</a></li>
		<li class='active'><a href='#'>4</a></li>
		<li><a href='#' >5</a></li>
		<li><a href='#' >6</a></li>
		<li><a href='#' >&rsaquo;</a></li>
		<li class='last-page'><a href='#'>&raquo;</a></li>
	</ul>-->	
	<div class="clear"></div>
	<!-- ENDS pager -->
	
</div>
<!-- ENDS Gallery holder -->
