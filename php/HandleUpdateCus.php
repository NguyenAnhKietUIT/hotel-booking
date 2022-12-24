<?php

session_start();

// include các file cần thiết
include "./connect.php";


// Xử lý từ các biến get
    // Update = 1 -> function UpdateCusInform
    // Update = 2 -> function UpdatePass
    // Update = 3 -> function cancelBooking

// Tạo biến update để gọi hàm
$update = $_GET['Update'];

/*
    function: UpdateActivate
    Ý nghĩa : Cập nhật thông tin khách hàng
*/
function UpdateCusInform(){

    //echo $_POST['yourname']."<br>".$_POST['phonenumber']."</br>".$_POST['country'];


    //Kiểm tra thông tin gửi qua
    if(isset($_POST['yourname']) || isset($_POST['phonenumber']) 
                            || isset ($_POST['country']) || isset ($_POST['sex'])){

        include "./connect.php";

        $accountID = $_SESSION['accID3'];
        
        $sql1 = "SELECT * FROM customer WHERE AccountID = '".$accountID."'";
        
        $result1 = mysqli_query($connect, $sql1);
        
        $row = mysqli_fetch_row($result1);
        
        // Lấy ra mã khách hàng
        $cus_id = $row[0];

        $name = $_POST['yourname'];

        $phone =  $_POST['phonenumber'];

        $country = $_POST['country'];

        $sex = $_POST['sex'];

        // Xét xem việc update có ảnh không
        if (isset($_FILES['app__main-input-img'])){

            //echo "Thành Phát";
            $image_name = $_FILES['app__main-input-img']['name'];
            $image_url_ex =  $_FILES['app__main-input-img']['tmp_name'];
            $image_size = $_FILES['app__main-input-img']['size'];
            $error = $_FILES['app__main-input-img']['error'];
            if($error === 0){
                if($image_size > 125000000000){
                    //$message = "File ảnh quá lớn";
                    header("Location: ./Customer_Information.php?flag=1");
                }
                else{
                    $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
    
                    $allow_extent = array("jpg", "jpeg", "png");
                    
                    if(in_array($img_ex_lc, $allow_extent)){
                        $new_img = uniqid("IMG-", true).'.'.$img_ex_lc;
                        $img_upload_path = '../assets/img/upload/' .$new_img;
                        move_uploaded_file($image_url_ex, $img_upload_path);

                        // Tiến hành update có ảnh
                        $sql2 = "UPDATE customer
                        SET 	CustomerName = '".$name."', Phone = '".$phone."'
                                       , Country = '".$country."' , Image_Customer = '".$new_img."', Sex = '".$sex."'
                        WHERE CustomerID = '".$cus_id."';";
       
                        $result2 = mysqli_query($connect, $sql2);
                        
                        header("Location: ./Customer_Information.php?this_id=$accountID");
       
                    }
                    else{
                        //$message = "Bạn không thể up ảnh với file này";
                        header("Location: ./Customer_Information.php?flag=2");
                    }
                }
            }
            else if($error === 4){
                //Tiến hành update không ảnh
                $sql2 = "UPDATE customer
                SET 	CustomerName = '".$name."', Phone = '".$phone."'
                            , Country = '".$country."', Sex = '".$sex."'
                WHERE CustomerID = '".$cus_id."';";

                $result2 = mysqli_query($connect, $sql2);
                header("Location: ./Customer_Information.php?this_id=$accountID");
            }
        }
    }
}

/*
    function: UpdatePass
    Ý nghĩa : Cập nhật mật khẩu tài khoản
*/
function UpdatePass(){

    $accID = $_SESSION['accID3'];

    if(!isset($_SESSION['accID3'])){
        header('Location: ./SignIn.php');
    }

    ?>

    <!-- Xử lý đổi mật khẩu -->
    <?php
        $pass_old = "";
        
        $pass_new = "";
    
        $confirm_pass = "";

        $flag = 0;

    if(isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['confirm-password'])){

        include "./connect.php";

        try {
            $sql1 = "SELECT * FROM ACCOUNT WHERE AccountID = '".$accID."'";

            $result1 = mysqli_query($connect, $sql1);

            $row2 = mysqli_fetch_row($result1);

            $pass_old = $_POST['oldPassword'];

            $pass_new = $_POST['newPassword'];

            $confirm_pass = $_POST['confirm-password'];

            if($pass_old != $row2[2]){
                $flag = 1; // sai mật khẩu cũ
                header("Location: ./Edit_Password.php?this_id=$accID&&flag=$flag");
            }
            else if($pass_new == $pass_old){
                $flag = 2; // mật khâu mới ko trùng mật khẩu cũ 
                header("Location: ./Edit_Password.php?this_id=$accID&&flag=$flag");
            }
            else{
                $sql3 = "UPDATE Account
                        SET Passwords = '$pass_new'
                        WHERE AccountID = '$accID'";

                $result3 = mysqli_query($connect, $sql3);

                if($result3){
                    $flag = 4;// Đăng nhập thành công
                    header("Location: ./Customer_Information.php?this_id=$accID");
                }
            }


        } catch (mysqli_sql_exception $th) {
            echo $th;
            $flag = 3;
        }
    }
}

/*
    function: cancelBooking
    Ý nghĩa : Cập nhật trạng thái đặt phòng
*/
function cancelBooking(){
    if(isset($_POST['btnCancel'])){

        include "./connect.php";
        
        $resNumber = $_POST['reservationNumber'];

        //echo $resNumber;

        $sql = "UPDATE RESERVATION
                SET STATUS_RESERVATION = 4
                WHERE ReservationID = '". $resNumber."'";

        $result = mysqli_query($connect, $sql);

        header("Location: ./Customer_viewBooking.php");
    }
}


/*
    Gọi hàm bằng biến $update
        + 1 -> function UpdateActivate
        + 2 -> function UpdateCusInform
        + 3 -> function UpdatePass
*/

switch ($update) {
    case 1:
        UpdateCusInform();
        break;
    case 2:
        UpdatePass();
        break;
    case 3:
        cancelBooking();
        break;
    default:
        break;
}

?>