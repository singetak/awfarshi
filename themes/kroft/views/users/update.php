<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->displayName=>array('view','id'=>$model->userID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->userID)),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>Update Users <?php echo $model->displayName; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'arrayCountries'=>$arrayCountries,'arrayRegions'=>$arrayRegions,'arrayCities'=>$arrayCities,)); ?>