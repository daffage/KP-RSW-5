<?php 
session_start();
include('header.php');
include 'valid.php';
$valid = new valid();
$valid->checkLoggedIn();

if(!empty($_GET['witel']) && $_GET['witel']) {
	$Values = $valid->getListdata($_GET['witel']);			
}
?>
<title>Bandwidth Validation</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
	<div class="container">		
  <br></br>
	  <h2 class="title text-danger">Validasi Bandwidth</h2>
    <br></br>
	  


</form>
      <table id="data-table" class="table table-hover table-bordered table-striped " >
        <thead class="bg-active">
        
          <tr class="bg-danger" align="center">
        
            <th class="text-white">Witel</th>
            <th class="text-white">Site Name</th>
            <th class="text-white">Site ID</th>
            <th class="text-white">Ubah</th>
  
          </tr>
        </thead>
        <?php		
		
        foreach($Values as $validDetails){

            echo '
              <tr class="table-active" align="center">
         
                <td>'.$validDetails["witel"].'</td>
                <td>'.$validDetails["site_name"].'</td>
                <td>'.$validDetails["site_id"].'</td>
                <td><a href="edit_data.php?update_id='.$validDetails["order_id"].'"  title="Ubah Data"><i class="fas fa-edit" style="font-size:20px;color:red"></i></a></td>
                
              </tr>
            ';
        }       
        ?>
      </table>	
</div>	
<?php include('footer.php');?>