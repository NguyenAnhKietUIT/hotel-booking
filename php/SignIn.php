<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/grid.css">
    <link rel="stylesheet" href="../css/SignIn.css">
    <link rel="stylesheet" href="../css/SignIn_Responsive.css">
    <title>Sign in</title>
</head>
<body>
    <div id="login">
        <div class="login__content">
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
                            <a href="./Customer_SignUp.php" class="app__nav-item-link">Sign Up</a>
                        </li>
                    </ul>
                </nav>
                <div class="login_main-content">
                    <div class="login__plan">
                        <h3 class="login__plan-title">VIETNAM</h3>
    
                        <div class="login__plan-desc">
                            <span class="login__plan-text">Discover the most of Vietnam with</span>
                            <a href="#" class="login__plan-link">
                                <img src="../assets/img/logo.png" alt="Trivia" class="login__plan-img">
                            </a>
                        </div>
    
                        <a href="../html/Homepage.php" class="plan-btn">
                            PLAN YOUR TRIP NOW &rarr;
                        </a>
                    </div>
    
                    <div class="login__main">
                        <form action="./HandleSignIn.php" method="post" class="form" id="form">
                            <h3 class="form-title">
                                Sign Into </br> Your Account
                            </h3>
    
                            <div class="form-group">
                                <input id="username" name="username" type="text" placeholder="Username" class="form-control">
                                <span class="form-message"></span>
                            </div>
    
                            <div class="form-group">
                                <input id="password" name="password" type="password" placeholder="Password" class="form-control">
                                <span class="form-message"></span>
                            </div>
    
                            <div class="remember">
                                <input type="checkbox" name="form-remember" id="form-remember" class="input-control">
                                <label for="form-remember" class="form-remember-text">Remember Me</label>
                            </div>
                            
                            <input type="submit" class="form-btn" name="login" value="Sign in">

                            <button class="login__google">
                                <img src="../assets/img/google_icon.png" alt="Google" class="login__google-img">
                                <span>Sign in with Google</span>
                            </button>
                        </form>
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
            ],
        });
    </script>
</body>
</html>