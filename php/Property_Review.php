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
    // Lấy ra ProID
    $proID = findProIDByAccID($connect, $accID);

    // Tìm usernameReceive
    $userNameReceive = findUsername($connect, $accID);
    // Tìm inbox
    $showInbox = showInbox($connect, $userNameReceive[0]);

    $allReview = allReview($connect, $proID[0]);
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
    <link rel="stylesheet" href="../css/Property_Review.css">
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
            </div>

            <div class="grid wide">
                <div class="app__content-main">
                    <p class="d-flex p-3 justify-content-between align-items-center border-bottom" style="color: #7a808b; font-size: 20px;">Reviews</p>

                    <div class="ms-3 me-3 mt-3">
                        <table class="table mb-0">
                            <tr>
                                <th>NAME</th>
                                <th class="text-center">RATING</th>
                                <th>REVIEW</th>
                            </tr>
                            <?php
                            while ($review = mysqli_fetch_row($allReview)) {
                            ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php
                                            // Gọi hàm xử lý chuỗi
                                            $array_img = findImage($review[0]);
                                            ?>
                                            <?php
                                            if ($array_img[0] === 'IMG') {
                                            ?>
                                                <img src="../assets/img/upload/<?php echo $review[0]; ?>" alt="Avatar" class="table-avatar">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="<?php echo $review[0]; ?>" alt="Avatar" class="table-avatar">
                                            <?php } ?>
                                            <div class="review-info ms-3">
                                                <p class="h6"><?php echo $review[1]; ?></p>
                                                <p><?php echo $review[2]; ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center h5"><?php echo $review[3]; ?></td>
                                    <td>
                                        <?php echo $review[4]; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
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