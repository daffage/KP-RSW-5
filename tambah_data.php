<?php 
session_start();
include('header.php');
include 'valid.php';
$valid = new valid();
$valid->checkLoggedIn();
if(!empty($_POST['witel']) && $_POST['witel']) {	
	$valid->simpandata($_POST);
	header("Location:list_data.php");	
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
		    			<h1 class="title text-danger"> Masukkan Data</h1>
						<br></br>
					
		    		</div>		    		
		    	</div>
				<input id="currency" type="hidden" value="$">
			    <div class="row">

				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
					<div class="form-group">
					WITEL<input type="text" class="form-control" name="witel" id="witel" placeholder="Masukkan Nama WITEL" autocomplete="off">
					</div>
					<div class="form-group">
					Site Name<input type="text" class="form-control" name="sitename" id="sitename" placeholder="Masukkan Site Name" autocomplete="off">
					</div>
					<div class="form-group">
					Site ID<input type="text" class="form-control" name="siteid" id="siteid" placeholder="Masukkan Site ID" autocomplete="off">
					</div>
					<div class="form-group">
					GPON<input type="text" class="form-control" name="gpon" id="gpon" placeholder="Masukkan GPON" autocomplete="off">
					</div>
					<div class="form-group">
					GPON Port<input type="text" class="form-control" name="gpon_port" id="gpon_port" placeholder="Masukkan GPON Port" autocomplete="off">
					</div>
					<div class="form-group">
					METRO<input type="text" class="form-control" name="metro" id="metro" placeholder="Masukkan METRO" autocomplete="off">
					</div>
					<div class="form-group">
					METRO Port<input type="text" class="form-control" name="metro_port" id="metro_port" placeholder="Masukkan METRO Port" autocomplete="off">
					</div>
					<div class="form-group">
					MAC Address<input type="text" class="form-control" name="mac_address" id="mac_address" placeholder="Masukkan MAC Address" autocomplete="off">
				</div>
			</div>	
			</div>
			<div class="row">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<h2 class="title"></h2>
				<table class="table table-striped table-hover table-bordered" id="invoiceItem">	
					<div class="form-group">
					<tr class="bg-danger" align="center">
							<th width="1%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="12%" class="text-white">Service</th>
							<th width="13%" class="text-white">VLAN</th>
							<th width="17%" class="text-white">Bandwidth GPON</th>
							<th width="17%" class="text-white">Bandwidth GPON</th>
							<th width="17%" class="text-white">Bandwidth METRO</th>
							<th width="16%" class="text-white">Status</th>
							</tr>						
						<tr class="bg-active" align="center"ss>
							<td><input class="itemRow" type="checkbox"></td>
							<td>
							<select class="form-control" name="pilihan_service[]">
                         	<option>Pilih</option>
                          	<option  value="NULL" id="pilihan_service_1" name="pilihan_service[]">---</option>
                          	<option value="4G"id="pilihan_service_1" name="pilihan_service[]">4G</option>
                          	<option value="3G" id="pilihan_service_1" name="pilihan_service[]">3G</option>
                          	<option value="2G" id="pilihan_service_1" name="pilihan_service[]">2G</option>
                   	 		</select>
							</td>
							<td><input type="text" name="vlan[]" id="vlan_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="bandwidth_gponu[]" id="bandwidth_gponu" class="form-control" placeholder="UPLINK" autocomplete="off"></td>	
							<td><input type="text" name="bandwidth_gpond[]" id="bandwidth_gpond" class="form-control" placeholder="DOWNLINK"  autocomplete="off"></td>
							<td><input type="text" name="bandwidth_metro[]" id="bandwidth_metro" class="form-control" autocomplete="off"></td>		
							<td>
							<select class="form-control" name="status[]">
                         	<option>Pilih</option>
                          	<option  value="NULL" id="status_1" name="status[]">---</option>
                          	<option value="WAIT"id="status_1" name="status[]">WAIT</option>
                          	<option value="VALIDATED" id="status_1" name="status[]">VALIDATED</option>
                   	 		</select>
							</td>
						</tr>	








					    </table>  
				    </div>
				</div>
				<div class="row">
				  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 pull-left">
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
						
		      		</div>
		      	
		      	</div>
		      	<div class="clearfix"></div>		      	
	      	</div>
		</form>			
    </div>
</div>	
<?php include('footer.php');?>