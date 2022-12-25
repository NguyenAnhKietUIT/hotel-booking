<?php

session_start();

$accountid = "";

$name_cus = "";

if (isset($_SESSION['accID3'])) {
    include "./getInformationCus.php";

    $accountid = $_SESSION['accID3'];

    $name_cus = $user_name;
}

if (
    !isset($_GET['check-in-date']) && !isset($_GET['check-out-date'])
    && !isset($_GET['bed-num']) && !isset($_GET['search-destination'])
    && !isset($_GET['top-destination']) && !isset($_GET['typePro'])
    && !isset($_GET['typeCategory']) && !isset($_GET['place'])
) {

    header("Location: ./Homepage.php?error=1");
} else {

    include "./HandleSelectCus.php";

    include "./connect.php";

    include "./HandleAnother.php";

    $place = "";
    $checkin = "";
    $checkout = "";
    $bednum = "";
    $result = 0;

    // Xét riêng theo Top
    if (isset($_GET['top-destination'])) {
        $place = $_GET['top-destination'];
        $date = getdate();
        $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];
        $checkin = $currentDate;
        $checkout = $currentDate;
        $result = timPhongTheoTopDestination($connect, $place);
    } else if (isset($_GET['typePro'])) {
        $typePro = $_GET['typePro'];
        $date = getdate();
        $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];
        $checkin = $currentDate;
        $checkout = $currentDate;
        $result = timPhongTheoTopType($connect, $typePro);
    } else if (isset($_GET['typeCategory']) && isset($_GET['place'])) {
        $typeCateGory = $_GET['typeCategory'];
        $place = $_GET['place'];
        $date = getdate();
        $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];
        $checkin = $currentDate;
        $checkout = $currentDate;
        $result = timPhongTheoTopCate($connect, $typeCateGory, $place);
    } else if (
        isset($_GET['check-in-date']) && isset($_GET['check-out-date'])
        && isset($_GET['search-destination']) && isset($_GET['bed-num'])
    ) {

        $place = $_GET['search-destination'];
        $checkin = $_GET['check-in-date'];
        $checkout = $_GET['check-out-date'];
        $bednum = $_GET['bed-num'];

        if ($place == "" && $checkin == "" && $checkout == "") {
            $place = "Hồ Chí Minh";
            $date = getdate();
            $currentDate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];
            $checkin = $currentDate;
            $checkout = $currentDate;
            $result = timPhong($connect, $place, $checkin, $checkout, $bednum);
        } else if ($place != "" && $checkin != "" && $checkout != "") {
            $result = timPhong($connect, $place, $checkin, $checkout, $bednum);
        }
        // Xử lý 1 Radio
        else if (isset($_GET['filter__main-radio'])) {
            $priceRoom = $_GET['filter__main-radio'];
            $result = timPhongTheoGia($connect, $priceRoom, $place, $checkin, $checkout, $bednum);
        }
        // Xử lý TypeHotel
        if (isset($_GET['filter__main-hotel'])) {
            if (isset($_GET['filter__main-apartment'])) {
                if (isset($_GET['filter__main-resort'])) {
                    $type1 = "Hotel";
                    $type2 = "Apartment";
                    $type3 = "Resort";
                    $result = timTheoProperty3($connect, $type1, $type2, $type3, $place, $checkin, $checkout, $bednum);
                } else if (isset($_GET['filter__main-homestay'])) {
                    $type1 = "Hotel";
                    $type2 = "Apartment";
                    $type3 = "Homestay";
                    $result = timTheoProperty3($connect, $type1, $type2, $type3, $place, $checkin, $checkout, $bednum);
                } else {
                    $type1 = "Hotel";
                    $type2 = "Apartment";
                    $result = timTheoProperty2($connect, $type1, $type2, $place, $checkin, $checkout, $bednum);
                }
            } else if (isset($_GET['filter__main-resort'])) {
                if (isset($_GET['filter__main-homestay'])) {
                    $type1 = "Hotel";
                    $type2 = "Resort";
                    $type3 = "Homestay";
                    $result = timTheoProperty3($connect, $type1, $type2, $type3, $place, $checkin, $checkout, $bednum);
                } else {
                    $type1 = "Hotel";
                    $type2 = "Resort";
                    $result = timTheoProperty2($connect, $type1, $type2, $place, $checkin, $checkout, $bednum);
                }
            } else if (isset($_GET['filter__main-homestay'])) {
                $type1 = "Hotel";
                $type2 = "Homestay";
                $result = timTheoProperty2($connect, $type1, $type2, $place, $checkin, $checkout, $bednum);
            } else {
                $typeHotel = "Hotel";
                $result = timPhongTheoProperty($connect, $typeHotel, $place, $checkin, $checkout, $bednum);
            }
        } else if (isset($_GET['filter__main-apartment'])) {
            if (isset($_GET['filter__main-resort'])) {
                $type1 = "Apartment";
                $type2 = "Resort";
                $result = timTheoProperty2($connect, $type1, $type2, $place, $checkin, $checkout, $bednum);
            } else if (isset($_GET['filter__main-homestay'])) {
                $type1 = "Apartment";
                $type2 = "Homestay";
                $result = timTheoProperty2($connect, $type1, $type2, $place, $checkin, $checkout, $bednum);
            } else {
                $typeHotel = "Apartment";
                $result = timPhongTheoProperty($connect, $typeHotel, $place, $checkin, $checkout, $bednum);
            }
        } else if (isset($_GET['filter__main-resort'])) {
            if (isset($_GET['filter__main-homestay'])) {
                $type1 = "Resort";
                $type2 = "Homestay";
                $result = timTheoProperty2($connect, $type1, $type2, $place, $checkin, $checkout, $bednum);
            } else {
                $typeHotel = "Apartment";
                $result = timPhongTheoProperty($connect, $typeHotel, $place, $checkin, $checkout, $bednum);
            }
        } else if (isset($_GET['filter__main-homestay'])) {
            $typeHotel = "Homestay";
            $result = timPhongTheoProperty($connect, $typeHotel, $place, $checkin, $checkout, $bednum);
        }
        // Xử lý TypeRoom
        if (isset($_GET['filter__main-standard'])) {
            if (isset($_GET['filter__main-deluxe'])) {
                $typeRoom1 = "Standard";
                $typeRoom2 = "Deluxe";
                $result = timPhongtheoTypeRoomV2($connect, $typeRoom1, $typeRoom2, $place, $checkin, $checkout, $bednum);
            } else if (isset($_GET['filter__main-supervisor'])) {
                $typeRoom1 = "Standard";
                $typeRoom2 = "Supervisor";
                $result = timPhongtheoTypeRoomV2($connect, $typeRoom1, $typeRoom2, $place, $checkin, $checkout, $bednum);
            } else {
                $typeRoom = "Standard";
                $result = timPhongtheoTypeRoom($connect, $typeRoom, $place, $checkin, $checkout, $bednum);
            }
        } else if (isset($_GET['filter__main-deluxe'])) {
            if (isset($_GET['filter__main-supervisor'])) {
                $typeRoom1 = "Deluxe";
                $typeRoom2 = "Supervisor";
                $result = timPhongtheoTypeRoomV2($connect, $typeRoom1, $typeRoom2, $place, $checkin, $checkout, $bednum);
            } else {
                $typeRoom = "Deluxe";
                $result = timPhongtheoTypeRoom($connect, $typeRoom, $place, $checkin, $checkout, $bednum);
            }
        } else if (isset($_GET['filter__main-supervisor'])) {
            $typeRoom = "Supervisor";
            $result = timPhongtheoTypeRoom($connect, $typeRoom, $place, $checkin, $checkout, $bednum);
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
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.2-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/Search.css">
    <title>Trivia</title>
</head>

<body>
    <div id="app">
        <header class="app__header">
            <nav class="app__nav" style="max-width: 1200px;margin: 0 auto;">
                <a href="./Homepage.php" class="app__nav-name-link">
                    <img src="../assets/img/logo.png" alt="Logo" class="app__nav-name-icon">
                </a>

                <ul class="app__nav-list">
                    <li class="app__nav-item">
                        <a href="./Homepage.php" class="app__nav-item-link">Home</a>
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

        <div style="max-width: 1200px;margin: 0 auto;">
            <form action="" method="" class="d-flex justify-content-around align-items-center" style="height: 60px;
                    margin-top: 64px;
                    border-radius: 12px;
                    background-color: white;
                    box-shadow: 0 0 2px 2px rgb(0 0 0 / 5%);">
                <div class="py-1 d-flex align-items-center">
                    <i class="pe-2 fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search-destination" value="<?php echo $place; ?>" style="width: 320px;">
                </div>
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
                </div>
                <div class="d-flex py-1 position-relative">
                    <div class="d-flex align-items-center">
                        <i class="pe-2 fa-solid fa-people-group"></i>
                        <div class="app__search-quantity">
                            <span><?php echo $bednum; ?></span>
                            bed,
                            <span><?php echo $bednum; ?></span>
                            adults
                        </div>
                    </div>

                    <div class="box-quantity">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <input type="range" name="bed-num" id="bed-num" min="1" max="30" step="1" value="<?php echo $bednum; ?>">
                            <div class="">
                                <label for="bed-num">Beds</label>
                            </div>
                            <div class="d-flex justify-content-between align-items-center" style="width: 110px;">
                                <button type="button" class="btn-minus-bed">-</button>
                                <span class="amount-bed"><?php echo $bednum; ?></span>
                                <button type="button" class="btn-add-bed">+</button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <input type="range" name="per-num" id="per-num" min="1" step="1" value="1">
                            <div class="">
                                <label for="per-num">Adults</label>
                            </div>
                            <div class="d-flex justify-content-between align-items-center" style="width: 110px;">
                                <button type="button" class="btn-minus-people">-</button>
                                <span class="amount-people">2</span>
                                <button type="button" class="btn-add-people">+</button>
                            </div>
                        </div>
                        <button type="button" class="btn-accept">Accept</button>
                    </div>
                </div>
                <div class="d-flex py-1">
                    <button type="submit" class="app__search-btn">Search</button>
                </div>
            </form>

            <div class="app__sort">
                <button class="btn-sort">
                    <span>Sort by</span>
                    <div class="box-sort">
                        <ul class="box-sort-list">
                            <li class="box-sort-list-item">Price &uarr;</li>
                            <li class="box-sort-list-item">Price &darr;</li>
                            <li class="box-sort-list-item">Nearest</li>
                        </ul>
                    </div>
                </button>
            </div>

            <div class="app__main-content row">
                <div class="col-4">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d502056.6239383943!2d105.2842887631872!3d10.554318626027014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a65b3d50c121f%3A0xdca0c95ead346e40!2zxJDhu5NuZyBUaMOhcCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1670054231946!5m2!1svi!2s" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <div div class="filter">
                        <div class="filter-box">
                            <span class="filter__header">Max price</span>
                            <div class="filter__main-box">
                                <input type="radio" name="filter__main-radio" id="filter__main-2500000" value="2500000">
                                <label for="filter__main-2500000">2500000</label>
                            </div>
                            <div class="filter__main-box">
                                <input type="radio" name="filter__main-radio" id="filter__main-4000000" value="4000000">
                                <label for="filter__main-4000000">4000000</label>
                            </div>
                            <div class="filter__main-box">
                                <input type="radio" name="filter__main-radio" id="filter__main-5000000" value="5000000">
                                <label for="filter__main-5000000">5000000</label>
                            </div>
                            <div class="filter__main-box">
                                <input type="radio" name="filter__main-radio" id="filter__main-6000000" value="6000000">
                                <label for="filter__main-6000000">6000000</label>
                            </div>
                        </div>

                        <div class="filter-box">
                            <span class="filter__header">Property type</span>
                            <div class="filter__main-box">
                                <input type="checkbox" name="filter__main-apartment" id="filter__main-apartment">
                                <label for="filter__main-apartment">Apartment</label>
                            </div>
                            <div class="filter__main-box">
                                <input type="checkbox" name="filter__main-hotel" id="filter__main-hotel">
                                <label for="filter__main-hotel">Hotel</label>
                            </div>
                            <div class="filter__main-box">
                                <input type="checkbox" name="filter__main-resort" id="filter__main-resort">
                                <label for="filter__main-resort">Resort</label>
                            </div>
                            <p class="action-see-active">See more</p>
                            <div class="filter-see-more">
                                <div class="filter__main-box">
                                    <input type="checkbox" name="filter__main-homestay" id="filter__main-homestay">
                                    <label for="filter__main-homestay">Homestay</label>
                                </div>
                            </div>
                            <p class="action-see-unactive">Hide</p>
                        </div>

                        <div class="filter-box">
                            <span class="filter__header">Room type</span>
                            <div class="filter__main-box">
                                <input type="checkbox" name="filter__main-standard" id="filter__main-standard">
                                <label for="filter__main-standard">Standard</label>
                            </div>
                            <div class="filter__main-box">
                                <input type="checkbox" name="filter__main-deluxe" id="filter__main-deluxe">
                                <label for="filter__main-deluxe">Deluxe</label>
                            </div>
                            <div class="filter__main-box">
                                <input type="checkbox" name="filter__main-supervisor" id="filter__main-supervisor">
                                <label for="filter__main-supervisor">Supervisor</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <?php
                    if (mysqli_num_rows($result) == 0) {
                    ?>
                        <div class="text-center">
                            <p style="font-size: 28px;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </p>
                            <p style="font-size: 24px;font-weight: 700;">No properties found in <?php echo $place; ?></p>
                            <p>There are no matching properties for your search criteria. Try updating your search</p>
                            <button class="btn btn-primary">Update search</button>
                        </div>
                        <?php
                    } else {
                        while ($row = mysqli_fetch_row($result)) {
                        ?>
                            <div div class="result-item">
                                <?php
                                // Gọi hàm xử lý chuỗi
                                $array_img = findImage($row[2]);
                                ?>
                                <?php
                                if ($array_img[0] === 'IMG') {
                                ?>
                                    <img src="../assets/img/upload/<?php echo $row[2]; ?>" alt="" class="result-item-img">
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo $row[2]; ?>" alt="" class="result-item-img">
                                <?php } ?>
                                <div class="result-item-info">
                                    <div class="result-item-info-header">
                                        <span class="result-item-info-name"><?php echo $row[1]; ?></span>
                                        <span class="result-item-info-point"><?php echo round($row[4], 1); ?></span>
                                    </div>

                                    <div class="result-item-info-address"><?php echo $row[3]; ?></div>
                                    <div class="result-item-info-price"><span><?php echo $row[5]; ?> VNĐ</span></div>
                                    <div class="result-item-info-desc">
                                        <span class="result-item-info-type"><?php echo $row[6]; ?></span>
                                        <a href="./Search_Property.php?id=<?php echo $row[0]; ?>&hotel=<?php echo $row[1]; ?>&check-in-date=<?php echo $checkin; ?>&check-out-date=<?php echo $checkout; ?>&bed-num=<?php echo $bednum; ?>" class="result-item-info-link">See availability</a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
            </div>
        </div>

        <footer class="app__footer">
            <div style="max-width: 1200px;margin: 0 auto;">
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

    <script src="../js/Homepage.js"></script>
    <script>
        let actionSeeActive = document.querySelector('.action-see-active');
        let actionSeeUnactive = document.querySelector('.action-see-unactive');

        actionSeeActive.addEventListener('click', () => {
            document.querySelector('.filter-see-more').style.display = 'block';
            actionSeeActive.classList.toggle('action-see-active');
            actionSeeActive.classList.toggle('action-see-unactive');
            actionSeeUnactive.classList.toggle('action-see-active');
            actionSeeUnactive.classList.toggle('action-see-unactive');
        });

        actionSeeUnactive.addEventListener('click', () => {
            document.querySelector('.filter-see-more').style.display = 'none';
            actionSeeActive.classList.toggle('action-see-active');
            actionSeeActive.classList.toggle('action-see-unactive');
            actionSeeUnactive.classList.toggle('action-see-active');
            actionSeeUnactive.classList.toggle('action-see-unactive');
        });
    </script>
</body>

</html>