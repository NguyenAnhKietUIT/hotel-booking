<?php

session_start();

// Xử lý các biến get
    // Update = 1 -> function updateInformation
    // Update = 2 -> function updateRoom
    // Update = 3 -> function updateStatusReservation

// Tạo biến đón các Update
$update = $_GET['Update'];

/*
    function: updateInformation
    Ý nghĩa : Update thông tin của Pro
*/
function updateInformation(){

    if(isset($_POST['name']) || isset($_POST['overview']) || isset($_POST['phonenumber']) 
        || isset($_POST['location']) || isset($_POST['check-in'])
        || isset($_POST['check-out']) || isset($_POST['property']) || isset($_POST['category'])
        || isset($_FILES['image'])){

        include "./connect.php";   
        include "./HandleSelectPro.php"; 

        $name = $_POST['name'];
        $overview = $_POST['overview'];
        $phone = $_POST['phonenumber'];
        $location = $_POST['location'];
        $check_in_time = $_POST['check-in'];
        $check_out_time = $_POST['check-out'];
        $type_pro = $_POST['property'];
        $type_category = $_POST['category'];

        // Lấy thông tin ảnh
        $image_name = $_FILES['image']['name'];
        $image_url_ex =  $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $error = $_FILES['image']['error'];

        // Kiểm tra dữ liệu
            // echo $name."<br>".$check_in_time."<br>".$check_out_time."<br>";
            // echo $location."<br>".$overview."<br>".$phone."<br>";
            // echo $type_pro."<br>".$type_category."<br>";
            // print_r($_FILES['image']);
        // Tìm proID
            $accID = $_SESSION['accID2'];
            $proID = findProIDByAccID($connect, $accID);

        $service_delete = $_POST['service'];

        $tmp_serive = allService($connect, $proID[0]);

        $service_origin = array();
        $value_delete = array();

        // Service delete
            // echo "Service muốn xóa: "."<br>";
            // print_r($service_delete);

            // echo "<br>"."Service ban đầu: "."<br>";
        while($row = mysqli_fetch_row($tmp_serive)){
            $service_origin[] = $row[0];
        }
            // print_r($service_origin);
            // echo "<br>"."Service có sự thay đổi:"."<br>";
        for($i = 0; $i < count($service_origin); $i++){
            $flag = 0;
            // Xét những giá trị bằng nhau
            for($j=0; $j < count($service_delete); $j++) { 
                if($service_origin[$i] == $service_delete[$j]){
                    $flag = 1;
                }
            }
            // Lấy ra các giá trị khác nhau đưa vào mảng lưu giá trị
            if($flag == 0){
                $value_delete[] = $service_origin[$i];
            }
        }
        

        if($error === 0){
            //echo "Update thông tin có ảnh";
            if($image_size > 125000000000){
                //$message = "File ảnh quá lớn";
                header("Location: ./Property_Information.php?flag=1");
            }
            else{
                $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allow_extent = array("jpg", "jpeg", "png");
                
                if(in_array($img_ex_lc, $allow_extent)){
                    $new_img = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = '../assets/img/upload/' .$new_img;
                    move_uploaded_file($image_url_ex, $img_upload_path);

                    $serviceAdd = $_POST['addService'];
                        if($serviceAdd == ""){
                            // Tiến hành Update
                            $sql = "UPDATE `property` 
                            SET `PropertyName`='$name',`CheckInTime`='$check_in_time',
                                `CheckOutTime`='$check_out_time',`Address_Property`='$location',
                                `Detail_Property`='$overview',`Phone_Property`='$phone',
                                `TypeProperty`='$type_pro',`Image_Property`='$new_img',
                                `TypeOfCategory`='$type_category'
                            WHERE PropertyID = '".$proID[0]."' ";

                            $result = mysqli_query($connect, $sql);

                            if($result){
                                // Xem xét mảng lưu giá trị xóa
                                for($i = 0; $i < count($value_delete); $i++){
                                    $value_delete_id = findServiceID($connect, $value_delete[$i]);
                                    //echo $value_delete_id[0]."<br>";
                                    $sql1 = "DELETE FROM SERVICE_SUPPLIED
                                            WHERE PropertyID = '".$proID[0]."' AND ServiceID = '".$value_delete_id[0]."'";

                                    mysqli_query($connect, $sql1);
                                }
                                header("Location: ./Property_Information.php");
                            }

                            
                        }
                        else{
                            //echo "<br>".$serviceAdd;
                            
                            // Tiến hành Update
                            $sql = "UPDATE `property` 
                            SET `PropertyName`='$name',`CheckInTime`='$check_in_time',
                                `CheckOutTime`='$check_out_time',`Address_Property`='$location',
                                `Detail_Property`='$overview',`Phone_Property`='$phone',
                                `TypeProperty`='$type_pro',`Image_Property`='$new_img',
                                `TypeOfCategory`='$type_category'
                            WHERE PropertyID = '".$proID[0]."' ";

                            mysqli_query($connect, $sql);


                            $check = checkService($connect, $serviceAdd);

                            // ServiceADD là 1 giá trị đã có trong bảng Service
                            if(mysqli_num_rows($check) > 0){
                                $serviceID = findServiceID($connect, $serviceAdd);

                                $sql = "INSERT INTO `service_supplied`(`PropertyID`, `ServiceID`) 
                                        VALUES ('$proID[0]','$serviceID[0]')";
                                
                                $result = mysqli_query($connect, $sql);

                                if($result){
                                    // Xem xét mảng lưu giá trị xóa
                                    for($i = 0; $i < count($value_delete); $i++){
                                        $value_delete_id = findServiceID($connect, $value_delete[$i]);
                                        //echo $value_delete_id[0]."<br>";
                                        $sql1 = "DELETE FROM SERVICE_SUPPLIED
                                                WHERE PropertyID = '".$proID[0]."' AND ServiceID = '".$value_delete_id[0]."'";
    
                                        mysqli_query($connect, $sql1);
                                    }
                                    header("Location: ./Property_Information.php");
                                }

                                //echo "<br>".$serviceID[0];
                            }
                            // ServiceAdd là 1 giá trị hoàn toàn mới
                            else {
                                $sql = "INSERT INTO SERVICE
                                        VALUES(NULL,'$serviceAdd')";
                                
                                $result = mysqli_query($connect, $sql);

                                if($result){
                                    $serviceID = newServiceID($connect);
                                    
                                    $sql = "INSERT INTO `service_supplied`(`PropertyID`, `ServiceID`) 
                                        VALUES ('$proID[0]','$serviceID[0]')";
                                
                                    $result = mysqli_query($connect, $sql);

                                    if($result){
                                        // Xem xét mảng lưu giá trị xóa
                                        for($i = 0; $i < count($value_delete); $i++){
                                            $value_delete_id = findServiceID($connect, $value_delete[$i]);
                                            //echo $value_delete_id[0]."<br>";
                                            $sql1 = "DELETE FROM SERVICE_SUPPLIED
                                                    WHERE PropertyID = '".$proID[0]."' AND ServiceID = '".$value_delete_id[0]."'";
        
                                            mysqli_query($connect, $sql1);
                                        }
                                        header("Location: ./Property_Information.php");
                                    }
                                }
                            }
                        }
                }
                else{
                    //$message = "Bạn không thể up ảnh với file này";
                    header("Location: ./Property_Information.php?flag=2");
                }
            }
        }
        // Update ko có ảnh
        else if($error == 4){
            $serviceAdd = $_POST['addService'];
            if($serviceAdd == ""){
                // Tiến hành Update
                $sql = "UPDATE `property` 
                SET `PropertyName`='$name',`CheckInTime`='$check_in_time',
                    `CheckOutTime`='$check_out_time',`Address_Property`='$location',
                    `Detail_Property`='$overview',`Phone_Property`='$phone',
                    `TypeProperty`='$type_pro',
                    `TypeOfCategory`='$type_category'
                WHERE PropertyID = '".$proID[0]."' ";

                $result = mysqli_query($connect, $sql);

                if($result){
                    // Xem xét mảng lưu giá trị xóa
                    for($i = 0; $i < count($value_delete); $i++){
                        $value_delete_id = findServiceID($connect, $value_delete[$i]);
                        //echo $value_delete_id[0]."<br>";
                        $sql1 = "DELETE FROM SERVICE_SUPPLIED
                                WHERE PropertyID = '".$proID[0]."' AND ServiceID = '".$value_delete_id[0]."'";

                        mysqli_query($connect, $sql1);
                    }
                    header("Location: ./Property_Information.php");
                }

                
            }
            else{
                //echo "<br>".$serviceAdd;
                
                // Tiến hành Update
                $sql = "UPDATE `property` 
                SET `PropertyName`='$name',`CheckInTime`='$check_in_time',
                    `CheckOutTime`='$check_out_time',`Address_Property`='$location',
                    `Detail_Property`='$overview',`Phone_Property`='$phone',
                    `TypeProperty`='$type_pro',
                    `TypeOfCategory`='$type_category'
                WHERE PropertyID = '".$proID[0]."' ";

                mysqli_query($connect, $sql);


                $check = checkService($connect, $serviceAdd);

                // ServiceADD là 1 giá trị đã có trong bảng Service
                if(mysqli_num_rows($check) > 0){
                    $serviceID = findServiceID($connect, $serviceAdd);

                    $sql = "INSERT INTO `service_supplied`(`PropertyID`, `ServiceID`) 
                            VALUES ('$proID[0]','$serviceID[0]')";
                    
                    $result = mysqli_query($connect, $sql);

                    if($result){
                        // Xem xét mảng lưu giá trị xóa
                        for($i = 0; $i < count($value_delete); $i++){
                            $value_delete_id = findServiceID($connect, $value_delete[$i]);
                            //echo $value_delete_id[0]."<br>";
                            $sql1 = "DELETE FROM SERVICE_SUPPLIED
                                    WHERE PropertyID = '".$proID[0]."' AND ServiceID = '".$value_delete_id[0]."'";

                            mysqli_query($connect, $sql1);
                        }
                        header("Location: ./Property_Information.php");
                    }

                    //echo "<br>".$serviceID[0];
                }
                // ServiceAdd là 1 giá trị hoàn toàn mới
                else {
                    $sql = "INSERT INTO SERVICE
                            VALUES(NULL,'$serviceAdd')";
                    
                    $result = mysqli_query($connect, $sql);

                    if($result){
                        $serviceID = newServiceID($connect);
                        
                        $sql = "INSERT INTO `service_supplied`(`PropertyID`, `ServiceID`) 
                            VALUES ('$proID[0]','$serviceID[0]')";
                    
                        $result = mysqli_query($connect, $sql);

                        if($result){
                            // Xem xét mảng lưu giá trị xóa
                            for($i = 0; $i < count($value_delete); $i++){
                                $value_delete_id = findServiceID($connect, $value_delete[$i]);
                                //echo $value_delete_id[0]."<br>";
                                $sql1 = "DELETE FROM SERVICE_SUPPLIED
                                        WHERE PropertyID = '".$proID[0]."' AND ServiceID = '".$value_delete_id[0]."'";

                                mysqli_query($connect, $sql1);
                            }
                            header("Location: ./Property_Information.php");
                        }
                    }
                }
            }
        }
    }
}

