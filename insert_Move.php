<?php

include './connect.php';
    session_start();
    $hotel_id = $_SESSION["name_hotel"];

    $ty_room = $_POST['ty_room']; //ห้องใหม่
    $ty_name = $_POST['tyname']; //ห้องเดิม
	$booking_id = $_POST['booking_id'];
   
echo $ty_room ;
echo $ty_name ;
echo $booking_id ;
echo $hotel_id ;

//อัพเดทห้องใหม่
   
 $q = "UPDATE `tb_booking` 
 SET `room_no`= '$ty_room'
 WHERE `booking_id`= '$booking_id' ";
 mysqli_query($conn,$q);

// ส่งไลน์แจ้งย้าย
 $s = "SELECT * FROM tb_booking
 WHERE booking_id = '$booking_id' ";
$objQuery = mysqli_query($conn,$s);
$rows= mysqli_fetch_array($objQuery);

$tk = $rows['token'];
 $message = "\nหมายเลขห้อง : "."$ty_name"."\nย้ายห้อง"."\nห้องใหม่ : "."$ty_room" ;
 $token = $tk ;
echo send_line_notify($message, $token);

// อัพเดทสถานะห้องเก่าและใหม่
$New = "UPDATE `tb_room` 
SET `status`= '0'
WHERE `hotel`='$hotel_id' AND `name`= '$ty_room' ";
mysqli_query($conn,$New);

$old = "UPDATE `tb_room` 
SET `status`= '1'
WHERE `hotel`='$hotel_id' AND `name`= '$ty_name' ";
mysqli_query($conn,$old);

 header("Location: index.php");    	   
// //LINE Notify
function send_line_notify($message, $token){
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=$message");
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    $headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec( $ch );
    curl_close( $ch );

    return $result;
}


  


?>