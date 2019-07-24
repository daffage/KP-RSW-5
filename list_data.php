<?php 
session_start();
include('header.php');
include 'valid.php';
$valid = new valid();
$valid->checkLoggedIn();
?>
<title>Bandwidth Validation</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
	<div class="container">		
  <br></br>
	  <h2 class="title text-danger" align="center">Wilayah Telekomunikasi</h2>
    <br> </br>

     
        <?php		
		$validList = $valid->getwiteldata();
        foreach($validList as $validDetails){

            echo '
            <div class="card-columns">
            <br>

            <a href="list_data2.php?witel='.$validDetails["witel"].'">
            <div class="card bg-danger">
            <div class="card-body ">
            <h4 class="card-title text-center text-light"><i class="fas fa-map-marker-alt" style="font-size:22px;color:danger"></i > '.$validDetails["witel"].'  </h4>
            </div>
        </div>
    </a>
    </div>
            ';
        }       
        ?>
 
     	
     
</div>	
<?php include('footer.php');?>