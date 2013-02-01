<?php

/**
 * This is the model class for table "tbl_promotion".
 *
 * The followings are the available columns in table 'tbl_promotion':
 * @property integer $id_promotion
 * @property string $title
 * @property string $description
 * @property integer $id_company
 * @property string $creation_date
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_continous
 * @property string $display_image
 * @property integer $userID
 * @property integer $active
 */
class Promotion extends CActiveRecord
{
	
	const LEVEL_ACTIVATED=1, LEVEL_DEACTIVATED=0;
	const LEVEL_CONT=1, LEVEL_NOTCONT=0;
	private $_start_date;
	private $_end_date;
	
	public $categories = null;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Promotion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_promotion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, active', 'required'),
			array('id_company, is_continous, userID, active', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>500),
			array('description', 'length', 'max'=>1000),
			array('display_image', 'length', 'max'=>255),
			array('start_date, end_date,creation_date,categories', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_promotion, title, description, id_company, creation_date, start_date, end_date, is_continous, display_image, userID, active', 'safe', 'on'=>'search'),
		);
	}
	//define the label for each Active Level
	static function getActiveList($level = null){
		$levelList=array(
			self::LEVEL_DEACTIVATED => 'Deactivated',
			self::LEVEL_ACTIVATED => 'Activated'
		);
		if($level === null)
			return $levelList;
		return $levelList[$level];
	}
	
	//define the label for each Active Level
	static function getContinueList($level = null){
		$levelList=array(
			self::LEVEL_NOTCONT => 'Limited',
			self::LEVEL_CONT => 'Continues'
		);
		if($level === null)
			return $levelList;
		return $levelList[$level];
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		'users' => array(self::BELONGS_TO, 'Users', 'userID'),
		'company' => array(self::BELONGS_TO, 'Company', 'id_company'),
		'categorymap' => array(self::MANY_MANY, 'Category', 'tbl_featured_promotion_mapping(id_promotion,id_category)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_promotion' => 'Promotion',
			'title' => 'Title',
			'description' => 'Description',
			'id_company' => 'Company Name',
			'creation_date' => 'Creation Date',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'is_continous' => 'Is Continous',
			'display_image' => 'Display Image',
			'userID' => 'User',
			'active' => 'Active',
			'categories' => 'Categories',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_promotion',$this->id_promotion);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('id_company',$this->id_company);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('is_continous',$this->is_continous);
		$criteria->compare('display_image',$this->display_image,true);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->creation_date=date('Y-m-d H:i:s',time());
				$this->userID=Yii::app()->user->id;
			}
			$this->_end_date = strtotime($this->end_date);
	    $this->end_date = date('Y-m-d H:i:s', $this->_end_date);
			$this->_start_date = strtotime($this->start_date);
	    $this->start_date = date('Y-m-d H:i:s', $this->_start_date);
			return true;
		}
		else
			return false;
	}
	
	protected function afterFind()
	{
		$this->categories = $this->categorymap;
		parent::afterFind();
	}
	/**
	 * Suggests a list of existing promotions matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of tags to be returned
	 * @return array list of matching tag names
	 */
	public function suggestPromotions($keyword = '',$limit=20)
	{
		$sql= 'SELECT id_promotion as id ,title AS label FROM tbl_promotion WHERE title LIKE :keyword';
        $keyword = $keyword.'%';
				
        return Yii::app()->db->createCommand($sql)->queryAll(true,array(':keyword'=>$keyword));
	}
	
	/**
	 * @return string the URL that shows the detail of the promotion
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('promotion/view', array('id'=>$this->id_promotion,'title'=>$this->title,));
	}
	
}