<?php

/**
 * This is the model class for table "tbl_featured_promotion_mapping".
 *
 * The followings are the available columns in table 'tbl_featured_promotion_mapping':
 * @property integer $id
 * @property integer $id_category
 * @property integer $id_promotion
 */
class FeaturedPromotionMapping extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FeaturedPromotionMapping the static model class
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
		return 'tbl_featured_promotion_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_category, id_promotion', 'required'),
			array('id_category, id_promotion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_category, id_promotion', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'id_category' => 'Id Category',
			'id_promotion' => 'Id Promotion',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_promotion',$this->id_promotion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * @param promotion_id of the category related that should be returned
	 * @return array of the mapped promotions categories
	 */
	public function findMappedPromotions($promotion_id)
	{
		return $this->findAll(array(
			'condition'=>'id_promotion='.$promotion_id,
		));
	}
	/**
	 * @param promotion_id of the category related that should be returned
	 * @delete array of the mapped promotions categories
	 */
	public function deleteMappedPromotions($promotion_id)
	{
		$sql = "Delete from tbl_featured_promotion_mapping where id_promotion =:id";
		$command = Yii::app()->db->createCommand($sql);
		$command->execute(array(':id'=>$promotion_id));
	}
}