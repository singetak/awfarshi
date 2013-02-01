<?php

/**
 * This is the model class for table "tbl_category".
 *
 * The followings are the available columns in table 'tbl_category':
 * @property integer $id_category
 * @property string $name
 * @property integer $active
 */
class Category extends CActiveRecord
{
	const LEVEL_ACTIVATED=1, LEVEL_DEACTIVATED=0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return 'tbl_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_category, name, active', 'safe', 'on'=>'search'),
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
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		//'promotion' => array(self::HAS_MANY, 'Promotion', 'postID','condition'=>'promotion.active='.Promotion::LEVEL_ACTIVATED,'order'=>'comments.creation_date DESC'),
		//'promotionCount' => array(self::STAT, 'Promotion', 'postID','condition'=>'active='.Promotion::LEVEL_ACTIVATED),
		'promotionCount'=>array(self::STAT, 'Promotion', 'tbl_featured_promotion_mapping(id_category, id_promotion)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_category' => 'Category',
			'name' => 'Name',
			'active' => 'Active',
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
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('active',$this->active);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * @param id of the category related that should be returned
	 * @return array of the categories
	 */
	public function findRecentCategories()
	{
		return $this->findAll(array(
			'condition'=>'active='.self::LEVEL_ACTIVATED,
			'order'=>'name ASC',
		));
	}
}