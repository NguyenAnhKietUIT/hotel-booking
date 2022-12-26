<?php

include './connect.php';

session_start();

$accID = 0;

if(!isset($_SESSION['accID3'])){
    header('Location: ./SignIn.php');
}
else if(!isset($_GET['reservationNumber'])){
    header("Location: ./Manage_Booking.php");
}
else{
    // Gọi lấy ra thông tin tài khoản
    include "./getInformationCus.php";

    include "./HandleSelectCus.php";

    include "./HandleAnother.php";

    $accID = $_SESSION['accID3'];

    //echo $username[0];
    
    $reserNumber = $_GET['reservationNumber'];
    //echo $reserNumber;

    // Thông tin Property sẽ Review
    $hotelInformation = hotelInformationForReview($connect, $reserNumber);

    // Xét ảnh
    $array_img = findImage($hotelInformation[0]);
    
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
    <title>Review</title>
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
                            echo "<a href='./Customer_Information.php' class='app__nav-item-link' style='cursor: pointer;'>".$user_name."</a>";
                        ?>
                    </li>
                </ul>
            </nav>
        </header>

        <div style="max-width: 1200px;margin: 0 auto;height: 250px;">
            <h2 class="mt-5">Writing your review</h2>

            <div class="border mt-4 d-flex" style="width: 800px;">
                <?php
                    if($array_img[0] === 'IMG'){
                ?>
                    <img src="../assets/img/upload/<?php echo $hotelInformation[0]; ?>" alt="img_hotel" class="img_hotel">
                <?php 
                    }
                    else {
                ?>
                    <img src="<?php echo $hotelInformation[0]; ?>" alt="img_hotel" class="img_hotel">
                <?php } ?>
                <div class="ms-4 my-2 d-flex flex-column justify-content-between" style="flex: 1;">
                    <h5><?php echo $hotelInformation[1]; ?></h5>
                    <p>Address: <?php echo $hotelInformation[2]; ?></p>
                    <p><?php echo $hotelInformation[3]; ?> - <?php echo $hotelInformation[4]; ?></p>
                    <p><b>Status: <?php
                                    switch ($hotelInformation[5]) {
                                        case 1:
                                            echo "Ready";
                                            break;
                                        case 2:
                                            echo "Checked-out";
                                            break;
                                        case 3:
                                            echo "Stayed";
                                            break;
                                        case 4:
                                            echo "Canceled";
                                            break;
                                        case 5:
                                            echo "No Show";
                                            break;
                                    }
                                ?></b></p>
                </div>
            </div>

            <form action="./HandleInsertCus.php?Insert=4" method="POST">
                <!-- Reservation Number -->
                <input type="hidden" name="resNumber" value="<?php echo $reserNumber; ?>">
                <div class="mt-3 d-flex flex-column">
                    <label for="review">Your review</label>
                    <textarea name="review" id="review" cols="35" rows="6" placeholder="Leave your review here..." required></textarea>
                </div>

                <div class="mt-3">
                    <label for="rating">Your rating</label>
                    <input type="number" name="rating" id="rating" min="0" max="10" step="1" required>
                    <span  class="ms-1 text-danger rate-message">Rating must be between 0 and 10</span>
                </div>

                <button type="submit" name="btnReview" class="btn btn-review mt-4">Log review</button>
            </form>
        </div>
    </div>

    <script>
        const rating = document.getElementById("rating");
        const rateMessage = document.querySelector(".rate-message");

        rating.addEventListener("blur", () => {
            if (rating.value != null && (rating.value < 0 || rating.value > 10)) {
                rateMessage.style.display = 'inline-block';
            }
        })

        rating.addEventListener("focus", () => {
            rateMessage.style.display = 'none';
        })
    </script>
</body>
</html>