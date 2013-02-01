<?php

/**
 * This is the model class for table "tbl_users".
 *
 * The followings are the available columns in table 'tbl_users':
 * @property integer $userID
 * @property string $username
 * @property string $password
 * @property integer $groupID
 * @property string $email
 * @property string $dateCreated
 * @property string $dateModified
 * @property string $displayName
 * @property string $firstName
 * @property string $lastName
 * @property string $id_country
 * @property string $id_region
 * @property string $id_city
 * @property string $phone
 * @property string $avatar
 * @property string $lastLogin
 * @property integer $type
 * @property integer $active
 * @property integer $roles
 * @property integer $latitude
 * @property integer $longitude
 * @property integer $map_zoom_level
 */
class Users extends CActiveRecord
{
	//define the number of levels that you need
	const LEVEL_REGISTERED=0, LEVEL_AUTHOR=1, LEVEL_ADMIN=5, LEVEL_SUPERADMIN=10;
	const LEVEL_ACTIVATED=1, LEVEL_DEACTIVATED=0;
	const LEVEL_NORMAL=0, LEVEL_BATEEKH=1;
	
	private $_dateCreated;
	private $_dateModified;
	private $_lastLogin;
	private $_salt = "afgdsgafsgagds234123dsfd";
	public $UseAfterfind=false;
	
	public $PasswordConfirm;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'tbl_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username,email,displayName,firstName,lastName,password', 'required'),
			array('email,username,displayName', 'unique'),
			array('PasswordConfirm', 'required','on'=>'insert'),
			array('groupID, active, roles,type,id_country,id_city,id_region', 'numerical', 'integerOnly'=>true),
			array('username, email, displayName', 'length', 'max'=>100),
			array('firstName, lastName', 'length', 'max'=>50),
			array('phone', 'length', 'max'=>20),
			array('dateCreated,lastLogin,dateModified,latitude,longitude,map_zoom_level', 'safe'),
			array('latitude,longitude', 'numerical'),
            array('map_zoom_level', 'numerical', 'integerOnly'=>true),
			array('password', 'length', 'max'=>100,'min'=>4,'on'=>'insert'),
			array('password', 'compare', 'compareAttribute'=>'username','operator'=>'!=', 'message'=>'Password must not be the same as username','on'=>'insert,update'),
			array('password', 'compare', 'compareAttribute'=>'PasswordConfirm','message'=>'Please enter the same password twice.', 'on'=>'insert'),
			array('avatar', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'insert,update'),
			array('avatar', 'length', 'max'=>255, 'on'=>'insert,update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userID, username, groupID, email, dateCreated, displayName,dateModified, firstName, lastName,id_city,id_region, id_country,type', 'safe', 'on'=>'search'),
		);
	}
	
	//define the label for each level Role
	static function getRolesList($level = null){
		$levelList=array(
			self::LEVEL_REGISTERED => 'Registered',
			self::LEVEL_AUTHOR => 'Author',
			self::LEVEL_ADMIN => 'Administrator',
			self::LEVEL_SUPERADMIN => 'Super Administrator'
		);
		if( $level === null)
			return $levelList;
		return $levelList[$level];
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
	//define the label for each level Role
	static function getTypeList($level = null){
		$levelList=array(
			self::LEVEL_NORMAL => 'Normal',
			self::LEVEL_BATEEKH => 'Bateekh'
		);
		if( $level === null)
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
			'posts' => array(self::HAS_MANY, 'posts', 'userID'),
			'postsCount' => array(self::STAT, 'posts', 'userID'),
			'country' => array(self::BELONGS_TO, 'Country',array('id_country'=>'id_country')),
			'region' => array(self::BELONGS_TO, 'Region',array('id_region'=>'id_region')),
			'city' => array(self::BELONGS_TO, 'City',array('id_city'=>'id_city')),
			//'country' => array(self::HAS_ONE, 'Country', 'country'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userID' => Yii::t('zii','User'),
			'username' => Yii::t('zii','Username'),
			'password' => Yii::t('zii','Password'),
			'PasswordConfirm' => Yii::t('zii','Confirm Password'),
			'groupID' => 'Group',
			'email' => Yii::t('zii','Email'),
			'dateCreated' => Yii::t('zii','Date Created'),
			'dateModified' => Yii::t('zii','Date Modified'),
			'displayName' => Yii::t('zii','Display Name'),
			'firstName' => Yii::t('zii','First Name'),
			'lastName' => Yii::t('zii','Last Name'),
			'id_country' => Yii::t('zii','Country'),
			'id_region' => Yii::t('zii','Region'),
			'id_city' => Yii::t('zii','City'),
			'phone' => Yii::t('zii','Phone'),
			'avatar' => Yii::t('zii','Avatar'),
			'lastLogin' => Yii::t('zii','Last Login'),
			'type' => Yii::t('zii','Type'),
			'active' => Yii::t('zii','Active'),
			'roles' => Yii::t('zii','Role'),
			'latitude' => Yii::t('zii','latitude'),
			'longitude' => Yii::t('zii','longitude'),
			'map_zoom_level' => Yii::t('zii','map_zoom_level'),
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

		$criteria->compare('userID',$this->userID);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('groupID',$this->groupID);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('dateCreated',$this->dateCreated,true);
		$criteria->compare('dateModified',$this->dateModified,true);
		$criteria->compare('displayName',$this->displayName,true);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('id_country',$this->id_country,true);
		$criteria->compare('id_region',$this->id_region,true);
		$criteria->compare('id_city',$this->id_city,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('lastLogin',$this->lastLogin,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('active',$this->active);
		$criteria->compare('roles',$this->roles);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
	{
		return $this->hashPassword($password)===$this->password;
		//return $password===$this->password;
	}
	public function hashPassword($password)
	{
		return md5($this->_salt.$password);
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->dateCreated=$this->lastLogin=$this->dateModified=date('Y-m-d H:i:s',time());
				//$this->userID=Yii::app()->user->id;
			}
			else{
				$this->dateModified=date('Y-m-d H:i:s',time());
			}
			if($this->password != '')
				$this->password = $this->hashPassword($this->password);
			return true;
		}
		else
			return false;
	}
	
	protected function afterFind()
	{
		if($this->UseAfterfind){
	        $this->_dateModified = strtotime($this->dateModified);
	        $this->dateModified = date('d/m/Y h:i:s', $this->_dateModified);
	        $this->_lastLogin = strtotime($this->lastLogin);
	        $this->lastLogin = date('d/m/Y h:i:s', $this->_lastLogin);
	        $this->_dateCreated = strtotime($this->dateCreated);
	        $this->dateCreated = date('d/m/Y h:i:s', $this->_dateCreated);
	        $this->_lastLogin = strtotime($this->lastLogin);
	        $this->lastLogin = date('d/m/Y h:i:s', $this->_lastLogin);
        }
		parent::afterFind();
	}
	
	/**
	 * @param integer the maximum number of posts that should be returned
	 * @return array the most recently added posts
	 */
	public function findRecentNotaireUsers()
	{
		return $this->findAll(array(
			'condition'=>'active='.self::LEVEL_ACTIVATED .' and type = ' . self::LEVEL_NOTAIRE ,
			'order'=>'lastName ASC,firstName ASC,displayName ASC',
		));
	}
}