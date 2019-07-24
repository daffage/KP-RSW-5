<?php



$con = mysqli_connect("localhost","root","","bandwidth_validation");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<?php 
include('header.php');


?>
<title>Bandwidth Validation</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<?php include('container.php');?>
	<div class="container">	
  <br></br>	
	  <h2 class="title text-danger">Validasi Bandwidth</h2>
    <br></br>	
	
    <table id="data-table" class="table table-hover table-bordered table-striped" >
        <thead class="bg-active">
        
          <tr class="bg-danger" align="center">
            <th class="text-white">No</th>
            <th class="text-white">Witel</th>
            <th class="text-white">Site Name</th>
            <th class="text-white">Site ID</th>
            <th class="text-white">Ubah</th>

          </tr>
        </thead>
        <tbody>
<?php 

$count=1;
$nyari = $_GET['nyari'];
$sel_query="Select * from list_data where  site_name like '%".$nyari."%' OR site_id like '%".$nyari."%'  ;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr class="table-active" align="center">
<td><?php echo $row["order_id"]; ?></td>
<td><?php echo $row["witel"]; ?></td>
<td><?php echo $row["site_name"]; ?></td>
<td><?php echo $row["site_id"]; ?></td>
<td><a href="edit_data.php?update_id=<?php echo $row["order_id"]; ?>"><i class="fas fa-edit" style="font-size:20px;color:red"></i></a></td>

<?php $count++; } ?>
</tbody>
      </table>	
</div>	
<?php include('footer.php');?>