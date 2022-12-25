<?php

session_start();

if (!isset($_SESSION['accID2'])) {
    header('Location: ./SignIn.php');
} else {
    include "./connect.php";
    include "./HandleSelectPro.php";
    include "./HandleAnother.php";

    // Lấy ra accountID
    $accID = $_SESSION['accID2'];
    // Lấy ra proID
    $proID = findProIDByAccID($connect, $accID);
    // Khai báo biến
    $year = array();
    $amount = array();
    $month = array();
    $day = array();

    // Tìm usernameReceive
    $userNameReceive = findUsername($connect, $accID);
    // Tìm inbox
    $showInbox = showInbox($connect, $userNameReceive[0]);

    // Thống kê bằng chữ
    // Total Reservation
    $totalReservation = totalReservation($connect, $proID[0]);
    // Arrival (Status_Reservation = 1, 3)
    $arrival = totalArrival($connect, $proID[0]);
    // Departure (Status_Reservation = 2)
    $departure = totalDeparture($connect, $proID[0]);
    // Review (Tat ca review)
    $totalReview = totalReview($connect, $proID[0]);

    // Thống kê bằng biểu đồ
    if (isset($_GET['select-date'])) {
        $filter = $_GET['select-date'];
        if ($filter === 'year') {
            // Đồ thị Reservation theo năm
            $date1 = $_GET['input-date-arrival'];
            $date2 = $_GET['input-date-departure'];

            //echo $date1."<br>".$date2;

            $query = analyticsByYear($connect, $proID[0], $date1, $date2);

            foreach ($query as $data) {
                $year[] = $data['year'];
                $amount[] = $data['amount'];
            }
        } else if ($filter === 'month') {
            // Đồ thị Reservation theo tháng
            $date1 = $_GET['input-date-arrival'];
            $date2 = $_GET['input-date-departure'];

            //echo $month1."<br>".$month2;

            $query2 = analyticsByMonth($connect, $proID[0], $date1, $date2);

            foreach ($query2 as $data) {
                $month[] = $data['month'];
                $amount[] = $data['amount'];
            }
        } else if ($filter === 'day') {
            // Đồ thị Reservation theo tháng
            $date1 = $_GET['input-date-arrival'];
            $date2 = $_GET['input-date-departure'];

            //echo $month1."<br>".$month2;

            $query3 = analyticsByDay($connect, $proID[0], $date1, $date2);

            foreach ($query3 as $data) {
                $day[] = $data['day'];
                $amount[] = $data['amount'];
            }
        }
    }
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
    <link rel="stylesheet" href="../assets/css/grid.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="../css/Home_Property.css">
    <title>Trivia</title>
</head>

<body>
    <div id="app">
        <header class="app__header">
            <div class="grid wide">
                <nav class="app__nav d-flex justify-content-between align-items-center">
                    <div class="position-relative">
                        <a href="./Home_Property.php" class="text-decoration-none">
                            <img src="../assets/img/logo.png" alt="Logo" class="app__nav-img">
                            <span class="app__nav-detail position-absolute text-white">For Property</span>
                        </a>
                    </div>

                    <div class="app__nav-search">
                        <i class="px-2 py-3 fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="app__nav-search-input" name="app__nav-search-input" placeholder="Search for reservation">
                    </div>
                </nav>
            </div>
        </header>

        <div class="app__content">
            <div class="app__content-nav">
                <div class="grid wide">
                    <nav class="d-flex justify-content-between align-items-center">
                        <a href="./Home_Property.php" class="text-decoration-none app__content-nav-item p-3 text-center" style="color: black;border-bottom: 4px solid #000;">
                            <i class="pb-1 fa-solid fa-house"></i>
                            <figcaption>Home</figcaption>
                        </a>
                        <a href="./Property_Rates.php" class="text-decoration-none app__content-nav-item p-3 text-center">
                            <i class="pb-1 fa-solid fa-calendar-days"></i>
                            <figcaption>Rates & availability</figcaption>
                        </a>
                        <a href="./Property_Reservation.php" class="text-decoration-none app__content-nav-item p-3 text-center">
                            <i class="pb-1 fa-solid fa-check-to-slot"></i>
                            <figcaption>Reservations</figcaption>
                        </a>
                        <div class="position-relative">
                            <label for="app__content-nav-input" class="text-decoration-none app__content-nav-item p-3 text-center">
                                <i class="pb-1 fa-solid fa-pen-to-square"></i>
                                <figcaption>Property</figcaption>
                            </label>
                            <input type="checkbox" hidden name="app__content-nav-input" id="app__content-nav-input">

                            <div class="app__content-edit-box position-absolute text-dark">
                                <ul class="list-unstyled">
                                    <li class="p-2">
                                        <a href="./Property_Information.php" class="text-decoration-none text-dark">Update Information</a>
                                    </li>
                                    <li class="p-2">
                                        <a href="./Property_Review.php" class="text-decoration-none text-dark">Guest
                                            reviews</a>
                                    </li>
                                    <li class="p-2">
                                        <a href="./Manage_Room.php" class="text-decoration-none text-dark">Manage
                                            Rooms</a>
                                    </li>
                                    <li class="p-2">
                                        <label for="app__inbox-input" style="width: 100%;cursor: pointer;">Inbox</label>
                                    </li>
                                    <li class="p-2">
                                        <form action="./logout.php" method="POST">
                                            <button name="logOut_Pro" type="submit" class="btn-sign-out">
                                                Log out
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="app__content-main">
                <div class="grid wide">
                    <div class="app__overview border-bottom">
                        <div class="app__overview-title">
                            <span>Reservation overview</span>
                            <i class="fa-regular fa-calendar-days"></i>
                        </div>

                        <div class="d-flex mb-3">
                            <div class="app__overview-content-item text-center">
                                <p>Total</p>
                                <span><?php echo $totalReservation; ?></span>
                            </div>
                            <div class="app__overview-content-item text-center">
                                <p>Check In</p>
                                <span><?php echo $arrival; ?></span>
                            </div>
                            <div class="app__overview-content-item text-center">
                                <p>Check Out</p>
                                <span><?php echo $departure; ?></span>
                            </div>
                            <div class="app__overview-content-item text-center">
                                <p>Reviews</p>
                                <span><?php echo $totalReview; ?></span>
                            </div>
                            <div></div>
                        </div>

                        <div>
                            <a href="./Property_Reservation.php" class="app__overview-link float-end text-decoration-none">View all reservation</a>
                        </div>
                    </div>

                    <div class="app__analytic mt-3">
                        <p class="app__analytic-title">Analytics</p>

                        <form action="#" method="GET">
                            <div class="d-flex pb-4">
                                <div class="app__form-filter d-flex flex-column">
                                    <label for="select-date">Statistics filters</label>
                                    <select name="select-date" id="select-date">
                                        <option value="date">Date</option>
                                        <option value="month">Month</option>
                                        <option value="year">Year</option>
                                    </select>
                                </div>
                                <div class="app__form-filter d-flex flex-column">
                                    <label for="input-date-arrival">From</label>
                                    <input type="date" name="input-date-arrival" required id="input-date-arrival">
                                </div>
                                <div class="app__form-filter d-flex flex-column">
                                    <label for="input-date-departure">Until</label>
                                    <input type="date" name="input-date-departure" required id="input-date-departure">
                                </div>
                                <div class="align-self-end">
                                    <button type="submit" class="ms-3 btn btn-secondary">Filter</button>
                                </div>
                            </div>
                        </form>

                        <canvas id="analytics" style="width: 100%;max-width: 1200px; max-height: 600px;"></canvas>
                    </div>
                </div>
            </div>

            <input type="checkbox" hidden name="app__inbox-input" id="app__inbox-input">
            <label for="app__inbox-input" class="app__inbox-overlay"></label>
            <div class="app__inbox">
                <div class="row m-0 h-100 overflow-auto">
                    <div class="col-4" style="border-right: 1px solid #ccc;">
                        <ul class="list-unstyled">
                            <?php
                            while ($inbox = mysqli_fetch_row($showInbox)) {
                            ?>
                                <li class="app__inbox-item pb-2">
                                    <h6 class="ps-2 pe-2 pt-1 app__inbox-item-title"><?php echo $inbox[0]; ?></h6>
                                    <script>
                                        usernameSend = <?php echo json_encode($userNameReceive[0]); ?>;
                                        usernameReceive = <?php echo json_encode($inbox[0]); ?>;

                                        if (usernameSend != "") {
                                            loadMessage(usernameSend, usernameReceive, 2);
                                        }
                                    </script>
                                    <span class="ps-2 pe-2 app__inbox-item-content">
                                        <?php echo $inbox[1]; ?>
                                    </span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-8 app__inbox-message"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/Inbox.js"></script>

    <script>
        function drawBarChart(optionalLabel, amountBooking, maxReservation) {

            const xValues = optionalLabel;

            const yValues = amountBooking;

            new Chart("analytics", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,0.6)",
                        borderColor: "rgba(0,0,255,0.6)",
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Reservation(s)"
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: maxReservation * 1.5
                            }
                        }],
                    }
                }
            });
        }
        <?php
        if (count($year) > 0) {
        ?>
            // Vẽ biểu đồ với year
            year = <?php echo json_encode($year) ?>;
            amount = <?php echo json_encode($amount) ?>;
            maxReservation = <?php echo json_encode($totalReservation) ?>;
            drawBarChart(year, amount, maxReservation);
        <?php
        } else if (count($month) > 0) {
        ?>
            // Vẽ biểu đồ với month
            month = <?php echo json_encode($month) ?>;
            amount = <?php echo json_encode($amount) ?>;
            maxReservation = <?php echo json_encode($totalReservation) ?>;
            drawBarChart(month, amount, maxReservation);
        <?php } else if (count($day) > 0) {
        ?>
            // Vẽ biểu đồ với day
            day = <?php echo json_encode($day) ?>;
            amount = <?php echo json_encode($amount) ?>;
            maxReservation = <?php echo json_encode($totalReservation) ?>;
            drawBarChart(day, amount, maxReservation);
        <?php } ?>
    </script>
</body>

</html>