<?php

/**
 * This is the model class for table "tbl_company".
 *
 * The followings are the available columns in table 'tbl_company':
 * @property integer $id_company
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $website
 * @property string $logo
 */
class Company extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
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
		return 'tbl_company';
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
			array('name', 'length', 'max'=>255),
			array('address', 'length', 'max'=>1000),
			array('phone', 'length', 'max'=>50),
			array('email, website', 'length', 'max'=>75),
			array('logo', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_company, name, address, phone, email, website, logo', 'safe', 'on'=>'search'),
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
			'id_company' => 'Id Company',
			'name' => 'Name',
			'address' => 'Address',
			'phone' => 'Phone',
			'email' => 'Email',
			'website' => 'Website',
			'logo' => 'Logo',
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

		$criteria->compare('id_company',$this->id_company);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('logo',$this->logo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Suggests a list of existing companies matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of tags to be returned
	 * @return array list of matching tag names
	 */
	public function suggestCompanies($keyword = '',$limit=20)
	{
		$sql= 'SELECT id_company as id ,name AS label FROM tbl_company WHERE name LIKE :keyword';
        $keyword = $keyword.'%';
				
        return Yii::app()->db->createCommand($sql)->queryAll(true,array(':keyword'=>$keyword));
	}
}