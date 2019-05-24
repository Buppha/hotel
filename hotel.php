<?php
session_start();
if ($_SESSION['username'] == "") {
    echo '<script type="text/javascript" language="javascript">
    alert("Please Login!");
    window.history.back()
    </script>';
    header("location:index.html");
    exit();

}if ($_SESSION['mem_status'] != "Admin") {
    exit();
    header("location:index.html");
}

include './connect.php';
$strSQL = "SELECT * FROM tb_hotel WHERE hotel_id = '" . $_SESSION['name_hotel'] . "' ";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_array($objQuery);

?>

<!DOCTYPE html>
<html>
<title>รายการเปิดห้อง</title>
<!-- icon title bar -->
<link rel="icon" type="image/png" href="./img/hotel.png"/>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" media="screen" href="./css/hotel.css" />
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

    <center><span><h4><?php echo $objResult['hotel_name'] ?></h4></span></center>

  </div>
  <hr>
  <div class="w3-container">
    <h5>เมนู</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  เปิดห้อง</a>
    <a href="hotel.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-eye fa-fw"></i>   ข้อมูลการเปิดห้อง</a>
    <a href="setting.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a>
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

  <center>

		<a href="hotel.php" class="btn btn-info" role="button">ทั้งหมด</a>
		<a href="hotel2.php" class="btn" role="button">วันนี้</a>

     </center>

<hr>
<div class="row"><!--ตรงนี้เลือกวันที่ค้นหา-->
                            <div class="col-md-1 col-lg-2"><label for="1">ตั้งแต่ วันที่</label></div>
                            <div class="col-md-1 col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="date" id="create_date" name ="create_date" class="form-control" value="<?=(isset($_GET['cd']) && $_GET['cd']) ? $_GET['cd'] : null?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-lg-2"><label for="id">ถึง วันที่</label></div>
                            <div class="col-md-1 col-lg-3">
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="date" id="expire_date" name ="expire_date" class="form-control" value="<?=(isset($_GET['ed']) && $_GET['ed']) ? $_GET['ed'] : null?>" >
                                     </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5 form-control-label">
                                <label ><input type="button" class = "btn  waves-effect" value="ค้นหา"/></label>
                            </div>
                        </div>
  <div class="row">
  <div class="column">
    <div class="card">

    <table role="table">

      <thead role="rowgroup">
        <tr role="row">
        <th role="columnheader">ลำดับ</th>
          <th role="columnheader">ห้อง</th>
          <th role="columnheader">ประเภท</th>
          <th role="columnheader">แบบ</th>

          <th role="columnheader">ราคา</th>
          <th role="columnheader">ทะเบียนรถ</th>
          <th role="columnheader">วันที่ / เวลา เข้าพัก</th>
          <th role="columnheader">วันที่ / เวลา ออก</th>

         </tr>
       </thead>
      <tbody role="rowgroup">
         <?php
include './connect.php';
$hotel_id = $_SESSION["name_hotel"];

$ed = (isset($_GET['ed']) && $_GET['ed']) ? $_GET['ed'] : 'now';
$cd = (isset($_GET['cd']) && $_GET['cd']) ? $_GET['cd'] : '0000-00-00';

$q = "SELECT tb_booking.*,tb_typeroom.* FROM tb_booking,tb_typeroom WHERE `hotel_d` = '$hotel_id'
            AND tb_typeroom.typeroom_id = tb_booking.type_rent
	 ORDER BY `booking_id`";

$qmany = mysqli_query($conn, $q);
$i = 1;
while ($row = mysqli_fetch_array($qmany)) {
    if (strtotime($row['date_come']) >= strtotime($cd) && strtotime($row['date_come']) <= strtotime($ed)):
    ?>


          <tr>
          <td><div><?=$i;?></div></td>
            <td><?php echo $row['room_no'] ?></td>
            <td><?php echo $row['type_room'] ?></td>
            <td><?php echo $row['type_name'] ?></td>

            <td><?php echo $row['total_cost'] ?></td>
            <td><?php echo $row['license_plate'] ?></td>
            <td><?php echo $row['date_come'] ?> / <?php echo $row['time_come'] ?></td>
            <td><?php echo $row['date_out'] ?> / <?php echo $row['time_out'] ?></td>



           </tr>

         <?php $i++;
    endif;
}?>
       </tbody>
     </table>
    </div>
  </div>

</div>
  <hr>
  <hr>
  <div class="row"> <!-- คำนวนเงินจากการค้นหา-->
  <div class="column">
    <div class="card">

    <table role="table">

      <thead role="rowgroup">
        <tr role="row">
        <th role="columnheader">รวมรายการจากการค้นหา</th>
        <td>วันที่ : <?php echo $cd ?></td>

                   <?php
$q = "SELECT COUNT(booking_id)
                            As id
                               FROM tb_booking,tb_typeroom WHERE `hotel_d` = '$hotel_id'
                    AND tb_typeroom.typeroom_id = tb_booking.type_rent
                    AND tb_booking.date_come = '$cd' ";

$objQuery = mysqli_query($conn, $q);
$rows = mysqli_fetch_array($objQuery);
?>

        <td>เปิดห้องทั้งหมด : <?php echo $rows['id'] ?> รายการ</td>

         <?php
$q = "SELECT  SUM(total_cost) As total
				  FROM tb_booking,tb_typeroom WHERE hotel_d = '$hotel_id'
          AND tb_typeroom.typeroom_id = tb_booking.type_rent
          AND tb_booking.date_come = '$cd' ";

$objQuery = mysqli_query($conn, $q);
$rows = mysqli_fetch_array($objQuery);
?>

            <td>เป็นเงิน : <?php echo $rows['total'] ?> บาท</td>


         </tr>
       </thead>

       </tbody>
     </table>
    </div>
  </div>
</div>
  <hr>

<div class="row"> <!-- คำนวนเงินจากรายการทั้งหมด-->
  <div class="column">
    <div class="card">

    <table role="table">

      <thead role="rowgroup">
        <tr role="row">
        <th role="columnheader">รวมรายการทั้งหมด</th>

         </tr>
       </thead>
      <tbody role="rowgroup">

           <?php
$q = "SELECT COUNT(booking_id)
                            As id
                               FROM tb_booking,tb_typeroom WHERE `hotel_d` = '$hotel_id'
            				AND tb_typeroom.typeroom_id = tb_booking.type_rent";

$objQuery = mysqli_query($conn, $q);
$rows = mysqli_fetch_array($objQuery);
?>


          <tr>
          <th>เปิดห้องทั้งหมด  </th>
            <td><?php echo $rows['id'] ?></td>
            <td>รายการ</td>


           </tr>
 <?php
$q = "SELECT  SUM(total_cost) As total
				  FROM tb_booking,tb_typeroom WHERE hotel_d = '$hotel_id'
          AND tb_typeroom.typeroom_id = tb_booking.type_rent ";

$objQuery = mysqli_query($conn, $q);
$rows = mysqli_fetch_array($objQuery);
?>

  <tr>
          <th>เป็นเงิน</th>
            <td><?php echo $rows['total'] ?></td>
            <td>บาท</td>


           </tr>

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

<script>
// Used to toggle the menu on small screens when clicking on the menu button


$("[value=ค้นหา]").click((e)=>{
    let cdate = $("#create_date").val();
    let edate = $("#expire_date").val();

    location.href = location.href.split('\?')[0] + "?cd="+cdate + "&ed=" + edate;
});
</script>


</body>
</html>
