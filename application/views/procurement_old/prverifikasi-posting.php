<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?#=script('jquery-1.7.2.min.js')?>
<?=script('jquery.easyui.min.js')?>
<?=script('datagrid-detailview.js')?>

<script type="text/javascript">
$(function(){
	
			$('#ver').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					var idpr   = $('#idpr').val();
					ddv.panel({
						border:false,
						cache:true,
						href:"<?=site_url('prverifikasi/show_ver')?>/"+idpr+"/?index="+index,
						onLoad:function(){
							$('#ver').datagrid('fixDetailRowHeight',index);
							$('#ver').datagrid('selectRow',index);
							$('#ver').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#ver').datagrid('fixDetailRowHeight',index);
				}
			});	
	});
			
		//CRUD
		function newItem(){
			$('#ver').datagrid('appendRow',{isNewRecord:true});
			var index = $('#ver').datagrid('getRows').length - 1;
			$('#ver').datagrid('expandRow', index);
			$('#ver').datagrid('selectRow', index);
		}
		
		function saveItem(index){
			var row = $('#ver').datagrid('getRows')[index];
			var url = row.isNewRecord ? '<?=site_url('prverifikasi/save_brg')?>' : '<?=site_url('prverifikasi/update_ver')?>/'+row.id;
			$('#ver').datagrid('getRowDetail',index).find('form').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(data){
					data = eval('('+data+')');
					data.isNewRecord = false;
					$('#ver').datagrid('collapseRow',index);
					$('#ver').datagrid('updateRow',{
						index: index,
						row: data
					});
				}
			});
		}
</script>





 <form action="<?=site_url('prverifikasi/postingpr')?>" method="post">
	<input type="hidden" name="idpr" id="idpr" value="<?=$data->id_pr?>"/>
		<table>
			<tr>
				<td>Budget Name</td>
				<td colspan="3"><input type="text" name="bgtnm" value="<?=$data->description?>" id="bgtnm" size="40" readonly="true"/></td>
			</tr>
			<tr>
				<td>Tgl. PR</td>
				<td><input type="text" name="tglpr" id="tglpr" value="<?=gettgl(); ?>" readonly="true"/></td>
				<td>Amount</td>
				<td><input type="text" name="amountpr" id="amountpr" readonly="true" value="<?=number_format($data->amount)?>" style="text-align:right"/></td>
			</tr>
			<tr>
				<td>&nbsp</td>
				<td>&nbsp</td>
				<td>No. PR</td>
				<td><input type="text" name="nopr" id="nopr" value="<?=$data->no_pr?>" style="width:200px" readonly="true"/></td>
			</tr>
			<tr>
				<td>Divisi</td>
				<td><input type="text" name="divisipr" value="<?=$data->divisi_nm?>" id="divisipr" readonly="true"/></td>
				<td>User Requestor</td>
				<td><input type="text" name="reqpr" id="reqpr" value="<?=$nama?>" readonly="true"/></td>
			</tr>		
			<tr>
				<td>Keterangan</td>
				<td colspan= "3">
				<input type="text" name="ketpr" value="<?=$data->ket_pr?>" id="ketpr" readonly="true" class="xinput validate[required]" >
				</td>
			</tr>
			</table>	


<div class="easyui-tabs" style="width:900px;height:310px;">
	<div title="Posting PR" style="padding:10px;">
		<table id="ver" title="Detail" style="width:900px;height:250px"
				url="<?=site_url('prverifikasi/get_brg')?>/<?=$data->id_pr?>"
				toolbar="#toolbar" pagination="true"
				fitColumns="true" singleSelect="true">
			<thead>	 		
				<tr>			
					<th field="kd" width="80px">Kode Barang</th>				
					<th field="kode" width="110px">Barang Verifikasi</th>				
					<th field="qty" width="40px">Qty</th>
					<th field="satuan" width="50px">Satuan</th>
					<th field="ven" width="120px">Vendor Winner</th>
					<th field="hrg" width="100px">Harga Satuan</th>
					<th field="disc" width="100px">Diskon</th>
					<th field="subtotal" width="100px">Subtotal</th>
					<th field="total" width="100px">Total</th>
				</tr>
			</thead>
		</table>
		<div id="toolbar">
		</div>
	</div>
</div>
	<input type="submit" name="posting" value="Posting PR"/>
</form>





