<?php

session_start();

if (!isset($_SESSION['accID2'])) {
    header('Location: ./SignIn.php');
} else {
    // Include file cần thiêt
    include "./HandleSelectPro.php";

    include "./connect.php";

    include "./HandleAnother.php";

    $accID = $_SESSION['accID2'];
    // Lấy ra ProID
    $proID = findProIDByAccID($connect, $accID);
    //echo $proID[0]."<br>";
    // Lấy ra các loại phòng
    $allRoom = allRoom($connect, $proID[0]);

    // Tìm usernameReceive
    $userNameReceive = findUsername($connect, $accID);
    // Tìm inbox
    $showInbox = showInbox($connect, $userNameReceive[0]);

    //echo $_GET['flag'];
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
    <link rel="stylesheet" href="../css/Home_Property.css">
    <link rel="stylesheet" href="../css/Manage_Room.css">
    <title>Trivia</title>
</head>

<body>
    <div id="app">
        <header class="app__header">
            <nav class="app__nav d-flex justify-content-between align-items-center" style="max-width: 1200px;margin: 0 auto;">
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
        </header>

        <div class="app__content">
            <div class="app__content-nav">
                <nav class="d-flex justify-content-between align-items-center" style="max-width: 1200px;margin: 0 auto;">
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
                    <div class="app__content-nav-last position-relative">
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

            <div class="app__content-main mt-4" style="max-width: 1200px;margin: 0 auto;">
                <div class="">
                    <form action="./HandleUpdatePro.php?Update=2" method="POST" enctype="multipart/form-data">
                        <input type="text" id="room-id" name="room-id" hidden>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-column">
                                <label for="room-name"><b>Room Name</b><span style="color: red;">*</span></label>
                                <input type="text" name="room-name" id="room-name" required>
                            </div>
                            <div class="d-flex flex-column">
                                <label for="type-room"><b>Type Of Room</b><span style="color: red;">*</span></label>
                                <select name="type-room" id="type-room" required>
                                    <option value="">Choose type of room</option>
                                    <option value="Standard">Standard</option>
                                    <option value="Deluxe">Deluxe</option>
                                    <option value="Supervisor">Supervisor</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column">
                                <label for="bed-num"><b>Number Of Bed</b><span style="color: red;">*</span></label>
                                <div class="d-flex align-items-center">
                                    <input type="number" name="bed-num" id="bed-num" min="1" max="5">
                                    <span class="ms-1 text-danger bed-num-message">Number of bed must be between 1 and 5</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <label for="price"><b>Price</b><span style="color: red;">*</span></label>
                                <div class="d-flex align-items-center">
                                    <input type="number" name="price" id="price" min="600000" required>
                                    <span class="ms-1 text-danger price-message">Price must be at least 600000 VND</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column mt-3">
                            <label for="image"><b>Image</b><span style="color: red;">*</span></label>
                            <input type="file" name="image" id="image" onchange="readURL(this);" required>
                        </div>
                        <img src="" alt="Image Room" id="img-room" hidden class="mt-2">
                        <input type="submit" value="Save" name="btnSave" class="btn btn-primary mt-4 py-0">
                    </form>
                    <?php
                    if (isset($_GET['flag'])) {
                        $flag = $_GET['flag'];
                        if ($flag == "1") {
                    ?>
                            <span class="text-danger"><?php echo "Your size of file is too big"; ?></span>
                        <?php
                        } else if ($flag == "2") {
                        ?>
                            <span class="text-danger"><?php echo "You cannot upload file with this type"; ?></span>
                    <?php   }
                    }
                    ?>
                </div>

                <form action="./HandleDeletePro.php?Delete=1" method="POST" enctype="multipart/form-data">
                    <table class="table mt-4" id="table-room">
                        <tr>
                            <th class="d-none"></th>
                            <th style="width: 16%;">Room Name</th>
                            <th style="width: 16%;">Type Of Room</th>
                            <th style="width: 16%;">Number of Bed</th>
                            <th style="width: 16%;">Price</th>
                            <th style="width: 16%;">Image</th>
                            <th style="width: 20%;">Function</th>
                        </tr>
                        <?php
                        while ($room = mysqli_fetch_row($allRoom)) {
                        ?>
                            <tr>
                                <td class="d-none"><?php echo $room[0]; ?></td>
                                <td><?php echo $room[1]; ?></td>
                                <td><?php echo $room[2]; ?></td>
                                <td><?php echo $room[3]; ?></td>
                                <td><?php echo $room[4]; ?> VND</td>
                                <td>
                                    <?php
                                    $array_img = findImage($room[5]);
                                    ?>
                                    <?php
                                    if ($array_img[0] === 'IMG') {
                                    ?>
                                        <img src="../assets/img/upload/<?php echo $room[5]; ?>" alt="Image Room">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="<?php echo $room[5]; ?>" alt="Image Room">
                                    <?php } ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info">Update</button>
                                    <button type="submit" class="btn btn-danger ms-3" onclick="findInform(this)">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </form>
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
    <script src="../js/Manage_Room.js"></script>
    <script>
        loadMessage(usernameSend, usernameReceive, 2);

        function findInform(button) {
            function find_pos(row, x) {
                var updateTableCells = document.querySelector("#table-room").rows[row].cells;
                var updateTableRows = document.querySelector("#table-room").rows;
                for (let i = 0; i < updateTableRows.length; i++) {
                    if (updateTableRows[i] === x.parentElement.parentElement) {
                        document.cookie = "RoomID" + "=" + updateTableCells[0].innerText;
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