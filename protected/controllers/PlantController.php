<?php

class PlantController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
protected $menuname = 'plant';

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Plant;

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
				'plantid'=>$model->plantid,
				'plantcode'=>$model->plantcode,
				'description'=>$model->description,
				'recordstatus'=>$model->recordstatus,
				));
            Yii::app()->end();
        }
      }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Plant'], $_POST['Plant']['plantid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Plant']))
	  {
        $messages = $this->ValidateData(
                array(array($_POST['Plant']['plantcode'],'emptyplantcode','emptystring'),
                array($_POST['Plant']['description'],'emptydescription','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Plant'];
		if ((int)$_POST['Plant']['plantid'] > 0)
		{
		  $model=$this->loadModel($_POST['Plant']['plantid']);
		  $this->olddata = $model->attributes;
			$this->useraction='update';
		  $model->plantcode = $_POST['Plant']['plantcode'];
		  $model->description = $_POST['Plant']['description'];
		  $model->recordstatus = $_POST['Plant']['recordstatus'];
		}
		else
		{
		  $model = new Plant();
		  $model->attributes=$_POST['Plant'];
		  $this->olddata = $model->attributes;
			$this->useraction='new';
		}
		$this->newdata = $model->attributes;
		try
          {
            if($model->save())
            {
			$this->InsertTranslog();
              $this->DeleteLock($this->menuname, $_POST['Plant']['plantid']);
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
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
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
	
	protected function gridData($data,$row)
  {     
    $model = Plant::model()->findByPk($data->plantid); 
    return $this->renderPartial('_view',array('model'=>$model),true); 
  }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	  parent::actionIndex();
		$model=new Plant('search');
	  $model->unsetAttributes();  // clear any default values
	  if(isset($_GET['Plant']))
			$model->attributes=$_GET['Plant'];
	  if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }
	  $this->render('index',array(
		'model'=>$model
	  ));
	}

public function actionDownload()
  {
	parent::actionDownload();
    $sql = "select *
				from plant a ";
		if ($_GET['id'] !== '0') {
				$sql = $sql . "where a.plantid = ".$_GET['id'];
		}
		$command=$this->connection->createCommand($sql);
		$dataReader=$command->queryAll();

		$this->pdf->title='Plant';
		$this->pdf->AddPage('P');

		$this->pdf->colalign=array('C','C','C','C','C','C');
		$this->pdf->setwidths(array(40,60,20,20,20,20));
		$this->pdf->colheader =array('Plant Code','Description');
		$this->pdf->Rowheader();
		$this->pdf->coldetailalign = array('L','L','L','L','L','L');
		foreach($dataReader as $row1)
		{
		  $this->pdf->row(array($row1['plantcode'],$row1['description']));
		}
		// me-render ke browser
		$this->pdf->Output();
  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Plant::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='plant-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
