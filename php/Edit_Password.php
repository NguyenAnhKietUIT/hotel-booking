<?php

session_start();

$flag = 0;
$accID = 0;

if(!isset($_SESSION['accID3'])){
    header("Location: ./SignIn.php");
}
else {

    include "./getInformationCus.php";

    $accID = $_SESSION['accID3'];

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
    <link rel="stylesheet" href="../css/Edit_Password.css">
    <title>Change password</title>
</head>

<body>
    <header class="app__header">
        <div class="grid wide">
            <nav class="app__nav">
                <a href="./Homepage.php" class="app__nav-name-link">
                    <img src="../assets/img/logo.png" alt="Logo" class="app__nav-name-icon">
                </a>

                <ul class="app__nav-list hide-on-mobile-tablet">
                    <li class="app__nav-item">
                    <a href="./Homepage.php?this_id=<?php echo $accID;?>" class="app__nav-item-link">Home</a>
                    </li>
                    <li class="app__nav-item">
                        <a href="./Contact.php" class="app__nav-item-link">Contacts</a>
                    </li>
                    <li class="app__nav-item">
                    <?php
                            echo "<a href='./Customer_Information.php?this_id=$accID' class='app__nav-item-link' style='cursor: pointer;'>".$user_name."</a>";
                        ?>
                    </li>
                </ul>
            </nav>

            <form action="./HandleUpdateCus.php?Update=2" method="post" id="form" class="form">
                <img src="../assets/img/favicon.png" id="logo" />

                <h2 class="form-title">Change your password</h2>

                <div class="form-group">
                    <input id="oldPassword" name="oldPassword" type="password" placeholder="Old your password" class="form-control">
                    <?php
                        if(isset($_GET['flag'])){
                            $flag = $_GET['flag'];
                            if($flag == 1){
                                echo "<span class='form-message text-danger'>Old password is wrong</span>";
                            }
                            else if($flag == 2){
                                echo "<span class='form-message'></span>";
                            }
                        }
                        else{
                            echo "<span class='form-message'></span>";
                        }
                    ?>
                </div>

                <div class="form-group">
                    <input id="newPassword" name="newPassword" type="password" placeholder="New your password" class="form-control">
                    <?php
                        if(isset($_GET['flag'])){
                            $flag = $_GET['flag'];
                            if($flag == 2){
                                echo "<span class='form-message text-danger'>New password is same with old password</span>";
                            }
                            else if($flag == 1){
                                echo "<span class='form-message'></span>";
                            }
                        }
                        else{
                            echo "<span class='form-message'></span>";
                        }
                    ?>
                </div>
                <div class="form-group">
                    <input id="confirm-password" name="confirm-password" type="password" placeholder="Confirm your password" class="form-control">
                    <span class="form-message"></span>
                </div>

                <input type="submit" id="form-btn" class="form-btn" value="Continue" name="btnUpdatePass">
                </input>
            </form>
        </div>
    </header>
    
    <script src="../assets/js/validator.js"></script>
    <script>
        Validator({
            form: '#form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.minLength('#newPassword', 6),
                Validator.isRequired('#confirm-password'),
                Validator.isConfirmed('#confirm-password', function() {
                    return document.querySelector('#form #newPassword').value;
                }, 'Confirm password is wrong')
            ],
        });
    </script>
</body>
</html>