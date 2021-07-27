<?php

include('../config/dbConfig.php');
session_start();
$response = array();

$pass_c = $_GET['pass_c'];
if($pass_c==5759){
    $_SESSION['logged_in']=true;
    $response['error'] = false;
    $response['msg']="User Logged In. Redirecting Now...";
}else{
    $response['error'] = true;
    $response['msg']="Passcode is wrong. Enter 5759";
}


echo json_encode($response);

?>
