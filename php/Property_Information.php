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

    // Thông tin Property đăng nhập
    $hInform = thongtinProperty($connect, $accID);

    // Tìm usernameReceive
    $userNameReceive = findUsername($connect, $accID);
    // Tìm inbox
    $showInbox = showInbox($connect, $userNameReceive[0]);
    // Tìm proID
    $proID = findProIDByAccID($connect, $accID);
    // Tìm Service
    $allService = allService($connect, $proID[0]);
    // Tạo mảng Category
    //$arrCategory = array(1, 2, 3, 4);
    $array_img = findImage($hInform[10]);
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
    <link rel="stylesheet" href="../css/Property_Information.css">
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
                                        <form action="./logout.php" method="post">
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

            <div class="mt-3 mb-5 grid wide">
                <h3>Update information</h3>

                <form action="./HandleUpdatePro.php?Update=1" method="POST" class="form" id="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="form-label">Property name<span style="color: red;">*</span></label>
                        <input id="name" name="name" type="text" class="form-control edit-active" value="<?php echo $hInform[1]; ?>" disabled>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="overview" class="form-label">Overview<span style="color: red;">*</span></label>
                        <textarea name="overview" id="overview" cols="30" rows="4" class="form-control edit-active" disabled><?php echo $hInform[2]; ?></textarea>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="phonenumber" class="form-label">Phone numbers<span style="color: red;">*</span></label>
                        <input id="phonenumber" name="phonenumber" type="text" class="form-control edit-active" value="<?php echo $hInform[3]; ?>" disabled>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="gmail" class="form-label">Gmail</label>
                        <input id="gmail" name="gmail" type="text" class="form-control" value="<?php echo $hInform[4]; ?>" disabled>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="location" class="form-label">Location<span style="color: red;">*</span></label>
                        <textarea name="location" id="location" cols="30" rows="2" class="form-control edit-active" disabled><?php echo $hInform[5]; ?></textarea>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="check-in" class="form-label">
                            Check-in time
                            <i class="fa-regular fa-clock"></i>
                            <span style="color: red;">*</span>
                        </label>
                        <input id="check-in" name="check-in" type="time" value="<?php echo $hInform[6]; ?>" class="form-control edit-active" disabled>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="check-out" class="form-label">
                            Check-out time
                            <i class="fa-regular fa-clock"></i>
                            <span style="color: red;">*</span>
                        </label>
                        <input id="check-out" name="check-out" type="time" value="<?php echo $hInform[7]; ?>" class="form-control edit-active" disabled>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Types of property<span style="color: red;">*</span></label>
                        <div class="d-flex flex-column">
                            <div>
                                <input type="radio" name="property" value="Hotel" class="edit-active" <?php if ($hInform[8] == "Hotel") echo "checked='checked'" ?> disabled>
                                <label for="hotel">Hotel</label>
                            </div>
                            <div>
                                <input type="radio" name="property" value="Resort" class="edit-active" <?php if ($hInform[8] == "Resort") echo "checked='checked'" ?> disabled>
                                <label for="resort">Resort</label>
                            </div>
                            <div>
                                <input type="radio" name="property" value="Apartment" class="edit-active" <?php if ($hInform[8] == "Apartment") echo "checked='checked'" ?> disabled>
                                <label for="apartment">Apartment</label>
                            </div>
                            <div>
                                <input type="radio" name="property" value="Homestay" class="edit-active" <?php if ($hInform[8] == "Homestay") echo "checked='checked'" ?> disabled>
                                <label for="homestay">Homestay</label>
                            </div>
                        </div>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Types of category<span style="color: red;">*</span></label>
                        <div class="d-flex flex-column">
                            <div>
                                <input type="radio" name="category" value="Beaches" class="edit-active" <?php if ($hInform[9] == "Beaches") echo "checked='checked'" ?> disabled>
                                <label for="beach">Beaches</label>
                            </div>
                            <div>
                                <input type="radio" name="category" value="Mountains" class="edit-active" <?php if ($hInform[9] == "Mountains") echo "checked='checked'" ?> disabled>
                                <label for="mountain">Mountains</label>
                            </div>
                            <div>
                                <input type="radio" name="category" value="Iconic Cities" class="edit-active" <?php if ($hInform[9] == "Iconic Cities") echo "checked='checked'" ?> disabled>
                                <label for="iconic-city">Iconic cities</label>
                            </div>
                            <div>
                                <input type="radio" name="category" value="Countryside" class="edit-active" <?php if ($hInform[9] == "Countryside") echo "checked='checked'" ?> disabled>
                                <label for="countryside">Countryside</label>
                            </div>
                            <div>
                                <input type="radio" name="category" value="Camping" class="edit-active" <?php if ($hInform[9] == "Camping") echo "checked='checked'" ?> disabled>
                                <label for="camping">Camping</label>
                            </div>
                            <div>
                                <input type="radio" name="category" value="Tropical" class="edit-active" <?php if ($hInform[9] == "Tropical") echo "checked='checked'" ?> disabled>
                                <label for="tropical">Tropical</label>
                            </div>
                        </div>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Available services</label>
                        <div class="row ms-0 me-0">
                            <div class="col">
                                <div class="d-flex flex-column">
                                    <?php
                                    while ($service = mysqli_fetch_row($allService)) {
                                    ?>
                                        <div>
                                            <input type="checkbox" name="service[]" value="<?php echo $service[0]; ?>" id="service" class="edit-active" checked disabled>
                                            <label for="service[]"><?php echo $service[0]; ?></label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="ms-5 mt-3 d-flex flex-column">
                            <label class="form-label">Add one service</label>
                            <input type="text" name="addService" placeholder="Enter your service..." style="outline: none;border: none;" class="px-2 py-1 border-bottom edit-active" disabled>
                        </div>

                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" name="image" id="image" class="edit-active" disabled>
                        <span class="form-message"></span>
                    </div>

                    <?php
                    if ($array_img[0] === 'IMG') {
                    ?>
                        <img src="../assets/img/upload/<?php echo $hInform[10]; ?>" alt="Image Property" id="img-property" class="mt-2" style="width: 300px;height: 200px;">
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo $hInform[10]; ?>" alt="Image Property" id="img-property" class="mt-2" style="width: 300px;height: 200px;">
                    <?php } ?>

                    <?php
                    if (isset($_GET['flag'])) {
                        $flag = $_GET['flag'];
                        if ($flag == "2") {

                    ?>
                            <span class="form-message"><?php echo "You cannot upload file with this type"; ?></span>
                        <?php
                        } else if ($flag == "1") {
                        ?>
                            <span class="form-message"><?php echo "Your size of file is too big"; ?></span>
                    <?php
                        }
                    }
                    ?>

                    <div class="d-flex">
                        <button type="button" class="form-btn">Update</button>
                        <input type="submit" class="form-btn  ms-5" value="Save" disabled>
                    </div>
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
    <script src="../js/Property_Information.js"></script>
    <script src="../assets/js/validator.js"></script>

    <script>
        loadMessage(usernameSend, usernameReceive, 2);

        Validator({
            form: '#form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#name'),
                Validator.isRequired('#overview'),
                Validator.isRequired('#phonenumber'),
                Validator.isPhoneNumber('#phonenumber'),
                Validator.isRequired('#gmail'),
                Validator.isEmail('#gmail'),
                Validator.isRequired('#location'),
                Validator.isRequired('#check-in'),
                Validator.isRequired('#check-out'),
                Validator.isRequired('input[name="property"]'),
                Validator.isRequired('input[name="category"]'),
            ],
        });
    </script>
</body>

</html>