<?php
header('Access-Control-Allow-Origin: *');  
include 'koneksi.php';
//Query to select movie id and movie name
$query = "SELECT * FROM data_atm";
$result = array();
$atmArray = array();
$response = array();
//Prepare the query
if($stmt = $con->prepare($query)){
	$stmt->execute();
	//Bind the fetched data to $movieId and $movieName
	$stmt->bind_result($id,$name,$imgURL);
	//Fetch 1 row at a time					
	while($stmt->fetch()){
		//Populate the movie array
		$atmArray["id"] = $id;
		$atmArray["name"] = $name;
		$atmArray["imgURL"] = $imgURL;
		$result[]=$atmArray;
		
	}
	$stmt->close();
	$response["success"] = 1;
	$response["data"] = $result;
	

}else{
	//Some error while fetching data
	$response["success"] = 0;
	$response["message"] = mysqli_error($con);
		
	
}
//Display JSON response
echo json_encode($response);

?>

