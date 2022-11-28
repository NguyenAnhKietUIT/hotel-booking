<?php

include "../../connect.php";

$gmail =  "";

$pass_word = "";
 
global $flag;

if( isset($_POST['login']) ){

    $gmail = $_POST['email'];

    $pass_word = $_POST['password'];

    $sql = "SELECT * FROM account WHERE GMAIL = '$gmail' AND Passwords = '$pass_word' AND ROLES = 3; ";

    $result = mysqli_query($connect, $sql);

    // Lấy ra id
    $row = mysqli_fetch_row($result);

    if(mysqli_num_rows($result) > 0){
        echo "Đăng nhập thành công";
        header("location: ../../home_page/home.html?this_id=$row[0]");
        $flag = 1;
    }
    else{
        header("location: sign_in.html"); 
        $flag = 2;
    }
        
}

?>