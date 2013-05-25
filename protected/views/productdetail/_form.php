<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'productdetail-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->hiddenField($model,'productdetailid'); ?>
    <table>
      <tr>
        
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'productid'); ?>
<?php echo $form->hiddenField($model,'productid'); ?>
	  <input type="text" name="sched_name" id="productname" title="Enter Schedule name" readonly >
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
      'dataProvider'=>$product->search(),
      'filter'=>$product,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_product",
          "id" => "send_product",
          "onClick" => "$(\"#product_dialog\").dialog(\"close\"); $(\"#productname\").val(\"$data->productname\"); $(\"#Productdetail_productid\").val(\"$data->productid\");
		  "))',
          ),
	array('name'=>'productid', 'visible'=>false,'value'=>'$data->productid','htmlOptions'=>array('width'=>'1%')),
        'productname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#product_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'productid'); ?>
	</div>
        </td>
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'slocid'); ?>
		<?php echo $form->hiddenField($model,'slocid'); ?>
	  <input type="text" name="sched_name" id="slocdesc" title="Enter Schedule name" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'sloc_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Material Master'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'sloc-grid',
      'dataProvider'=>$sloc->search(),
      'filter'=>$sloc,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_product",
          "id" => "send_product",
          "onClick" => "$(\"#sloc_dialog\").dialog(\"close\"); $(\"#slocdesc\").val(\"$data->description\");
          $(\"#Productdetail_slocid\").val(\"$data->slocid\");
		  "))',
          ),
	array('name'=>'slocid', 'visible'=>false,'value'=>'$data->slocid','htmlOptions'=>array('width'=>'1%')),
        'sloccode',
          'description',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#sloc_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'slocid'); ?>
	</div>
        </td>
		<td>
          <div class="row">
		<?php echo $form->labelEx($model,'expiredate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'attribute'=>'expiredate',
              'model'=>$model,
              // additional javascript options for the date picker plugin
             'options'=>array(
                  'showAnim'=>'fold',
				  'dateFormat'=>Yii::app()->params['dateviewcjui'],
				  'changeYear'=>true,
				  'changeMonth'=>true,
                                  'yearRange'=>'1900:+50'
              ),
              'htmlOptions'=>array(
                  'style'=>'height:20px',
                  'size'=>'10',
              ),
          ));?>
		<?php echo $form->error($model,'expiredate'); ?>
	</div>
        </td>
      </tr>
      <tr>        
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'serialno'); ?>
		<?php echo $form->textField($model,'serialno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'serialno'); ?>
	</div>
        </td>
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'qty'); ?>
		<?php echo $form->textField($model,'qty',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'qty'); ?>
	</div>
        </td>
		<td>
          <div class="row">
		<?php echo $form->labelEx($model,'unitofmeasureid'); ?>
		<?php echo $form->hiddenField($model,'unitofmeasureid'); ?>
	  <input type="text" name="sched_name" id="uomcode" title="Enter Schedule name" readonly>
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'unitofmeasure_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Material Master'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'unitofmeasure-grid',
      'dataProvider'=>$unitofmeasure->search(),
      'filter'=>$unitofmeasure,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_unitofmeasure",
          "id" => "send_unitofmeasure",
          "onClick" => "$(\"#unitofmeasure_dialog\").dialog(\"close\"); $(\"#uomcode\").val(\"$data->uomcode\"); $(\"#Productdetail_unitofmeasureid\").val(\"$data->unitofmeasureid\");
		  "))',
          ),
	array('name'=>'unitofmeasureid', 'visible'=>false,'value'=>'$data->unitofmeasureid','htmlOptions'=>array('width'=>'1%')),
        'uomcode',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#unitofmeasure_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'unitofmeasureid'); ?>
	</div>
        </td>
      </tr>
      <tr>        
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'picproduct'); ?>
		<?php echo $form->textField($model,'picproduct'); ?>
		<?php echo $form->error($model,'picproduct'); ?>
	</div>
        </td>
        <td>
          <div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location'); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>
        </td>
		<td>
           <div class="row">
		<?php echo $form->labelEx($model,'materialstatusid'); ?>
		<?php echo $form->hiddenField($model,'materialstatusid'); ?>
	  <input type="text" name="sched_name" id="materialstatusname" title="Enter Schedule name" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'materialstatus_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Material Status'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'materialstatus-grid',
      'dataProvider'=>$materialstatus->search(),
      'filter'=>$materialstatus,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_currency",
          "id" => "send_currency",
          "onClick" => "$(\"#materialstatus_dialog\").dialog(\"close\"); $(\"#materialstatusname\").val(\"$data->materialstatusname\"); 
		  $(\"#Productdetail_materialstatusid\").val(\"$data->materialstatusid\");
		  "))',
          ),
	array('name'=>'materialstatusid', 'visible'=>false,'value'=>'$data->materialstatusid','htmlOptions'=>array('width'=>'1%')),
        'materialstatusname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#materialstatus_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'materialstatusid'); ?>
	</div>
        </td>
      </tr>
	  <tr>
	  <td>
          <div class="row">
		<?php echo $form->labelEx($model,'ownershipid'); ?>
		<?php echo $form->hiddenField($model,'ownershipid'); ?>
	  <input type="text" name="ownershipname" id="ownershipname" title="Enter Schedule name" readonly >
    <?php
      $this->beginWidget('zii.widgets.jui.CJuiDialog',
       array(   'id'=>'ownership_dialog',
                // additional javascript options for the dialog plugin
                'options'=>array(
                                'title'=>Yii::t('app','Ownership'),
                                'width'=>'auto',
                                'autoOpen'=>false,
                                'modal'=>true,
                                ),
                        ));

    $this->widget('zii.widgets.grid.CGridView', array(
      'id'=>'ownership-grid',
      'dataProvider'=>$ownership->search(),
      'filter'=>$ownership,
      'template'=>'{summary}{pager}<br>{items}{pager}{summary}',
      'columns'=>array(
        array(
          'header'=>'',
          'type'=>'raw',
        /* Here is The Button that will send the Data to The MAIN FORM */
          'value'=>'CHtml::Button("+",
          array("name" => "send_product",
          "id" => "send_product",
          "onClick" => "$(\"#ownership_dialog\").dialog(\"close\"); $(\"#ownershipname\").val(\"$data->ownershipname\");
          $(\"#Productdetail_ownershipid\").val(\"$data->ownershipid\");
		  "))',
          ),
	array('name'=>'ownershipid', 'visible'=>false,'value'=>'$data->ownershipid','htmlOptions'=>array('width'=>'1%')),
        'ownershipname',
        ),
    ));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    echo CHtml::Button('...',
                          array('onclick'=>'$("#ownership_dialog").dialog("open"); return false;',
                       ))?>
		<?php echo $form->error($model,'ownershipid'); ?>
	</div>
        </td>
		<td>
			<div class="row">
			<?php echo $form->labelEx($model,'recordstatus'); ?>
			<?php echo $form->checkBox($model,'recordstatus'); ?>
			<?php echo $form->error($model,'recordstatus'); ?>
			</div>
		</td>
	  </tr>
    </table>
	<table>
      <tr>
        <td colspan="2" align="center">
		<?php echo CHtml::ajaxSubmitButton('Save',
		array('productdetail/write'),
	  array(
	  'success'=>'function(data)
		{
			var x = eval("(" + data + ")");
			document.getElementById("messages").innerHTML = x.div;
			if (x.status == "success")
			{
			  $.fn.yiiGridView.update("datagrid");
			  $("#createdialog").dialog("close");
              document.getElementById("messages").innerHTML = "";
			}
        }')); ?>
		<?php echo CHtml::ajaxSubmitButton('Cancel',
		array('productdetail/cancelwrite'),
	  array(
	  'success'=>'function(data)
		{
			var x = eval("(" + data + ")");
			document.getElementById("messages").innerHTML = x.div;
			if (x.status == "success")
			{
			  $.fn.yiiGridView.update("datagrid");
			  $("#createdialog").dialog("close");
              document.getElementById("messages").innerHTML = "";
			}
        }')); ?>
        </td>
      </tr>
    </table>
<?php $this->endWidget(); ?>

</div><!-- form -->