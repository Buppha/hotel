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
  <?php
     include './connect.php';
     $name = $_GET['name'];
     $ty_name = $_GET['tyname'];
     $ty_bed = $_GET['tybed'];
     $hotel_id = $_SESSION["name_hotel"];

     $strSQL = "SELECT MAX(booking_id) id 
     FROM tb_booking 
     WHERE hotel_d = '$hotel_id'
     AND room_no = '$name'
	";
     $objQuery = mysqli_query($conn,$strSQL);
     $rows= mysqli_fetch_array($objQuery);

     $booking_id = $rows['id'];

     $qq = "SELECT * FROM tb_booking 
     WHERE hotel_d = '$hotel_id '
     AND booking_id = '$booking_id' ";

$qqq = mysqli_query($conn,$qq);
$rows3= mysqli_fetch_array($qqq);


?>
<div class="div">
  <form action="./insert_Move1.php" method="POST">
    <div class="row">
            <div class="col-md-1 col-lg-2" >ห้องเดิม</div>
            <div class="col-md-1 col-lg-3">
                : <?php echo $rows3['room_no'] ?>
                
            </div>
    </div>
    <br>
    <div class="row">
            <div class="col-md-1 col-lg-2" >ย้ายไปห้อง</div>
            <div class="col-md-1 col-lg-3">
                <select class="form-control" id="ty_room" name="ty_room">
    
    <?php
        include './connect.php';
$hotel_id = $_SESSION["name_hotel"];

$q = " SELECT * FROM tb_room 
WHERE hotel = '$hotel_id'
AND status = '1'
AND ty_name = '$ty_name'
AND ty_bed = '$ty_bed'
";
        
$qmany = mysqli_query($conn,$q);
while($row= mysqli_fetch_array($qmany)) { ?>

<option value="<?php echo $row['name']?>" >
<?php echo $row['name']?>
</option>

<?php   } ?>
</select>     

            </div>
    </div>
    <p><input type="hidden" name="tyname" value="<?php echo $rows3['room_no']?>" ></p>
    <p><input type="hidden" name="booking_id" value="<?php echo $booking_id ?>" ></p>
    <br>
    <div class="row">
            <div class="col-md-1 col-lg-2" >แบบ</div>
            <div class="col-md-1 col-lg-3" >
                : <?php echo $rows3['type_rent_name'] ?>
            </div>
    </div>
    <br>
    <div class="row">
            <div class="col-md-1 col-lg-2" >ประเภทห้อง</div>
            <div class="col-md-1 col-lg-3" >
                : <?php echo $ty_name ?>
            </div>
    </div>
    <br>
    <div class="row">
            <div class="col-md-1 col-lg-2" >ประเภทเตียง</div>
            <div class="col-md-1 col-lg-3" >
                : <?php echo $ty_bed ?>
            </div>
    </div>

    <br>
    <div class="row">

            <div class="col-md-1 col-lg-2" >ราคา</div>
            <div class="col-md-1 col-lg-3" >
               : <?php echo $rows3['total_cost']?>
            </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-1 col-lg-2" >ทะเบียนรถ</div>
        <div class="col-md-1 col-lg-6">
        : <?php echo $rows3['license_plate']?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3 col-lg-3" ></div>
            <div class="col-md-3 col-lg-3" >
            <button class="form-control btn btn-primary" type="submit" onclick="gettime();" >
                บันทึก</button>
            </div>
            <div class="col-md-3 col-lg-3" >
            <button class="form-control btn btn-danger" type="button" onclick="parent.location.href='User-Home.php'">
                ยกเลิก</button>
            </div>
        </div>
  </form>
</div>

<script language="javascript">
	function gettime(){
		var limit = "3:00:00"; //Set ไว้ 3 ชั่วโมง
		if (document.images){
			var parselimit=limit.split(":");
			parselimit=parselimit[0]*3600+parselimit[1]*60+parselimit[2]*1;
			begintimer(parselimit);
		}
	}
	
	function begintimer(parselimit){
		if (!document.images)
		return
		
//---------Time=0----event------
		if (parselimit==0){
			alert("หมดเวลาแล้วค่ะ");
			// parselimit = 10800;// 3 ชั่วโมง 
			// begintimer();
		}else{
			parselimit-=1;
			curhr = Math.floor(parselimit/3600); 
			curmin=Math.floor(parselimit/60)%60;
			cursec=parselimit%60;
				
//------------------------set 00----------------------
			if(curhr < 10){
				curhr = "0"+curhr;
			}
			if(curmin < 10 ){
				curmin = "0"+curmin;
			}
			if(cursec < 10 ){
				cursec = "0"+cursec;
			}

			curtime=+curhr+":"+curmin+":"+cursec; //รูปแบบแสดงผล 00:00:00

			document.getElementById('d2').innerHTML = curtime; //แสดงผลที่ <p id='d2' ></p> 
			setTimeout("begintimer("+parselimit+")",1000); // เอา onclick="gettime(); ไปใส่ในปุ่ม
		}
	}
</script>

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
