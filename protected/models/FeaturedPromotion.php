<?php

/**
 * This is the model class for table "tbl_featured_promotion".
 *
 * The followings are the available columns in table 'tbl_featured_promotion':
 * @property integer $id_featured
 * @property integer $id_promotion
 * @property string $start_date
 * @property string $end_date
 * @property string $featured_image
 * @property string $featured_teaser
 * @property integer $active
 */
class FeaturedPromotion extends CActiveRecord
{
	const LEVEL_ACTIVATED=1, LEVEL_DEACTIVATED=0;
	private $_start_date;
	private $_end_date;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FeaturedPromotion the static model class
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
		return 'tbl_featured_promotion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_promotion, active', 'required'),
			array('id_promotion, active', 'numerical', 'integerOnly'=>true),
			array('featured_image', 'length', 'max'=>255),
			array('start_date, end_date, featured_teaser', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_featured, id_promotion, start_date, end_date, featured_image, featured_teaser, active', 'safe', 'on'=>'search'),
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
			'promotion' => array(self::BELONGS_TO, 'Promotion', 'id_promotion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_featured' => 'Id Featured',
			'id_promotion' => 'Promotion',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'featured_image' => 'Featured Image',
			'featured_teaser' => 'Featured Teaser',
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

		$criteria->compare('id_featured',$this->id_featured);
		$criteria->compare('id_promotion',$this->id_promotion);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('featured_image',$this->featured_image,true);
		$criteria->compare('featured_teaser',$this->featured_teaser,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			$this->_end_date = strtotime($this->end_date);
	    $this->end_date = date('Y-m-d H:i:s', $this->_end_date);
			$this->_start_date = strtotime($this->start_date);
	    $this->start_date = date('Y-m-d H:i:s', $this->_start_date);
			return true;
		}
		else
			return false;
	}
	
	/**
	 * @return string the URL that shows the detail of the promotion
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('featuredpromotion/view', array('id'=>$this->id_promotion,'title'=>$this->promotion->title,));
	}
}