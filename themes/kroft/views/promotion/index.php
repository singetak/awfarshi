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

<?php //print_r($arraycategories); //$this->widget('zii.widgets.CListView', array('dataProvider'=>$dataProvider,'itemView'=>'/promotion/_view',)); ?>

<!-- Gallery holder -->
<div id="gallery-holder">

	<!-- filter -->
	<ul class="gallery-filter">
		<?php foreach($arraycategories as $subcategory): ?>
		<li>
			<?php echo CHtml::link(CHtml::encode($subcategory), array('promotions/'.$subcategory)); ?>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="clear"></div>
	<!-- filter -->

	<!-- Thumbnails -->
	<ul class="work-thumbs" >
		<?php
			foreach($dataProvider as $i => $item){
				Yii::app()->controller->renderPartial('_viewpromotions',array('index' => $i, 'data' => $item, 'widget' => $this));
			} 
			?>
	</ul>
	<div class="clear"></div>	
    <!-- ENDS Thumbnails -->
    <!-- pager -->
	<ul class='pager'>
		<?php $tempPath= 'promotions'; if($category != '')$tempPath = $tempPath . '/'.$category;?>
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