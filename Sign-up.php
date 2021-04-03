<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

//import database file
include('connection.php');

//get the data from json
$data = json_decode(file_get_contents("php://input"));

$first_name = $data->first_name;
$last_name = $data->last_name;
$email = $data->email;
$password = $data->password;
$Role = $data->Role;

//insert the data into the table
$sql = "INSERT INTO users (`first_name`, `last_name`, `email`, `password`, `Role`) VALUES ('$first_name', '$last_name', '$email', '$password', '$Role')";

//excute the query
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
    exit;
}
?>
