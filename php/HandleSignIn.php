<?php

session_start();

header('Content-Type: text/html; charset=UTF-8');

$user_name = "";

$pass = "";


if (isset($_POST['username']) && $_POST['password']){   
    
    include './connect.php';

    $user_name = $_POST['username'];

    $pass = $_POST['password'];

        try {
            $sql = "SELECT * FROM account WHERE Username = '".$user_name."' AND Passwords = '".$pass."'";

            $result = mysqli_query($connect, $sql);

            $row = mysqli_fetch_row($result);

            if(mysqli_num_rows($result) > 0){


                if( $row[4] == 1){
                    // Tạo session cho accountID của Admin
                    $_SESSION['accID1'] = $row[0];
                    header("Location: ./Admin_Dashboard.php");
                }
                else if($row[4] == 2){
                    // Tạo session cho accountID của Property
                    $_SESSION['accID2'] = $row[0];  
                    $acc_id2 = $_SESSION['accID2'];    
                    header("Location: ./Home_Property.php?this_id=$acc_id2");            
                }
                else{
                    // Xét tồn tại Session và chuyển sang trang Reservation
                    if(isset($_SESSION['hotel']) && isset($_SESSION['hotel']) && isset($_SESSION['check-in-date'])
                                    && isset($_SESSION['check-out-date']) && isset($_SESSION['bed-num']) && isset($_SESSION['per-num'])){

                        $hotelName = $_SESSION['hotel'];
                        $proID = $_SESSION['id'];
                        $checkin =  $_SESSION['check-in-date'];
                        $checkout =  $_SESSION['check-out-date'];
                        $bednum = $_SESSION['bed-num'];
                        $perNum = $_SESSION['per-num'];
                        $_SESSION['accID3'] = $row[0];
                        $acc_id = $_SESSION['accID3'];  

                        header("Location: ./Search_Property.php?id=$proID&hotel= $hotelName&check-in-date=$checkin&check-out-date=$checkout&bed-num=$bednum&per-num=$perNum");
                    }
                    // Tạo session cho accountID của Customer đăng nhập vào Customer_Information
                    else{
                        $_SESSION['accID3'] = $row[0];
                        $acc_id = $_SESSION['accID3'];                    
                        header("Location: ./Customer_Information.php?this_id=$acc_id");
                    }
                }
            }
            else{
                header("Location: ./SignIn.php?flag=1");
            }
        } catch (mysqli_sql_exception $th) {
            
        }
}

?>