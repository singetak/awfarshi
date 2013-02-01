<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),*/
			array('allow', // allow owners users to perform 'update' actions
				'actions'=>array('index','update','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
				'expression'=>'Yii::app()->user->isAdmin()',//this function is in /protected/components/EWebUser.php
			),
			array('deny',  // deny all users
				'users'=>array('*'),
				//'deniedCallback' => function() { Yii::app()->controller->redirect(array ('/')); }//redirect if cannot access
			),
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
		
			$rnd = rand(0,99999999);  // generate random number between 0-9999
            $model->attributes=$_POST['Users'];
 
            $uploadedFile=CUploadedFile::getInstance($model,'avatar');
            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            if(empty($uploadedFile))
            	$fileName = 'default.jpg';
            $model->avatar = $fileName;
 
            if($model->save())
            {
            	if(!empty($uploadedFile)){  // check if uploaded file is set or not
            		$imageUrl = Yii::app()->basePath.'/../images/users/avatar/'.$fileName;
                	$uploadedFile->saveAs($imageUrl);  // image will upload to rootDirectory/banner/
                	
                	//Resize
                	$image = Yii::app()->image->load($imageUrl);
				    $image->resize(200, 200);
				    $image->save();
                }
                $this->redirect(array('view','id'=>$model->userID));
            }
		}
		$arrayCountries = Country::model()->getAllCountries();//get all countries
		$arrayRegions = Region::model()->getAllRegions($model->id_country);//get all region related countries
		$arrayCities = City::model()->getAllCities($model->id_region);//get all region related countries
		$this->render('create',array('model'=>$model,'arrayCountries'=>$arrayCountries,'arrayRegions'=>$arrayRegions,'arrayCities'=>$arrayCities,));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		if(Yii::app()->user->isOwner($model->userID) or (Yii::app()->user->isAdmin() && Yii::app()->user->isHigher($model->roles))){//give access for owners and admin 
			
			// Uncomment the following line if AJAX validation is needed
			//$this->performAjaxValidation($model);
	
			if(isset($_POST['Users']))
			{
				$fileName = "";
				
				if($model->avatar != 'default.jpg'){
					if(!isset($_POST['Users']['clearImage']))
						$fileName = $model->avatar;
					$imageUrl = Yii::app()->basePath.'/../images/users/avatar/'.$model->avatar;
					if(file_exists ($imageUrl))
		                unlink($imageUrl);
				}
									
				$model->attributes=$_POST['Users'];
					
				$uploadedFile=CUploadedFile::getInstance($model,'avatar');
				if($fileName == ""){
					if(!empty($uploadedFile)){
						$rnd = rand(0,99999999);  // generate random number between 0-9999
						$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
					}else
						$fileName = 'default.jpg';
				}
	            $model->avatar = $fileName;
				
				if($model->save()){
					if(!empty($uploadedFile))  // check if uploaded file is set or not
	                {
	                	$imageUrl = Yii::app()->basePath.'/../images/users/avatar/'.$fileName;
	                    $uploadedFile->saveAs($imageUrl);
	                    
	                    //Resize
	                    $image = Yii::app()->image->load($imageUrl);
					    $image->resize(200, 200);
					    $image->save();
	                }
					$this->redirect(array('view','id'=>$model->userID));
				}
			}
			$arrayCountries = Country::model()->getAllCountries();//get all countries
			$arrayRegions = Region::model()->getAllRegions($model->id_country);//get all region related countries
			$arrayCities = City::model()->getAllCities($model->id_region);//get all city related regions
			$this->render('update',array('model'=>$model,'arrayCountries'=>$arrayCountries,'arrayRegions'=>$arrayRegions,'arrayCities'=>$arrayCities,));
		}
		else
			throw new CHttpException(403,'You are not authorized to perform this action.');
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria;
		if(isset($_GET['notaires'])){
			$criteria->condition = 'type = ' .Users::LEVEL_NOTAIRE;
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

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
