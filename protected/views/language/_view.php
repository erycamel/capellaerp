<?php
$this->widget('ToolbarButton',array('cssToolbar'=>'buttongrid','isEdit'=>true,'id'=>$model->languageid,
	'isDelete'=>true,'isDownload'=>true));
?>
<div id="tabledata">
<div class="rowdata">
	<span class="cell">ID</span>
    <span class="cellcontent"><?php echo $model->languageid;?></span>
</div>
<div class="rowdata">
	<span class="cell">Language</span>
    <span class="cellcontent"><?php echo $model->languagename;?></span>
</div>
<div class="rowdata">
	<span class="cell">Date Format</span>
    <span class="cellcontent"><?php echo $model->formatdate;?></span>
</div>
</div>