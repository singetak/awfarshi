<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->displayName,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->userID)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->userID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View User <?php echo $model->displayName; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'displayName',
		'firstName',
		'lastName',
		'email',
		'dateCreated',
		array(
			'name'=>'id_country',
			'value'=>$model->country->name,
		),
		'phone',
		'avatar',
		'lastLogin',
		array(
			'name'=>'active',
			'value'=>$model->activeList[$model->active],
		),
		array(
			'name'=>'roles',
			'value'=>$model->rolesList[$model->roles],
		),
		array(
			'name'=>'type',
			'value'=>$model->typeList[$model->type],
		),
	),
)); ?>
