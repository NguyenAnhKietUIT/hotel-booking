<?php
    include "../connect.php";

    $account_id = $_GET['this_id'];

    $sql = "SELECT CustomerName, Gmail, Phone, Image_Customer, A.AccountID
            FROM Customer C join ACCOUNT A ON C.AccountID = A.AccountID
            WHERE A.AccountID = '$account_id'";

    $result = mysqli_query($connect, $sql);

    // Lấy ra dòng dữ liệu
    $row = mysqli_fetch_row($result);

    $name = $row[0];
    $Gmail = $row[1];
    $phone = $row[2];
    $Image_Customer = $row[3];
    $acc_id = $row[4];
?>