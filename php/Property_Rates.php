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

    // Get giá trị các biến get
    if (isset($_GET['select-room']) && isset($_GET['select-status'])) {
        $typeRoom = $_GET['select-room'];
        $status = $_GET['select-status'];
        if ($typeRoom == "" && $status == "") {
            $allRate = allRate($connect, $proID[0]);
        } else if ($typeRoom != "" && $status == "") {
            $allRate = filterRateByTypeRoom($connect, $proID[0], $typeRoom);
        } else if ($typeRoom == "" && $status != "") {
            $allRate = filterRateByStatus($connect, $proID[0], $status);
        } else if ($typeRoom != "" && $status != "") {
            $allRate = filterRateByAll($connect, $proID[0], $typeRoom, $status);
        }
    } else {
        $allRate = allRate($connect, $proID[0]);
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
    <link rel="stylesheet" href="../css/Property_Rates.css">
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

            <div class="app__content-main">
                <div class="grid wide">
                    <form action="#" method="GET">
                        <div class="mt-5 d-flex justify-content-between">
                            <select name="select-room" id="select-room">
                                <option value="">Types of room</option>
                                <option value="Standard">Standard</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Deluxe">Deluxe</option>
                            </select>

                            <select name="select-status" id="select-status" class="ms-3">
                                <option value="">Room status</option>
                                <option value="1">Booked</option>
                                <option value="2">Checked out</option>
                                <option value="3">Live in</option>
                                <option value="4">Canceled</option>
                                <option value="5">No show</option>
                            </select>

                            <button type="submit" class="ms-3 btn-clear">Filters</button>
                            <div style="flex: 1;"></div>
                        </div>
                    </form>

                    <table class="table mt-5">
                        <tr>
                            <th>Quantity</th>
                            <th>Room types</th>
                            <th>Standard rates</th>
                            <th>Room status</th>
                        </tr>
                        <?php
                        while ($rate = mysqli_fetch_row($allRate)) {
                        ?>
                            <tr>
                                <td><?php echo $rate[0]; ?></td>
                                <td><?php echo $rate[1]; ?></td>
                                <td><?php echo round($rate[2], 2); ?> VND</td>
                                <td>
                                    <?php
                                    switch ($rate[3]) {
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
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
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
    <script>
        loadMessage(usernameSend, usernameReceive, 2);
    </script>
</body>

</html>