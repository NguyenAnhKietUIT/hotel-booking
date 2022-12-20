<?php


/*
    function: newAccountCus
    Đầu vào: con
*/
function newAccountCus($con){
    $sql = "SELECT AccountID
            FROM Account
            WHERE ROLES = 3
            ORDER BY AccountID DESC
            LIMIT 1;";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;

}

/*
    function: newAccountPro
    Đầu vào: con
*/
function newAccountPro($con){
    $sql = "SELECT AccountID
            FROM Account
            WHERE ROLES = 2
            ORDER BY AccountID DESC
            LIMIT 1;";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_row($result);

    return $row;

}


/*
    function: findImage
    Đầu vào: 1 chuỗi chứa giá trị là ảnh trong tìm file ảnh
*/
function findImage($array){
    // Mảng dữ liệu
    $image = $array;
    // Tiến hành tách 
    $array_img = explode("-", $image);

    return $array_img;
}

/*
    function: handleArray
    Đầu vào: 1 chuỗi chữ cần tách trong DeleteMessage
*/
function handleArray($array){
        // Mảng dữ liệu
        $message = $array;
        // Tiến hành tách 
        $array_message = explode(" - ", $message);
    
        return $array_message;
}


/*
    function: showInbox
    Đầu vào: con, usernameReceive
*/
function showInbox($con, $usernameReceive){

    $sql = "SELECT UsernameSend, Message
            FROM contact
            WHERE UsernameReceive = '".$usernameReceive."';";

    $result = mysqli_query($con, $sql);

    return $result;
}

?>