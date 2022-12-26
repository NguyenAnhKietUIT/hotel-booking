<?php $flag = 0; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/grid.css">
    <link rel="stylesheet" href="../css/Customer_SignUp.css">
    <link rel="stylesheet" href="../css/SignUp_Responsive.css">
    <title>Sign up</title>
</head>
<body>
    <div id="register">
        <div class="register__content">
            <div class="grid wide">
                <nav class="app__nav">
                    <a href="./Homepage.php" class="app__nav-name-link">
                        <img src="../assets/img/logo.png" alt="Logo" class="app__nav-name-icon">
                    </a>
    
                    <ul class="app__nav-list hide-on-mobile-tablet">
                        <li class="app__nav-item">
                            <a href="../html/Homepage.php" class="app__nav-item-link">Home</a>
                        </li>
                        <li class="app__nav-item">
                            <a href="./Contact.php" class="app__nav-item-link">Contacts</a>
                        </li>
                        <li class="app__nav-item">
                            <a href="./SignIn.php" class="app__nav-item-link">Sign In</a>
                        </li>
                    </ul>
                </nav>

                <div class="register_main-content">
                    <div class="register__plan">
                        <h3 class="register__plan-title">VIETNAM</h3>
    
                        <div class="register__plan-desc">
                            <span class="register__plan-text">Discover the most of Vietnam with</span>
                            <a href="#" class="register__plan-link">
                                <img src="../assets/img/logo.png" alt="Trivia" class="register__plan-img">
                            </a>
                        </div>
    
                        <a href="../html/Homepage.php" class="plan-btn">
                            PLAN YOUR TRIP NOW &rarr;
                        </a>
                    </div>
    
                    <div class="register__main">
                    <form action="./HandleInsertCus.php?Insert=1" method="POST" class="form" id="form">
                            <h3 class="form-title">
                                Create An Account
                            </h3>

                            <div class="form-group">
                                <input id="username" name="username" type="text" placeholder="Username" class="form-control">
                                <!-- Username đã tồn tai -->
                                <?php
                                    if(isset($_GET['flag'])){
                                        $flag = $_GET['flag'];
                                        if($flag == 1){
                                            echo "<span class='form-message text-danger'>Username đã tồn tại</span>";
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
                                <input id="email" name="email" type="email" placeholder="Email Address" class="form-control">
                                <!-- Gmail đã tồn tai -->
                                <?php
                                    if(isset($_GET['flag'])){
                                        $flag = $_GET['flag'];
                                        if($flag == 2){
                                            echo "<span class='form-message text-danger'>Gmail đã tồn tại</span>";
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
                                <input id="password" name="password" type="password" placeholder="Password" class="form-control">
                                <span class="form-message"></span>
                            </div>

                            <div class="form-group">
                                <input id="confirm-password" name="confirm-password" type="password" placeholder="Confirm Password" class="form-control">
                                <span class="form-message"></span>
                            </div>

                            <div class="register__agree">
                                <input type="checkbox" name="register__agree-checkbox" id="register__agree-checkbox" class="register__form-control">
                                <label for="register__agree-checkbox" class="register__agree-text">
                                    By clicking Create account, I agree that I have read and accepted the 
                                    <a href="#" class="register__agree-link">Terms of use</a>
                                    and
                                    <a href="#" class="register__agree-link">Privacy Policy</a>
                                </label>
                            </div>
                            
                            <input type="submit" class="form-btn" value="create account" name="inCreate">

                            <span class="register__or">
                                -or-
                            </span>

                            <button class="register__google">
                                <img src="../assets/img/google_icon.png" alt="Google" class="register__google-img">
                                <span>Sign up with Google</span>
                            </button>

                            <span class="register__already">
                                Already have an account?
                                <a href="./SignIn.php" class="register__already-link">Sign in</a> 
                            </span>
                        </form>
    
                        <div class="register__main-property">
                            <a href="./Property_SignUp.php" class="register__property-link">
                                <b>Sign up</b>
                            </a> for Properties
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
                Validator.isRequired('#username'),
                Validator.minLength('#password', 6),
                Validator.isEmail('#email'),
                Validator.isRequired('#confirm-password'),
                Validator.isConfirmed('#confirm-password', function() {
                    return document.querySelector('#form #password').value;
                }, 'Confirm password is wrong'),
            ],
        });
    </script>
</body>
</html>