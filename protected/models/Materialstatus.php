<?php

/**
 * This is the model class for table "materialstatus".
 *
 * The followings are the available columns in table 'materialstatus':
 * @property integer $materialstatusid
 * @property string $materialstatusname
 * @property string $description
 * @property integer $recordstatus
 */
class Materialstatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Materialstatus the static model class
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
		return 'materialstatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('materialstatusname, recordstatus', 'required'),
			array('recordstatus', 'numerical', 'integerOnly'=>true),
			array('materialstatusname', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('materialstatusid, materialstatusname, recordstatus', 'safe', 'on'=>'search'),
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
			'materialstatusid' => 'Data',
			'materialstatusname' => 'Material Status Name',
			'recordstatus' => 'Record Status',
		);
	}
	
	private function comparedb($criteria)
	{
		if (isset($_GET['materialstatusname']))
{
	$criteria->compare('materialstatusname',$_GET['materialstatusname'],true);
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
$this->comparedb($criteria);
		$criteria->compare('materialstatusid',$this->materialstatusid);
		$criteria->compare('materialstatusname',$this->materialstatusname,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

    public function searchwstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$this->comparedb($criteria);
$criteria->condition='recordstatus=1';
		$criteria->compare('materialstatusid',$this->materialstatusid);
		$criteria->compare('materialstatusname',$this->materialstatusname,true);
		$criteria->compare('recordstatus',$this->recordstatus);

		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}
}