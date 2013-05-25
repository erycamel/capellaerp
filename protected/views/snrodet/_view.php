<?php
$this->widget('ToolbarButton',array('cssToolbar'=>'buttongrid','isEdit'=>true,'id'=>$model->snrodid,
	'isDelete'=>true,'isDownload'=>true));
?>
<div id="tabledata">
<div class="rowdata">
	<span class="cell">ID</span>
    <span class="cellcontent"><?php echo $model->snrodid;?></span>
</div>
<div class="rowdata">
	<span class="cell">Description</span>
    <span class="cellcontent"><?php echo $model->snro->description;?></span>
</div>
<div class="rowdata">
	<span class="cell">Current Day</span>
    <span class="cellcontent"><?php echo $model->curdd;?></span>
</div>
<div class="rowdata">
	<span class="cell">Current Month</span>
    <span class="cellcontent"><?php echo $model->curmm;?></span>
</div>
<div class="rowdata">
	<span class="cell">Current Year</span>
    <span class="cellcontent"><?php echo $model->curyy;?></span>
</div>
<div class="rowdata">
	<span class="cell">Current Value</span>
    <span class="cellcontent"><?php echo $model->curvalue;?></span>
</div>
</div>