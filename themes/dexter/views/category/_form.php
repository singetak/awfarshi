<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

  <?php if(Yii::app()->user->isAdmin()){ ?>
	<div class="formrow">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active',$model->activeList); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>
  
	<?php }else{ ?>
		<div class="formrow">
			<?php echo $form->labelEx($model,'active'); ?>
			<?php echo $model->activeList[$model->active]; ?>
		</div>
	<?php } ?> 

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->