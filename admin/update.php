<?php
include "../config/dbConfig.php";
$id=$_GET['id'];
$appointment=$_GET['appointment'];
$mechanic = $_GET['mechanic'];


$sql = "SELECT COUNT(*) as counter FROM booking WHERE mechanic='$mechanic' AND appointment='$appointment'";
$data = mysqli_fetch_assoc(mysqli_query($db, $sql));

if($data['counter']>=4){
    $response['error'] = true;
    $response['msg']="The Mechanic is Booked. Please select different date !";
}else{
    $sql_in = "UPDATE booking SET mechanic='$mechanic', appointment='$appointment' WHERE id='$id'";
    if(mysqli_query($db, $sql_in)){
        $response['error'] = false;
        $response['msg']="Booking Updated. Mechanic: ".$mechanic." Appointment: ".$appointment;
    }else{
        $response['error'] = true;
        $response['msg']="Something Went Wrong";
    }

}

echo json_encode($response);
?>