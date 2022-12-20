<?php

// Xử lý từ các biến get
    // Update = 1 -> function UpdateActivate

// Tạo biến update để gọi hàm
$update = $_GET['Update'];

/*
    function: UpdateActivate
    Ý nghĩa : Cập nhật trạng thái tài khoản
*/
function UpdateActivate(){

    if(isset($_POST['btnActivate'])){

        if(isset($_COOKIE['Status']) && isset($_COOKIE['CusName'])){
    
            include "./connect.php";
    
            $status = $_COOKIE['Status'];
    
            $Cus_name = $_COOKIE['CusName'];
    
            if($status === "Inactive"){
                $sql = "UPDATE Customer 
                SET Status_Account = 1
                WHERE  CustomerName = '".$Cus_name."'";
    
                mysqli_query($connect, $sql);
    
                header("Location: ./Admin_Dashboard.php");
                
            }
            else {
                header("Location: ./Admin_Dashboard.php");
            }
        }
    
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
        UpdateActivate();
        break;
    default:
        break;
}

?>