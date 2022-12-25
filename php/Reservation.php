<?php

session_start();

if (!isset($_SESSION['accID3'])) {
    header("Location: ./SignIn.php");
} else if (
    !isset($_GET['proNumber']) && !isset($_GET['RoomName'])
    && !isset($_GET['price']) && !isset($_GET['type'])
    && !isset($_GET['checkin']) && !isset($_GET['checkout'])
) {
    header("Location: ./Search.php");
} else {

    include "./HandleSelectCus.php";

    include "./getInformationCus.php";

    include "./HandleAnother.php";

    // Lấy ra các giá trị cần thiết

    $accountid = $_SESSION['accID3'];

    $name_cus = $user_name;

    // Lấy ra các thông tin cần đặt phòng
    $roomName = $_GET['RoomName'];

    $proID = $_GET['proNumber'];

    $price = $_GET['price'];

    $type = $_GET['type'];

    $checkin =  $_GET['checkin'];

    $checkout =  $_GET['checkout'];

    $hotel = thongtinKhachSanDatPhong($connect, $proID);

    $array_img = findImage($hotel[5]);

    //echo $status[0];

    $totalMoney = 0;
    // Tổng ngày ở
    $totalDay = totalDay($checkin, $checkout);
    if ($totalDay == 0) {
        $totalMoney = $price;
    } else {
        // Tổng tiền
        $totalMoney = totalMoney($price, $totalDay);
    }

    $vat = $totalMoney * 5 / 100;

    $total = $totalMoney + $vat;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/Reservation.css">
    <title>Trivia</title>
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
                        <a href="./Homepage.php" class="app__nav-item-link text-white">Home</a>
                    </li>
                    <li class="app__nav-item">
                        <a href="./Contact.php" class="app__nav-item-link">Contacts</a>
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
        </header>

        <div class="app__content mt-5" style="max-width: 1200px;margin: 0 auto;">
            <div class="row">
                <div class="col-4">
                    <div class="border" style="border-radius: 16px;">
                        <div class="m-4 d-flex flex-column justify-content-between">
                            <h5>Your booking details</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <p>Check-in</p>
                                    <h6><?php echo $checkin; ?></h6>
                                    <p style="font-size: 12px;"><?php echo $hotel[3]; ?></p>
                                </div>

                                <div>
                                    <p>Check-out</p>
                                    <h6><?php echo $checkout; ?></h6>
                                    <p style="font-size: 12px;"><?php echo $hotel[4]; ?></p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h6>Total length of stay:</h6>
                                <p><?php echo $totalDay; ?> night</p>
                            </div>
                            <div class="mt-4">
                                <h6>You selected</h6>
                                <p><?php echo $type; ?> Room</p>
                            </div>
                        </div>
                    </div>
                    <div class="border mt-4" style="border-radius: 16px;">
                        <div class="m-4 d-flex flex-column justify-content-between">
                            <h5>Your price summary</h5>
                            <div class="mt-3 d-flex justify-content-between">
                                <span>Total before VAT</span>
                                <span><?php echo $totalMoney; ?> VND</span>
                            </div>
                            <div class="mt-1 d-flex justify-content-between pb-3 border-bottom">
                                <span>5% VAT</span>
                                <span><?php echo $vat ?> VND</span>
                            </div>
                            <div class="mt-1 d-flex justify-content-between">
                                <h6>Total</h6>
                                <span><?php echo $total; ?> VND</span>
                            </div>
                        </div>
                    </div>
                    <div class="border mt-4" style="border-radius: 16px;">
                        <div class="m-4 d-flex flex-column justify-content-between">
                            <h5>Payment method</h5>
                            <p>At the property</p>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="d-flex border" style="border-radius: 16px;">
                        <?php
                        if ($array_img[0] === 'IMG') {
                        ?>
                            <img src="../assets/img/upload/<?php echo $hotel[5]; ?>" alt="Avatar" class="property-img">
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo $hotel[5]; ?>" alt="Avatar" class="property-img">
                        <?php } ?>
                        <div class="d-flex flex-column m-3 flex-1">
                            <h5><?php echo $hotel[0]; ?></h5>
                            <p class="mb-1">Address: <?php echo $hotel[1]; ?></p>
                            <p style="flex: 1;">Average point: <?php echo round($hotel[2], 2); ?></p>
                        </div>
                    </div>

                    <div class="border mt-5" style="border-radius: 16px;">
                        <div class="m-4 d-flex flex-column justify-content-between">
                            <h5>Enter your stay details</h5>

                            <form action="./HandleInsertCus.php?Insert=3" method="post" id="form">
                                <!-- Lấy ra các thông tin cần xử lý DB -->
                                <!-- PropertyID -->
                                <input type="hidden" name="PropertyID" value="<?php echo $hotel[6]; ?>">
                                <!-- RoomName -->
                                <input type="hidden" name="RoomName" value="<?php echo $roomName; ?>">
                                <!-- UserName -->
                                <input type="hidden" name="UserName" value="<?php echo $name_cus; ?>">
                                <!-- CheckIn -->
                                <input type="hidden" name="CheckIn" value="<?php echo $checkin; ?>">
                                <!-- CheckOut -->
                                <input type="hidden" name="CheckOut" value="<?php echo $checkout; ?>">
                                <!-- TotalPrice -->
                                <input type="hidden" name="TotalPrice" value="<?php echo $total; ?>">
                                <div class="form-group">
                                    <label for="name"><b>Name</b><span style="color: red;">*</span></label>
                                    <input id="name" name="name" type="text" class="form-control mt-2">
                                    <span class="form-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="phone-number"><b>Phone numbers</b><span style="color: red;">*</span></label>
                                    <input id="phone-number" name="phone-number" type="text" class="form-control mt-2">
                                    <span class="form-message"></span>
                                </div>
                                <div class="mt-4 mb-5 d-flex">
                                    <div style="flex: 1;"></div>
                                    <a href="./Search_Property.php" class="text-decoration-none">
                                        <button>Cancel</button>
                                    </a>
                                    <button class="ms-3" type="submit">Complete Your Booking</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/validator.js"></script>
    <script>
        Validator({
            form: '#form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#name'),
                Validator.isRequired('#phone-number'),
                Validator.isPhoneNumber('#phone-number'),
            ]
        });
    </script>
</body>

</html>