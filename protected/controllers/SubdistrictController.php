<?php

class SubdistrictController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
protected $menuname = 'subdistrict';

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
		$model=new Subdistrict;

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
				));
            Yii::app()->end();
        }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
	  parent::actionUpdate();
	  $model=$this->loadModel($_POST['id']);
if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $_POST['id']) == false)
        {
          $this->InsertLock($this->menuname, $_POST['id']);
            echo CJSON::encode(array(
                'status'=>'success',
				'subdistrictid'=>$model->subdistrictid,
				'cityid'=>$model->cityid,
                'cityname'=>($model->city!==null)?$model->city->cityname:"",
				'subdistrictname'=>$model->subdistrictname,
				'zipcode'=>$model->zipcode,
				'recordstatus'=>$model->recordstatus,
				));
            Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Subdistrict'], $_POST['Subdistrict']['subdistrictid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Subdistrict']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Subdistrict']['cityid'],'emptycityname','emptystring'),
                array($_POST['Subdistrict']['subdistrictname'],'emptysubdistrictname','emptystring'),
                array($_POST['Subdistrict']['zipcode'],'emptyzipcode','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Subdistrict'];
		if ((int)$_POST['Subdistrict']['subdistrictid'] > 0)
		{
		  $model=$this->loadModel($_POST['Subdistrict']['subdistrictid']);
		  $this->olddata = $model->attributes;
			$this->useraction='update';
		  $model->cityid = $_POST['Subdistrict']['cityid'];
		  $model->subdistrictname = $_POST['Subdistrict']['subdistrictname'];
		  $model->zipcode = $_POST['Subdistrict']['zipcode'];
		  $model->recordstatus = $_POST['Subdistrict']['recordstatus'];
		}
		else
		{
		  $model = new Subdistrict();
		  $model->attributes=$_POST['Subdistrict'];
		  $this->olddata = $model->attributes;
			$this->useraction='new';
		}
		$this->newdata = $model->attributes;
		try
          {
            if($model->save())
            {
			$this->InsertTranslog();
              $this->DeleteLock($this->menuname, $_POST['Subdistrict']['subdistrictid']);
              $this->GetSMessage('insertsuccess');
            }
            else
            {
              $this->GetMessage($model->getErrors());
            }
          }
          catch (Exception $e)
          {
            $this->GetMessage($e->getMessage());
          }
        }
	  }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
	  parent::actionDelete();
		$model=$this->loadModel($_POST['id']);
		  $model->recordstatus=0;
		  $model->save();
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	  parent::actionIndex();
    $model=new Subdistrict('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Subdistrict']))
			$model->attributes=$_GET['Subdistrict'];
if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
		$this->render('index',array(
			'model'=>$model,
		));
	}

  public function actionDownload()
  {
    parent::actionDownload();
    $sql = "select *
				from subdistrict a 
				inner join city b on b.cityid = a.cityid ";
		if ($_GET['id'] !== '0') {
				$sql = $sql . "where a.subdistrictid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		$this->pdf->title='Subdistrict List';
		$this->pdf->AddPage('P');

		$this->pdf->colalign = array('C','C');
		$this->pdf->setwidths(array(60,90));
		$this->pdf->colheader = array('City','Subdistrict Name');
		$this->pdf->RowHeader();
		$this->pdf->coldetailalign = array('L','L');
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['cityname'],$row1['subdistrictname']));
		}
		// me-render ke browser
		$this->pdf->Output();
  }
  
  protected function gridData($data,$row)
  {     
    $model = Subdistrict::model()->findByPk($data->subdistrictid); 
    return $this->renderPartial('_view',array('model'=>$model),true); 
  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Subdistrict::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='subdistrict-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
