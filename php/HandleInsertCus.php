<!-- Xử lý Đăng ký -->
<?php

session_start();

// Xử lý các biến get
    // Insert = 1 -> function signUp
    // Insert = 2 -> function sendMessage
    // Insert = 3 -> function reservation
    // Insert = 4 -> function writeReview
    // Insert = 5 -> function sendContact


// Tạo biến đón các insẻt
$insert = $_GET['Insert'];

/*
    function: signUp
    Ý nghĩa : Đăng ký tài khoản. Thêm vào bảng Account
*/
function signUp(){

    $username = "";

    $email = "";

    $pass = "";

    $confirm_pass = "";

    $flag = 0;
    
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ){

        include "./connect.php";

        include "./HandleAnother.php";

        try {
            $username = $_POST['username'];

            $email = $_POST['email'];

            $pass = $_POST['password'];

            $confirm_pass = $_POST['confirm-password'];

            $sql1 = "SELECT * FROM ACCOUNT WHERE Username = '".$username."'";

            $result1 = mysqli_query($connect, $sql1);

            $sql2 = "SELECT * FROM ACCOUNT WHERE GMAIL = '".$email."'";

            $result2 = mysqli_query($connect, $sql2);

            if(mysqli_num_rows($result1) > 0){
                $flag = 1;// Username đã tồn tại
                header("Location: Customer_SignUp.php?flag=$flag");
            }
            else if(mysqli_num_rows($result2) > 0){
                $flag = 2;// Gmail đã tồn tại
                header("Location: Customer_SignUp.php?flag=$flag");
            }
            else {
                $sql = "INSERT INTO `account`(`AccountID`, `Username`, `Passwords`, `GMAIL`, `ROLES`) 
                VALUES (NULL,'$username','$pass','$email','3')";
    
                $result1 = mysqli_query($connect, $sql);

                if($result1){
                    $new_accountid = newAccountCus($connect);

                    $sql2 = "INSERT INTO `customer`(`CustomerID`, `Sex`, `Status_Account`, `AccountID`) 
                                VALUES (NULL,'0','1','$new_accountid[0]')";

                    $result2 = mysqli_query($connect, $sql2);

                    if($result2){
                        header("Location: ./SignIn.php");
                    }
                }
                
            }   
        }catch (mysqli_sql_exception $sth) {
            echo $sth;
        }
    }
}


/*
    function: sendMessage
    Ý nghĩa : Gửi thông tin Message. Thêm vào bảng Contact
*/
function sendMessage(){
    $topic = "";

    $email = "";

    $full_name = "";

    $message = "";

    try {
        if(isset($_POST['topic']) && isset($_POST['email']) 
                && isset($_POST['fullname']) && isset($_POST['box-msg']) && isset($_POST['topicname'])){

            include "./connect.php";

            $topic = $_POST['topic'];

            $topicName = $_POST['topicname'];

            $email = $_POST['email'];

            $full_name = $_POST['fullname'];

            $message = $_POST['box-msg'];

            if(isset($_SESSION['accID3'])){
                include "./HandleSelect.php";

                $account = $_SESSION['accID3'];

                $username = findUsername($connect, $account);

                echo $username[0];

                $sql = "INSERT INTO `contact`(`contactID`, `userNameSend`, `userNameReceive`, `topicType`, `topicName`, `fullName`, `Email`, `Message`) 
                            VALUES (NULL,'$username[0]','admin','$topic','$topicName','$full_name','$email','$message')";

                $result = mysqli_query($connect ,$sql);

                header("Location: ./Contact.php?flag=1");  
            }
            else {
                $username = "";
                $sql = "INSERT INTO `contact`(`contactID`, `userNameSend`, `userNameReceive`, `topicType`, `topicName`, `fullName`, `Email`, `Message`) 
                            VALUES (NULL,'$username','admin','$topic','$topicName','$full_name','$email','$message')";

                $result = mysqli_query($connect ,$sql);

                header("Location: ./Contact.php?flag=1"); 
            }

 
        }
    } catch (mysqli_sql_exception $th) {
        
    }
}

/*
    function: reservation
    Ý nghĩa : Đặt phòng. Thêm vào bảng Reservation
*/
function reservation(){
    
    if(isset($_POST['name']) && isset($_POST['phone-number'])
        && isset($_POST['PropertyID']) && isset($_POST['RoomName']) && isset($_POST['UserName'])
        && isset($_POST['CheckIn']) && isset($_POST['CheckOut']) && isset($_POST['TotalPrice'])){

        include "./connect.php";

        include "./HandleSelectCus.php";

        $accID = $_SESSION['accID3'];

        $name = $_POST['name'];

        $phone = $_POST['phone-number'];

        $proID = $_POST['PropertyID'];

        $roomName = $_POST['RoomName'];

        $userName = $_POST['UserName'];

        $checkin = $_POST['CheckIn'];

        $checkout = $_POST['CheckOut'];

        $totalPrice = $_POST['TotalPrice'];

        $status_reser = 1;

        $roomID = roomID($connect, $roomName, $proID);
        
        $cusID = findcusID($connect, $userName);

        $status = findStatusAccount($connect, $accID);
        // Kiểm tra
            
            // echo $cusID[0]."<br>".$roomID[0]."<br>";
            // echo $name."<br>".$phone."<br>";
            // echo $checkout."<br>".$checkin."<br>";   
            // echo $totalPrice."<br>".$status[0];
        // Inactive account => Reservation Failed
        if($status[0] == 0){
            header("Location: ./Error.php");
        }
        // Active account => Reservation Success
        else{
            $sql = "INSERT INTO `reservation` 
            VALUES (NULL,'$cusID[0]','$roomID[0]','$name','$phone'
                                ,'$checkin','$checkout','$totalPrice','$status_reser')";

            mysqli_query($connect, $sql);

            header("Location: ./Success.php");
        }
        
    }
}

/*
    function: writeReview
    Ý nghĩa : Viết bình luận. Thêm vào bảng Evaluate_Property
*/
function writeReview(){
    if(isset($_POST['review']) && isset($_POST['rating']) && isset($_POST['resNumber'])){

        include "./connect.php";

        include "./HandleSelectPro.php";

        include "./HandleSelectCus.php";

        $accID = $_SESSION['accID3'];

        $review = $_POST['review'];

        $rating = $_POST['rating'];

        $resNumber = $_POST['resNumber'];

        // Thông tin Insert
        $proID = findProIDByResno($connect, $resNumber);

        $username = findUsernameCus($connect, $accID);
        //echo $username[0];

        $cusID = findcusID($connect, $username[0]);

        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $date = getdate();

        $currentDate = $date["year"] . "-". $date["mon"] . "-". $date["mday"];
        // Thông tin kiểm tra
            // echo $cusID[0]."<br>";
            // echo $proID[0]."<br>";
            // echo $rating."<br>".$review."<br>";
            // echo $date;
    
        $sql = "INSERT INTO `evaluate_property`(`evaHotelID`, `CustomerID`, `PropertyID`, `Point`, `Comment`, `timeComment`) 
                 VALUES (NULL,'$cusID[0]','$proID[0]','$rating','$review', '$currentDate')";

        mysqli_query($connect, $sql);

        header("Location: ./Customer's_Review.php");
    }
}


/*
    Gọi hàm bằng biến $insert
        + 1: signUp
        + 2: sendMessage
        + 3: reservation
*/

switch ($insert) {
    case 1:
        signUp();
        break;
    case 2:
        sendMessage();
        break;   
    case 3:
        reservation();
        break; 
    case 4:
        writeReview();
        break;
    default:
        break;
}

?>