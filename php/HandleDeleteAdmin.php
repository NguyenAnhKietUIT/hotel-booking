<?php

$delete = $_GET['Delete'];


function deleteMessage(){

   if(isset($_POST['btnDelete'])){
        include "./connect.php";

        include "./HandleAnother.php";
            $contactID = $_COOKIE['contactID'];

        $sql = "DELETE FROM Contact WHERE contactID = '".$contactID."'";

        mysqli_query($connect, $sql);

        header("Location: ./Admin_Message.php");
   }

}

function deleteAllMessage(){

    if(isset($_POST['btnDeleteAll'])){

        include "./connect.php";

        $sql = "DELETE FROM Contact ";

        mysqli_query($connect, $sql);

        header("Location: ./Admin_Message.php");

    }
}

switch ($delete) {
    case 1:
        deleteMessage();
        break;
    case 2:
        echo "Xóa toàn bộ";
        break;
    case 3:
    default:
        break;
}
?>