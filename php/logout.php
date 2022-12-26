<?php

session_start();

// Đăng xuất cho Property
if(isset($_POST['logOut_Pro'])){
    if (isset($_SESSION['accID2'])){
        unset($_SESSION['accID2']);
        header("Location: ./Homepage.php");
    }
}
// Đăng xuất cho Customer
else if(isset($_POST['logout_Cus'])){
    if(isset($_SESSION['accID3'])){
        unset($_SESSION['accID3']);
        unset($_SESSION['id']);
        unset($_SESSION['check-in-date']);
        unset($_SESSION['check-out-date']);
        unset($_SESSION['bed-num']);
        unset($_SESSION['hotel']);
        header("Location: ./Homepage.php");
    }
}

// Đăng xuất cho Admin
else if(isset($_POST['sign-out'])){
    if(isset($_SESSION['accID1'])){
        unset($_SESSION['accID1']);
        header("Location: ./Homepage.php");
    }
}

?>