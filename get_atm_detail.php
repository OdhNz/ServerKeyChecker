<?php
include 'koneksi.php';
$atmArray = array();
$response = array();
//Check for mandatory parameter id
if(isset($_GET['id'])){
	$id = $_GET['id'];
	//Query to fetch atm details
	$query = "SELECT AtmName FROM data_atm WHERE id=?";
	if($stmt = $con->prepare($query)){
		//Bind id parameter to the query
		$stmt->bind_param("i",$id);
		$stmt->execute();
		//Bind fetched result to variables $AtmName
		$stmt->bind_result($name);
		$stmt->bind_result($imgURL)
		//Check for results		
		if($stmt->fetch()){
			//Populate the atm array
			$atmArray["id"] = $id;
			$atmArray["name"] = $name;
			$atmArray["imgURL"]= $imgURL;
			$response["success"] = 1;
			$response["data"] = $atmArray;
		
		
		}else{
			//When atm is not found
			$response["success"] = 0;
			$response["message"] = "Atm not found";
		}
		$stmt->close();


	}else{
		//Whe some error occurs
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
		
	}

}else{
	//When the mandatory parameter movie_id is missing
	$response["success"] = 0;
	$response["message"] = "missing parameter id";
}
//Display JSON response
echo json_encode($response);
?>