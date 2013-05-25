<?php
$this->breadcrumbs=array(
	'Grheaders',
);
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.autoNumeric.js" ></script>
<script type="text/javascript">
var inputConfig = {aSep:',', aNeg:'-', mDec:2, mRound:'S', mNum:30};
$(function() {
            $('#Grdetail_qty').autoNumeric(inputConfig);
        });	
function refreshdata()
{
    $.fn.yiiGridView.update('datagrid');
    $.fn.yiiGridView.update('indatagrid');
    return false;
}
</script>
<script type="text/javascript">
// here is the magic
function adddata()
{
    <?php echo CHtml::ajax(array(
			'url'=>array('grheader/create'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
				document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog div.divcreate').html(data.div);
					$('#Grheader_grheaderid').val(data.grheaderid);
					$('#Grheader_grno').val('');
					$('#Grheader_grdate').val('');
                                        $('#Grheader_poheaderid').val('');
                                        $('#pono').val('');
                          // Here is the trick: on submit-> once again this function!
document.forms[2].elements[1].value=data.grheaderid;
$.fn.yiiGridView.update('detaildatagrid',{data:{'Grdetail[grheaderid]':data.grheaderid}});
                    $('#createdialog').dialog('open');
                }
                else
                {
                    document.getElementById('messages').innerHTML = data.div;
                }
            } ",
            ))?>;
    return false;
}
</script>
<script type="text/javascript">
function editdata()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('grheader/update'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
document.getElementById('messages').innerHTML = '';
                if (data.status == 'success')
                {
                    $('#createdialog div.divcreate').html(data.div);
					$('#Grheader_grheaderid').val(data.grheaderid);
					$('#Grheader_grno').val(data.grno);
					$('#Grheader_grdate').val(data.grdate);
                                        $('#Grheader_poheaderid').val(data.poheaderid);
                                        $('#pono').val(data.pono);
					if (data.recordstatus == '1') {
                    document.forms[1].elements[5].checked = true;
                } else {
                    document.forms[1].elements[5].checked = false;
                }
document.forms[2].elements[1].value=data.grheaderid;
$.fn.yiiGridView.update('detaildatagrid',{data:{'Grdetail[grheaderid]':data.grheaderid}});
                          // Here is the trick: on submit-> once again this function!
                    $('#createdialog').dialog('open');
                }
                else
                {
                    document.getElementById('messages').innerHTML = data.div;
                }
            } ",
            ))?>;
    return false;
}
</script>
<script type="text/javascript">
function deletedata()
{
    <?php
	echo CHtml::ajax(array(
			'url'=>array('grheader/delete'),
            'data'=> array('id'=>'js:$.fn.yiiGridView.getSelection("datagrid")'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {

            } ",
            ))?>;
	refreshdata();
    return false;
}
</script>
<script type="text/javascript">
function approvedata()
{jQuery.ajax({'url':'/smlive/index.php?r=grheader/approve','data':{'id':$.fn.yiiGridView.getSelection("datagrid")},'type':'post','dataType':'json',
        'success':function(data)
{if (data.status == 'failure')
                {
                document.getElementById('messages').innerHTML = data.div;
            }},'cache':false});;refreshdata();return false;}
</script>
<script type="text/javascript">
function helpdata(value) {
	jQuery.ajax({
        'url': '/smlive/index.php?r=grheader/help',
        'data': {
            'id': value
        },
        'type': 'post',
        'dataType': 'json',
        'success': function(data) {
            if (data.status == 'success') {
				document.getElementById('divhelp').innerHTML = data.div;
                $('#helpdialog').dialog('open');
            } else {
                document.getElementById('messages').innerHTML = data.div;
            }
        },
        'cache': false
    });;
    return false;
}
</script>
<script type="text/javascript">
function showdetail() {
    $.fn.yiiGridView.update('indatagrid', {
                    data: {
                        'Grdetail[grheaderid]': $.fn.yiiGridView.getSelection("datagrid")[0]
                    }
                });
    return false;
}
</script>
<script type="text/javascript">
function downloaddata() {
	window.open('/smlive/index.php?r=grheader/download&id='+$.fn.yiiGridView.getSelection("datagrid"));
}
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'createdialog',
    'options'=>array(
        'title'=>'Form Dialog',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divcreate"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model,
					'poheader'=>$poheader,
					'grdetail'=>$grdetail,
    'giheader'=>$giheader)); ?>
