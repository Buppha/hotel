<?php
	session_start();
    include './connect.php';

    $username = $_GET['username'];
    $pass = $_GET['pass'];
    
    $strSQL = "SELECT * FROM member WHERE username = '$username'AND  password = '$pass' ";

	$objQuery = mysqli_query($conn,$strSQL);
    $objResult = mysqli_fetch_array($objQuery);
    
	if(!$objResult)
	{
		echo '<script type="text/javascript" language="javascript"> 
                alert("กรุณาตรวจสอบ Username หรือ Password");
                window.history.back();
        </script>';
	}
	else
	{
			$_SESSION["mem_id"] = $objResult["mem_id"];
			$_SESSION["name"] = $objResult["name"];
            $_SESSION["name_hotel"] = $objResult["name_hotel"];
			$_SESSION["hotel_token"] = $objResult["hotel_token"];
            $_SESSION["username"] = $objResult["username"];
            $_SESSION["mem_status"] = $objResult["mem_status"];

            session_write_close();
			
			if($objResult["mem_status"] == "Admin")
			{
				header("location:index.php");

			}else if ($objResult["mem_status"] == "System")
			{
				header("location:System/System-Home.php");
			}
			else
			{
				header("location:User-Home.php");
			}

	}
	mysql_close();

?>
