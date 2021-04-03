<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



require_once("vendor/autoload.php"); 

use \Firebase\JWT\JWT;

//import database file
include('connection.php');

//get the data from json
$data = json_decode(file_get_contents("php://input"));

$email = $data->email;
$password = $data->password;

//Run query: Check combinaton of email & password exists
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
        //If email & password don't match print error
$count = mysqli_num_rows($result);
if($count !== 1){
    echo '<div class="alert alert-danger">Wrong Username or Password</div>';
}



else{
    //fetching the user data from database
    $item = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $first_name = $item['first_name'];
    $last_name = $item['last_name'];
    $email = $item['email'];
    $Role = $item['Role'];

    //secret key for signing the JWT payload 
    $secretKey  = 'grhktgjfdhliedcmiolrsyih';
    
    //adding PAYLOAD DATA
    $data = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email'  => $email,       
        'Role' => $Role,     
    ];
    //making JWT token
    $jwt = JWT::encode(
        $data,
        $secretKey,
        'HS512'
    );
    //printing the jwt to see the result
    echo $jwt;
}

?>