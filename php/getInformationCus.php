<?php

include './connect.php';



if(isset($_SESSION['accID3'])){

       try {
        // Lấy ra mã tài khoản
        $account_id = $_SESSION['accID3'];


        $sql = "SELECT Username, Gmail, Phone, Image_Customer, A.AccountID, Country, CustomerName, Sex
                FROM Customer C join ACCOUNT A ON C.AccountID = A.AccountID
                WHERE A.AccountID = '".$account_id."'";

        $result = mysqli_query($connect, $sql);

        // Lấy ra dòng dữ liệu
        $row = mysqli_fetch_row($result);

        // Gán các dòng dữ liệu cho biến
        $user_name = $row[0];
        $Gmail = $row[1];
        $phone = $row[2];
        $Image_Customer = $row[3];
        $acc_id = $row[4];
        $country = $row[5];
        $cus_name = $row[6];  
        $sex = $row[7];       
       } catch (mysqli_sql_exception $th) {
                
       }
}

?>