<?php
/* @var $this CategoryController */
/* @var $data Category */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id_category)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->activeList[$data->active]); ?>
	<br />
</div>
<hr>