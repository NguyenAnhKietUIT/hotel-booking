<?php

session_start();

$accountid = "";

$name_cus = "";

if(isset($_SESSION['accID3'])){
    include "./getInformationCus.php";

    $accountid = $_SESSION['accID3'];

    $name_cus = $user_name;
}

include "./HandleSelectCus.php";
include "./connect.php";

// Lấy ra top destination
$topDestination = topDestination($connect);
// Lấy ra top PropertyType
$topTypePro = topTypeProperty($connect);
// Top Category
// Beach
    $topBeach = topCategory($connect, 'Beaches');
    
// Mountain
    $topMoutain = topCategory($connect, 'Moutains');
    
// Iconic Cities
    $topIconic = topCategory($connect, 'Iconic Cities');
    
// Countryside
    $topCountryside = topCategory($connect, 'Countryside');
    
// Camping
    $topCamping = topCategory($connect, 'Camping');
    
// Tropical
    $topTropical = topCategory($connect, 'Tropical');
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
    <link rel="stylesheet" href="../css/Homepage.css">
    <title>Trivia</title>
</head>

<body>
    <div id="app">
        <header class="app__header">
            <div style="max-width: 1200px;margin: 0 auto;">
                <nav class="app__nav">
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
                            if (isset($_SESSION['accID3'])) {
                                echo "<a href='./Customer_Information.php' class='app__nav-item-link' style='cursor: pointer;'>" . $name_cus . "</a>";
                            } else {
                                echo "<a href='./Customer_SignUp.php' class='app__nav-item-link'>Sign Up</a>";
                            }
                            ?>
                        </li>
                    </ul>
                </nav>

                <div class="app__title">
                    <h1>Dive yourself into Viet soul.</h1>
                    <h2>Plan your next trip from now!</h2>
                </div>

                <form action="./Search.php" method="GET" 
                    class="d-flex justify-content-around align-items-center"
                    style="height: 60px;
                    margin-top: 64px;
                    border-radius: 12px;
                    background-color: rgba(255, 255, 255, 0.4);"
                >
                    <div class="py-1 d-flex align-items-center">
                        <i class="pe-2 fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="search-destination" 
                                placeholder="Search destinations, hotels" 
                                style="width: 320px;">
                    </div>
                    <div class="py-1 position-relative" style="width: 140px;">
                        <div class="d-flex align-items-center">
                            <i class="pe-2 fa-solid fa-plane-departure"></i>
                            <div class="app__status-in">Check in</div>
                            <input type="date" name="check-in-date" id="app__check-in"
                                min="2017-10-14" max="2050-12-31">
                        </div>
                        <p class="position-absolute toast-message-in p-1 text-center">The maximum interval between two
                            days is thirty</p>
                    </div>
                    <div class="py-1 position-relative" style="width: 140px;">
                        <div class="d-flex align-items-center">
                            <i class="pe-2 fa-solid fa-money-check"></i>
                            <div class="app__status-out">Check out</div>
                            <input type="date" name="check-out-date" id="app__check-out"
                                min="2017-10-14" max="2050-12-31">
                        </div>
                        <p class="position-absolute toast-message-out p-1 text-center">The maximum interval between two
                            days is thirty</p>
                    </div>
                    <div class="d-flex py-1 position-relative">
                        <div class="d-flex align-items-center">
                            <i class="pe-2 fa-solid fa-people-group"></i>
                            <div class="app__search-quantity">
                                <span>1</span>
                                bed,
                                <span>2</span>
                                adults
                            </div>
                        </div>

                        <div class="box-quantity">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <input type="range" name="bed-num" id="bed-num" min="1" max="30" step="1" value="1">
                                <div class="">
                                    <label for="bed-num">Beds</label>
                                </div>
                                <div class="d-flex justify-content-between align-items-center" style="width: 110px;">
                                    <button type="button" class="btn-minus-bed">-</button>
                                    <span class="amount-bed">1</span>
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
                        <a href="./Search.php" class="text-decoration-none">
                            <button class="app__search-btn">Search</button>
                        </a>
                    </div>
                </form>

                <div class="mt-5">
                    <h3 class="app__categories-title">Top Categories</h3>

                    <div class="pb-5 mt-4 row">
                        <a href="#beach" class="app__category-item text-decoration-none col">
                            <i class="app__category-item-icon fa-sharp fa-solid fa-umbrella-beach"></i>
                            <figcaption>Beaches</figcaption>
                        </a>
                        <a href="#mountain" class="app__category-item text-decoration-none col">
                            <i class="app__category-item-icon fa-solid fa-mountain-sun"></i>
                            <figcaption>Mountains</figcaption>
                        </a>
                        <a href="#iconic-city" class="app__category-item text-decoration-none col">
                            <i class="app__category-item-icon fa-solid fa-city"></i>
                            <figcaption>Iconic Cities</figcaption>
                        </a>
                        <a href="#countryside" class="app__category-item text-decoration-none col">
                            <i class="app__category-item-icon fa-solid fa-seedling"></i>
                            <figcaption>Countryside</figcaption>
                        </a>
                        <a href="#camping" class="app__category-item text-decoration-none col">
                            <i class="app__category-item-icon fa-solid fa-fire-flame-curved"></i>
                            <figcaption>Camping</figcaption>
                        </a>
                        <a href="#tropical" class="app__category-item text-decoration-none col">
                            <i class="app__category-item-icon fa-solid fa-cloud-sun-rain"></i>
                            <figcaption>Tropical</figcaption>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="app__content" style="max-width: 1200px;margin: 0 auto;">
            <div class="app__content-home">
                <div class="mt-5">
                    <h3 class="app__selection-title">Top Destinations</h3>

                    <div class="row">
                    <?php
                            while($destination = mysqli_fetch_row($topDestination)){
                        ?>
                            <div class="app__selection-item col">
                                <a href="./Search.php?top-destination=<?php echo $destination[0]?>" class="app__selection-item-link">
                                    <img src="<?php echo $destination[1]?>" alt="Hoi An" class="app__selection-item-img">
                                    <span class="app__selection-item-desc"><?php echo $destination[0]?></span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="mt-5">
                    <h3 class="app__selection-title">Browse by property type</h3>

                    <div class="row">
                    <?php
                            while($typePro = mysqli_fetch_row($topTypePro)){
                        ?>
                            <div class="app__selection-item col">
                                <a href="./Search.php?typePro=<?php echo $typePro[0]; ?>" class="app__selection-item-link">
                                    <img src="<?php echo $typePro[1]; ?>" alt="Hotels" class="app__selection-item-img">
                                    <span class="app__selection-item-desc"><?php echo $typePro[0]; ?></span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="beach" class="mt-5">
                    <h3 class="text-center mb-4" style="font-size: 32px;">Popular Beach Destinations</h3>

                    <div class="row">
                    <?php
                            while($beach = mysqli_fetch_row($topBeach)){
                        ?>
                            <div class="col-3">
                                <a href="./Search.php?typeCategory=<?php echo $beach[5];?>&place=<?php echo $beach[1]; ?>" class="home-location-item pb-3">
                                    <img src="<?php echo $beach[0]; ?>" alt="" class="home-location-item__img">

                                    <h4 class="ms-3 mb-0 text-dark"><?php echo $beach[1]; ?></h4>

                                    <div class="d-flex mt-3 mx-3 justify-content-between text-center" style="color: var(--text-color);">
                                        <?php
                                            if($beach[3] == 'Hotel'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-hotel" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $beach[4]; ?> Hotels</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($beach[3] == 'Apartment'){
                                        ?>    
                                            <span>
                                            <i class="pb-2 fa-solid fa-building" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $beach[4]; ?> Apartments</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($beach[3] == 'Homestay'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-house" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $beach[4]; ?> Homestays</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($beach[3] == 'Resort'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-landmark" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $beach[4]; ?> Resorts</figcaption>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="mountain" class="mt-5">
                    <h3 class="text-center mb-4" style="font-size: 32px;">Popular Mountain Destinations</h3>

                    <div class="row">
                    <?php
                            while($mountain = mysqli_fetch_row($topMoutain)){
                        ?>
                            <div class="col-3">
                                <a href="./Search.php?typeCategory=<?php echo $mountain[5];?>&place=<?php echo $mountain[1]; ?>" class="home-location-item pb-3">
                                    <img src="<?php echo $mountain[0]; ?>" alt="" class="home-location-item__img">

                                    <h4 class="ms-3 mb-0 text-dark"><?php echo $mountain[1]; ?></h4>

                                    <div class="d-flex mt-3 mx-3 justify-content-between text-center" style="color: var(--text-color);">
                                        <?php
                                            if($mountain[3] == 'Hotel'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-hotel" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $mountain[4]; ?> Hotels</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($mountain[3] == 'Apartment'){
                                        ?>    
                                            <span>
                                            <i class="pb-2 fa-solid fa-building" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $mountain[4]; ?> Apartments</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($mountain[3] == 'Homestay'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-house" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $mountain[4]; ?> Homestays</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($mountain[3] == 'Resort'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-landmark" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $mountain[4]; ?> Resorts</figcaption>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="iconic-city" class="mt-5">
                    <h3 class="text-center mb-4" style="font-size: 32px;">Popular Iconic City Destinations</h3>

                    <div class="row">
                    <?php
                            while($iconic = mysqli_fetch_row($topIconic)){
                        ?>
                            <div class="col-3">
                                <a href="./Search.php?typeCategory=<?php echo $iconic[5];?>&place=<?php echo $iconic[1]; ?>" class="home-location-item pb-3">
                                    <img src="<?php echo $iconic[0]; ?>" alt="" class="home-location-item__img">

                                    <h4 class="ms-3 mb-0 text-dark"><?php echo $iconic[1]; ?></h4>

                                    <div class="d-flex mt-3 mx-3 justify-content-between text-center" style="color: var(--text-color);">
                                        <?php
                                            if($iconic[3] == 'Hotel'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-hotel" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $iconic[4]; ?> Hotels</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($iconic[3] == 'Apartment'){
                                        ?>    
                                            <span>
                                            <i class="pb-2 fa-solid fa-building" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $iconic[4]; ?> Apartments</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($iconic[3] == 'Homestay'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-house" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $iconic[4]; ?> Homestays</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($iconic[3] == 'Resort'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-landmark" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $iconic[4]; ?> Resorts</figcaption>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="countryside" class="mt-5">
                    <h3 class="text-center mb-4" style="font-size: 32px;">Popular Countryside Destinations</h3>

                    <div class="row">
                    <?php
                            while($countryside = mysqli_fetch_row($topCountryside)){
                        ?>
                            <div class="col-3">
                            <a href="./Search.php?typeCategory=<?php echo $countryside[5];?>&place=<?php echo $countryside[1]; ?>" class="home-location-item pb-3">
                                    <img src="<?php echo $countryside[0]; ?>" alt="" class="home-location-item__img">

                                    <h4 class="ms-3 mb-0 text-dark"><?php echo $countryside[1]; ?></h4>

                                    <div class="d-flex mt-3 mx-3 justify-content-between text-center" style="color: var(--text-color);">
                                        <?php
                                            if($countryside[3] == 'Hotel'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-hotel" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $countryside[4]; ?> Hotels</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($countryside[3] == 'Apartment'){
                                        ?>    
                                            <span>
                                            <i class="pb-2 fa-solid fa-building" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $countryside[4]; ?> Apartments</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($countryside[3] == 'Homestay'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-house" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $countryside[4]; ?> Homestays</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($countryside[3] == 'Resort'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-landmark" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $countryside[4]; ?> Resorts</figcaption>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="camping" class="mt-5">
                    <h3 class="text-center mb-4" style="font-size: 32px;">Popular Camping Destinations</h3>

                    <div class="row">
                    <?php
                            while($camping = mysqli_fetch_row($topCamping)){
                        ?>
                            <div class="col-3">
                            <a href="./Search.php?typeCategory=<?php echo $camping[5];?>&place=<?php echo $camping[1]; ?>" class="home-location-item pb-3">
                                    <img src="<?php echo $camping[0]; ?>" alt="" class="home-location-item__img">

                                    <h4 class="ms-3 mb-0 text-dark"><?php echo $camping[1]; ?></h4>

                                    <div class="d-flex mt-3 mx-3 justify-content-between text-center" style="color: var(--text-color);">
                                        <?php
                                            if($camping[3] == 'Hotel'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-hotel" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $camping[4]; ?> Hotels</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($camping[3] == 'Apartment'){
                                        ?>    
                                            <span>
                                            <i class="pb-2 fa-solid fa-building" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $camping[4]; ?> Apartments</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($camping[3] == 'Homestay'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-house" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $camping[4]; ?> Homestays</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($camping[3] == 'Resort'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-landmark" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $camping[4]; ?> Resorts</figcaption>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="tropical" class="mt-5">
                    <h3 class="text-center mb-4" style="font-size: 32px;">Popular Tropical Destinations</h3>

                    <div class="row">
                    <?php 
                            while($tropical = mysqli_fetch_row($topTropical)){
                        ?>
                            <div class="col-3">
                            <a href="./Search.php?typeCategory=<?php echo $tropical[5];?>&place=<?php echo $tropical[1]; ?>" class="home-location-item pb-3">
                                    <img src="<?php echo $tropical[0]; ?>" alt="" class="home-location-item__img">

                                    <h4 class="ms-3 mb-0 text-dark"><?php echo $tropical[1]; ?></h4>

                                    <div class="d-flex mt-3 mx-3 justify-content-between text-center" style="color: var(--text-color);">
                                        <?php
                                            if($tropical[3] == 'Hotel'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-hotel" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $tropical[4]; ?> Hotels</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($tropical[3] == 'Apartment'){
                                        ?>    
                                            <span>
                                            <i class="pb-2 fa-solid fa-building" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $tropical[4]; ?> Apartments</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($tropical[3] == 'Homestay'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-house" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $tropical[4]; ?> Homestays</figcaption>
                                            </span>
                                        <?php } ?>
                                        <?php
                                            if($tropical[3] == 'Resort'){
                                        ?>    
                                            <span>
                                                <i class="pb-2 fa-solid fa-landmark" style="font-size: 18px;"></i>
                                                <figcaption><?php echo $tropical[4]; ?> Resorts</figcaption>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="app__background-theme">
                    <a href="#" class="app__background-theme-link">
                        <img src="../assets/img/home_page/background_theme.png" alt="" class="app__background-theme-img">
                        <div class="app__background-theme-desc">
                            <h3 class="app__background-theme-title">Plan your trip with</br> travel expert</h3>
                            <span class="app__background-theme-detail">Our professional advisors can craft your perfect
                                itinerary</span>
                        </div>
                    </a>
                </div>

                <div class="app__inspiration">
                    <h3 class="app__inspiration-title">Get inspiration for your next trip</h3>

                    <div class="row">
                        <div class="col large">
                            <a href="./Article_1.php" class="app__inspiration-item">
                                <img src="../assets/img/inspiration/image_1.png" alt="Inspiration"
                                    class="app__inspiration-item__img">

                                <div class="app__inspiration-item-info">
                                    <span class="app__inspiration-item-title">Exploring Vung Tau Beach City</span>
                                    <p class="app__inspiration-item-desc">Travel community Vung Tau – A coastal city is 
                                        always an attractive destination for tourists. However, there are many people 
                                        who do not have much time for a multi-day trip to Vung Tau but only 1 day to stay in 
                                        the coastal city. So in a short day in Vung Tau, where should I go? What to do? 
                                        Do not panic because the 1 day Vung Tau tour below can help you enjoy the short 
                                        but experience completely Vung Tau trip!
                                    </p>
                                    <p class="pt-1"></p>
                                </div>
                            </a>
                        </div>

                        <div class="col large">
                            <a href="./Article_2.php" class="app__inspiration-item">
                                <img src="../assets/img/inspiration/image_7.png" alt="Inspiration"
                                    class="app__inspiration-item__img">

                                <div class="app__inspiration-item-info">
                                    <span class="app__inspiration-item-title">
                                        Paragliding over million-year-old dormant volcano in Central Highlands
                                    </span>
                                    <p class="app__inspiration-item-desc">
                                        Visitors have flocked to Gia Lai Province in the Central Highlands to
                                        paraglide over Chu Dang Ya volcano, active millions of years ago.
                                    </p>
                                    <p class="pt-1"></p>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col">
                                    <a href="./Article_3.php" class="app__inspiration-item">
                                        <img src="../assets/img/inspiration/image_11.png" alt="Inspiration"
                                            class="app__inspiration-item__img">

                                        <div class="app__inspiration-item-info">
                                            <span class="app__inspiration-item-title">Camping by Central Highlands lake Ta Dung</span>
                                            <p class="app__inspiration-item-desc">
                                                TTa Dung Lake in Vietnam's Central Highlands offers mesmerizing camping 
                                                given its charming emerald hue, dotted with forest-green islands.
                                            </p>
                                            <p class="pt-1"></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="./Article_4.php" class="app__inspiration-item">
                                        <img src="../assets/img/inspiration/image_14.png" alt="Inspiration"
                                            class="app__inspiration-item__img">

                                        <div class="app__inspiration-item-info">
                                            <span class="app__inspiration-item-title">2 treks for discovering Vietnam’s rural heartlands</span>
                                            <p class="app__inspiration-item-desc">
                                                Jungle-cloaked hills that once shook with the sound of combat are now the serene setting for 
                                                adventurous hikes to remote villages, lofty lookouts, tumbling waterfalls and the summit of Indochina’s 
                                                highest mountain. With plenty of local guides and trekking agencies on hand to help you to the top of 
                                                the trails, all you really need to do is pick a route – and set out.
                                            </p>
                                            <p class="pt-1"></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top text-center position-fixed">
            <i class="text-dark fa-solid fa-angles-up"></i>
        </a>
        <!--End Back To Top Button-->

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
                            <a href="#" class="text-decoration-none">
                                <button class="app__search-btn">Get Started</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <a href="#" class="app__nav-name-link">
                            <img src="../assets/img/logo.png" alt="Logo" class="app__nav-name-icon">
                        </a>
                    </div>
                    <div class="col">
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
                    <div class="col">
                        <ul class="app__footer-list">
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Community</a>
                            </li>
                            <li class="app__footer-list-item">
                                <a href="#" class="app__footer-list-item-link">Trivia Community</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
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
                    <div class="col">
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

        <script src="../js/Homepage.js"></script>
        <script>
            $(document).ready(function () {
                $(window).on("scroll", function () {
                    if ($(this).scrollTop() > 300) {
                        $('.back-to-top').fadeIn();
                    } else {
                        $('.back-to-top').fadeOut();
                    }
                });

                $('.back-to-top').on("click", function () {
                    $("html, body").animate({ scrollTop: 0 }, 200);
                    return false;
                });
            });
        </script>
    </div>
</body>

</html>