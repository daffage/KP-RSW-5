<?php 
session_start();
include('header.php');
$loginError = '';
if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
	include 'valid.php';
	$valid = new valid();
	$user = $valid->loginUsers($_POST['email'], $_POST['pwd']); 
	if(!empty($user)) {
		$_SESSION['user'] = $user[0]['first_name']."".$user[0]['last_name'];
		$_SESSION['userid'] = $user[0]['id'];
		$_SESSION['email'] = $user[0]['email'];		
		$_SESSION['address'] = $user[0]['address'];
		$_SESSION['mobile'] = $user[0]['mobile'];
		header("Location:list_data.php");
	} else {
		$loginError = "Email Atau Kata Sandi Salah !";
	}
}
?>
<title>Bandwidth Validation</title>
<body background="batik.jpg">
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">

<div class="row ">	
	<div class="demo-heading ">
		<h1 ></h1>
		<br></br>
		<br></br>
	</div>
	<div class="container">	
	<div class="row">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4">
		<h2 >Masuk</h2>	
		<form method="post" action="">
			<div class="form-group">
			<?php if ($loginError ) { ?>
				<div class="alert alert-warning"><?php echo $loginError; ?></div>
			<?php } ?>
			</div>
			<div class="form-group">
				<input name="email" id="email" type="email" class="form-control" placeholder="Alamat Email" autofocus="" required>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="pwd" placeholder="Kata Sandi" required>
			</div>  
			<div class="form-group">
				<button type="submit" name="login" class="btn btn-danger">Masuk</button>
			</div>
		</form>
		<br>
		<p><b>Email</b> : Namawitel@admin<br><b>Password</b> : Namawitel</p>			
	</div>		
</div>		
</div>
<?php include('footer.php');?>