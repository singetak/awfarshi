<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-5">
	<div id="sidebar">
  <?php if(Yii::app()->user->isGuest){?>
    <form class="navbar-form pull-right" method="post" action="<?php echo Yii::app()->request->baseUrl . "/site/login/"; ?>">
      <input class="span1_5" name="LoginForm[username]" type="text" placeholder="<?php echo Yii::t('zii','User Name'); ?>">
      <input class="span1_5" name="LoginForm[password]" type="password" placeholder="<?php echo Yii::t('zii','Password'); ?>">
      <button type="submit" class="btn"><?php echo Yii::t('zii','Sign in'); ?></button>
    </form>
    <ul class="nav pull-right">
    <li><?php echo CHtml::link(Yii::t('zii','Login Page'), Yii::app()->request->baseUrl . "/site/login"); ?></li>
    </ul>
    <?php }else{ ?>
    <ul class="nav pull-right">
    <li><?php echo CHtml::link( Yii::t('zii','Profile'), Yii::app()->request->baseUrl . "/users/view/".Yii::app()->user->id); ?></li>
    <li><?php echo CHtml::link('Logout ('.Yii::app()->user->name.')', Yii::app()->request->baseUrl . "/site/logout"); ?></li>
    </ul>
  <?php }?>
  
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
  <?php $this->widget('RecentCategories', array('title' => Yii::t('zii','Categories'),)); ?>
	</div><!-- sidebar -->
</div>
<div class="span-19 last">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>