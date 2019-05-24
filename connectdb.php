<?php

$err_level = error_reporting(0);
$conn = mysqli_connect("localhost", "root", "", "hotel") or die("Error: " . mysqli_error($conn));
mysqli_set_charset($conn, "utf8");
error_reporting($err_level);
