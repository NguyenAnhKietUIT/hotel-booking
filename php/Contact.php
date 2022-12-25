<?php

session_start();

$accountid = "";

$user = "";

$name_cus = "";

$flag = 0;

if(isset($_SESSION['accID3'])){
    include "./getInformationCus.php";

    $accountid = $_SESSION['accID3'];

    $user = $user_name;
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
    <link rel="stylesheet" href="../css/Contact.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.2-web/css/all.min.css">
    <title>Contact</title>
</head>

<body>
    <div id="app">
        <header class="app__header">
            <div class="grid wide">
                <nav class="app__nav">
                    <a href="./Homepage.php" class="app__nav-name-link">
                        <img src="../assets/img/logo.png" alt="Logo" class="app__nav-name-icon">
                    </a>

                    <ul class="app__nav-list hide-on-mobile-tablet">
                        <li class="app__nav-item">
                            <a href="./Homepage.php" class="app__nav-item-link">Home</a>
                        </li>
                        <li class="app__nav-item">
                            <a href="#" class="app__nav-item-link">Contacts</a>
                        </li>
                        <li class="app__nav-item">
                            <?php
                            if (isset($_SESSION['accID3'])) {
                                echo "<a href='./Customer_Information.php' class='app__nav-item-link' style='cursor: pointer;'>" . $user . "</a>";
                            } else {
                                echo "<a href='./Customer_SignUp.php' class='app__nav-item-link'>Sign Up</a>";
                            }
                            ?>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="app__header-content">
                <div class="app__contact">
                    <div class="app__contact-box">
                        <div class="box-info">
                            <span class="app__contact-title">Alien</span>
                            <ul class="app__contact-list">
                                <li class="app__contact-item">
                                    <i class="app__contact-item-icon fa-solid fa-location-dot"></i>
                                    <span>
                                        Đường Hàn Thuyên, khu phố 6 P, Thủ Đức, Thành phố Hồ Chí Minh, Việt Nam
                                    </span>
                                </li>
                                <li class="app__contact-item">
                                    <i class="app__contact-item-icon fa-solid fa-phone"></i>
                                    <a href="tel:+84 348630164" class="app__contact-item-link">
                                        0348630164
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.2312403776427!2d106.80086541458994!3d10.870008892258094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527587e9ad5bf%3A0xafa66f9c8be3c91!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiAtIMSQSFFHIFRQLkhDTQ!5e0!3m2!1svi!2s!4v1669743923640!5m2!1svi!2s"
                            width="759.6" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </header>

        <div class="grid wide">
            <p class="app__content-title">
                Have a questions ?
            </p>

            <div class="app__content-form">
                <form action="">
                    <div class="row">
                        <div class="col l-6">
                            <label for="">TOPIC</label>
                            <select name="topic" id="form__topic" required>
                                <option value="">Select topic</option>
                                <option value="Contact">Contact</option>
                                <option value="Complain">Complain</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col l-6">
                            <label for="">Topic Name<span>*</span></label>
                            <input type="text" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col l-6">
                            <label for="">Full Name<span>*</span></label>
                            <input type="text" required>
                        </div>
                        <div class="col l-6">
                            <label for="">Email<span>*</span></label>
                            <input type="email" required>
                        </div>
                    </div>

                    <div>
                        <label for="box-msg">Message<span>*</span></label>
                        <textarea name="box-msg" id="box-msg" cols="160" rows="10"></textarea>
                    </div>

                    <div class="btn-send">
                        <input type="submit" value="SEND">
                        <?php
                            if(isset($_GET['flag'])){
                                $flag = $_GET['flag'];
                                if($flag == 1){
                                    echo "<span class='form-message'>Successfully send!!!</span>";
                                }
                            }
                        ?>
                    </div>
                </form>
            </div>
        </div>

        <footer class="app__footer">
            <div class="grid wide">
                <div class="row" style="padding-top: 20px;">
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
</body>

</html>