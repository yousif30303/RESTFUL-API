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

include('username change.php');

try {

    $decoded = JWT::decode($jwt, $secretKey, array('HS512'));

    // Access is granted. Add code of the operation here 

    echo json_encode(array(
        "message" => "Access granted:",
        "error" => $e->getMessage()
    ));

}catch (Exception $e){

http_response_code(401);

echo json_encode(array(
    "message" => "Access denied.",
    "error" => $e->getMessage()
));
}
?>