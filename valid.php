<?php
class valid{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "bandwidth_validation";   
	private $tabelpengguna = 'pengguna';
	private $tabelwitel = 'list_witel';	
    private $listdata = 'list_data';
	private $invoiceOrderItemTable = 'layanan';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	public function loginUsers($email, $password){
		$sqlQuery = "
			SELECT id, email, first_name, last_name, address, mobile 
			FROM ".$this->tabelpengguna." 
			WHERE email='".$email."' AND password='".$password."'";
        return  $this->getData($sqlQuery);
	}	
	public function checkLoggedIn(){
		if(!$_SESSION['userid']) {
			header("Location:index.php");
		}
	}		
	public function simpandata($POST) {		
		$sqlInsert = "
		INSERT INTO ".$this->listdata."(user_id, witel, site_name, site_id, gpon, gpon_port, metro, metro_port, mac) 
		VALUES ('".$POST['userId']."', '".$POST['witel']."', '".$POST['sitename']."', '".$POST['siteid']."', '".$POST['gpon']."', '".$POST['gpon_port']."', '".$POST['metro']."', '".$POST['metro_port']."', '".$POST['mac']."')";				
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['pilihan_service']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->invoiceOrderItemTable."(order_id, pilihan_service,vlan, bwGpon_up, bwGpon_down, bw_metro, status) 
			VALUES ('".$lastInsertId."', '".$POST['pilihan_service'][$i]."', '".$POST['vlan'][$i]."', '".$POST['bandwidth_gponu'][$i]."', '".$POST['bwandwidth_gpond'][$i]."' ,'".$POST['bandwidth_metro'][$i]."', '".$POST['status'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}       	
	}		
	public function updateInvoice($POST) {
		if($POST['invoiceId']) {	
			$sqlInsert = "
				UPDATE ".$this->listdata." 
				SET witel = '".$POST['witel']."', site_name= '".$POST['sitename']."', site_id = '".$POST['siteid']."', gpon = '".$POST['gpon']."',  gpon_port = '".$POST['gpon_port']."', metro = '".$POST['metro']."', metro_port = '".$POST['metro_port']."', mac = '".$POST['mac']."'
				WHERE user_id = '".$POST['userId']."' AND order_id = '".$POST['invoiceId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);	
		}		
		$this->deleteInvoiceItems($POST['invoiceId']);
		for ($i = 0; $i < count($POST['pilihan_service']); $i++) {			
			$sqlInsertItem = "
				INSERT INTO ".$this->invoiceOrderItemTable."(order_id, pilihan_service, vlan, bwGpon_up, bwGpon_down, bw_metro, status) 
				VALUES ('".$POST['invoiceId']."', '".$POST['pilihan_service'][$i]."', '".$POST['vlan'][$i]."', '".$POST['bandwidth_gponu'][$i]."', '".$POST['bandwidth_gpond'][$i]."', '".$POST['bandwidth_metro'][$i]."', '".$POST['status'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		}       	
	}	
	public function getListdata($witel){
		$sqlQuery = "
			SELECT * FROM ".$this->listdata." 
			WHERE user_id = '".$_SESSION['userid']."' AND witel = '$witel'";
		return  $this->getData($sqlQuery);
	}	
	public function getwiteldata(){
		$sqlQuery = "
			SELECT * FROM ".$this->tabelwitel." 
			WHERE user_id = '".$_SESSION['userid']."'";
		return  $this->getData($sqlQuery);
	}	
	public function getInvoice($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->listdata." 
			WHERE user_id = '".$_SESSION['userid']."' AND order_id = '$invoiceId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getInvoiceItems($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderItemTable." 
			WHERE order_id = '$invoiceId'";
		return  $this->getData($sqlQuery);	
	}
	public function deleteInvoiceItems($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->invoiceOrderItemTable." 
			WHERE order_id = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	public function deleteInvoice($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->listdata." 
			WHERE order_id = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);	
		$this->deleteInvoiceItems($invoiceId);	
		return 1;
	}
}
?>