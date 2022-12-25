<?php

session_start();

if (!isset($_GET['hotel']) && !isset($_GET['id'])) {
    header("Location: ./Search.php");
} else if (!isset($_GET['check-in-date']) && !isset($_GET['check-out-date'])) {
    header("Location: ./Search.php");
} else {

    include "./HandleSelectCus.php";

    include "./connect.php";

    include "./HandleAnother.php";

    // Xử lý lấy ra thông tin khách sạn
    $hotelName = $_GET['hotel'];
    $proID = $_GET['id'];
    $checkin =  $_GET['check-in-date'];
    $checkout =  $_GET['check-out-date'];
    $bednum = $_GET['bed-num'];

    // Tạo session cho việc đăng nhập lại
    $_SESSION['hotel'] = $hotelName;
    $_SESSION['id'] = $proID;
    $_SESSION['check-in-date'] = $checkin;
    $_SESSION['check-out-date'] = $checkout;
    $_SESSION['bed-num'] = $bednum;

    // Xử lý lấy thông tin các phòng của khách sạn
    $result = thongtinKhachSan($connect, $proID);
    $hotel = mysqli_fetch_row($result);
    $result2 = thongTinPhong($connect, $proID, $checkin, $checkout, $bednum);
    $result3 = imageRoom($connect, $proID);
    $result4 = dichvuKhachSan($connect, $proID);
    $array_image_room = array();
    while ($image = mysqli_fetch_row($result3)) {
        $array_image_room[] = $image[0];
    }

    //print_r($array_image_room);

    // $soluong = mysqli_fetch_row($result2);
    // echo $soluong[0];
}

