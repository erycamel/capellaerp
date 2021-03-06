<?php

/**
 * This is the model class for table "useraccess".
 *
 * The followings are the available columns in table 'useraccess':
 * @property integer $useraccessid
 * @property string $username
 * @property string $realname
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Abstrans[] $abstrans
 * @property Usergroup[] $usergroups
 */
class Useraccess extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Useraccess the static model class
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
		return 'useraccess';
	}

	public $id;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, realname, salt, email,recordstatus', 'required'),
			array('recordstatus,languageid', 'numerical', 'integerOnly'=>true),
			array('username,theme,background', 'length', 'max'=>50),
			array('realname, email', 'length', 'max'=>100),
			array('password, salt', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('useraccessid, username, realname, password,theme,salt, languageid,email, recordstatus', 'safe', 'on'=>'search'),
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
			'usergroups' => array(self::HAS_MANY, 'Usergroup', 'useraccessid'),
			'language' => array(self::BELONGS_TO, 'Language', 'languageid'),
		);
	}
	
	public function getformatdate()
	{
		$formatdate = 'dd-mm-yyyy';
		$menu = Language::model()->findbysql("select formatdate 
		from useraccess a 
		inner join language b on b.languageid = a.languageid
		where lower(username) = '".Yii::app()->user->id."'");
		if ($menu != null)
		{
			$formatdate = $menu->formatdate;
		}
		return $formatdate;
	}
	
	public function getformatqty()
	{
		$formatdate = '#,##0.00';
		$menu = Language::model()->findbysql("select formatqty 
		from useraccess a 
		inner join language b on b.languageid = a.languageid
		where lower(username) = '".Yii::app()->user->id."'");
		if ($menu != null)
		{
			$formatdate = $menu->formatdate;
		}
		return $formatdate;
	}
	
	public function getformatcurrency()
	{
		$formatdate = '#,##0.0000';
		$menu = Language::model()->findbysql("select formatcurrency 
		from useraccess a 
		inner join language b on b.languageid = a.languageid
		where lower(username) = '".Yii::app()->user->id."'");
		if ($menu != null)
		{
			$formatdate = $menu->formatdate;
		}
		return $formatdate;
	}
	
	public function getformatdec()
	{
		$formatdate = '.';
		$menu = Language::model()->findbysql("select formatdec 
		from useraccess a 
		inner join language b on b.languageid = a.languageid
		where lower(username) = '".Yii::app()->user->id."'");
		if ($menu != null)
		{
			$formatdate = $menu->formatdate;
		}
		return $formatdate;
	}
	
	public function getformatperiod()
	{
		$formatdate = '.';
		$menu = Language::model()->findbysql("select formatperiod 
		from useraccess a 
		inner join language b on b.languageid = a.languageid
		where lower(username) = '".Yii::app()->user->id."'");
		if ($menu != null)
		{
			$formatdate = $menu->formatdate;
		}
		return $formatdate;
	}
	
	public function getqtydecimal()
	{
		$formatdate = '.';
		$menu = Language::model()->findbysql("select qtydecimal 
		from useraccess a 
		inner join language b on b.languageid = a.languageid
		where lower(username) = '".Yii::app()->user->id."'");
		if ($menu != null)
		{
			$formatdate = $menu->formatdate;
		}
		return $formatdate;
	}
	
	public function getcurrdecimal()
	{
		$formatdate = '.';
		$menu = Language::model()->findbysql("select currdecimal 
		from useraccess a 
		inner join language b on b.languageid = a.languageid
		where lower(username) = '".Yii::app()->user->id."'");
		if ($menu != null)
		{
			$formatdate = $menu->formatdate;
		}
		return $formatdate;
	}
	
	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'useraccessid' => 'Data',
			'username' => 'User',
			'realname' => 'Real',
			'password' => 'Password',
			'salt' => 'Salt',
			'email' => 'Email',
			'recordstatus' => 'Record Status',
			'languageid'=>'Language',
			'theme'=>'Theme',
			'background'=>'Background'
		);
	}
	
	private function comparedb($criteria)
	{
		if (isset($_GET['realname']))
{
	$criteria->compare('realname',$_GET['realname'],true);
}
		if (isset($_GET['username']))
{
	$criteria->compare('username',$_GET['username'],true);
}
if (isset($_GET['theme']))
{
	$criteria->compare('theme',$_GET['theme'],true);
}
if (isset($_GET['background']))
{
	$criteria->compare('theme',$_GET['background'],true);
}
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
$criteria->with=array('language');
$this->comparedb($criteria);
		$criteria->compare('useraccessid',$this->useraccessid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('language.languagename',$this->languageid,true);
		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->with=array('language');
		$criteria->condition='t.recordstatus>=1';
		$this->comparedb($criteria);
		$criteria->compare('useraccessid',$this->useraccessid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('language.languagename',$this->languageid,true);
		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

  /**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
	  if ($salt == '') {
		$salt = $this->generateSalt();
	  }
		return md5($salt.$password);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	public function generateSalt()
	{
		return uniqid('',true);
	}

  /**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}
}