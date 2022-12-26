<?php

session_start();

// Xử lý các biến get
    // Insert = 1 -> function signUp


// Tạo biến đón các insẻt
$insert = $_GET['Insert'];

/*
    function: signUp
    Ý nghĩa : Đăng ký tài khoản. Thêm vào bảng Account
*/
function signUp(){
    $username = "";

    $email = "";

    $pass = "";

    $confirm_pass = "";

    $flag = 0;
    
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ){

        include "./connect.php";

        include "./HandleAnother.php";

        try {
            $username = $_POST['username'];

            $email = $_POST['email'];

            $pass = $_POST['password'];

            $confirm_pass = $_POST['confirm-password'];

            $sql1 = "SELECT * FROM ACCOUNT WHERE Username = '".$username."'";

            $result1 = mysqli_query($connect, $sql1);

            $sql2 = "SELECT * FROM ACCOUNT WHERE GMAIL = '".$email."'";

            $result2 = mysqli_query($connect, $sql2);

            // Property => Role = 2

            $signup = 2;

            if(mysqli_num_rows($result1) > 0){
                $flag = 1;// Username đã tồn tại
                header("Location: Property_SignUp.php?flag=$flag");
            }
            else if(mysqli_num_rows($result2) > 0){
                $flag = 2;// Gmail đã tồn tại
                header("Location: Property_SignUp.php?flag=$flag");
            }
            else {
                $sql = "INSERT INTO `account`(`AccountID`, `Username`, `Passwords`, `GMAIL`, `ROLES`) 
                VALUES (NULL,'$username','$pass','$email','2')";
    
                $result = mysqli_query($connect, $sql);

                if($result){

                    $new_accountid = newAccountPro($connect);

                    $place = random_int(1, 10);

                    $sql2 = "INSERT INTO `property`(`PropertyID`, `AccountID`, `PlaceID`) 
                                VALUES (NULL, '$new_accountid[0]', '$place')";

                    $result2 = mysqli_query($connect, $sql2);

                    if($result2){
                        header("Location: ./SignIn.php");
                    }
                }
            }  
        }catch (mysqli_sql_exception $sth) {
            echo $sth;
        }
    }
}


/*
    Gọi hàm bằng biến $insert
        + 1: signUp
*/

switch ($insert) {
    case 1:
        signUp();
    default:
        break;
}



?>