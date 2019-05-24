
    <?php
include './connect.php';
date_default_timezone_set("Asia/Bangkok");

$hotel_id = $_POST['hotel_id'];

$name = $_POST['name']; //ชื่อโรงแรม
$tokenline = $_POST['token']; //token
$address = $_POST['address']; //address

$pic = $_POST['pic'];


    $path; //ที่อยู่ไฟล์เอกสาร
    if ($_FILES['upfile']) {
        $file = $_FILES['upfile'];
        $path = "./Usdocument/$doc_id$temp$create_date$file[name]";

        if (!move_uploaded_file($file['tmp_name'], $path)) {
            $path = "";
        }
    }

// if ($_FILES['upfile']) {
//     $file = $_FILES['upfile'];
//     $img = "../img/$file[name]";

//     if (!move_uploaded_file($file['tmp_name'], $img)) {
//         $img = "";
//     }
// }

$q = "UPDATE tb_hotel SET hotel_name ='$name', BK_token ='$tokenline', address= '$address', img ='$path'  WHERE hotel_id= '$hotel_id' ";

echo $q;
mysqli_query($conn, $q);

//header("Location: data_hotel.php");
?>