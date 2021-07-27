<?php

include('config/dbConfig.php');
$response = array();

$name = $_GET['name'];
$address= $_GET['address'];
$cellnum = $_GET['cellnum'];
$license = $_GET['license'];
$engine = $_GET['engine'];
$appointment = $_GET['appointment'];
$mechanic = $_GET['mechanic'];

$sql_o="SELECT * FROM booking WHERE license='$license' AND appointment='$appointment'";
$result_o = mysqli_query($db, $sql_o);
if(mysqli_num_rows($result_o)>=1){
    $response['error'] = true;
    $response['msg']="You Have Already Booked Today";
}else{
    $sql = "SELECT COUNT(*) as counter FROM booking WHERE mechanic='$mechanic' AND appointment='$appointment'";
    $data = mysqli_fetch_assoc(mysqli_query($db, $sql));

    if($data['counter']>=4){
        $response['error'] = true;
        $response['msg']="The Mechanic is Booked. Please select different date !";
    }else{
        $sql_in = "INSERT INTO booking (id, name, address, cellnum, license, engine, appointment, mechanic) 
VALUES 
       (NULL, '$name', '$address', '$cellnum', '$license', '$engine', '$appointment', '$mechanic')";
        if(mysqli_query($db, $sql_in)){
            $response['error'] = false;
            $response['msg']="Your Booking is confirmed on: ".$appointment;
        }else{
            $response['error'] = true;
            $response['msg']="Something Went Wrong";
        }

    }
}

echo json_encode($response);
?>