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
                    // Tạo session cho accountID của Customer
                    $_SESSION['accID3'] = $row[0];
                    $acc_id = $_SESSION['accID3'];                    
                    header("Location: ./Customer_Information.php?this_id=$acc_id");
                }                    
            }
            else{
                header("Location: ./SignIn.php?flag=1");
            }
        } catch (mysqli_sql_exception $th) {
            
        }
}

?>