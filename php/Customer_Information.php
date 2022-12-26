<!-- Xử lý lấy thông tin từ database -->
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

    $array_img = findImage($Image_Customer);

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
    <?php echo "<title>Trivia - $user_name</title>"; ?>
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
                            <?php echo "<a href='./Customer_Information.php' class='app__nav-item-link' style='cursor: pointer;'>" . $user_name . "</a>"; ?>
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
                            <li class="app__sidebar-item app__sidebar-item--active">Your Account</li>
                            <li class="app__sidebar-item">
                                <a href="./Customer_viewBooking.php" class="text-decoration-none text-dark">View all bookings</a>
                            </li>
                            <li class="app__sidebar-item">
                                <label for="app__inbox-input" style="cursor: pointer;">Inbox</label>
                            </li>
                            <li class="app__sidebar-item">
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
                    <div class="col-9">
                        <h1 class="app__main-title">User Details</h1>

                        <form action="./HandleUpdateCus.php?Update=1" method="post" class="form-detail" id="form-detail" enctype="multipart/form-data">
                            <div class="form-avatar">
                                <label for="app__main-input-img" class="app__main-label-img" style="width: 100%;">
                                    <?php
                                    if ($array_img[0] === 'IMG') {
                                    ?>
                                        <img src="../assets/img/upload/<?php echo $Image_Customer; ?>" alt="avatar" class="app__main-img">
                                    <?php
                                    }
                                    else if ($array_img[0] === '') {
                                        echo '<img src="../assets/img/others/avatar.png" alt="avatar" class="app__main-img">';
                                    }
                                    else {
                                    ?>
                                        <img src="<?php echo $Image_Customer; ?>" alt="avatar" class="app__main-img">
                                    <?php } ?>
                                </label>
                                <span class="form-avatar__message">
                                    <i class="fa-solid fa-camera"></i>
                                    Change your avatar
                                </span>
                                <?php
                                if (isset($_GET['flag'])) {
                                    $flag = $_GET['flag'];
                                    if ($flag == "2") {

                                ?>
                                        <script>
                                            alert('You cannot upload file with this type')
                                        </script>
                                    <?php
                                    } else if ($flag == "1") {
                                    ?>
                                        <script>
                                            alert('Your size of file is too big')
                                        </script>
                                <?php
                                    }
                                }
                                ?>
                                <input type="file" name="app__main-input-img" id="app__main-input-img" hidden disabled>
                            </div>

                            <div class="form-info">
                                <div class="form-group">
                                    <label for="yourname" class="form-label">Your Name<span style="color: red;">*</span></label>
                                    <input id="yourname" name="yourname" type="text" value="<?php echo $cus_name; ?>" disabled class="form-control edit-active">
                                    <span class="form-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input id="email" name="email" type="text" value="<?php echo $Gmail; ?>" disabled class="form-control">
                                    <span class="form-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="country" class="form-label">Country</label>
                                    <select id="country" name="country" class="form-control edit-active" disabled>
                                        <option value="">--- Select Country ---</option>
                                        <?php
                                        if (strlen($country) != 0) {
                                            echo "<option value='$country' selected>$country</option>";
                                        }
                                        ?>

                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antartica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo">Congo, the Democratic Republic of the</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                                        <option value="Croatia">Croatia (Hrvatska)</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="France Metropolitan">France, Metropolitan</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                                        <option value="Holy See">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran (Islamic Republic of)</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia, Federated States of</option>
                                        <option value="Moldova">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint LUCIA">Saint LUCIA</option>
                                        <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                        <option value="Span">Spain</option>
                                        <option value="SriLanka">Sri Lanka</option>
                                        <option value="St. Helena">St. Helena</option>
                                        <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syrian Arab Republic</option>
                                        <option value="Taiwan">Taiwan, Province of China</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Viet Nam</option>
                                        <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                        <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                                        <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                    <span class="form-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="sex" class="form-label">Your Sex<span style="color: red;">*</span></label>
                                    <select id="sex" name="sex" class="form-control edit-active" disabled style="font-size: 14px;">
                                        <option value="">--- Select your sex ---</option>
                                        <option value="0" <?php if ($sex == 0) {
                                                                echo "selected='selected'";
                                                            } ?>>Male</option>
                                        <option value="1" <?php if ($sex == 1) {
                                                                echo "selected='selected'";
                                                            } ?>>Female</option>
                                    </select>
                                    <span class="form-message"></span>
                                </div>

                                <div class="form-group">
                                    <label for="phonenumber" class="form-label">Phone Number<span style="color: red;">*</span></label>
                                    <input id="phonenumber" name="phonenumber" value="<?php echo $phone; ?>" disabled type="text" class="form-control edit-active">
                                    <span class="form-message"></span>
                                </div>

                                <div class="button-handle">
                                    <button class="form-edit">Edit details</button>
                                    <input type="submit" class="form-edit" value="Accept" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
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
                                        <h6 class="ps-2 pe-2 pt-1 app__inbox-item-title"><?php echo $inbox[0] ?></h6>
                                        <script>
                                            usernameSend = <?php echo json_encode($row[0]); ?>;
                                            usernameReceive = <?php echo json_encode($inbox[0]); ?>;
                                        </script>
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

    <script src="../assets/js/validator.js"></script>
    <script src="../js/Customer_Information.js"></script>
    <script src="../js/Inbox.js"></script>
    <script>
        loadMessage(usernameSend, usernameReceive, 3);

        Validator({
            form: '#form-detail',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#yourname'),
                Validator.isRequired('#country'),
                Validator.isRequired('#sex'),
                Validator.isRequired('#phonenumber'),
            ]
        });
    </script>
</body>

</html>