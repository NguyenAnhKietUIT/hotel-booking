<?php

// Giá trị là Localhost
    $dbhost = "localhost";
// Giá trị là root
    $dbuser = "root";
// Giá trị là ""
    $dbpass = "";
// Giá trị là tên CSDL đã tạo trên MYSQL
    $dbname = "hotel_booking";

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


// Cho phép in có dấu
mysqli_set_charset($connect, "utf8");

// if($connect)
//     echo "Kết nối thành công";
// else
//     echo "Kết nối không thành công";

?>