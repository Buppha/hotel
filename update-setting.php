<?php

include './connect.php';
    session_start();
    $hotel_id = $_SESSION["name_hotel"];

    $name = $_POST['name']; //???????????
    $ty_room = explode("|", $_REQUEST['ty_room']);
        			      $id = $ty_room[0];
       				      $room = $ty_room[1];
				      $bed = $ty_room[2];
   
    $id = $_POST['id'];
  
    $q = "UPDATE `tb_room` SET `name`= '$name'
,`ty_name`='$room'
,`ty_bed`='$bed'
WHERE `id` = '$id' " ;

   mysqli_query($conn,$q);
	   

header("Location: setting.php");    
  


?>