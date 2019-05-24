<?php 
        include './connect.php';
    date_default_timezone_set("Asia/Bangkok");
 session_start();
 
$hotel_id = $_SESSION['name_hotel'];
$hotel_token = $_SESSION['hotel_token'];
	
	$type_name = $_POST['type_name']; //ชั่วคราว/ค้างคืน
    $room_no = $_POST['name']; //หมายเลขห้อง
    $type_rent = $_POST['type_rent']; //ประเภทห้องพัก
   
    $total_cost = $_POST['price']; //ราคา
    $date_come = date("Y-m-d"); //วันที่เข้าพัก
    $time_come = date("H:i:s"); //เวลาที่เข้าพัก
    $license_plate = $_POST['carnum']; //ป้ายทะเบียน
 
  
$q ="INSERT INTO tb_booking
(`booking_id`, `hotel_d`, `room_no`, `type_rent`, `type_rent_name`, `total_cost`, `date_come`, `time_come`, `date_out`, `time_out`, `license_plate`, `BK_status`, `token`)
 VALUES (Null,'$hotel_id','$room_no','$type_rent','$type_name','$total_cost','$date_come','$time_come',Null,Null,'$license_plate','0','$hotel_token')";

    mysqli_query($conn,$q);
	   echo $q;
	    $message = "\nหมายเลขห้อง : "."$room_no"."\nสถานะห้อง : "."เปิด"."\nเปิดแบบ : "."$type_name"."\nราคา : "."$total_cost"." ฿"."\nวันที่เข้าพัก : "."$date_come"."\nเวลา : "."$time_come";
      //  $token = '0DkXmpupnW5YULKa86aBxV79uvL5mU25kr6Yxyc34Jy';
    $token = $hotel_token ;
    echo send_line_notify($message, $token);

    echo $time_come;
    echo $message;

    $ww ="UPDATE `tb_room` SET `status`='0' WHERE `name`='$room_no'";
    mysqli_query($conn,$ww);

header("Location: User-Home.php");
  
   //LINE Notify
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