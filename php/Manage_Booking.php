<?php

include './connect.php';

session_start();

$accID = 0;

if (!isset($_SESSION['accID3'])) {
    header('Location: ./SignIn.php');
} else if (!isset($_GET['pro']) && !isset($_GET['check-in-date']) && !isset($_GET['room'])) {
    header("Location: ./Customer_viewBooking.php");
} else {
    // Gọi lấy ra thông tin tài khoản
    include "./getInformationCus.php";

    include "./HandleAnother.php";

    include "./HandleSelectCus.php";

    include "./HandleSelectPro.php";

    $accID = $_SESSION['accID3'];

    $resID = $_GET['resID'];

    $proID = findProIDByResno($connect, $resID);

    $proName = $_GET['pro'];

    $room = $_GET['room'];

    //echo $proName."<br>".$checkin."<br>".$room;

    // Manage_Booking
    $manageBooking = manageBooking($connect, $proName, $accID, $room);

    // Xét ảnh
    $array_img = findImage($manageBooking[0]);

    //Point_Hotel_Booking
    $point_Property = pointPropertyInMangeBooking($connect, $proID[0]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/Manage_Booking.css">
    <title>Manage your booking</title>
</head>

<body>
    <div id="app">
        <header class="app__header">
            <nav class="app__nav" style="max-width: 1200px;margin: 0 auto;">
                <a href="./Homepage.php" class="app__nav-name-link">
                    <img src="../assets/img/logo.png" alt="Logo" class="app__nav-name-icon">
                </a>

                <ul class="app__nav-list hide-on-mobile-tablet">
                    <li class="app__nav-item">
                        <a href="./Homepage.php" class="app__nav-item-link">Home</a>
                    </li>
                    <li class="app__nav-item">
                        <a href="./Contact.php" class="app__nav-item-link">Contacts</a>
                    </li>
                    <li class="app__nav-item">
                        <?php
                        echo "<a href='./Customer_Information.php' class='app__nav-item-link' style='cursor: pointer;'>" . $user_name . "</a>";
                        ?>
                    </li>
                </ul>
            </nav>
        </header>

        <div style="max-width: 1200px;margin: 0 auto;height: 250px;">
            <h2 class="mt-5">Manage Your Booking</h2>

            <div class="mt-4 d-flex w-100">
                <?php
                if ($array_img[0] === 'IMG') {
                ?>
                    <img src="../assets/img/upload/<?php echo  $manageBooking[0]; ?>" alt="Room image" style="width: 250px;height: 250px;">
                <?php
                } else {
                ?>
                    <img src="<?php echo  $manageBooking[0]; ?>" alt="Room image" style="width: 250px;height: 250px;">
                <?php } ?>

                <div class="ms-5 d-flex flex-column justify-content-between" style="flex: 1;">
                    <h4><?php echo $manageBooking[1]; ?></h4>
                    <p>Reservation number: <?php echo $manageBooking[2]; ?></p>
                    <p>Phone numbers: <?php echo $manageBooking[3]; ?></p>
                    <p>Address: <?php echo $manageBooking[4]; ?></p>
                    <p><b>Rating Score: </b><?php echo round($point_Property[0], 2); ?></p>
                    <!-- If status === "Ready" -->
                    <p><b><?php echo $manageBooking[5]; ?> - <?php echo $manageBooking[6]; ?></b></p>
                    <p><b>Check-in time: <?php echo $manageBooking[7]; ?> - Check-out time: <?php echo $manageBooking[8]; ?></b></p>
                    <!-- Else -->
                    <!-- <p><b>Check-in: 29 November, 2021</b></p>
                    <p><b>Check-out: 30 November, 2021</b></p> -->
                    <p><b>Status: <?php
                                    switch ($manageBooking[9]) {
                                        case 1:
                                            echo "Booked";
                                            break;
                                        case 2:
                                            echo "Checked out";
                                            break;
                                        case 3:
                                            echo "Live in";
                                            break;
                                        case 4:
                                            echo "Cancelled";
                                            break;
                                        case 5:
                                            echo "No show";
                                            break;
                                    }
                                    ?></b></p>
                </div>
            </div>

            <div class="mt-4" style="margin-left: 298px;">
                <!-- If status === "Ready" -->
                <?php
                if ($manageBooking[9] == 1) {

                ?>
                    <form action="./HandleUpdateCus.php?Update=3" method="POST">
                        <!-- Reservation Number -->
                        <input type="hidden" value="<?php echo $manageBooking[2]; ?>" name="reservationNumber">
                        <button type="submit" class="btn btn-danger" name="btnCancel">Cancel Your Booking</button>
                    </form>
                <?php
                } else if ($manageBooking[9] == 2) {
                ?>
                    <!-- Else if status === "Completed" -->
                    <a href="./Review_Property.php?reservationNumber=<?php echo $manageBooking[2]; ?>" class="btn btn-review text-decoration-none">Write your review</a>
                <?php
                } else {
                ?>
                    <!-- Else -> no button -->
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>