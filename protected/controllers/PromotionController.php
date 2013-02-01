<?php

class PromotionController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),*/
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','suggestCompanies'),
				'expression'=>'Yii::app()->user->isAdmin()',//this function is in /protected/components/EWebUser.php
			),
			array('deny',  // deny all users
				'users'=>array('*'),
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
		$model=new Promotion;
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Promotion']))
		{
		
			$rnd = rand(0,99999999);  // generate random number between 0-9999
			$model->attributes=$_POST['Promotion'];

			$uploadedFile=CUploadedFile::getInstance($model,'display_image');
			$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
			if(empty($uploadedFile))
				$fileName = 'default.jpg';
			$model->display_image = $fileName;

			if($model->save())
			{
				if(!empty($uploadedFile)){  // check if uploaded file is set or not
					$imageUrl = Yii::app()->basePath.'/../images/promotion/image/'.$fileName;
						$uploadedFile->saveAs($imageUrl);  // image will upload to rootDirectory/banner/
						
						//Resize
						$image = Yii::app()->image->load($imageUrl);
						$image->resize(200, 200);
						$image->save();
					}
				//delete insert category mappings to the mapping table
                FeaturedPromotionMapping::model()->deleteMappedPromotions($model->id_promotion);
                foreach($model->categories as $cat){
	            	$modelC=new FeaturedPromotionMapping;
	                $modelC->id_category=$cat;
	                $modelC->id_promotion=$model->id_promotion;
	                $modelC->save();
                }
				$this->redirect(array('view','id'=>$model->id_promotion));
			}
		}
		
		$arraycategories = Category::model()->findRecentCategories();
		$cats = CHtml::listData($arraycategories, 'id_category', 'name');
		$this->render('create',array(
			'model'=>$model,'arraycategories'=>$cats,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Promotion']))
			{
				
				$fileName = "";
				
				if($model->display_image != 'default.jpg'){
					if(!isset($_POST['Promotion']['clearImage']))
						$fileName = $model->display_image;
					$imageUrl = Yii::app()->basePath.'/../images/promotion/image/'.$model->avatar;
					if(file_exists ($imageUrl))
		                unlink($imageUrl);
				}
									
				$model->attributes=$_POST['Promotion'];	
				$uploadedFile=CUploadedFile::getInstance($model,'display_image');
				if($fileName == ""){
					if(!empty($uploadedFile)){
						$rnd = rand(0,99999999);  // generate random number between 0-9999
						$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
					}else
						$fileName = 'default.jpg';
				}
	            $model->display_image = $fileName;
				
				if($model->save()){
					if(!empty($uploadedFile))  // check if uploaded file is set or not
	                {
	                	$imageUrl = Yii::app()->basePath.'/../images/promotion/image/'.$fileName;
	                    $uploadedFile->saveAs($imageUrl);
	                    
	                    //Resize
	                    $image = Yii::app()->image->load($imageUrl);
					    $image->resize(200, 200);
					    $image->save();
	                }
	                
	                //delete insert category mappings to the mapping table
	                FeaturedPromotionMapping::model()->deleteMappedPromotions($model->id_promotion);
	                foreach($model->categories as $cat){
		            	$modelC=new FeaturedPromotionMapping;
		                $modelC->id_category=$cat;
		                $modelC->id_promotion=$model->id_promotion;
		                $modelC->save();
	                }
	                
					
					$this->redirect(array('view','id'=>$model->id_promotion));
				}
			}
		$arraycategories = Category::model()->findRecentCategories();
		$cats = CHtml::listData($arraycategories, 'id_category', 'name');		
		$this->render('update',array(
			'model'=>$model,'arraycategories'=>$cats,
		));
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
		$this->layout='//layouts/column1';
		$dataProvider=new CActiveDataProvider('Promotion');
		$arraycategories = Category::model()->findRecentCategories();
		$cats = CHtml::listData($arraycategories, 'id_category', 'name');	
		$this->render('index',array(
			'dataProvider'=>$dataProvider,'arraycategories'=>$cats,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Promotion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Promotion']))
			$model->attributes=$_GET['Promotion'];

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
		$model=Promotion::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='promotion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * Suggests Companies based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestCompanies()
	{
		$term = trim($_GET['term']) ;
		if($term !='') {
			// Note: Users::usersAutoComplete is the function you created in Step 2
			$companies=Company::model()->suggestCompanies($term);
			echo CJSON::encode($companies);
			Yii::app()->end();
		}
	}
}
