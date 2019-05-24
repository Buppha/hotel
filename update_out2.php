
    <?php
        $conn = mysqli_connect("localhost","root","totkkntotkkn","hotel") or die("Error: " . mysqli_error($conn));
        mysqli_set_charset($conn, "utf8");
        date_default_timezone_set("Asia/Bangkok");
        
        
        $room_no = $_GET['name'];
     

        $ww = "SELECT MAX(booking_id) AS booking_id FROM `tb_booking` WHERE `room_no` = '$room_no'";
        $rr = mysqli_query($conn,$ww);
        $row1 = mysqli_fetch_assoc($rr);

        $booking_id = $row1['booking_id'];

echo $booking_id; 
echo $room_no;

        $nn = "SELECT * FROM `tb_booking` WHERE booking_id = '$booking_id' ";
        $n = mysqli_query($conn,$nn);
        $qpbk = mysqli_fetch_assoc($n);

        $date_out = date("Y-m-d");
        $time_out = date("H:i:s");
 echo  $qpbk['BK_status'];
    

        if ($qpbk['BK_status'] == "0") { 
            // เงื่อนไข สถานะห้อง เท่ากับ เปิด ให้ Update ปรับสถานะให้เป็น ปิด
           // echo "I UPDATE.";
                 
            $sql = "UPDATE tb_booking SET date_out ='$date_out' ,time_out= '$time_out' ,BK_status = '1' WHERE booking_id = '$booking_id' ";
            mysqli_query($conn,$sql);

            $ee = "UPDATE `tb_room` SET `status`='1' WHERE `name`='$room_no'";
            mysqli_query($conn,$ee);
           

            //เมื่อข้อมูลถูกอัพเดทเรียบร้อย จะทำการส่งข้อความเข้า line โรงแรม
            $q = "SELECT * FROM `tb_booking` WHERE `booking_id`= '$booking_id' ";
            $objQuery = mysqli_query($conn,$q);
            $row = mysqli_fetch_assoc($objQuery);
            $room_noo = $row['room_no'];
            $TK = $row['token'];
			
            $message = "\nหมายเลขห้อง : "."$row[room_no]"."\nสถานะห้อง : "."ปิด"."\nเปิดแบบ : "."$row[type_rent_name]"."\nวันที่ออก : "."$row[date_out]"."\nเวลา : "."$row[time_out]";
          //  $token = '0DkXmpupnW5YULKa86aBxV79uvL5mU25kr6Yxyc34Jy';
          $token = $TK ;
           echo send_line_notify($message, $token);
           // echo $message;
            
            
        }
 header("Location:index.php");  

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
