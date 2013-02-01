<?php
/* @var $this FeaturedPromotionController */
/* @var $model FeaturedPromotion */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_featured'); ?>
		<?php echo $form->textField($model,'id_featured'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_promotion'); ?>
		<?php echo $form->textField($model,'id_promotion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_date'); ?>
		<?php echo $form->textField($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'featured_image'); ?>
		<?php echo $form->textField($model,'featured_image',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'featured_teaser'); ?>
		<?php echo $form->textArea($model,'featured_teaser',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->