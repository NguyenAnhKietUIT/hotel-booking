<?php

// Xử lý các biến get
    // Delete = 1 -> function deleteRoom
    // 

// Tạo biến đón các Delet
$delete = $_GET['Delete'];

/*
    function: deleteRoom
    Ý nghĩa : xóa phòng
*/
function deleteRoom(){
    if(isset($_COOKIE['RoomID'])){

        include "./connect.php";

        $room_id = $_COOKIE['RoomID'];

        //$roomName = $_COOKIE['RoomName'];

        //cho $room_id."<br>".$roomName;

        $sql = "DELETE FROM ROOM WHERE RoomID = '".$room_id."' ";

        $result = mysqli_query($connect, $sql);

        header("Location: ./Manage_Room.php");
    }
}


/*
    Gọi hàm bằng biến $delete
        + 1: deleteRoom
*/
switch ($delete) {
    case 1:
        deleteRoom();
        break;
        break;
    default:
        break;
}

?>