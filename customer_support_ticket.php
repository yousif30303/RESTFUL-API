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


//Get header Authorization
 
function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}

//get access token from header

function getBearerToken() {
$headers = getAuthorizationHeader();
// HEADER: Get the access token from the header
if (!empty($headers)) {
    if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
        return $matches[1];
    }
}
return null;
}

//get the token
$jwt1 = getBearerToken();

$secretKey = 'grhktgjfdhliedcmiolrsyih';


try {
    //decode JWT and getting user_id
    $decoded = JWT::decode($jwt1, $secretKey, array('HS512'));
    $user_id = $decoded->user_id;
    
    // print Access is granted in case user authorized 
    echo json_encode(array(
        "message" => "user authenticated",
    ));
    
    //get the data from json
    $data = json_decode(file_get_contents("php://input"));
    $Message = $data->Message;
 
    //insert the data into the table
    $sql = "INSERT INTO customer_support_ticket (`user_id`, `Message`) VALUES ('$user_id', '$Message')";

//excute the query
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
        exit;
    }

}catch (Exception $e){

  echo json_encode(array(
    "message" => "Access denied.",
    "error" => $e->getMessage()
));
}
?>