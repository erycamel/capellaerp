<?php
$this->widget('ToolbarButton',array('cssToolbar'=>'buttongrid','isEdit'=>true,'id'=>$model->genjournalid,
'isApprove'=>true,
	'isDelete'=>true,'isDownload'=>true));
?>
<div id="tabledata">
<div class="rowdata">
	<span class="cell">ID</span>
    <span class="cell"><?php echo $model->genjournalid;?></span>
</div>
<div class="rowdata">
	<span class="cell">Journal No</span>
    <span class="cell"><?php echo $model->journalno;?></span>
</div>
<div class="rowdata">
	<span class="cell">Reference No</span>
    <span class="cell"><?php echo $model->referenceno;?></span>
</div>
<div class="rowdata">
	<span class="cell">Journal Date</span>
    <span class="cell"><?php echo $model->journaldate;?></span>
</div>
<div class="rowdata">
	<span class="cell">Post Date</span>
    <span class="cell"><?php echo $model->postdate;?></span>
</div>
<div class="rowdata">
	<span class="cell">Journal Note</span>
    <span class="cell"><?php echo $model->journalnote;?></span>
</div>
<div class="rowdata">
	<span class="cell">Status</span>
    <span class="cell"><?php echo Wfstatus::model()->findstatusname("appjournal",$model->recordstatus);?></span>
</div>
<div class="rowdata">
<span class="cell">Journal Detail</span>
<span class="cellcontent">
<div id='tabledetail'>
<?php $customeraddress = Journaldetail::model()->findallbyattributes(array('genjournalid'=>$model->genjournalid)); 
echo "<div class='rowheader'>";
 echo "<span class='celldetail'>Account</span>";
 echo "<span class='celldetail'>Debit</span>";
 echo "<span class='celldetail'>Credit</span>";
 echo "<span class='celldetail'>Rate</span>";
 echo "<span class='celldetail'>Detail Note</span>";
 echo "</div>";

foreach ($customeraddress as $sa)
{
 echo "<div class='rowdetail'>";
 echo "<span class='celldetail'>".$sa->account->accountcode." (".$sa->account->accountname.")</span>";
 echo "<span class='celldetailnumeric'>".$sa->currency->symbol.$sa->debit."</span>";
 echo "<span class='celldetailnumeric'>".$sa->currency->symbol.$sa->credit."</span>";
 echo "<span class='celldetailnumeric'>".Company::model()->getsymbol().$sa->ratevalue."</span>";
 echo "<span class='celldetail'>".$sa->detailnote."</span>";
 echo "</div>";
}
if (isset($sa))
{
echo "<div class='rowdetail'>";
 echo "<span class='celldetail'>Total</span>";
 echo "<span class='celldetailnumeric'>".Company::model()->getsymbol().$sa->getTotalDebit()."</span>";
 echo "<span class='celldetailnumeric'>".Company::model()->getsymbol().$sa->getTotalCredit()."</span>";
 echo "<span class='celldetailnumeric'></span>";
 echo "<span class='celldetail'></span>";
 echo "</div>";
 }
?>
</div>
</span>
</div>
</div>

