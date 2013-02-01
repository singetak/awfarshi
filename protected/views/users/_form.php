<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
	$currentLocation="";
	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
    )); 
?>

	<p class="note"><?php echo Yii::t('zii','Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('zii','are required'); ?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="formrow">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="formrow">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('value' => '','size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<?php if($model->isNewRecord=='1'){ ?>
	<div class="formrow">
		<?php echo $form->labelEx($model,'PasswordConfirm'); ?>
		<?php echo $form->passwordField($model, 'PasswordConfirm', array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'PasswordConfirm'); ?>
    </div>
    <?php } ?>
    <?php /*
	<div class="formrow">
		<?php echo $form->labelEx($model,'groupID'); ?>
		<?php echo $form->textField($model,'groupID'); ?>
		<?php echo $form->error($model,'groupID'); ?>
	</div>
	*/ ?>
	<div class="formrow">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="formrow">
		<?php echo $form->labelEx($model,'displayName'); ?>
		<?php echo $form->textField($model,'displayName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'displayName'); ?>
	</div>

	<div class="formrow">
		<?php echo $form->labelEx($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'firstName'); ?>
	</div>

	<div class="formrow">
		<?php echo $form->labelEx($model,'lastName'); ?>
		<?php echo $form->textField($model,'lastName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'lastName'); ?>
	</div>
	<div class="formrow">
		<?php echo $form->labelEx($model,'id_country'); ?>
		<?php echo $form->dropDownList($model,'id_country',$arrayCountries,array(
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('region/dynamicregions'),
		//'data'=>array('id_region'=>'js:this.value'),
		'success'=>'function(retval){$("#Users_id_region").html(retval);$("#Users_id_region").change()}',
		//'error'=>'function(){alert(\'Bad AJAX\');}',
		'update'=>'#Users_id_region', 
		))); ?>
		<?php echo $form->error($model,'id_country'); ?>
	</div>
	
	<div class="formrow">
		<?php echo $form->labelEx($model,'id_region'); ?>
		<?php echo $form->dropDownList($model,'id_region',$arrayRegions,array(
		'ajax' => array(
		'type'=>'POST', //request type
		'url'=>CController::createUrl('city/dynamiccities'), 
		'update'=>'#Users_id_city', 
		))); ?>
		<?php echo $form->error($model,'id_region'); ?>
	</div>
	
	<div class="formrow">
		<?php echo $form->labelEx($model,'id_city'); ?>
		<?php echo $form->dropDownList($model,'id_city',$arrayCities); ?>
		<?php echo $form->error($model,'id_city'); ?>
	</div>

	<div class="formrow">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
	
	<div class="formrow">
        <?php echo $form->labelEx($model,'avatar'); ?>
        <?php echo CHtml::activeFileField($model, 'avatar'); // by this we can upload image 
        ?>  
        <?php echo $form->error($model,'avatar'); ?>
	</div>
	<?php if($model->isNewRecord!='1'){ ?>
	<div class="formrow">
	     <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/users/avatar/'.$model->avatar,"Avatar",array("width"=>200)); // Image shown here if page is update page 
	     ?>  
	</div>
	<div class="formrow">
		<input type="checkbox" name="clearImage" value="1"> Delete Avatar
	</div>
	<?php } ?>
	<?php if(Yii::app()->user->isAdmin() && Yii::app()->user->isHigher($model->roles)){ ?>
	<div class="formrow">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active',$model->activeList); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>
	<div class="formrow">
		<?php 
			$_rolesList = $model->rolesList;
			unset($_rolesList[10]);//prevent superuser setting up
			echo $form->labelEx($model,'roles'); 
			echo $form->dropDownList($model,'roles',$_rolesList); 
			echo $form->error($model,'roles'); 
		?>
	</div>
	<div class="formrow">
		<?php 
			echo $form->labelEx($model,'type'); 
			echo $form->dropDownList($model,'type',$model->typeList); 
			echo $form->error($model,'type'); 
		?>
	</div>
	<?php }else{ ?>
		<div class="formrow">
			<?php echo $form->labelEx($model,'active'); ?>
			<?php echo $model->activeList[$model->active]; ?>
		</div>
		<div class="formrow">
			<?php 
				echo $form->labelEx($model,'roles'); 
				echo $model->rolesList[$model->roles]; 
			?>
		</div>
		<div class="formrow">
			<?php 
				echo $form->labelEx($model,'type'); 
				echo $model->typeList[$model->type]; 
			?>
		</div>
	<?php } ?> 
	<div class="formrow buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('zii','Create') : Yii::t('zii','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->