<?php

include './connect.php';
    session_start();
    $hotel_id = $_SESSION["name_hotel"];

    $ty_name = $_POST['ty_name']; //???????????
    $ty_room = $_POST['ty_room']; //?????????????
$price = $_POST['price'];
$bed = $_POST['bed'];
   
    $id = $_POST['id'];

 
  
    $q = "UPDATE `tb_typeroom` SET `type_room`= '$ty_room'
				,`type_bed`= '$bed'
				,`type_name`= '$ty_name'

				,`price`= '$price'
				,`hotelid`= '$hotel_id'
			WHERE typeroom_id= '$id' " ;

    mysqli_query($conn,$q);
	   

header("Location: setting2.php");    
  


?>