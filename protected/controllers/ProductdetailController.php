<?php

class ProductdetailController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
protected $menuname = 'productdetail';

  public $product,$currency,$unitofmeasure,$sloc,$materialstatus,$ownership;

  public function lookupdata()
  {
      	$this->product=new Product('searchwstatus');
	  $this->product->unsetAttributes();  // clear any default values
	  if(isset($_GET['Product']))
		$this->product->attributes=$_GET['Product'];

            	$this->currency=new Currency('searchwstatus');
	  $this->currency->unsetAttributes();  // clear any default values
	  if(isset($_GET['Currency']))
		$this->currency->attributes=$_GET['Currency'];

                  	$this->unitofmeasure=new Unitofmeasure('searchwstatus');
	  $this->unitofmeasure->unsetAttributes();  // clear any default values
	  if(isset($_GET['Unitofmeasure']))
		$this->unitofmeasure->attributes=$_GET['Unitofmeasure'];

      $this->sloc=new Sloc('searchwstatus');
	  $this->sloc->unsetAttributes();  // clear any default values
	  if(isset($_GET['Sloc']))
		$this->sloc->attributes=$_GET['Sloc'];

		      $this->materialstatus=new Materialstatus('searchwstatus');
	  $this->materialstatus->unsetAttributes();  // clear any default values
	  if(isset($_GET['Materialstatus']))
		$this->materialstatus->attributes=$_GET['Materialstatus'];
		
		$this->ownership=new Ownership('searchwstatus');
	  $this->ownership->unsetAttributes();  // clear any default values
	  if(isset($_GET['Ownership']))
		$this->ownership->attributes=$_GET['Ownership'];

  }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	  parent::actionCreate();
	  $this->lookupdata();

		$model=new Productdetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'success',
                'divcreate'=>$this->renderPartial('_form', array('model'=>$model,
                    'product'=>$this->product,
                    'currency'=>$this->currency,
                    'unitofmeasure'=>$this->unitofmeasure,
                    'sloc'=>$this->sloc,
					'materialstatus'=>$this->materialstatus,
					'ownership'=>$this->ownership
				), true)
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
	  $this->lookupdata();
		$id=$_POST['id'];
	  $model=$this->loadModel($id[0]);
 if ($model != null)
      {
        if ($this->CheckDataLock($this->menuname, $id[0]) == false)
        {
          $this->InsertLock($this->menuname, $id[0]);
            echo CJSON::encode(array(
                'status'=>'success',
				'productdetailid'=>$model->productdetailid,
				'productid'=>$model->productid,
				'productname'=>($model->product!==null)?$model->product->productname:"",
				'slocid'=>$model->slocid,
				'slocdesc'=>($model->sloc!==null)?$model->sloc->description:"",
				'buyprice'=>$model->buyprice,
				'buydate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->buydate)),
				'currencyid'=>$model->currencyid,
				'currencyname'=>($model->currency!==null)?$model->currency->currencyname:"",
                'qty'=>Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$model->qty),
				'unitofmeasureid'=>$model->unitofmeasureid,
				'uomcode'=>($model->unitofmeasure!==null)?$model->unitofmeasure->uomcode:"",
				'materialstatusid'=>$model->materialstatusid,
				'materialstatusname'=>($model->materialstatus!==null)?$model->materialstatus->materialstatusname:"",
				'expiredate'=>date(Yii::app()->params['dateviewfromdb'], strtotime($model->expiredate)),
				'location'=>$model->location,
				'picproduct'=>$model->picproduct,
				'location'=>$model->location,
				'ownershipid'=>$model->ownershipid,
				'ownershipname'=>($model->ownership!==null)?$model->ownership->ownershipname:"",
				'recordstatus'=>$model->recordstatus,
				'serialno'=>$model->serialno,
				'picproduct'=>$model->picproduct,
                'div'=>$this->renderPartial('_form', array('model'=>$model,
                    'product'=>$this->product,
                    'currency'=>$this->currency,
                    'unitofmeasure'=>$this->unitofmeasure,
                    'sloc'=>$this->sloc,
					'materialstatus'=>$this->materialstatus,
					'ownership'=>$this->ownership), true)
				));
            Yii::app()->end();
        }
        }
	}

    public function actionCancelWrite()
    {
      $this->DeleteLockCloseForm($this->menuname, $_POST['Productdetail'], $_POST['Productdetail']['productdetailid']);
    }

	public function actionWrite()
	{
	  parent::actionWrite();
	  if(isset($_POST['Productdetail']))
	  {
        $messages = $this->ValidateData(
                array(
                    array($_POST['Productdetail']['productid'],'mmpdemptyproductid','emptystring'),
            )
        );
        if ($messages == '') {
		//$dataku->attributes=$_POST['Productdetail'];
		if ((int)$_POST['Productdetail']['productdetailid'] > 0)
		{
		  $model=$this->loadModel($_POST['Productdetail']['productdetailid']);
		  $model->slocid = $_POST['Productdetail']['slocid'];
		  $model->expiredate = $_POST['Productdetail']['expiredate'];
		  $model->serialno = $_POST['Productdetail']['serialno'];
		  $model->qty = $_POST['Productdetail']['qty'];
		  $model->unitofmeasureid = $_POST['Productdetail']['unitofmeasureid'];
		  $model->picproduct = $_POST['Productdetail']['picproduct'];
		  $model->productid = $_POST['Productdetail']['productid'];
		  $model->materialstatusid = $_POST['Productdetail']['materialstatusid'];
		  $model->location = $_POST['Productdetail']['location'];
		  $model->ownershipid = $_POST['Productdetail']['ownershipid'];
		$model->qty = str_replace(",","",$model->qty);
		}
		else
		{
		  $model = new Productdetail();
		  $model->attributes=$_POST['Productdetail'];
		$model->qty = str_replace(",","",$model->qty);
		}
		try
          {
            if($model->save())
            {
              $this->DeleteLock($this->menuname, $_POST['Productdetail']['productdetailid']);
              $this->GetSMessage('mmpbinsertsuccess');
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
		$id=$_POST['id'];
		foreach($id as $ids)
		{
		  $model=$this->loadModel($ids);
		  $model->recordstatus=0;
		  $model->save();
		}
		echo CJSON::encode(array(
                'status'=>'success',
                'div'=>'Data deleted'
				));
        Yii::app()->end();
	}
	
		public function actionApprove()
	{
            parent::actionApprove();
		$id=$_POST['id'];
		foreach($id as $ids)
		{
			//$model=$this->loadModel($ids);
                    $a = Yii::app()->user->name;
			$connection=Yii::app()->db;
			  $transaction=$connection->beginTransaction();
			  try
			  {
				$sql = 'call ApproveProductDetail(:vid, :vlastupdateby)';
				$command=$connection->createCommand($sql);
				$command->bindvalue(':vid',$ids,PDO::PARAM_INT);
				$command->bindvalue(':vlastupdateby', $a,PDO::PARAM_STR);
				$command->execute();
				$transaction->commit();
				$this->GetSMessage('pprinsertsuccess');
			  }
			  catch(Exception $e) // an exception is raised if a query fails
			  {
				  $transaction->rollBack();
				  $this->GetMessage($e->getMessage());
			  }
		}
        Yii::app()->end();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	  parent::actionIndex();
	  $this->lookupdata();
		$productdetailhist=new Productdetailhist('search');
		$productdetailhist->unsetAttributes();  // clear any default values
		if(isset($_GET['Productdetailhist']))
			$productdetailhist->attributes=$_GET['Productdetailhist'];
		$model=new Productdetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Productdetail']))
			$model->attributes=$_GET['Productdetail'];
			if (isset($_GET['pageSize']))
	  {
		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
		unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
	  }

		$this->render('index',array(
			'model'=>$model,
                    'product'=>$this->product,
                    'currency'=>$this->currency,
                    'unitofmeasure'=>$this->unitofmeasure,
                    'sloc'=>$this->sloc,
					'materialstatus'=>$this->materialstatus,
					'productdetailhist'=>$productdetailhist
		));
	}

	public function actionUpload()
	{
      parent::actionUpload();
	  $folder=$_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/upload/';// folder for uploaded files
	  $allowedExtensions = array("csv");
	  $sizeLimit = (int)Yii::app()->params['sizeLimit'];// maximum file size in bytes
	  $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
	  $result = $uploader->handleUpload($folder,true);
	  $row = 0;
	  if (($handle = fopen($folder.$uploader->file->getName(), "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if ($row>0) {
			  $model=Productdetail::model()->findByPk((int)$data[0]);
			  if ($model=== null) {
				$model = new Productdetail();
			  }
			  $model->productdetailid = (int)$data[0];
			  $model->productid = $data[1];
			  $model->baseuom = $data[2];
			  $model->materialgroupid = (int)$data[3];
			  $model->oldmatno = $data[4];
			  $model->divisionid = (int)$data[5];
			  $model->grossweight = $data[6];
			  $model->weightunit = $data[7];
			  $model->netweight = $data[8];
			  $model->volume = $data[9];
			  $model->volumeunit = (int)$data[10];
			  $model->sizedimension = $data[11];
			  $model->materialpackage = (int)$data[12];
			  $model->recordstatus = (int)$data[13];
			  try
			  {
				if(!$model->save())
				{
				  $errormessage=$model->getErrors();
				  if (Yii::app()->request->isAjaxRequest)
				  {
					echo CJSON::encode(array(
					  'status'=>'failure',
					  'div'=>$errormessage
					));
				  }
				}
			  }
			  catch (Exception $e)
			  {
				$errormessage=$e->getMessage();
				if (Yii::app()->request->isAjaxRequest)
				  {
					echo CJSON::encode(array(
					  'status'=>'failure',
					  'div'=>$errormessage
					));
				  }
			  }
			}
			$row++;
		  }
		  fclose($handle);
	  }
	  $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	  echo $result;
  }

  public function actionGeneratedata()
        {
            if(isset($_POST['id']))
	  {
                $podetail=Grdetail::model()->findbypk($_POST['id']);

                echo CJSON::encode(array(
                'status'=>'success',
				'grno'=>($podetail->grheader!==null)?$podetail->grheader->grno:"",
				'productid'=>$podetail->productid,
				'productname'=>($podetail->product!==null)?$podetail->product->productname:"",
				'slocid'=>$podetail->slocid,
				'slocdesc'=>($podetail->sloc!==null)?$podetail->sloc->description:"",
				'buyprice'=>($podetail->podetail!==null)?$podetail->podetail->netprice:"",
				'buydate'=>$podetail->grheader->grdate,
				'currencyid'=>($podetail->podetail!==null)?$podetail->podetail->currency->currencyid:"",
				'currencyname'=>($podetail->podetail!==null)?$podetail->podetail->currency->currencyname:"",
                'qty'=>"1",
				'unitofmeasureid'=>$podetail->unitofmeasureid,
				'uomcode'=>($podetail->unitofmeasure!==null)?$podetail->unitofmeasure->uomcode:""));
            Yii::app()->end();
            }
        }

	public function actionDownload()
  {
	parent::actionDownload();
    $this->pdf->title='Material Detail List';
    $this->pdf->AddPage('P');
    $this->pdf->setFont('Arial','B',8);

    // menuliskan tabel
	$sql = "select distinct b.productid,b.productname
		from productdetail a
		inner join product b on b.productid = a.productid ";
	if ($_GET['id'] !== '') {
				$sql = $sql . "where a.productdetailid = ".$_GET['id'];
		}
	$command=$this->connection->createCommand($sql);
    $dataReader=$command->queryAll();
 foreach($dataReader as $row)
    {
	$this->pdf->Rect(10,60,190,25);
	      $this->pdf->text(15,$this->pdf->gety()+5,'Material ');$this->pdf->text(50,$this->pdf->gety()+5,': '.$row['productname']);
    $sql1 = "select b.productname,c.description,a.expiredate,a.serialno,a.qty,d.uomcode,a.buydate,
      e.currencyname,a.picproduct,a.location,a.locationdate
      from productdetailhist a
      left join product b on b.productid = a.productid
      left join sloc c on c.slocid = a.slocid
      left join unitofmeasure d on d.unitofmeasureid = a.unitofmeasureid
      left join currency e on e.currencyid = a.currencyid 
	  where a.productid = ".$row["productid"];		

    $command1=$this->connection->createCommand($sql1);
    $dataReader1=$command1->queryAll();

	$this->pdf->sety($this->pdf->gety()+10);
    $this->pdf->colalign = array('C','C','C','C','C','C','C','C','C','C','C','C');
    $this->pdf->setwidths(array(30,20,20,15,20,20,10,35,20));
	$this->pdf->colheader = array('Sloc','Expire Date','Serial No',
	'Qty','UOM','Buy Date','PIC',
        'Location','Loc Date');
    $this->pdf->RowHeader();
    $this->pdf->coldetailalign = array('L','L','L','R','C','L','L','L','L','L','L','L');
    foreach($dataReader1 as $row1)
    {
      $this->pdf->row(array($row1['description'],
		  date(Yii::app()->params["dateviewfromdb"], strtotime($row1['expiredate'])),
          $row1['serialno'],
		  Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$row1['qty']),
          $row1['uomcode'],
		  date(Yii::app()->params["dateviewfromdb"], strtotime($row1['buydate'])),
          $row1['picproduct'],$row1['location'],
		  date(Yii::app()->params["dateviewfromdb"], strtotime($row1['locationdate']))));
    }
      $this->pdf->setFont('Arial','',8);
      $this->pdf->text(10,$this->pdf->gety()+15,'Proposed By');$this->pdf->text(100,$this->pdf->gety()+15,'Approved');
      $this->pdf->text(10,$this->pdf->gety()+30,'----------------------');$this->pdf->text(95,$this->pdf->gety()+30,'----------------------');
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
		$model=Productdetail::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='productdetail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
