<?php

include './connect.php';
    session_start();

 $ty_room = explode("|", $_REQUEST['ty_room']);
        			      $id = $ty_room[0];
       				      $room = $ty_room[1];
				      $bed = $ty_room[2];

    $hotel_id = $_SESSION["name_hotel"];

    $name = $_POST['name']; //???????????
 
   


 
  
    $q = "INSERT INTO `tb_room`(`id`, `hotel`, `name`, `ty_name`, `ty_bed`, `status`) 
VALUES (Null,'$hotel_id','$name','$room','$bed','1')";

    mysqli_query($conn,$q);
	   

header("Location: setting.php");    
  


?>