/*
    function: updateRoom
    Ý nghĩa : Update thông tin của Room
*/
function updateRoom(){
    if(isset($_POST['room-id']) || isset($_POST['type-room']) || isset($_POST['bed-num']) 
                || isset($_POST['room-name'] ) || isset($_POST['price'])){
        
        include "./connect.php";

        include "./HandleSelectPro.php";

        $room_id = $_POST['room-id'];

        $roomName = $_POST['room-name'];

        $typeRoom = $_POST['type-room'];

        $bedNum = $_POST['bed-num'];

        $price = $_POST['price'];
        
        // echo $room_id."<br>".$roomName."<br>".$typeRoom."<br>".$bedNum."<br>".$price."<br>";

        // print_r($_FILES['image']);

        if($room_id == ""){
            //echo "Insert thông tin";
            // Tìm accountID
                $accID = $_SESSION['accID2'];
                //echo "AccountID: ".$accID."<br>";
            // Tìm ProID
                // Lấy ra ProID
                $proID = findProIDByAccID($connect, $accID);
                // echo "PropertyID: ".$proID[0]."<br>";
            // Lấy thông tin ảnh
            $image_name = $_FILES['image']['name'];
            $image_url_ex =  $_FILES['image']['tmp_name'];
            $image_size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            if($error === 0){
                //echo "Update thông tin có ảnh";
                if($image_size > 125000000000){
                    //$message = "File ảnh quá lớn";
                    header("Location: ./Manage_Room.php?flag=1");
                }
                else{
                    $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
    
                    $allow_extent = array("jpg", "jpeg", "png");
                    
                    if(in_array($img_ex_lc, $allow_extent)){
                        $new_img = uniqid("IMG-", true).'.'.$img_ex_lc;
                        $img_upload_path = '../assets/img/upload/' .$new_img;
                        move_uploaded_file($image_url_ex, $img_upload_path);

                        // Tiến hành Insert
                        $sql = "INSERT INTO `room`(`RoomID`, `RoomName`, `TypeOfRoom`, `BedNum`, `Price`, `Image_Room`, `PropertyID`) 
                        VALUES (NULL,' $roomName','$typeRoom','$bedNum ','$price','$new_img','$proID[0]')";

                        $result = mysqli_query($connect, $sql);

                        header("Location: ./Manage_Room.php");
        
                    }
                    else{
                        //$message = "Bạn không thể up ảnh với file này";
                        header("Location: ./Manage_Room.php?flag=2");
                    }
                }
            }

        }
        else {
            if(isset($_FILES['image'])){
                $image_name = $_FILES['image']['name'];
                $image_url_ex =  $_FILES['image']['tmp_name'];
                $image_size = $_FILES['image']['size'];
                $error = $_FILES['image']['error'];
                if($error === 0){
                    //echo "Update thông tin có ảnh";
                    if($image_size > 125000000000){
                        //$message = "File ảnh quá lớn";
                        header("Location: ./Manage_Room.php?flag=1");
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
                            $sql = "UPDATE ROOM
                                    SET RoomName = '".$roomName."', TypeOfRoom = '".$typeRoom."',
                                                BedNum = '".$bedNum."', Price = '".$price."', Image_Room = '". $new_img."'
                                    WHERE RoomID = '".$room_id."' ";

                            $result = mysqli_query($connect, $sql);

                            header("Location: ./Manage_Room.php");
           
                        }
                        else{
                            //$message = "Bạn không thể up ảnh với file này";
                            header("Location: ./Manage_Room.php?flag=2");
                        }
                    }
                }
                else if($error === 4){
                    //echo "Update thông tin không có ảnh";

                    // Tiến hành update
                    $sql = "UPDATE ROOM
                            SET RoomName = '".$roomName."', TypeOfRoom = '".$typeRoom."',
                                BedNum = '".$bedNum."', Price = '".$price."'
                            WHERE RoomID = '".$room_id."' ";

                    $result = mysqli_query($connect, $sql);

                    header("Location: ./Manage_Room.php");
                }
            }
        }
    }
}

function updateStatusReservation(){
    if(isset($_COOKIE['ResID']) && isset($_COOKIE['Status'])){
        include "./connect.php";

        $ResID = $_COOKIE['ResID'];
        
        // $checkIn = $_COOKIE['CheckIn'];

        // $checkout = $_COOKIE['CheckOut'];

        $status = $_COOKIE['Status'];

        //echo $ResID."<br>".$status;

        $sql = "UPDATE Reservation
                SET Status_Reservation = '".$status."'
                WHERE ReservationID = '".$ResID."' ";

        $result = mysqli_query($connect, $sql);

        header("Location: ./Property_Reservation.php");
    }
}

/*
    Gọi hàm bằng biến $update
        + 1: updateInformation
        + 2: updateRoom
        + 3: updateStatusReservation
*/

switch ($update) {
    case 1:
        updateInformation();
        break;
    case 2:
        updateRoom();
        break;
    case 3:
        updateStatusReservation();
        break;
    default:
        break;
}

?>