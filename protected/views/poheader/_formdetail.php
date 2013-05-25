<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'podetail-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<?php echo $form->hiddenField($model,'podetailid'); ?>
<?php echo $form->hiddenField($model,'poheaderid'); ?>
	<div id="tabledata">
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'prdetailid'); ?>
<?php echo $form->hiddenField($model,'prdetailid'); ?></span>
            <span class="cell"><input type="text" name="prno" id="prno" style="width: 250px" readonly>
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'pr_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Purchase Requisition'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'pr-grid',
      'dataProvider'=>$prheader->searchwfqtystatus(),
      'filter'=>$prheader,
	  	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/main.css'),
'cssFile' => Yii::app()->theme->baseUrl . '/css/main.css',
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#pr_dialog\").dialog(\"close\");
          $(\"#Podetail_productid\").val(\"$data->productid\");
          $(\"#Podetail_prdetailid\").val(\"$data->prmaterialid\");
          generatedata();
		  "))',
          ),
	array('name'=>'prmaterialid', 'visible'=>false,'value'=>'$data->prmaterialid'),
          array('name'=>'prheaderid', 'header'=>'PR Date','value'=>'($data->prheader!==null)?date(Yii::app()->params["dateviewfromdb"], strtotime($data->prheader->prdate)):""'),
          array('name'=>'prheaderid', 'value'=>'($data->prheader!==null)?$data->prheader->prno:""'),
          array('name'=>'productid', 'header'=>'Product Name','value'=>'($data->product!==null)?$data->product->productname:""'),
        array(
      'name'=>'qty',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->qty - $data->poqty)',
     ),
          array('name'=>'unitofmeasureid', 'header'=>'UOM Code','value'=>'($data->unitofmeasure!==null)?$data->unitofmeasure->uomcode:""'),
          array('name'=>'requestedbyid','header'=>'Requested By Code','value'=>'($data->requestedby!==null)?$data->requestedby->description:""'),
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("pr-grid");$("#pr_dialog").dialog("open"); return false;',
                       ))?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'productid'); ?>
<?php echo $form->hiddenField($model,'productid'); ?></span>
	  <span class="cell"><input type="text" name="productname" id="productname" style="width: 250px" readonly >
	  <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'product_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Material Master'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'product-grid',
      'dataProvider'=>$product->searchwstatus(),
      'filter'=>$product,
	  	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/main.css'),
'cssFile' => Yii::app()->theme->baseUrl . '/css/main.css',
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#product_dialog\").dialog(\"close\");
          $(\"#Podetail_productid\").val(\"$data->productid\");
          $(\"#productname\").val(\"$data->productname\");
		  "))',
          ),
	array('name'=>'productid', 'visible'=>false,'value'=>'$data->productid'),
	'productname'
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$.fn.yiiGridView.update("product-grid");$("#product_dialog").dialog("open"); return false;',
                       ))?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'poqty'); ?></span>
		<span class="cell"><?php echo $form->textField($model,'poqty'); ?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'unitofmeasureid'); ?></span>
<?php echo $form->hiddenField($model,'unitofmeasureid'); ?>
	  <span class="cell"><input type="text" name="product_name" id="uomcode" title="Account name" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'uom_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Unit of Measure'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'uom-grid',
      'dataProvider'=>$unitofmeasure->Searchwstatus(),
      'filter'=>$unitofmeasure,
	  	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/main.css'),
'cssFile' => Yii::app()->theme->baseUrl . '/css/main.css',
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#uom_dialog\").dialog(\"close\"); $(\"#uomcode\").val(\"$data->uomcode\"); $(\"#Podetail_unitofmeasureid\").val(\"$data->unitofmeasureid\");
		  "))',
          ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid'),
        'uomcode',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#uom_dialog").dialog("open"); return false;',
                       ))?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'netprice'); ?></span>
		<span class="cell"><?php echo $form->textField($model,'netprice'); ?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'currencyid'); ?>
<?php echo $form->hiddenField($model,'currencyid'); ?></span>
	  <span class="cell"><input type="text" name="product_name" id="currencyname" title="Account name" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'curr_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Currency'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'curr-grid',
      'dataProvider'=>$currency->Searchwstatus(),
      'filter'=>$currency,
	  	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/main.css'),
