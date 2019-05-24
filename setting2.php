<?php
  session_start();
  if($_SESSION['username'] == ""){
    echo '<script type="text/javascript" language="javascript"> 
    alert("Please Login!");
    window.history.back()
    </script>';
    header("location:index.html");
    exit();

  }if($_SESSION['mem_status'] != "Admin"){
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
<title>ตั้งค่า</title>
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
  width: 100%;
  padding: 0 20px;
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
  text-align: left;
  background-color: #ffffff;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  td, th {
    border: 0px solid #dddddd;
    text-align: center;
    padding: 8px;}

    .right{
      text-align: right;
    }
    .left{
      text-align: left;
    }

    .td{
      width: 10px;


    }
  
  tr:nth-child(even) {
    background-color: #dddddd;}

 .select {
      width: 100%;
      padding: 10px 20px;
      margin: 6px 0;
      display: inline-block;
      border: 3px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;

  }
  
  
</style>
   <script language="JavaScript">
    function chkdel(){if(confirm('  ยืนยันการลบข้อมูล  ')){
      return true;
    }else{
      return false;
    }
    }
    </script>
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
    <a href="index.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  เปิดห้อง</a>
    <a href="hotel.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>   ข้อมูลการเปิดห้อง</a>
    <a href="setting.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-cog fa-fw"></i>  Settings</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  ออกจากระบบ</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:320px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:20px">
  
  </header>

  <hr>
  <div class="row">
    <div class="column">
        <div class="card">
         <form action="insert-setting2.php" method = "post" >
         <div class="row">
         <div class="col-sm-3">
            ประเภทห้อง :
         </div>
            <div class="col-sm-4">
                <select class="form-control" id="ty_room" name="ty_room">> 
                    <option>Standard</option>
                    <option>VIP</option>
                </select>
            </div>
            </div>
	<br>
         <div class="row">
         <div class="col-sm-3">
            ประเภทเตียง :
         </div>

            <div class="col-sm-4">
                <input type="text" class="form-control" id="bed" name="bed" required="required">
            </div>
        </div>
         <br>
         <div class="row">
         <div class="col-sm-3">
            แบบ :
         </div>
            <div class="col-sm-4">
                <select class="form-control" id="ty_name" name="ty_name">
                    <option>ค้างคืน</option>
                    <option>ชั่วคราว</option>
                </select>
            </div>
         </div>
         
        <br>
    <div class="row">
         <div class="col-sm-3">
            ราคา :
         </div>

            <div class="col-sm-4">
                <input type="text" class="form-control" id="price" name="price" required="required">
            </div>
        </div>
        <br>

        <div class="row">
        <div class="col-sm-3">
            </div>
            <div class="col-sm-4">
            <input type="submit" value="บันทึก" class="form-control btn btn-primary">
            </div>
        </div>
            </form>
            </div>
        </div>
    </div>

  <hr>
  <center>

		<a href="setting.php" class="btn " role="button">ห้องทั้งหมด</a>
		<a href="#" class="btn btn-info" role="button">ราคา</a>
               
     </center>
     <hr>
  <div class="row">
  <div class="column">
    <div class="card">
      
    <table role="table">
      
      <thead role="rowgroup">
      
        <tr>
        <th>ลำดับ</th>
          <th>ประเภทห้อง</th>
	<th>ประเภทเตียง</th>
          <th>แบบ</th>
          <th>ราคา</th>
          <th >แก้ไข</th>
          <th >ลบ</th>
         </tr>

        
       </thead>
      <tbody role="rowgroup">
         <?php
             include './connect.php';
        $hotel_id = $_SESSION["name_hotel"];
            $q = "SELECT * FROM tb_typeroom WHERE hotelid = '$hotel_id' ";

            $qmany = mysqli_query($conn,$q);
            $i = 1;
            while($row= mysqli_fetch_array($qmany)) {
           ?>
           

          <tr>
          <td><div><?=$i;?></div></td>
            <td><?php echo $row['type_room'] ?></td>
		<td><?php echo $row['type_bed'] ?></td>
            <td><?php echo $row['type_name'] ?></td>
            <td><?php echo $row['price'] ?></td>
      

          <td><a href="edit_setting2.php?id=<?php echo $row['typeroom_id'] ?>"><i class="fa fa-edit" style="color:blue;"></i></a></td>

       
       <td>
				<a href="delete-setting2.php?id=<?php echo $row['typeroom_id']?>" 
				onclick="return confirm(' ยืนยันการลบข้อมูล')">
				<i  class="fa fa-close" style="color:red;" ></i></a>
			</td>

           </tr>
         
         <?php $i++;  } ?>
       </tbody>
     </table> 
    </div>
  </div>

</div>
  <hr>
  
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
