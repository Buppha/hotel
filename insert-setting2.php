<?php

include './connect.php';
    session_start();
    $hotel_id = $_SESSION["name_hotel"];

    $ty_room = $_POST['ty_room']; 
    $ty_name = $_POST['ty_name']; //ประเภทห้องพัก
	$bed = $_POST['bed'];
   
    $price = $_POST['price']; //ราคา

 
  
    $q = "INSERT INTO `tb_typeroom`
    (`typeroom_id`, `type_room`, `type_name`,`type_bed`, `price`, `hotelid`) 
    VALUES (Null,'$ty_room','$ty_name','$bed','$price','$hotel_id')";

    mysqli_query($conn,$q);
	   

header("Location: setting2.php");    
  


?>