<?php

session_start();


if(!isset($_SESSION['accID1'])){
   header('Location: ./SignIn.php');  
}


else {
    // include các file cần thiết
    include "./connect.php";

    include "./HandleSelectAdmin.php";
    // Thống kê chữ
        // Favourite Type
        $fType = favouriteType($connect);
        // Monthly Booking
        $mBooking = monthlyBooking($connect);
        // Hotel most Booking
        $hBooking = hotelMostBooking($connect);
        // Hotel Highest Point
        $hPoint = hotelHighestPoint($connect);

    // Đồ thị Real estate statistíc by category
    $query = thongkeCategoryBooking($connect);

    foreach($query as $data)
    {
        $Category[] = $data['Category'];
        $amount[] = $data['amount'];
    }

    // Đồ thị Statistics of bookings in the year
    $query1 = thongkeBookingYear($connect);

    foreach($query1 as $data1)
    {
        $month[] = $data1['month'];
        $soluong[] = $data1['soluong'];
    }
    // Số lượng Reservation 
    $reservationMax = soLuongReservation($connect);
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
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="../css/Admin.css">
    <link rel="stylesheet" href="../css/Admin_Analytics.css">
    <title>Trivia</title>
</head>

<body>
    <div id="wrapper">
        <nav class="nav-action">
            <div class="nav__header">
                <img src="../assets/img/logo.png" alt="Logo" class="nav__header-img">

                <span class="app__header-name">Admin page</span>
            </div>

            <div class="nav__content">
                <ul class="nav__content-list">
                    <li>
                        <a href="./Admin_Dashboard.php" class="nav__content-list-item">
                            <i class="fa-brands fa-unsplash"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="./Admin_Analytics.php" class="nav__content-list-item active">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span>Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="./Admin_Message.php" class="nav__content-list-item">
                            <i class="fa-solid fa-message"></i>
                            <span>Message</span>
                        </a>
                    </li>
                </ul>

                <form action="./logout.php" method="POST" class="nav__content-list-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <input type="submit" name="sign-out" class="sign-out" value="Sign out">
                </form>
            </div>
        </nav>

        <!--Start header-->
        <header class="topbar-nav">
            <nav class="navbar navbar-expand fixed-top">
                <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link toggle-menu" href="javascript:void();">
                            <i class="menu-icon fa-solid fa-bars"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form class="search-bar">
                            <input type="text" class="form-control" placeholder="Enter keywords">
                            <a href="javascript:void();">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </form>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                            href="javascript:void();">
                            <i class="fa-solid fa-envelope-open"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                            href="javascript:void();">
                            <i class="fa-regular fa-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                            <span class="user-profile">
                                <img src="../assets/img/others/anhkiet.jpg" class="img-circle" alt="user avatar">
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar">
                                            <img class="align-self-start me-3" src="../assets/img/others/anhkiet.jpg"
                                                alt="user avatar">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title">Nguyen Anh Kiet</h6>
                                            <p class="user-subtitle">20521498@gm.uit.edu.vn</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="fa-solid fa-inbox me-2"></i>
                                Inbox
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="fa-solid fa-user me-2"></i>
                                Account
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="fa-solid fa-sliders me-2"></i>
                                Setting
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="fa-solid fa-power-off me-2"></i>
                                Logout
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <!--End header-->

        <div class="clearfix"></div>

        <!-- Start content -->
        <div class="content-wrapper">
            <div class="row">
                <div class="col-5 d-flex flex-column justify-content-between">
                    <div class="analytic-item text-white pt-2 ps-3 pe-3 ms-3 me-3 mt-3">
                        <h5>Favourite type</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ms-3 d-flex flex-column align-items-center">
                                <span class="analytic-item-title">Name</span>
                                <span class="p-2 analytic-item-value"><?php echo $fType[0]; ?></span>
                            </div>
                            <div class="me-3 d-flex flex-column align-items-center">
                                <span class="analytic-item-title">Booking Quantity</span>
                                <span class="p-2 analytic-item-value"><?php echo $fType[1]; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="analytic-item text-white pt-2 ps-3 pe-3 ms-3 me-3 mt-3">
                        <h5>Month with the most booking</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ms-3 d-flex flex-column align-items-center">
                                <span class="analytic-item-title">Month</span>
                                <span class="p-2 analytic-item-value"><?php echo $mBooking[0]; ?></span>
                            </div>
                            <div class="me-3 d-flex flex-column align-items-center">
                                <span class="analytic-item-title">Booking Quantity</span>
                                <span class="p-2 analytic-item-value"><?php echo $mBooking[1]; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="analytic-item text-white pt-2 ps-3 pe-3 ms-3 me-3 mt-3">
                        <h5>Hotel with the most booking</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ms-3 d-flex flex-column align-items-center">
                                <span class="analytic-item-title">Hotel Name</span>
                                <span class="p-2 analytic-item-value"><?php echo $hBooking[1]; ?></span>
                            </div>
                            <div class="me-3 d-flex flex-column align-items-center">
                                <span class="analytic-item-title">Booking Quantity</span>
                                <span class="p-2 analytic-item-value"><?php echo $hBooking[2]; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="analytic-item text-white pt-2 ps-3 pe-3 ms-3 me-3 mt-3">
                        <h5>The most favourite hotel</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ms-3 d-flex flex-column align-items-center">
                                <span class="analytic-item-title">Hotel Name</span>
                                <span class="p-2 analytic-item-value"><?php echo $hPoint[1]; ?></span>
                            </div>
                            <div class="me-3 d-flex flex-column align-items-center">
                                <span class="analytic-item-title">Average Score</span>
                                <span class="p-2 analytic-item-value"><?php echo round($hPoint[2], 2); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <canvas id="property-statistic-by-category" style="width:100%;"></canvas>
                </div>
            </div>

            <div class="row">
                <canvas id="booking-year" class="mt-5" style="width:100%; height: 500px;"></canvas>
            </div>
        </div>
        <!-- End content -->

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top">
            <i class="fa-solid fa-angles-up"></i>
        </a>
        <!--End Back To Top Button-->

        <!--Start footer-->
        <footer class="footer">
            <div class="text-center">
                Copyright © 2022 by Alien
            </div>
        </footer>
        <!--End footer-->

        <!--start color switcher-->
        <div class="right-sidebar">
            <div class="switcher-icon">
                <i class="fa-solid fa-gear"></i>
            </div>
            <div class="right-sidebar-content">
                <p>Galaxy Background</p>
                <hr>

                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>

                <p>Gradient Background</p>
                <hr>

                <ul class="switcher">
                    <li id="theme7"></li>
                    <li id="theme8"></li>
                    <li id="theme9"></li>
                    <li id="theme10"></li>
                    <li id="theme11"></li>
                    <li id="theme12"></li>
                    <li id="theme13"></li>
                    <li id="theme14"></li>
                    <li id="theme15"></li>
                </ul>
            </div>
        </div>
        <!--end color switcher-->
    </div>

    <script src="../js/Admin.js"></script>
    <script src="../js/Admin_Analytics.js"></script>
    <script>
        // Vẽ CategoryBooking
        typecate = <?php echo json_encode( $Category) ?>;
        phpvalues1 = <?php echo json_encode($amount) ?>;
        drawPieChart(typecate, phpvalues1);

        // Vẽ YearBooking
        month = <?php echo json_encode($month) ?>;
        phpvalues2 = <?php echo json_encode($soluong) ?>;
        maxValue = <?php echo json_encode($reservationMax) ?>;
        drawLineChart(month, phpvalues2, maxValue);
    </script>
</body>

</html>