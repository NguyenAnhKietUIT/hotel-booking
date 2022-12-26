<?php

session_start();

if (!isset($_SESSION['accID2'])) {
    header('Location: ./SignIn.php');
} else {
    include "./connect.php";
    include "./HandleSelectPro.php";
    include "./HandleAnother.php";

    // Tìm accountID
    $accID = $_SESSION['accID2'];
    // Tìm ProID
    $proID = findProIDByAccID($connect, $accID);

    // Tìm usernameReceive
    $userNameReceive = findUsername($connect, $accID);
    // Tìm inbox
    $showInbox = showInbox($connect, $userNameReceive[0]);

    // Xử lý Filter
    if (
        isset($_GET['select-date']) && isset($_GET['input-date-arrival'])  && isset($_GET['input-date-departure'])
        && isset($_GET['input-search'])
    ) {

        $selected = $_GET['select-date'];
        if ($selected == 0) {
            $checkInFrom = $_GET['input-date-arrival'];
            //echo $checkInFrom."<br>";
            $checkInUntil = $_GET['input-date-departure'];
            //echo $checkInUntil;
            $input = $_GET['input-search'];
            if ($input == "") {
                $allReser = filterReservationByArrival($connect, $proID[0], $checkInFrom, $checkInUntil);
            } else {
                $allReser = filterReservationByArrivalInput($connect, $proID[0], $checkInFrom, $checkInUntil, $input);
            }
        } else if ($selected == 1) {
            $checkOutFrom = $_GET['input-date-arrival'];
            $checkOutUntil = $_GET['input-date-departure'];
            $input = $_GET['input-search'];

            if ($input = "") {
                $allReser = filterReservationByDeparture($connect, $proID[0], $checkOutFrom, $checkOutUntil);
            } else {
                $allReser = filterReservationByDepartureInput($connect, $proID[0], $checkOutFrom, $checkOutUntil, $input);
            }
        }
    } else {
        $allReser = allReservation($connect, $proID[0]);
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
    <link rel="stylesheet" href="../css/Home_Property.css">
    <link rel="stylesheet" href="../css/Property_Reservation.css">
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
                        <a href="./Home_Property.php" class="text-decoration-none app__content-nav-item p-3 text-center">
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
                                        <a href="./Manage_Room.php" class="text-decoration-none text-dark">Manage Rooms</a>
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

            <div class="grid wide">
                <div class="app__content-main">
                    <form action="#" method="GET">
                        <div class="d-flex pb-4 border-bottom">
                            <div class="app__form-filter d-flex flex-column">
                                <label for="select-date">Date of</label>
                                <select name="select-date" id="select-date">
                                    <option value="0">Check in</option>
                                    <option value="1">Check out</option>
                                </select>
                            </div>
                            <div class="app__form-filter d-flex flex-column">
                                <label for="input-date-arrival">From</label>
                                <input type="date" name="input-date-arrival" id="input-date-arrival">
                            </div>
                            <div class="app__form-filter d-flex flex-column">
                                <label for="input-date-departure">Until</label>
                                <input type="date" name="input-date-departure" id="input-date-departure">
                            </div>
                            <div class="app__form-filter d-flex flex-column">
                                <label for="input-search">Search</label>
                                <input type="search" name="input-search" id="input-search" placeholder="Keywords (optional)">
                            </div>
                            <button class="btn btn-secondary ms-3 py-0" style="height: 32px;margin-top: 24px;">Filter</button>
                        </div>
                    </form>

                    <form action="./HandleUpdatePro.php?Update=3" method="POST" enctype="multipart/form-data">
                        <table class="mt-3 w-100 table-striped table-hover table-bordered" id="table-reservation">
                            <tr>
                                <th>Reservation number</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Types of room</th>
                                <th>Status</th>
                                <th>Total price</th>
                                <th>Edit</th>
                            </tr>
                            <?php
                            while ($reser = mysqli_fetch_row($allReser)) {
                            ?>
                                <tr>
                                    <td>
                                        <p><?php echo $reser[0]; ?></p>
                                        <span style="font-size: 12px;"><?php echo $reser[1]; ?> bed</span>
                                    </td>
                                    <td><?php echo $reser[2]; ?></td>
                                    <td><?php echo $reser[3]; ?></td>
                                    <td><?php echo $reser[4]; ?></td>
                                    <td>
                                        <!-- Bỏ Disabled -->
                                        <select name="select-status" id="select-status" onchange="findSelected(this)" disabled>
                                            <option value="1" <?php if ($reser[5] == 1) {
                                                                    echo "selected";
                                                                } ?>>Booked</option>
                                            <option value="2" <?php if ($reser[5] == 2) {
                                                                    echo "selected";
                                                                } ?>>Checked out</option>
                                            <option value="3" <?php if ($reser[5] == 3) {
                                                                    echo "selected";
                                                                } ?>>Live in</option>
                                            <option value="4" <?php if ($reser[5] == 4) {
                                                                    echo "selected";
                                                                } ?>>Canceled</option>
                                            <option value="5" <?php if ($reser[5] == 5) {
                                                                    echo "selected";
                                                                } ?>>No show</option>
                                        </select>
                                    </td>
                                    <td><?php echo $reser[6]; ?> VND</td>
                                    <td>
                                        <button class="btn btn-info" type="button">
                                            Edit status
                                        </button>
                                        <!-- Bỏ Disabled -->
                                        <button class="ms-3 btn btn-success" name="btnSucces" type="submit" onclick="findInform(this)" disabled>
                                            Success
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </form>
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
    <script src="../js/Property_Reservation.js"></script>
    <script>
        loadMessage(usernameSend, usernameReceive, 2);

        function findSelected(select) {

            document.cookie = "Status" + "=" + select.value;
        }

        function findInform(button) {
            function find_pos(row, x) {
                var updateTableCells = document.querySelector("#table-reservation").rows[row].cells;
                var updateTableRows = document.querySelector("#table-reservation").rows;
                for (let i = 0; i < updateTableRows.length; i++) {
                    if (updateTableRows[i] === x.parentElement.parentElement) {
                        document.cookie = "ResID" + "=" + updateTableCells[0].innerText;
                        break;
                    }
                }
                return false;
            }
            find_pos((button.parentElement).parentElement.rowIndex, button);
        }
    </script>
</body>

</html>