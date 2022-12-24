<?php

include './connect.php';

session_start();

$accID = 0;

if (!isset($_SESSION['accID3'])) {
    header('Location: ./SignIn.php');
} else {
    // Gọi lấy ra thông tin tài khoản
    include "./getInformationCus.php";

    include "./HandleSelectCus.php";

    include "./HandleAnother.php";

    $accID = $_SESSION['accID3'];

    $result = CustomerReview($connect, $accID);

    // Tìm username bằng accID
    $usernameReceive = findUsernameCus($connect, $accID);
    // Kiểm tra
    //echo $usernameReceive[0];

    $showInbox = showInbox($connect, $usernameReceive[0]);
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
    <link rel="stylesheet" href="../css/Customer_Information.css">
    <?php
    echo "<title>Trivia - $user_name</title>";
    ?>
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
                            <a href="./Contact.php" class="app__nav-item-link">Contacts</a>
                        </li>
                        <li class="app__nav-item">
                            <?php
                            echo "<a href='./Customer_Information.php' class='app__nav-item-link' style='cursor: pointer;'>" . $user_name . "</a>";
                            ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="app__content">
            <div class="grid wide">
                <div class="row">
                    <div class="col-3">
                        <ul class="app__sidebar-list">
                            <li class="app__sidebar-item">
                                <a href="./Customer_Information.php" class="text-decoration-none text-dark">Your Account</a>
                            </li>
                            <li class="app__sidebar-item">
                                <a href="./Customer_viewBooking.php" class="text-decoration-none text-dark">View all bookings</a>
                            </li>
                            <li class="app__sidebar-item">
                                <label for="app__inbox-input" style="cursor: pointer;">Inbox</label>
                            </li>
                            <li class="app__sidebar-item  app__sidebar-item--active">
                                <a href="./Customer's_Review.php" class="text-decoration-none text-dark">Your Reviews</a>
                            </li>
                            <li>
                                <a href="./Edit_Password.php?this_id=<?php echo $accID; ?>" class="text-decoration-none text-dark">Edit your password</a>
                            </li>
                            <li class="app__sidebar-item">
                                <form action="./logout.php" method="post"><button class="btn-sign-out" name="logout_Cus">Sign out</button></form>
                            </li>
                        </ul>
                    </div>
                    <div class="col-9 ps-5">
                        <?php 
                            while($row = mysqli_fetch_row($result)) {
                        ?>
                            <a href="./Detail_Review.php?evaluateNumber=<?php echo $row[5]; ?>" class="text-decoration-none mt-3 d-block" style="color: #303030;">
                                <div class="d-flex justify-content-between border" style="border-radius: 12px;box-shadow: 0 0 2px 2px rgb(0 0 0 / 4%);">
                                    <?php 
                                        // Gọi hàm xử lý chuỗi
                                        $array_img = findImage($row[0]);
                                        ?>
                                        <?php
                                            if($array_img[0] === 'IMG'){
                                        ?>
                                            <img src="../assets/img/upload/<?php echo $row[0]; ?>"  alt="" style="width: 180px;height: 180px; border-radius: 12px;">
                                        <?php 
                                            }
                                            else {
                                        ?>
                                            <img src="<?php echo $row[0]; ?>"  alt="" style="width: 180px;height: 180px; border-radius: 12px;">
                                    <?php } ?>
                                    <div class="py-3 ps-4 d-flex flex-column justify-content-between" style="flex: 1;">
                                        <h4><?php echo $row[1]; ?></h4>
                                        <p>Time review: <?php echo $row[2]; ?></p>
                                        <p>Your rating:  <?php echo round($row[3], 1); ?></p>
                                        <p>Your review:  <?php echo $row[4]; ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <input type="checkbox" hidden name="app__inbox-input" id="app__inbox-input">
                <label for="app__inbox-input" class="app__inbox-overlay"></label>
                <div class="app__inbox">
                    <div class="row m-0 h-100 overflow-auto">
                        <div class="col-4" style="border-right: 1px solid #ccc;">
                            <ul class="list-unstyled">
                            <?php
                                    while($inbox = mysqli_fetch_row($showInbox)){
                                ?>
                                    <li class="app__inbox-item pb-2">
                                        <h6 class="ps-2 pe-2 pt-1 app__inbox-item-title"><?php echo $inbox[0] ?></h6>
                                        <span class="ps-2 pe-2 app__inbox-item-content">
                                            <?php echo $inbox[1] ?>
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
    </div>

    <script src="../js/Inbox.js"></script>

    <script>
        const options = document.querySelectorAll('.app__sidebar-item')

        options.forEach(element => {
            element.addEventListener('click', () => {
                options.forEach(element => {
                    element.classList.remove('app__sidebar-item--active')
                })
                element.classList.add('app__sidebar-item--active')
            })
        })
    </script>
</body>

</html>