<?php
/* @var $this PromotionController */
/* @var $model Promotion */
/* @var $form CActiveForm */
?>

<!-- Load TinyMCE -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '<?php echo Yii::app()->request->baseUrl; ?>/js/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
</script>
<!-- /TinyMCE -->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promotion-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="formrow">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo CHtml::activeTextArea($model,'description',array('rows'=>20, 'cols'=>70, 'class'=>'span8 tinymce')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	<div class="formrow">
		<?php echo $form->labelEx($model,'id_company'); ?>
		<?php 
		$this->widget('ext.myAutoComplete', array(
				'model'=>$model,
				'attribute'=>'id_company',
				'name'=>'user_autocomplete',
				'value' => $model->company->name,
				'source'=>$this->createUrl('suggestCompanies'), 
				// additional javascript options for the autocomplete plugin
				'options'=>array(
						'minLength'=>'0',
				),
				'htmlOptions'=>array(
						'style'=>'height:20px;',
				),        
		));
		
		?>
		<?php echo $form->error($model,'id_company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date',array('id'=>'datepickerStartDate','readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?php echo $form->textField($model,'end_date',array('id'=>'datepickerEndDate','readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'end_date'); ?>
	</div>
	<div class="formrow">
		<?php echo $form->labelEx($model,'categories'); ?>
		<?php echo $form->dropDownList($model,'categories',$arraycategories, array('multiple' => 'multiple')); ?>
		<?php echo $form->error($model,'categories'); ?>
		
	</div>
	<div class="formrow">
        <?php echo $form->labelEx($model,'display_image'); ?>
        <?php echo CHtml::activeFileField($model, 'display_image'); // by this we can upload image 
        ?>  
        <?php echo $form->error($model,'display_image'); ?>
	</div>
	<?php if($model->isNewRecord!='1'){ ?>
	<div class="formrow">
	     <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/promotion/image/'.$model->display_image,"Promotion Image",array("width"=>200)); // Image shown here if page is update page 
	     ?>  
	</div>
  <div class="formrow">
		<input type="checkbox" name="clearImage" value="1"> Delete Avatar
	</div>
	<?php } ?>
  <?php if(Yii::app()->user->isAdmin()){ ?>
  <div class="row">
		<?php echo $form->labelEx($model,'is_continous'); ?>
		<?php echo $form->dropDownList($model,'is_continous',$model->continueList); ?>
		<?php echo $form->error($model,'is_continous'); ?>
	</div>
	<div class="formrow">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active',$model->activeList); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>
  
	<?php }else{ ?>
  	<div class="formrow">
			<?php echo $form->labelEx($model,'is_continous'); ?>
			<?php echo $model->continueList[$model->is_continous]; ?>
		</div>
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
<script>
	$(function() {
        $( "#datepickerStartDate" ).datepicker();
				$( "#datepickerEndDate" ).datepicker();
    });
</script>