<?php $this->endWidget();?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'helpdialog',
    'options'=>array(
        'title'=>'Help',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'auto',
        'height'=>'auto',
    ),
));?>
<div id="divhelp"></div>
<?php $this->endWidget();?>
<h1>Transaction: Goods Received</h1>
<div id="toolbar">
<ul>
<?php
$imgcreate=CHtml::image(Yii::app()->request->baseUrl.'/images/create.png');
echo CHtml :: openTag('li');
echo CHtml::link($imgcreate,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{adddata()}",
	'title'=>Yii::t('app','create data')
));
echo CHtml :: closeTag('li');

$imgedit=CHtml::image(Yii::app()->request->baseUrl.'/images/edit.png');
echo CHtml :: openTag('li');
echo CHtml::link($imgedit,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{editdata()}",
	'title'=>Yii::t('app','edit data')
));
echo CHtml :: closeTag('li');

$imgapprove=CHtml::image(Yii::app()->request->baseUrl.'/images/approve.png');
echo CHtml :: openTag('li');
echo CHtml::link($imgapprove,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{approvedata()}",
   'title'=>Yii::t('app','approve data')
));
echo CHtml :: closeTag('li');

$imgdelete=CHtml::image(Yii::app()->request->baseUrl.'/images/delete.png');
echo CHtml :: openTag('li');
echo CHtml::link($imgdelete,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{deletedata()}",
   'title'=>Yii::t('app','delete data')
));
echo CHtml :: closeTag('li');

$imgdown=CHtml::image(Yii::app()->request->baseUrl.'/images/down.png');
echo CHtml :: openTag('li');
echo CHtml::link($imgdown,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
    'onclick'=>"{downloaddata()}",
   'title'=>Yii::t('app','download data')
));
echo CHtml :: closeTag('li');

$imgrefresh=CHtml::image(Yii::app()->request->baseUrl.'/images/refresh.png');
echo CHtml :: openTag('li');
echo CHtml::link($imgrefresh,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{refreshdata()}",
   'title'=>Yii::t('app','refresh data')
));
echo CHtml :: closeTag('li');

$imghelp=CHtml::image(Yii::app()->request->baseUrl.'/images/help.png');
echo CHtml :: openTag('li');
echo CHtml::link($imghelp,'#',array(
   'style'=>'cursor: pointer; text-decoration: underline;',
   'onclick'=>"{helpdata(1)}",
   'title'=>Yii::t('app','help')
));
echo CHtml :: closeTag('li');
?>
<div class="recordpage">Record/page<?php echo CHtml::textField($pageSize,'',array('size'=>'5',
        // change 'user-grid' to the actual id of your grid!!
        'onchange'=>"$.fn.yiiGridView.update('datagrid',{ data:{pageSize: $(this).val() }})",
	  ));  ?></div></ul></div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'datagrid',
	'dataProvider'=>$model->Searchwfstatus(),
	'filter'=>$model,
    'selectionChanged'=>'showdetail',
  'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
    array(
      'class'=>'CCheckBoxColumn',
      'id'=>'ids',
    ),
	array('name'=>'grheaderid', 'visible'=>false,'header'=>'ID','value'=>'$data->grheaderid','htmlOptions'=>array('width'=>'1%')),
		'grno',
        array(
      'name'=>'grdate',
      'type'=>'raw',
         'value'=>'date(Yii::app()->params["dateviewfromdb"], strtotime($data->grdate))'
     ),
	array('name'=>'poheaderid', 'value'=>'($data->poheader!==null)?$data->poheader->pono:""'),
//	array('name'=>'poheaderid', 'header'=>'Supplier','value'=>'($data->poheader!==null)?($data->poheader->supplier!==null?$data->poheader->supplier->fullname:""):""'),
	array('name'=>'giheaderid', 'value'=>'($data->giheader!==null)?$data->giheader->gino:""'),
	array('header'=>'Status','value'=>'Wfstatus::model()->findstatusname("appgr",$data->recordstatus)')
  ),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indatagrid',
	'dataProvider'=>$grdetail->search(),
  'selectableRows'=>1,
	'template'=>'{pager}<br>{items}{pager}',
	'columns'=>array(
	array('name'=>'grdetailid', 'visible'=>false,'header'=>'ID','value'=>'$data->grdetailid','htmlOptions'=>array('width'=>'1%')),
	array('name'=>'productid','value'=>'($data->product!==null)?$data->product->productname:""'),
	array('name'=>'unitofmeasureid','value'=>'($data->unitofmeasure!==null)?$data->unitofmeasure->uomcode:""'),
	 array(
      'name'=>'qty',
      'type'=>'raw',
         'value'=>'Yii::app()->numberFormatter->format(Yii::app()->params["defaultnumberqty"],$data->qty)',
     ),
	array('name'=>'slocid','value'=>'($data->sloc!==null)?$data->sloc->description:""'),
  ),
));
?>
