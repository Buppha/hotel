<?php
  session_start();
  if($_SESSION['username'] == ""){
    echo '<script type="text/javascript" language="javascript"> 
    alert("Please Login!");
    window.history.back()
    </script>';
    header("location:index.html");
    exit();

  }if($_SESSION['mem_status'] != "User"){
    exit();
    header("location:index.html");
  }

  include './connect.php';
  $strSQL = "SELECT * FROM tb_hotel WHERE hotel_id = '".$_SESSION['name_hotel']."' ";
  $objQuery = mysqli_query($conn,$strSQL);
  $objResult = mysqli_fetch_array($objQuery);
  
  ?>

<!DOCTYPE html>
<html>
<title><?php echo $objResult['hotel_name']?></title>
<!-- icon title bar -->
<link rel="icon" type="image/png" href="./img/hotel.png"/>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- ปุ่มกด -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {
    font-family: "Raleway", sans-serif}
</style>

<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #32CD32;
}
.card2 {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #ff3300;
}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">Logo</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
   
      <center><img src="./img/slider01.jpg" style="width:250px"></center>
   
    <br>
    
    <center><span><h4><?php echo $objResult['hotel_name']?></h4></span></center>
    
  </div>
  <hr>
  <div class="w3-container">
    <h5>เมนู</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  เปิดห้อง</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  ออกจากระบบ</a><br><br>

  
  </div>

</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">

  </header>
  <hr>
  <div class="row">
  <?php
     include './connect.php';
     $strSQL = "SELECT * FROM tb_room WHERE hotel = '".$_SESSION["name_hotel"]."' ";
     $objQuery = mysqli_query($conn,$strSQL);
     
     while($rows= mysqli_fetch_array($objQuery)) {
        ?>
        
        <div class="column">
        <?php 
              if ($rows['status']=='1'){
                  
                  echo ' <div class="card">';
                  
              }else{
                echo ' <div class="card2">';
              }
        ?>
        <font color="#ffffff">
       <h1>
       <?php echo $rows['name']?></h1><?php echo $rows['ty_name']?> <?php echo $rows['ty_bed']?></font>
       
       <?php 
              if ($rows['status']=='1'){
                  
                  ?>
                  <form action="insert.php">
                  <div class="row">

                    <div class="col-sm-6">
                        <div class="radio">
                            <p><input type="radio" name="optradio1" value="ชั่วคราว" required="required"> ชั่วคราว <p>
                            <p><input type="radio" name="optradio1" value="ค้างคืน" required="required"> ค้างคืน   </p>
                        </div>
                    </div>
                    <div class="col-sm-6" >
                    <p><input type="hidden" name="tyname" value="<?php echo $rows['ty_name']?>" ></p>
                    <p><input type="hidden" name="tybed" value="<?php echo $rows['ty_bed']?>" ></p>
                    <p><input type="hidden" name="name" value="<?php echo $rows['name']?>" ></p>
                    <center><button type="submit" class="btn btn-default btn-lg">  เปิด  </button></center>
                    </div>
                </div>
                  </form>
                  <?php
                  
              }else{
                ?>
                
                <div class="row">
                <form action="./update_Move1.php">
                <div class="col-sm-6" >
                <p><input type="hidden" name="tyname" value="<?php echo $rows['ty_name']?>" ></p>
                    <p><input type="hidden" name="tybed" value="<?php echo $rows['ty_bed']?>" ></p>
                    <p><input type="hidden" name="name" value="<?php echo $rows['name']?>" ></p>
                <p> <center><button type="submit" class="btn btn-default btn-lg">  ย้าย  </button></center></p>
                  </div>
                  </form>
                  <form action="./update_out.php">

                  <div class="col-sm-6" >
                  <p><input type="hidden" name="name" value="<?php echo $rows['name']?>" ></p>
                <p> <center><button type="submit" class="btn btn-default btn-lg" onclick="return confirm(' ยืนยันการออก')">  ออก  </button></center></p>
                  </div>
                      </form>


                  </div>
          
                <?php
              }
        ?>

        
       
        <p></p>
            </div>
<br>
        </div>
        <?php  } ?>
    </div>
  <hr>
  <script language="JavaScript">
    function chkdel(){if(confirm('  ยืนยันการออก  ')){
      return true;
    }else{
      return false;
    }
    }
    </script>
  
  
  <!-- --------------------------------------------------------------------- -->
  

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>


</body>
</html>
