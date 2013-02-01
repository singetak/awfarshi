<?php

/**
 * This is the model class for table "tbl_region".
 *
 * The followings are the available columns in table 'tbl_region':
 * @property integer $id_region
 * @property string $name
 * @property integer $id_country
 */
class Region extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Region the static model class
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
		return 'tbl_region';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, country_id', 'required'),
			array('id_country', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_region, name, id_country', 'safe', 'on'=>'search'),
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
			'id_region' => 'ID',
			'name' => Yii::t('zii','Name'),
			'id_country' => Yii::t('zii','Country'),
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

		$criteria->compare('id_region',$this->region_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('id_country',$this->country_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * @param id of the country the regions related that should be returned
	 * @return array of the regions
	 */
	public function getAllRegions($countryId)
	{
		$data = $this->findAll(array(
			'condition'=>'id_country='.$countryId . ' and id_country<>0',
			'order'=>'name ASC',
		));
		$data = CHtml::listData($data,'id_region','name');
		$data[0] = "Unknown";
		return $data;
	}
}