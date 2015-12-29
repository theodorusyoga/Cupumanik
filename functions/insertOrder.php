<?php
include('/dbConnection.php');

if(isset($_POST['jsondata'])){
	$jsondata = $_POST['jsondata'];
	try{
		$data = json_decode($jsondata);
		if($data->num_rows > 0){
			while($item = $data->fetch_assoc()){
				
			}
		}
		else{
		
		}
	}
	catch (Exception $e){
		echo false;
		return;
	}
}
	

?>