'cssFile' => Yii::app()->theme->baseUrl . '/css/main.css',
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#curr_dialog\").dialog(\"close\"); $(\"#currencyname\").val(\"$data->currencyname\"); $(\"#Podetail_currencyid\").val(\"$data->currencyid\");
		  "))',
          ),
	array('name'=>'currencyid', 'visible'=>false,'value'=>'$data->currencyid'),
        'currencyname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#curr_dialog").dialog("open"); return false;',
                       ))?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'ratevalue'); ?></span>
		<span class="cell"><?php echo $form->textField($model,'ratevalue'); ?></span>
	</div>
<div class="rowdata">
<span class="cell">
		<?php echo $form->labelEx($model,'slocid'); ?>
<?php echo $form->hiddenField($model,'slocid'); ?></span>
	  <span class="cell"><input type="text" name="sloccode" id="sloccode" title="Account name" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'sloc_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Storage Location'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'sloc-grid',
      'dataProvider'=>$sloc->Searchwstatus(),
      'filter'=>$sloc,
	  	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/main.css'),
'cssFile' => Yii::app()->theme->baseUrl . '/css/main.css',
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#sloc_dialog\").dialog(\"close\"); $(\"#sloccode\").val(\"$data->sloccode\"); $(\"#Podetail_slocid\").val(\"$data->slocid\");
		  "))',
          ),
	array('name'=>'slocid', 'visible'=>false,'value'=>'$data->slocid'),
        'sloccode',
          'description',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#sloc_dialog").dialog("open"); return false;',
                       ))?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'taxid'); ?>
<?php echo $form->hiddenField($model,'taxid'); ?></span>
	  <span class="cell"><input type="text" name="product_name" id="taxcode" title="Account name" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'req_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Tax'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'sloc-grid',
      'dataProvider'=>$tax->Searchwstatus(),
      'filter'=>$tax,
	  	'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/main.css'),
'cssFile' => Yii::app()->theme->baseUrl . '/css/main.css',
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_absschedule",
          "id" => "send_absschedule",
          "onClick" => "$(\"#req_dialog\").dialog(\"close\"); $(\"#taxcode\").val(\"$data->taxcode\"); $(\"#Podetail_taxid\").val(\"$data->taxid\");
		  "))',
          ),
	array('name'=>'taxid', 'visible'=>false,'value'=>'$data->taxid'),
        'taxcode',
          'description',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#req_dialog").dialog("open"); return false;',
                       ))?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'delvdate'); ?></span>
		<span class="cell"><?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'delvdate',
              'model'=>$model,
              // additional javascript options for the date picker plugin
              'options'=>array(
                  'showAnim'=>'fold',
				  'dateFormat'=>Yii::app()->params['dateviewcjui'],
              ),
              'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'15',
              ),
          ));?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'itemtext'); ?></span>
		<span class="cell"><?php echo $form->textArea($model,'itemtext',array('rows'=>6, 'cols'=>30)); ?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'underdelvtol'); ?></span>
		<span class="cell"><?php echo $form->textField($model,'underdelvtol'); ?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo $form->labelEx($model,'overdelvtol'); ?></span>
		<span class="cell"><?php echo $form->textField($model,'overdelvtol'); ?></span>
	</div>
<div class="rowdata">
<span class="cell"><?php echo CHtml::ajaxSubmitButton('Save',
		array('poheader/writedetail'),
	  array(
	  'success'=>'function(data)
		{
			var x = eval("(" + data + ")");
			if (x.status == "success")
			{
				$.fn.yiiGridView.update("datagrid");
				$("#createdialog").dialog("close");
				toastr.info(x.div);
			}
			else
			{
				toastr.error(x.div);
			}
        }')); ?><?php echo CHtml::ajaxSubmitButton('Cancel',
		array('poheader/cancelwritedetail'),
	  array(
	  'success'=>'function(data)
		{
			var x = eval("(" + data + ")");
			if (x.status == "success")
			{
				$.fn.yiiGridView.update("datagrid");			  
				$("#createdialog").dialog("close");
				toastr.info(x.div);
			}
			else
			{
				toastr.error(x.div);
			}
        }')); ?></span>
</div>
</div>  
<?php $this->endWidget(); ?>
</div><!-- form -->