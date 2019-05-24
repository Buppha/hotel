<?php
$conn = mysqli_connect("localhost","root","","hotel") or die("Error: " . mysqli_error($conn));
mysqli_set_charset($conn, "utf8");
date_default_timezone_set("Asia/Bangkok");

      $last_id = "SELECT MAX(id) AS maxid FROM tb_booking"; // query อ่านค่า id สูงสุด
      $res = mysqli_query($conn,$sql); // ทำคำสั่ง
      $ret = mysqli_fetch_assoc($result); // อ่านค่า
      $last_id = $ret['maxid']; // คืนค่า id ที่ insert สูงสุด

      
 ?>