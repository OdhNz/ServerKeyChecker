<?php
/* header('Access-Control-Allow-Origin: *');  
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
echo json_encode($response); */

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
	$stmt = $conn->prepare("SELECT id, title, shortdesc, rating, location, image FROM atms;");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $title, $shortdesc, $rating, $location, $image);
	
	$atms = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['title'] = $title; 
		$temp['shortdesc'] = $shortdesc; 
		$temp['rating'] = $rating; 
		$temp['location'] = $location; 
		$temp['image'] = $image; 
		array_push($atms, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($atms);

?>

