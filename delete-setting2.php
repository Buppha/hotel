<?php

include './connect.php';


    $id = $_GET['id'];

  
    $q = "DELETE FROM tb_typeroom WHERE typeroom_id = '$id' " ;

    mysqli_query($conn,$q);


header("Location: setting2.php");    
  


?>