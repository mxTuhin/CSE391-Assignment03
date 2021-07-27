<?php
include "../config/dbConfig.php";
$id=$_GET['id'];

$sql="DELETE FROM booking WHERE id='$id'";
if(mysqli_query($db, $sql)){
    $response['error'] = false;
    $response['msg']="Booking Deleted";
}else{
    $response['error'] = true;
    $response['msg']="Something Went Wrong";
}


echo json_encode($response);
?>