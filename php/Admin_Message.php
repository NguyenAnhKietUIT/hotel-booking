<?php

session_start();

if (!isset($_SESSION['accID1'])) {
    header('Location: ./SignIn.php');
} else {
    include "./connect.php";

    include "./HandleSelectAdmin.php";

    $result = showMessage($connect);
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
    <link rel="stylesheet" href="../css/Admin.css">
    <link rel="stylesheet" href="../css/Admin_Message.css">
    <title>Trivia</title>
</head>

<body>
    <div id="wrapper">
        <nav class="nav-action">
            <div class="nav__header">
                <img src="../assets/img/logo.png" alt="Logo" class="nav__header-img">

                <span class="app__header-name">Admin page</span>
            </div>

            <div class="nav__content">
                <ul class="nav__content-list">
                    <li>
                        <a href="./Admin_Dashboard.php" class="nav__content-list-item">
                            <i class="fa-brands fa-unsplash"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="./Admin_Analytics.php" class="nav__content-list-item">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span>Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="./Admin_Message.php" class="nav__content-list-item active">
                            <i class="fa-solid fa-message"></i>
                            <span>Message</span>
                        </a>
                    </li>
                </ul>

                <form action="./logout.php" method="POST" class="nav__content-list-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <input type="submit" name="sign-out" class="sign-out" value="Sign out">
                </form>
            </div>
        </nav>

        <!--Start header-->
        <header class="topbar-nav">
            <nav class="navbar navbar-expand fixed-top">
                <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link toggle-menu" href="javascript:void();">
                            <i class="menu-icon fa-solid fa-bars"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form class="search-bar">
                            <input type="text" class="form-control" placeholder="Enter keywords">
                            <a href="javascript:void();">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </form>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
                            <i class="fa-solid fa-envelope-open"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
                            <i class="fa-regular fa-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                            <span class="user-profile">
                                <img src="../assets/img/others/anhkiet.jpg" class="img-circle" alt="user avatar">
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar">
                                            <img class="align-self-start me-3" src="../assets/img/others/anhkiet.jpg" alt="user avatar">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title">Nguyen Anh Kiet</h6>
                                            <p class="user-subtitle">20521498@gm.uit.edu.vn</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="fa-solid fa-inbox me-2"></i>
                                Inbox
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="fa-solid fa-user me-2"></i>
                                Account
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="fa-solid fa-sliders me-2"></i>
                                Setting
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">
                                <i class="fa-solid fa-power-off me-2"></i>
                                Logout
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <!--End header-->

        <div class="clearfix"></div>

        <!-- Start content -->
        <div class="content-wrapper">
            <div class="box-list-message">
                <nav class="nav-message m-3">
                    <div>
                        <input type="checkbox" name="nav-select-all" id="nav-select-all">
                        <label for="nav-select-all">Select all</label>
                    </div>

                    <div class="nav-message-delete">
                        <i class="fa-solid fa-trash"></i>
                        <span>Delete</span>
                    </div>
                </nav>

                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card ms-3 me-3">
                            <form action="./HandleDeleteAdmin.php?Delete=1" method="POST">
                                <table class="table" id="table-message">
                                    <?php
                                    while ($row = mysqli_fetch_row($result)) {
                                    ?>

                                        <tr>
                                            <td><input type="checkbox" class="message-select"></td>
                                            <td>
                                                <i class="message-icon fa-regular fa-star"></i>
                                                <i class="message-icon-active fa-solid fa-star"></i>
                                            </td>
                                            <td><?php echo $row[5]; ?></td>
                                            <td>
                                                <span class="message-title"><?php echo $row[4]; ?></span>
                                                -
                                                <span class="message-content"><?php echo $row[7]; ?></span>
                                            </td>
                                            <td>
                                                <button class="message-trash" name="btnDelete" type="submit" onclick="findInform(this)">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                            <td class="d-none"><?php echo $row[0]; ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End content -->

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top">
            <i class="fa-solid fa-angles-up"></i>
        </a>
        <!--End Back To Top Button-->

        <!--Start footer-->
        <footer class="footer">
            <div class="text-center">
                Copyright © 2022 by Alien
            </div>
        </footer>
        <!--End footer-->

        <!--start color switcher-->
        <div class="right-sidebar">
            <div class="switcher-icon">
                <i class="fa-solid fa-gear"></i>
            </div>
            <div class="right-sidebar-content">
                <p>Galaxy Background</p>
                <hr>

                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>

                <p>Gradient Background</p>
                <hr>

                <ul class="switcher">
                    <li id="theme7"></li>
                    <li id="theme8"></li>
                    <li id="theme9"></li>
                    <li id="theme10"></li>
                    <li id="theme11"></li>
                    <li id="theme12"></li>
                    <li id="theme13"></li>
                    <li id="theme14"></li>
                    <li id="theme15"></li>
                </ul>
            </div>
        </div>
        <!--end color switcher-->
    </div>

    <script src="../js/Admin.js"></script>
    <script src="../js/Admin_Message.js"></script>
    <script src="../js/Pagination.js"></script>
    <script>
        paginationTable('message', 10);

        function findInform(button) {
            function find_pos(row, x) {
                var updateTableCells = document.querySelector("#table-message").rows[row].cells; // lấy ra các cell của 1 row
                var updateTableRows = document.querySelector("#table-message").rows;
                for (let i = 0; i < updateTableRows.length; i++) {
                    if (updateTableRows[i] === x.parentElement.parentElement) {
                        document.cookie = "contactID" + "=" + updateTableCells[5].innerText;
                        break;
                    }
                }
                return false;
            }
            find_pos((button.parentElement).parentElement.rowIndex, button);
            // console.log((button.parentElement).parentElement.parentElement);
        }
    </script>
</body>

</html>