// Thông tin khách hàng (nếu có đăng nhập)
if (isset($_SESSION['accID3'])) {

    include "./getInformationCus.php";

    $accountid = $_SESSION['accID3'];

    $name_cus = $user_name;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/grid.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="stylesheet" href="../css/Search_Property.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title><?php echo $hotel[0] ?></title>
</head>

<body>
    <div id="app">
        <header class="app__header">
            <div class="grid wide">
                <nav class="app__nav">
                    <a href="./Homepage.php" class="app__nav-name-link">
                        <img src="../assets/img/logo.png" alt="Logo" class="app__nav-name-icon">
                    </a>

                    <ul class="app__nav-list">
                        <li class="app__nav-item">
                            <?php
                            // if(isset($_SESSION['accID3'])){
                            //     echo "<a href='./Homepage.php' class='app__nav-item-link'>Home</a>";
                            // }
                            // else {
                            //     echo "<a href='./Homepage.php' class='app__nav-item-link'>Home</a>";
                            // }
                            ?>
                            <a href="./Homepage.php" class="app__nav-item-link">Home</a>
                        </li>
                        <li class="app__nav-item">
                            <a href="./Contact.php" class="app__nav-item-link">Contact</a>
                        </li>
                        <li class="app__nav-item">
                            <?php
                            if (isset($_SESSION['accID3'])) {
                                echo "<a href='./Customer_Information.php' class='app__nav-item-link' style='cursor: pointer;'>" . $name_cus . "</a>";
                            } else {
                                echo "<a href='./Customer_SignUp.php' class='app__nav-item-link'>Sign Up</a>";
                            }
                            ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="grid wide">
            <div class="app__property-img">
                <?php
                // Gọi hàm xử lý chuỗi
                $array_img = findImage($array_image_room[0]);
                ?>
                <?php
                if ($array_img[0] === 'IMG') {
                ?>
                    <img src="../assets/img/upload/<?php $array_image_room[0]; ?>" alt="Image Property" class="app__list-img-item">
                <?php
                } else {
                ?>
                    <img src="<?php echo $array_image_room[0]; ?>" alt="Image Property" class="app__list-img-item">
                <?php } ?>
                <div>
                    <div>
                        <?php
                        // Gọi hàm xử lý chuỗi
                        $array_img = findImage($array_image_room[1]);
                        ?>
                        <?php
                        if ($array_img[0] === 'IMG') {
                        ?>
                            <img src="../assets/img/upload/<?php echo $array_image_room[1]; ?>" alt="Image Property" class="app__list-img-item">
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo $array_image_room[1]; ?>" alt="Image Property" class="app__list-img-item">
                        <?php } ?>
                        <?php
                        // Gọi hàm xử lý chuỗi
                        $array_img = findImage($array_image_room[2]);
                        ?>
                        <?php
                        if ($array_img[0] === 'IMG') {
                        ?>
                            <img src="../assets/img/upload/<?php echo  $array_image_room[2]; ?>" alt="Image Property" class="app__list-img-item">
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo $array_image_room[2]; ?>" alt="Image Property" class="app__list-img-item">
                        <?php } ?>
                    </div>
                    <div>
                        <?php
                        // Gọi hàm xử lý chuỗi
                        $array_img = findImage($array_image_room[3]);
                        ?>
                        <?php
                        if ($array_img[0] === 'IMG') {
                        ?>
                            <img src="../assets/img/upload/<?php echo $array_image_room[3]; ?>" alt="Image Property" class="app__list-img-item">
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo $array_image_room[3]; ?>" alt="Image Property" class="app__list-img-item">
                        <?php } ?>
                        <?php
                        // Gọi hàm xử lý chuỗi
                        $array_img = findImage($array_image_room[4]);
                        ?>
                        <?php
                        if ($array_img[0] === 'IMG') {
                        ?>
                            <img src="../assets/img/upload/<?php echo $array_image_room[4]; ?>" alt="Image Property" class="app__list-img-item">
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo $array_image_room[4]; ?>" alt="Image Property" class="app__list-img-item">
                        <?php } ?>
                    </div>
                </div>
            </div>
            <nav class="app__navigation">
                <a href="#app__overview">Overview</a>
                <a href="#app__room">Room</a>
                <a href="#app__information">Information</a>
                <a href="#app__facility">Amenities and Facilities</a>
                <a href="#app__review">Review</a>
            </nav>

            <div class="app__title">
                <h1> <?php echo $hotel[0]; ?></h1>
            </div>

            <div id="app__overview">
                <h3>Overview</h3>
                <span><?php echo $hotel[1]; ?></span>
            </div>

            <form action="" method="GET">
                <!-- Xử lý lưu dữ liệu liên quan db -->
                <!-- HotelID -->
                <input type="hidden" name="id" value="<?php echo $hotel[10]; ?>">
                <!-- HotelName -->
                <input type="hidden" name="hotel" value="<?php echo $hotel[0]; ?>">
                <div class="app__search">
                    <div class="py-1 position-relative" style="width: 140px;">
                        <div class="d-flex align-items-center">
                            <i class="pe-2 fa-solid fa-plane-departure"></i>
                            <div class="app__status-in">Check in</div>
                            <input type="date" name="check-in-date" id="app__check-in" min="2017-10-14" max="2050-12-31" value="<?php echo $checkin; ?>">
                        </div>
                        <p class="position-absolute toast-message-in p-1 text-center">The maximum interval between two
                            days is thirty</p>
                    </div>
                    <div class="py-1 position-relative" style="width: 140px;">
                        <div class="d-flex align-items-center">
                            <i class="pe-2 fa-solid fa-money-check"></i>
                            <div class="app__status-out">Check out</div>
                            <input type="date" name="check-out-date" id="app__check-out" min="2017-10-14" max="2050-12-31" value="<?php echo $checkout; ?>">
                        </div>
                        <p class="position-absolute toast-message-out p-1 text-center">The maximum interval between two
                            days is thirty</p>
                        <div class="box-quantity">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <input type="range" name="bed-num" value="<?php echo $bednum; ?>" id="bed-num" min="1" max="30" step="1" value="1">
                                <div class="">
                                    <label for="bed-num">Beds</label>
                                </div>
                                <div>
                                    <button type="button" class="btn-minus-bed">-</button>
                                    <span class="amount-bed">1</span>
                                    <button type="button" class="btn-add-bed">+</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <input type="range" name="per-num" id="per-num" min="1" max="30" step="1" value="1">
                                <div class="">
                                    <label for="per-num">Adults</label>
                                </div>
                                <div>
                                    <button type="button" class="btn-minus-people">-</button>
                                    <span class="amount-people">2</span>
                                    <button type="button" class="btn-add-people">+</button>
                                </div>
                            </div>
                            <button type="button" class="btn-accept">Accept</button>
                        </div>
                    </div>
                    <div class="d-flex py-1">
                        <button class="app__search-btn" type="submit">Search</button>
                    </div>
            </form>

            <div id="app__room">
                <div class="row">
                    <?php
                    while ($room = mysqli_fetch_row($result2)) {
                    ?>
                        <div class="col l-3">
                            <h3><?php echo $room[1]; ?></h3>
                            <div class="app__room-item">
                                <?php
                                $array_img = findImage($room[5]);
                                ?>
                                <?php
                                if ($array_img[0] === 'IMG') {
                                ?>
                                    <img src="../assets/img/upload/<?php echo $room[5]; ?>" alt="Image Room" class="app__room-item-img">
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo $room[5]; ?>" alt="Image Room" class="app__room-item-img">
                                <?php } ?>

                                <div class="app__room-item-main">
                                    <p class="app__room-item-type"><?php echo $room[2]; ?></p>
                                    <p class="app__room-item-request">
                                        <i class="fa-solid fa-user-group"></i>
                                        <span>Sleeps <?php echo $bednum * 2; ?></span>
                                    </p>
                                    <p class="app__room-item-request">
                                        <i class="fa-solid fa-bed"></i>
                                        <span><?php echo $room[3]; ?> Bed</span>
                                    </p>
                                    <p class="app__room-item-request">
                                        <i class="fa-solid fa-check"></i>
                                        <span>Reserve now, pay later</span>
                                    </p>
                                </div>
                                <div class="app__room-item-reserve">
                                    <p class="app__room-item-price"><?php echo $room[4]; ?></p>
                                    <span>for 1 night </br> includes taxes & fees</span>
                                    <div class="app__room-item-action">
                                        <?php
                                        if (isset($_SESSION['accID3'])) {
                                            echo " <span class='app__room-item-remain'></span>";
                                            echo "<a href='./Reservation.php?proNumber=$hotel[10]&RoomName=$room[1]&price=$room[4]&type= $room[2]&checkin=$checkin&checkout=$checkout' class='btn-reserve'>Reserve</a>";
                                        } else {
                                        ?>
                                            <span class="app__room-item-remain">Vui lòng đăng nhập để đặt phòng</span>
                                            <a href="./SignIn.php" class="btn-reserve">Reserve</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div id="app__information">
                <h3>Information</h3>

                <div class="app__information-item">
                    <h4>Check-in/Check-out</h4>
                    <p>Check-in from: <?php echo $hotel[2]; ?>
                        <br> Check-out until: <?php echo $hotel[3]; ?>
                    </p>
                </div>
                <div class="app__information-item">
                    <h4>Services</h4>
                    <div class="row">
                        <div class="col">
                            <?php
                            while ($service = mysqli_fetch_row($result4)) {
                            ?>
                                <p>
                                    <i class="fa-solid fa-check"></i>
                                    <?php echo $service[0]; ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="app__information-item">
                    <h4>Location</h4>
                    <p><?php echo $hotel[4]; ?>
                    </p>
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.537518774658!2d106.68078051458896!3d10.770081792325838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f223b48af69%3A0x49c2aebea46b1ab1!2zNDUzLzE2IE5ndXnhu4VuIMSQw6xuaCBDaGnhu4N1LCBQaMaw4budbmcgNSwgUXXhuq1uIDMsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1670094886989!5m2!1sen!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <div id="app__review">
                <h3>Review</h3>
                <div>
                    <div class="app__review-info">
                        <div class="app__review-info-title">
                            <span class="app__review-info-point"><?php echo $hotel[5]; ?></span>
                            <span>
                                <?php
                                if ($hotel[5] >= 6 && $hotel[5] < 7) {
                                    echo "Comfortable";
                                } else if ($hotel[5] >= 7 && $hotel[5] < 7) {
                                    echo "Good";
                                } else if ($hotel[5] >= 8 && $hotel[5] < 9) {
                                    echo "Excellent";
                                } else if ($hotel[5] >= 9) {
                                    echo "Exceptional";
                                }
                                ?>
                            </span>
                        </div>
                        <p class="app__review-info-item">
                            <i class="fa-solid fa-earth-americas"></i>
                            <span><b><?php echo $hotel[6]; ?></b> from <?php echo $hotel[7]; ?></span>
                        </p>
                    </div>

                    <div class="app__review-comment">
                        <p><?php echo $hotel[8]; ?></p>
                        <span><?php echo $hotel[9]; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <footer class="app__footer">
            <div class="grid wide">
                <div class="app__footer-contact">
                    <h3 class="app__footer-contact-title">
                        Enter your e-mail address and get</br> notified of exclusive offers
                    </h3>

                    <div class="app__footer-contact-input">
                        <div class="app__footer-input">
                            <input type="text" placeholder="Your e-mail address">
                        </div>

                        <div class="app__footer-btn">
                            <a href="#" class="app__search-btn btn-footer">Get Started</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col l-2-4 m-2-4 c-4">
                        <a href="#" class="app__nav-name-link">
                            <img src="../assets/img/logo.png" alt="Logo" class="app__nav-name-icon">
                        </a>
                    </div>
                    <div class="col l-2-4 m-2-4 c-4">
                        <ul class="app__footer-list">
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">About us</a>
                            </li>
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Newsletter</a>
                            </li>
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Careers</a>
                            </li>
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Blog</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l-2-4 m-2-4 c-4">
                        <ul class="app__footer-list">
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Community</a>
                            </li>
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Trivia Community</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l-2-4 m-2-4 c-4 mobile-offset-4">
                        <ul class="app__footer-list">
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Support</a>
                            </li>
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Help Centre</a>
                            </li>
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Safety Information</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l-2-4 m-2-4 c-4">
                        <ul class="app__footer-list">
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Hedge Karla</a>
                            </li>
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Mullein abc</a>
                            </li>
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Autumnal Bulgier</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="app__footer-socials">
                    <ul class="app__footer-socials-list">
                        <li class="app__footer-socials-item">
                            <a href="#" class="app__footer-socials-item-link">
                                <i class="app__footer-socials-item-icon fa-brands fa-square-instagram"></i>
                            </a>
                        </li>
                        <li class="app__footer-socials-item">
                            <a href="#" class="app__footer-socials-item-link">
                                <i class="app__footer-socials-item-icon fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li class="app__footer-socials-item">
                            <a href="#" class="app__footer-socials-item-link">
                                <i class="app__footer-socials-item-icon fa-brands fa-youtube"></i>
                            </a>
                        </li>
                        <li class="app__footer-socials-item">
                            <a href="#" class="app__footer-socials-item-link">
                                <i class="app__footer-socials-item-icon fa-brands fa-square-facebook"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="app__footer-copyright">
                    Copyright &copy; 2022 Alien
                </div>
            </div>
        </footer>
    </div>

    <script src="../js/Property_Information.js"></script>
</body>

</html>