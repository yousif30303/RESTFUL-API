<?php
//making connection to database
$link = mysqli_connect("localhost", "root", "", "sign up");
if(mysqli_connect_error()){
    die('ERROR: Unable to connect:' . mysqli_connect_error()); 
}

?>