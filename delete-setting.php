<?php

include './connect.php';


    $id = $_GET['id'];

  
    $q = "DELETE FROM `hotel`.`tb_room` WHERE `tb_room`.`id` = '$id' " ;

    mysqli_query($conn,$q);


header("Location: setting.php");    
  


?>