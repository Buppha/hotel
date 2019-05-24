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
<title>เปิดห้อง</title>
<!-- icon title bar -->
<link rel="icon" type="image/png" href="./img/hotel.png"/>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>

<style>
input[type=text], select {
    width: 100%;
    padding: 10px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding:50px;
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
    <a href="User-Home.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  เปิดห้อง</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  ออกจากระบบ</a><br><br>

  
  </div>
  <div class="w3-container">
      <?php ?>
    <h5>ห้อง Standard = </h5>
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
     $type_name = $_GET['optradio1'];
  
     $name = $_GET['name'];
     $ty_name = $_GET['tyname'];
     $ty_bed = $_GET['tybed'];
     
     $strSQL = "SELECT tb_room.*,tb_typeroom.* FROM tb_room,tb_typeroom
     WHERE tb_room.ty_name = '$ty_name'
     AND tb_typeroom.type_name = '$type_name'
     AND tb_room.name = '$name'
	";
     $objQuery = mysqli_query($conn,$strSQL);
     $rows= mysqli_fetch_array($objQuery);


?>
<div class="div">
  <form action="./insert_come.php" method="POST">
    <div class="row">
            <div class="col-md-1 col-lg-2" >ห้อง</div>
            <div class="col-md-1 col-lg-3">
                : <?php echo $name ?>
            </div>
    </div>
    <br>
    <div class="row">
            <div class="col-md-1 col-lg-2" >แบบ</div>
            <div class="col-md-1 col-lg-3" >
                : <?php echo $type_name ?>
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
            <div class="col-md-1 col-lg-2" >ประเภท</div>
            <div class="col-md-1 col-lg-3" >
                : <?php echo $ty_bed ?>
            </div>
    </div>
    
  
    <br>
    <div class="row">
        <?php
            $hotel_id = $_SESSION["name_hotel"];
          include './connect.php';
        $strSQL = "SELECT *  FROM tb_typeroom 
        WHERE hotelid = '$hotel_id'
		AND type_room = '$ty_name'
		AND type_name = '$type_name'
		AND type_bed = '$ty_bed'
    
        ";

        $objQuery1 = mysqli_query($conn,$strSQL);
        $rows1= mysqli_fetch_array($objQuery1);
        ?>
        <input type="hidden" name="type_rent" value="<?php echo $rows1['typeroom_id'] ?>" >
	<input type="hidden" name="type_name" value="<?php echo $type_name ?>" >
        <input type="hidden" name="name" value="<?php echo $name ?>" >

            <div class="col-md-1 col-lg-2" >ราคา</div>
            <div class="col-md-1 col-lg-3" >
                <input type="text" class="form-control" id="price" name="price" value = "<?php echo $rows1['price']?>" required="required">
            </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-1 col-lg-2" >ทะเบียนรถ</div>
        <div class="col-md-1 col-lg-6">
            <input type="text" class="form-control" id="carnum" name="carnum" >
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
