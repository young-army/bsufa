<?php
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>");
	grid.navButtonAdd('#pager',{
		   caption:"Cust.Complaint", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+750+'&height='+450);
		   }, 
		   position:"last"
		})
	.navButtonAdd('#pager',{
		   caption:"Follow Up", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/app/' + id + '/?width='+750+'&height='+400);
			 }else{
				 alert('Pilih Complaint yang akan di Follow Up');
			 }
		   }, 
		   position:"last"
		})
	.navButtonAdd('#pager',{
		   caption:"Print Complaint", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url($module_url)?>" + '/cetakcs/' + id + '/?width='+750+'&height='+400);
			 }else{
				 alert('Pilih Complaint yang akan di cetak');
			 }
		   }, 
		   position:"last"
		})	
	
		
	.navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})
	
});

function cellColumn(cellVal,opts,element){
	if(element.flag_id == 1)
		var newVal = '<span class="customBg" style="background-color:#F596AE">'+cellVal+'</span>';
	else if(element.flag_id == 2)
		var newVal = '<span class="customBg" style="background-color:#FFFF80">'+cellVal+'</span>';
	else if(element.flag_id == 3)
		var newVal = '<span class="customBg" style="background-color:#76F257">'+cellVal+'</span>';
	
	else var newVal = cellVal;
	return newVal;
}



</script>

<style>
.customBg{
	display:block;
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;
}
.customBg2{
	display:block;
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;
}
</style>
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>
<br>
<br>
<div style="left">
<table >
		<tr>
			<td style="background-color:white;width:130px;height:25px" align="center">NOT FOLLOW UP</td>
			<td style="background-color:#F596AE;;width:130px;height:25px">PENDING</td>
			<td style="background-color:#FFFF80;width:130px;height:25px" >ON PROGRESS</td>
			<td style="background-color:#76F257;;width:130px;height:25px">DONE</td>
			
		
			
		</tr>
</table>




</div>



