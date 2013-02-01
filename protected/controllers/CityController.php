<?php

class CityController extends Controller
{
	/*public function actionIndex()
	{
		$criteria=new CDbCriteria;
		if(isset($_GET['id_region'] && $_GET['id_region'] != '')){
			$criteria->condition = 'id_region = ' . $_GET['id_region'];
			$criteria->order = 'firstName ASC, lastName ASC';
		}
		$dataProvider=new CActiveDataProvider('Users', array(
		    'criteria'=>$criteria,
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),
		));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}*/
	
	public function actionDynamiccities()
	{
	    $data=City::model()->getAllCities((int)$_POST['Users']['id_region']);
	    if(!empty($data)){
		    foreach($data as $value=>$name)
		    {
		        echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
		    }
	    }else
	    	echo CHtml::tag('option',array('value'=>0),CHtml::encode('Unknown'),true);
	}
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}