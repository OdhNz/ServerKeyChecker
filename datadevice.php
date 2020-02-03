<?php

	//database constants
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'loginandroid_db');
	
	//connecting to database and getting the connection object
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	//creating a query
	$stmt = $conn->prepare("SELECT id, id_device, token, passkey, data, status_batrei FROM data_device;");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $id_device, $token, $passkey, $data, $status_batrei);
	
	$data_device = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['id_device'] = $id_device; 
		$temp['token'] = $token; 
		$temp['passkey'] = $passkey; 
		$temp['data'] = $data; 
		$temp['status_batrei'] = $status_batrei; 
		array_push($data_device, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($data_device);

?>