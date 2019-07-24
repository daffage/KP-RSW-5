 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr align="center">';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
		htmlRows += '<td><select class="form-control" name="pilihan_service[]"><option>Pilih</option><option  value="NULL" id="pilihan_service_'+count+'" name="pilihan_service[]">---</option><option value="4G"id="pilihan_service_'+count+'" name="pilihan_service[]">4G</option><option value="3G" id="pilihan_service_'+count+'" name="pilihan_service[]">3G</option> <option value="2G" id="pilihan_service_'+count+'" name="pilihan_service[]">2G</option></select></td>';
		htmlRows += '<td><input type="text" name="vlan[]" id="vlan_'+count+'" class="form-control" autocomplete="off"></td>'; 
		htmlRows += '<td><input type="text" name="bandwidth_gponu[]" id="bandwidth_gponu'+count+'" class="form-control" placeholder="Uplink" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="bandwidth_gpond[]" id="bandwidth_gpond'+count+'" class="form-control" placeholder="Downlink" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="bandwidth_metro[]" id="bandwidth_metro'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><select class="form-control" name="status[]"><option>Pilih</option><option  value="NULL" id="status_'+count+'" name="status[]">---</option><option value="WAIT"id="status_'+count+'" name="status[]">WAIT</option><option value="VALIDATED" id="status_'+count+'" name="status[]">VALIDATED</option></select></td>';   		  
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
		
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		

	
$('.btn').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 8000);
});

	


	$(document).on('click', '.deleteInvoice', function(){
		var id = $(this).attr("id");
		if(confirm("Apakah Yakin Akan Menghapus?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});	


 