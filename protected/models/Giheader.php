<?php

/**
 * This is the model class for table "genjournal".
 *
 * The followings are the available columns in table 'genjournal':
 * @property integer $genjournalid
 * @property string $gino
 * @property string $journaldate
 * @property string $journalnote
 * @property integer $recordstatus
 *
 * The followings are the available model relations:
 * @property Journaldetail[] $journaldetails
 */
class Giheader extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Genjournal the static model class
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
		return 'giheader';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('recordstatus', 'required'),
			array('recordstatus,deliveryadviceid,soheaderid', 'numerical', 'integerOnly'=>true),
			array('gino,location', 'length', 'max'=>50),
array('headernote','length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('giheaderid, gino, gidate,postdate, soheaderid,recordstatus,deliveryadviceid,location,headernote', 'safe', 'on'=>'search'),
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
			'gidetail' => array(self::HAS_MANY, 'Gidetail', 'giheaderid'),
      'deliveryadvice' => array(self::BELONGS_TO, 'Deliveryadvice', 'deliveryadviceid'),
      'soheader' => array(self::BELONGS_TO, 'Soheader', 'soheaderid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'giheaderid' => 'ID',
			'gino' => 'GI No',
			'gidate' => 'GI Date',
			'postdate' => 'Post Date',
			'recordstatus' => 'Record Status',
            'deliveryadviceid'=>'Form Request (Goods/Service/Delivery)',
            'location'=>'Location',
			'headernote'=>'Header Note',
			'soheaderid'=>'Sales Order'
		);
	}

        public function beforeSave() {
		if ($this->gidate !== null)
		{
			$this->gidate = date(Yii::app()->params['datetodb'], strtotime($this->gidate));
			$this->postdate = $this->gidate;
		}
    return parent::beforeSave();
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
$criteria->with=array('deliveryadvice','soheader');
		$criteria->compare('giheaderid',$this->giheaderid);
		$criteria->compare('gino',$this->gino,true);
		$criteria->compare('gidate',$this->gidate,true);
		$criteria->compare('postdate',$this->postdate,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('t.headernote',$this->headernote,true);
		$criteria->compare('deliveryadvice.dano',$this->deliveryadviceid,true);
		$criteria->compare('soheader.sono',$this->soheaderid,true);


		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

	public function searchwfstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->with=array('deliveryadvice','soheader');
$criteria->condition="t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listgi') and upper(e.username)=upper('".Yii::app()->user->name."'))";
		$criteria->compare('giheaderid',$this->giheaderid);
		$criteria->compare('gino',$this->gino,true);
		$criteria->compare('gidate',$this->gidate,true);
		$criteria->compare('postdate',$this->postdate,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('deliveryadvice.dano',$this->deliveryadviceid,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('t.headernote',$this->headernote,true);
		$criteria->compare('soheader.sono',$this->soheaderid,true);


		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}

    public function searchwfgstatus()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
$criteria->with=array('deliveryadvice','soheader');
$criteria->condition="t.recordstatus in (select b.wfbefstat
from workflow a
inner join wfgroup b on b.workflowid = a.workflowid
inner join groupaccess c on c.groupaccessid = b.groupaccessid
inner join usergroup d on d.groupaccessid = c.groupaccessid
inner join useraccess e on e.useraccessid = d.useraccessid
where upper(a.wfname) = upper('listgi') and upper(e.username)=upper('".Yii::app()->user->name."') and gino is not null)";
		$criteria->compare('giheaderid',$this->giheaderid);
		$criteria->compare('gino',$this->gino,true);
		$criteria->compare('gidate',$this->gidate,true);
		$criteria->compare('postdate',$this->postdate,true);
		$criteria->compare('deliveryadvice.dano',$this->deliveryadviceid,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('t.headernote',$this->headernote,true);
		$criteria->compare('soheader.sono',$this->soheaderid,true);

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
		$criteria->condition='recordstatus=1';
		$criteria->compare('giheaderid',$this->giheaderid);
		$criteria->compare('gino',$this->gino,true);
		$criteria->compare('gidate',$this->gidate,true);
		$criteria->compare('postdate',$this->postdate,true);
		$criteria->compare('recordstatus',$this->recordstatus);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('t.headernote',$this->headernote,true);


		return new CActiveDataProvider(get_class($this), array(
'pagination'=>array(
        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    ),
			'criteria'=>$criteria,
		));
	}
}