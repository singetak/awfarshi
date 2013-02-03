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
		<?php foreach($arraycategories as $subcategory): ?>
		<li>
			<?php echo CHtml::link(CHtml::encode($subcategory), array('featuredpromotions/'.$subcategory)); ?>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>
	<!-- filter -->

	<!-- Thumbnails -->
	<ul class="work-thumbs" >
		<?php
			foreach($dataProvider as $i => $item){
				Yii::app()->controller->renderPartial('_viewfeatured',array('index' => $i, 'data' => $item, 'widget' => $this));
			}
			?>
	</ul>
	<div class="clear"></div>	
    <!-- ENDS Thumbnails -->
    
    <!-- pager -->
	<ul class='pager'>
		<?php $tempPath= 'featuredpromotions'; if($category != '')$tempPath = $tempPath . '/'.$category;?>
		<li class='first-page'><?php echo CHtml::link('&laquo;', array($tempPath.'/?page=1')); ?></li>
		<? if($prev_page): ?>
		<li><?php echo CHtml::link('&lsaquo;', array($tempPath.'/?page='.$prev_page)); ?>
		<? endif ?>
		<? for($i = 1; $i <= $qty_pages; $i++): ?>
		<li class="<?php echo ($i == $curr_page) ? 'active' : '' ?>"><?php echo CHtml::link(CHtml::encode($i), array($tempPath.'/?page='.$i)); ?></li>
		<? endfor ?>
		<? if($next_page): ?>
			<li><?php echo CHtml::link('&rsaquo;', array($tempPath.'/?page='.$next_page)); ?></li>
		<? endif ?>
		<li class='last-page'><?php echo CHtml::link('&raquo;', array($tempPath.'/?page='.$qty_pages)); ?></li>
	</ul>
	<div class="clear"></div>
	<!-- ENDS pager -->
	
</div>
<!-- ENDS Gallery holder -->
