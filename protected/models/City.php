<?php

/**
 * This is the model class for table "tbl_city".
 *
 * The followings are the available columns in table 'tbl_city':
 * @property integer $id_city
 * @property string $name
 * @property integer $id_region
 */
class City extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return City the static model class
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
		return 'tbl_city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, id_region', 'required'),
			array('region_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_city, name, id_region', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_city' => 'ID',
			'name' => Yii::t('zii','Name'),
			'id_region' => Yii::t('zii','Region'),
		);
	}
	
	/**
	 * @param id of the region the cities related that should be returned
	 * @return array of the cities
	 */
	public function getAllCities($regionId)
	{
		$data = $this->findAll(array(
			'condition'=>'id_region='.$regionId . ' and id_region<>0',
			'order'=>'name ASC',
		));
		$data = CHtml::listData($data,'id_city','name');
		$data[0] = "Unknown";
		return $data;
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

		$criteria->compare('id_city',$this->city_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('id_region',$this->region_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}