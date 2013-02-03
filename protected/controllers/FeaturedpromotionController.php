<?php

class FeaturedPromotionController extends Controller
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
				'actions'=>array('admin','delete','create','update','SuggestPromotions'),
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
		$model=new FeaturedPromotion;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['FeaturedPromotion']))
		{
		
			$rnd = rand(0,99999999);  // generate random number between 0-9999
			$model->attributes=$_POST['FeaturedPromotion'];

			$uploadedFile=CUploadedFile::getInstance($model,'featured_image');
			$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
			if(empty($uploadedFile))
				$fileName = 'default.jpg';
			$model->featured_image = $fileName;

			if($model->save())
			{
				if(!empty($uploadedFile)){  // check if uploaded file is set or not
					$imageUrl = Yii::app()->basePath.'/../images/featuredpromotion/image/'.$fileName;
						$uploadedFile->saveAs($imageUrl);  // image will upload to rootDirectory/banner/
						
						//Resize
						$image = Yii::app()->image->load($imageUrl);
			$image->resize(200, 200);
			$image->save();
					}
					$this->redirect(array('view','id'=>$model->id_featured));
			}
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['FeaturedPromotion']))
			{
				$fileName = "";
				
				if($model->featured_image != 'default.jpg'){
					if(!isset($_POST['FeaturedPromotion']['clearImage']))
						$fileName = $model->featured_image;
					$imageUrl = Yii::app()->basePath.'/../images/featuredpromotion/image/'.$model->avatar;
					if(file_exists ($imageUrl))
		                unlink($imageUrl);
				}
									
				$model->attributes=$_POST['FeaturedPromotion'];
					
				$uploadedFile=CUploadedFile::getInstance($model,'featured_image');
				if($fileName == ""){
					if(!empty($uploadedFile)){
						$rnd = rand(0,99999999);  // generate random number between 0-9999
						$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
					}else
						$fileName = 'default.jpg';
				}
	            $model->featured_image = $fileName;
				
				if($model->save()){
					if(!empty($uploadedFile))  // check if uploaded file is set or not
	                {
	                	$imageUrl = Yii::app()->basePath.'/../images/featuredpromotion/image/'.$fileName;
	                    $uploadedFile->saveAs($imageUrl);
	                    
	                    //Resize
	                    $image = Yii::app()->image->load($imageUrl);
					    $image->resize(200, 200);
					    $image->save();
	                }
					$this->redirect(array('view','id'=>$model->id_featured));
				}
			}


		if(isset($_POST['FeaturedPromotion']))
		{
			$model->attributes=$_POST['FeaturedPromotion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_featured));
		}

		$this->render('update',array(
			'model'=>$model,
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
	public function actionIndex($category = '')
	{
		$this->layout='//layouts/column1';
		$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$pageSize=Yii::app()->params->featuredPromotionsCount;
		$qty_items = 0;
		$category = strtolower($category);
		$notacategory = 1;
		$arraycategories = Category::model()->findRecentCategories();
		$cats = CHtml::listData($arraycategories, 'id_category', 'name');
		foreach($cats as $subcategory){
			if(strtolower($subcategory) == $category){
				$notacategory = 0;
				break;
			}
		}
		if($notacategory == false || $category == ''){
			$idArray = array();
			$dataIdProvider = FeaturedPromotion::model()->returnFeaturedPromotions($keyword = $category, $limit = 100);
			
			$qty_items = count($dataIdProvider);
			
			$qty_pages = ceil($qty_items / $pageSize);
			
			$next_page = $curr_page < $qty_pages ? $curr_page + 1 : null;
			$prev_page = $curr_page > 1 ? $curr_page - 1 : null;
			
			$offset = ($curr_page - 1) * $pageSize;
			$dataIdProvider = array_slice($dataIdProvider, $offset, $pageSize);
			
			foreach ($dataIdProvider as $item)
				$idArray[] = $item['id_promotion'];
			$criteria = new CDbCriteria();
			$criteria->addInCondition("id_promotion", $idArray);
			$dataProvider = FeaturedPromotion::model()->findAll($criteria);
			
			$this->render('index',array('dataProvider'=>$dataProvider,'arraycategories'=>$cats,'category'=>$category,'prev_page'=>$prev_page,'next_page'=>$next_page,'qty_pages'=>$qty_pages,'curr_page'=>$curr_page));
		}else
			throw new CHttpException(404, 'The category you chose doesn\'t exist');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FeaturedPromotion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FeaturedPromotion']))
			$model->attributes=$_GET['FeaturedPromotion'];

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
		$model=FeaturedPromotion::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='featured-promotion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * Suggests Promotions based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestPromotions()
	{
		$term = trim($_GET['term']) ;
		if($term !='') {
			// Note: Users::usersAutoComplete is the function you created in Step 2
			$companies=Promotion::model()->suggestPromotions($term);
			echo CJSON::encode($companies);
			Yii::app()->end();
		}
	}
}
