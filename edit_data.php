<?php 
session_start();
include('header.php');
include 'valid.php';
$valid = new valid();
$valid->checkLoggedIn();
if(!empty($_POST['witel']) && $_POST['witel'] && !empty($_POST['invoiceId']) && $_POST['invoiceId']) {	
	$valid->updateInvoice($_POST);	
	
}
if(!empty($_GET['update_id']) && $_GET['update_id']) {
	$Values = $valid->getInvoice($_GET['update_id']);		
	$Items = $valid->getInvoiceItems($_GET['update_id']);		
}
?>
<title>Validasi Bandwidth</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>

<div class="container content-invoice">

    	<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate=""> 
	    	<div class="load-animate animated fadeInUp">
		    	<div class="row">
		    		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<br></br>
		    			<h1 class="title text-danger"><i class="fas fa-edit" style="font-size:30px;color:danger"></i > Masukan Data</h1>
						<br></br>
						
		    		</div>		    		
		    	</div>
		      	<input id="currency" type="hidden" value="$">
		    	<div class="row">
		      			
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		      			<div class="form-group">
							Witel<input value="<?php echo $Values['witel']; ?>" type="text" class="form-control" name="witel" id="witel" placeholder="Masukkan Nama WITEL" autocomplete="off" >
						</div>
						<div class="form-group">
							Site Name<input value="<?php echo $Values['site_name']; ?>" type="text" class="form-control" name="sitename" id="sitename" placeholder="Masukkan Site Name" autocomplete="off" readonly>
						</div>
						<div class="form-group">
							Site ID<input value="<?php echo $Values['site_id']; ?>" type="text" class="form-control" name="siteid" id="siteid" placeholder="Masukkan Site ID" autocomplete="off" readonly>
						</div>
						<div class="form-group">
							GPON<input value="<?php echo $Values['gpon']; ?>" type="text" class="form-control" name="gpon" id="gpon" placeholder="Masukkan Gpon" autocomplete="off">
						</div>
						<div class="form-group">
							GPON Port<input value="<?php echo $Values['gpon_port']; ?>" type="text" class="form-control" name="gpon_port" id="gpon_port" placeholder="Masukkan Gpon Port" autocomplete="off">
						</div>
						<div class="form-group">
							METRO<input value="<?php echo $Values['metro']; ?>" type="text" class="form-control" name="metro" id="metro" placeholder="Masukkan Metro" autocomplete="off">
						</div>
						<div class="form-group">
							METRO Port<input value="<?php echo $Values['metro_port']; ?>" type="text" class="form-control" name="metro_port" id="metro_port" placeholder="Masukkan Gpon" autocomplete="off">
						</div>
						<div class="form-group">
							MAC Address<input value="<?php echo $Values['mac']; ?>" type="text" class="form-control" name="mac" id="mac" placeholder="Masukkan MAC Address" autocomplete="off">
						</div>
		      		</div>
		      	</div>
		      	<div class="row">
				  <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				  <h1 class="title"></h1>
				  <br></br>
		      			<table class="table table-striped table-hover table-bordered" id="invoiceItem">	
							<tr class="bg-danger" align="center">
							<th width="1%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="12%" class="text-white">Service</th>
							<th width="13%" class="text-white">VLAN</th>
							<th width="17%" class="text-white">Bandwidth GPON</th>
							<th width="17%" class="text-white">Bandwidth GPON</th>
							<th width="17%" class="text-white">Bandwidth METRO</th>
							<th width="16%" class="text-white">Status</th>
							</tr>
							<?php 
							$count = 0;
							foreach($Items as $Item){
								$count++;
							?>								
							<tr class="bg-active" align="center">
							<td><input class="itemRow" type="checkbox"></td>
							<td><select class="form-control" name="pilihan_service[]">
                          	<option value="<?php echo $Item["pilihan_service"]; ?>" id="pilihan_service_<?php echo $count; ?>" name="pilihan_service[]"><?php echo $Item["pilihan_service"]; ?></option>
                          	<option value="4G" id="pilihan_service_<?php echo $count; ?>" name="pilihan_service[]">4G</option>
                          	<option value="3G" id="pilihan_service_<?php echo $count; ?>" name="pilihan_service[]">3G</option>
                          	<option value="2G" id="pilihan_service_<?php echo $count; ?>" name="pilihan_service[]">2G</option>
                   	 		</select></td>
							<td><input type="text" value="<?php echo $Item["vlan"]; ?>" name="vlan[]" id="vlan_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" value="<?php echo $Item["bwGpon_up"]; ?>" name="bandwidth_gponu[]" id="bandwidth_gponu" class="form-control" placeholder="Uplink" autocomplete="off"></td>	
							<td><input type="text" value="<?php echo $Item["bwGpon_down"]; ?>" name="bandwidth_gpond[]" id="bandwidth_gpond" class="form-control" placeholder="Downlink"  autocomplete="off"></td>
							<td><input type="text" value="<?php echo $Item["bw_metro"]; ?>"name="bandwidth_metro[]" id="bandwidth_metro" class="form-control" autocomplete="off"></td>		
								<td><select class="form-control" name="status[]">
                          	<option value="<?php echo $Item["status"]; ?>" id="status_<?php echo $count; ?>" name="status[]"><?php echo $Item["status"]; ?></option>
                          	<option value="WAIT" id="status_<?php echo $count; ?>" name="status[]">WAIT</option>
                          	<option value="VALIDATED" id="status_<?php echo $count; ?>" name="status[]">VALIDATED</option>
 
                   	 		</select></td>
                      
								
								<input type="hidden" value="<?php echo $Item['order_item_id']; ?>" class="form-control" name="itemId[]">
							</tr>	
							<?php } ?>		
						</table>
		      		</div>
		      	</div>
		      	<div class="row">
				  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 pull-right">
		      			<button class="btn btn-danger delete" id="removeRows" type="button"><i class="far fa-trash-alt" style="font-size:14px;color:white"></i>Hapus Data</button>
		      			<button class="btn btn-secondary" id="addRows" type="button"><i class="fas fa-plus" style="font-size:14px;color:white"></i>Tambah Data</button>
		      		</div>
		      	</div>
		      	<div class="row">	
				  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 pull-right">
		      			
						<br>
						<div class="form-group">
							<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
							<input type="hidden" value="<?php echo $Values['order_id']; ?>" class="form-control" name="invoiceId" id="invoiceId">
							<input data-loading-text="Menyimpan.." type="submit" name="invoice_btn" value="Simpan Data" class="btn btn-primary submit_btn ">
			      		</div>
						  <br></br>
						  <div class="form-group">
							Last Update <?php echo $Item['date']; ?>
						</div>
						
		      		</div>
		      	
		      	</div>
		      	<div class="clearfix"></div>		      	
	      	</div>
		</form>			
    </div>
</div>	
<?php include('footer.php');?>