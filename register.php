<?php
include("./config/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./components/head.php") ?>
    <title>Register - FeetHub</title>
</head>

<body>
    <header>
        <div class="wrapper">
            <nav class="nav">
                <div class="wrap">
                    <div class="back">
                        <a href="./index.php"><i class="bi bi-arrow-left"></i>
                            <p>Back to Home</p>
                        </a>
                    </div>
                    <div class="logo">
                        <a href="./index.php"><img src="./assests/images/home/logo.svg" alt="logo"></a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <?php
        $firstNameErr = $lastNameErr = $userNameErr = $userMailErr = $userNumErr = $userPasswordErr = $confirmPasswordErr = $stateErr = $addressErr = $landmarkErr = $shopNameErr = $brandNameErr = $bNumErr = $shopAddressErr = "";
        if (isset($_POST['register'])) {
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $userName = strtolower($_POST['user_name']);
            $userMail = strtolower($_POST['user_mail']);
            $userNum = $_POST['userNum'];
            $userPassword = $_POST['user_password'];
            $confirmPassword = $_POST['confirm_password'];
            $state = $_POST['state'];
            $district = $_POST['district'];
            $address = $_POST['address'];
            $landmark = $_POST['landmark'];
            $role = $_POST['role'];
            $shopName = $_POST['shop_name'];
            $brandType = $_POST['brand_type'];
            $bNum = $_POST['business_number'];
            $shopAddress = $_POST['shop_address'];

            // patterns
            $namePatt = '/^[A-Za-z]{3,}$/';
            $userPatt = '/^[A-Za-z0-9_]{5,}$/';
            $emailpatt = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
            $numPatt = '/^[6-9][0-9]{9}$/';
            $passPatt = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
            $addressPatt = '/^[A-Za-z0-9\s,.-]{10,}$/';
            $landmarkPatt = '/^[A-Za-z0-9\s,.-]{5,}$/';
            // errors
            // first name validation
            if (empty($firstName)) {
                $firstNameErr = "Please enter the first name";
            } elseif (strlen($firstName) < 3) {
                $firstNameErr = "First name must be at least 3 characters long";
            } elseif (strlen($firstName) > 30) {
                $firstNameErr = "First name Less than 30 character only allowed";
            } else {
                if (!preg_match($namePatt, $firstName)) {
                    $firstNameErr = "Please enter a valid first name";
                }
            }
            // last name validation
            if (empty($lastName)) {
                $lastNameErr = "Please enter the Last name";
            } elseif (strlen($lastName) < 1) {
                $lastNameErr = "Last name must be at least 1 characters long";
            } elseif (strlen($lastName) > 15) {
                $lastNameErr = "Last name Less than 15 character only allowed";
            } else {
                if (!preg_match($namePatt, $lastName)) {
                    $lastNameErr = "Please enter a valid Last name";
                }
            }
            // user name validation
            if (empty($userName)) {
                $userNameErr = "Please enter the User name";
            } elseif (strlen($userName) < 5) {
                $userNameErr = "User name must be at least 5 characters long";
            } elseif (strlen($userName) > 15) {
                $userNameErr = "User name Less than 15 character only allowed";
            } else {
                if (!preg_match($userPatt, $userName)) {
                    $userNameErr = "Please enter a valid User name";
                }
            }
            // email validation
            if (empty($userMail)) {
                $userMailErr = "Please enter the Email id";
            } elseif (strlen($userMail) > 50) {
                $userMailErr = "Email id Less than 50 character only allowed";
            } else {
                if (!preg_match($emailpatt, $userMail)) {
                    $userMailErr = "Please enter a valid Email id";
                }
            }
            // mobile number validation
            if (empty($userNum)) {
                $userNumErr = "Please enter the Mobile number";
            } else {
                if (!preg_match($numPatt, $userNum)) {
                    $userNumErr = "Please enter a valid Mobile number";
                }
            }
            // password validation
            if (empty($userPassword)) {
                $userPasswordErr = "Please enter the Password";
            } elseif (strlen($userPassword) < 8) {
                $userPasswordErr = "Password must be at least 8 characters long";
            } elseif (strlen($userPassword) > 20) {
                $userPasswordErr = "Password Less than 20 character only allowed";
            } else {
                if (!preg_match($passPatt, $userPassword)) {
                    $userPasswordErr = "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character";
                }
            }
            // confirm password validation
            if (empty($confirmPassword)) {
                $confirmPasswordErr = "Please enter the Confirm Password";
            } elseif ($confirmPassword !== $userPassword) {
                $confirmPasswordErr = "Password and Confirm Password does not match";
            }
            // state validation
            if (empty($state)) {
                $stateErr = "Please select the State";
            }
            // district validation
            if (empty($district)) {
                $districtErr = "Please select the District";
            }

            // address validation
            if (empty($address)) {
                $addressErr = "Please enter the Address";
            } elseif (strlen($address) < 10) {
                $addressErr = "Address must be at least 10 characters long";
            } elseif (strlen($address) > 100) {
                $addressErr = "Address Less than 100 character only allowed";
            } else {
                if (!preg_match($addressPatt, $address)) {
                    $addressErr = "Please enter a valid Address";
                }
            }
            // landmark validation
            if (empty($landmark)) {
                $landmarkErr = "Please enter the Landmark";
            } elseif (strlen($landmark) < 5) {
                $landmarkErr = "Landmark must be at least 5 characters long";
            } elseif (strlen($landmark) > 50) {
                $landmarkErr = "Landmark Less than 50 character only allowed";
            } else {
                if (!preg_match($landmarkPatt, $landmark)) {
                    $landmarkErr = "Please enter a valid Landmark";
                }
            }
            // shop name validation
            if ($role === "merchant") {
                if (empty($shopName)) {
                    $shopNameErr = "Please enter the Shop Name";
                } elseif (strlen($shopName) < 3) {
                    $shopNameErr = "Shop Name must be at least 3 characters long";
                } elseif (strlen($shopName) > 100) {
                    $shopNameErr = "Shop Name Less than 50 character only allowed";
                } else {
                    if (!preg_match($namePatt, $shopName)) {
                        $shopNameErr = "Please enter a valid Shop Name";
                    }
                }
                // business number validation
                if (empty($brandType)) {
                    $brandNameErr = "Please enter the Brand Type";
                } elseif (strlen($brandType) < 3) {
                    $brandNameErr = "Brand Type must be at least 3 characters long";
                } elseif (strlen($brandType) > 100) {
                    $brandNameErr = "Brand Type Less than 50 character only allowed";
                } else {
                    if (!preg_match($namePatt, $brandType)) {
                        $brandNameErr = "Please enter a valid Brand Type";
                    }
                }
                // business number validation
                if (empty($bNum)) {
                    $bNumErr = "Please enter the Business Contact Number";
                } elseif (strlen($bNum) != 10) {
                    $bNumErr = "Business Contact Number must be 10 digits";
                } else {
                    if (!preg_match($numPatt, $bNum)) {
                        $bNumErr = "Please enter a valid Business Contact Number";
                    }
                }
                // shop address validation
                if (empty($shopAddress)) {
                    $shopAddressErr = "Please enter the Shop Address";
                } elseif (strlen($shopAddress) < 10) {
                    $shopAddressErr = "Shop Address must be at least 10 characters long";
                } elseif (strlen($shopAddress) > 100) {
                    $shopAddressErr = "Shop Address Less than 100 character only allowed";
                } else {
                    if (!preg_match($addressPatt, $shopAddress)) {
                        $shopAddressErr = "Please enter a valid Shop Address";
                    }
                }

            }
            $checkQuery = "SELECT * FROM user_details WHERE email='$userMail' OR phone='$userNum'";
            $checkResult = mysqli_query($connect, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                // If record exists, find which one matches
                $existing = mysqli_fetch_assoc($checkResult);
                if ($existing['email'] === $userMail) {
                    $userMailErr = "This email is already registered. Please use another email.";
                }
                if ($existing['phone'] === $userNum) {
                    $userNumErr = "This phone number is already registered. Please use another number.";
                }
            } else {
                if (empty($firstNameErr) && empty($lastNameErr) && empty($userNameErr) && empty($userMailErr) && empty($userNumErr) && empty($userPasswordErr) && empty($confirmPasswordErr) && empty($stateErr) && empty($addressErr) && empty($landmarkErr) && empty($shopNameErr) && empty($brandNameErr) && empty($bNumErr) && empty($shopAddressErr)) {
                    // query execution
                    $query = "INSERT INTO `user_details` (`first_name`, `last_name`, `user_name`, `email`, `phone`, `password`, `state`, `district`, `address`, `landmark`, `role`, `shop_name`, `brand_name`, `business_number`, `shop_address`) VALUES ('$firstName', '$lastName', '$userName', '$userMail', '$userNum', '$userPassword', '$state', '$district', '$address', '$landmark', '$role', '$shopName', '$brandType', '$bNum', '$shopAddress')";
                    // echo $query;
                    $result = mysqli_query($connect, $query);
                    if ($result) {
                        ?>
                        <script>
                            alert('form submitted successfully!');
                            window.location.href = "./login.php";
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                            alert('Error occured')
                        </script>
                        <?php
                    }
                }
            }
        }




        ?>
        <section id="register">
            <div class="wrapper">
                <form class="form-container" method="POST">
                    <div class="header-section">
                        <h2 class="sub-head"><i class="bi bi-person-add personi"></i> Register</h2>
                        <h4>Create your FeetHub account</h4>
                    </div>
                    <div class="info">

                        <div class="form-row">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" placeholder="Enter your first name" name="first_name"
                                    value="<?php echo isset($firstName) ? $firstName : '' ?>" />
                                <span><?php echo $firstNameErr; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" placeholder="Enter your last name" name="last_name"
                                    value="<?php echo isset($lastName) ? $lastName : '' ?>" />
                                <span><?php echo $lastNameErr; ?></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>User Name</label>
                                <input placeholder="Enter your username" name="user_name"
                                    value="<?php echo isset($userName) ? $userName : '' ?>" />
                                <span><?php echo $userNameErr; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="role">Register As:</label>
                                <select name="role" id="role" onchange="toggleMerchantFields()">
                                    <option value="customer" <?php echo (isset($role) && $role == 'customer') ? 'selected' : ''; ?> selected>Customer</option>
                                    <option value="merchant" <?php echo (isset($role) && $role == 'merchant') ? 'selected' : ''; ?>>Merchant</option>
                                </select>
                            </div>
                        </div>

                        <div class=" full-width">
                            <div id="merchantFields" style="display:none;">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Shop Name</label>
                                        <input type="text" name="shop_name" placeholder="Shop Name"
                                            value="<?php echo isset($shopName) ? $shopName : '' ?>">
                                        <span><?php echo $shopNameErr; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input type="text" name="brand_type" placeholder="Brand Type"
                                            value="<?php echo isset($brandType) ? $brandType : '' ?>">
                                        <span><?php echo $brandNameErr; ?></span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Business Number</label>
                                        <input type="text" name="business_number" placeholder="Business Contact Number"
                                            value="<?php echo isset($bNum) ? $bNum : '' ?>">
                                        <span><?php echo $bNumErr; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Shop Address</label>
                                        <input type="text" name="shop_address" placeholder="Shop Address"
                                            value="<?php echo isset($shopAddress) ? $shopAddress : '' ?>">
                                        <span><?php echo $shopAddressErr; ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class=" full-width">
                            <label>Email id</label>
                            <input placeholder="example@mail.com" name="user_mail"
                                value="<?php echo isset($userMail) ? $userMail : '' ?>" />
                            <span><?php echo $userMailErr; ?></span>
                        </div>
                        <div class="full-width">
                            <label>Mobile Number</label>
                            <input placeholder="987564XXXX" name="userNum"
                                value="<?php echo isset($userNum) ? $userNum : '' ?>" />
                            <span><?php echo $userNumErr; ?></span>
                        </div>
                        <div class="form-row">
                            <div class="form-group" style="position: relative;">
                                <label>Password</label>
                                <input type="password" id="password" placeholder="Create password" name="user_password"
                                    value="<?php echo isset($userPassword) ? $userPassword : '' ?>" />
                                <i class="bi bi-eye-slash" id="togglePassword1"
                                    style="position:absolute; right:10px; top:45px; cursor:pointer; color:#555;"></i>
                                <span><?php echo $userPasswordErr; ?></span>
                            </div>
                            <div class="form-group" style="position: relative;">
                                <label>Confirm password</label>
                                <input type="password" id="confirmPassword" placeholder="Re-enter password"
                                    name="confirm_password"
                                    value="<?php echo isset($confirmPassword) ? $confirmPassword : '' ?>" />
                                <i class="bi bi-eye-slash" id="togglePassword2"
                                    style="position:absolute; right:10px; top:45px; cursor:pointer; color:#555;"></i>
                                <span><?php echo $confirmPasswordErr; ?></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="state">State</label>
                                <select id="state" name="state" onchange="populateDistricts()">
                                    <option value="">Select State</option>
                                    <option value="Tamil Nadu" <?= (isset($state) && $state === "Tamil Nadu") ? 'selected' : '' ?>>Tamil Nadu</option>
                                    <option value="Kerala" <?= (isset($state) && $state === "Kerala") ? 'selected' : '' ?>>
                                        Kerala</option>
                                    <option value="Karnataka" <?= (isset($state) && $state === "Karnataka") ? 'selected' : '' ?>>Karnataka</option>
                                    <option value="Andhra Pradesh" <?= (isset($state) && $state === "Andhra Pradesh") ? 'selected' : '' ?>>Andhra Pradesh</option>
                                </select>
                                <span><?php echo $stateErr; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="district">City / District</label>
                                <select id="district" name="district">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                        </div>

                        <div class=" full-width">
                            <label>Address</label>
                            <textarea placeholder="Type your Address"
                                name="address"><?php echo isset($address) ? $address : ''; ?></textarea>
                            <span><?php echo $addressErr; ?></span>
                        </div>

                        <div class="full-width">
                            <label>Landmark</label>
                            <input type="text" placeholder="Enter lanmark here" name="landmark"
                                value="<?php echo isset($landmark) ? $landmark : '' ?>" />
                            <span><?php echo $landmarkErr; ?></span>
                        </div>


                    </div>
                    <div class="last-section">
                        <button type="submit" class=" proceed button-primary" name="register"><i
                                class="bi bi-person-add personi"></i> Register</button>
                        <h4>Already have an account? <a href="./login.php">Login here</a></h4>
                    </div>
                </form>
            </div>
        </section>

    </main>
    <?php include("./components/footer.php") ?>

    <button id="floatBtn" class="floating-btn"><i class="bi bi-chevron-up"></i></button>
    <script>
        const districtData = {
            "Tamil Nadu": ["Madurai", "Chennai", "Coimbatore", "Salem", "Tirunelveli"],
            Kerala: ["Kochi", "Thiruvananthapuram", "Kozhikode", "Thrissur"],
            Karnataka: ["Bengaluru", "Mysuru", "Mangaluru", "Hubli"],
            "Andhra Pradesh": ["Vijayawada", "Visakhapatnam", "Guntur", "Nellore"],
        };

        function populateDistricts() {
            const stateSelect = document.getElementById("state");
            const districtSelect = document.getElementById("district");
            const selectedState = stateSelect.value;
            districtSelect.innerHTML = '<option value="">Select District</option>';
            if (districtData[selectedState]) {
                districtData[selectedState].forEach((district) => {
                    const option = document.createElement("option");
                    option.value = district;
                    option.text = district;
                    districtSelect.appendChild(option);
                });
            }
        }

        const togglePassword1 = document.querySelector("#togglePassword1");
        const password = document.querySelector("#password");

        togglePassword1.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.classList.toggle("bi-eye");
            this.classList.toggle("bi-eye-slash");
        });

        const togglePassword2 = document.querySelector("#togglePassword2");
        const confirmPassword = document.querySelector("#confirmPassword");

        togglePassword2.addEventListener("click", function () {
            const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
            confirmPassword.setAttribute("type", type);
            this.classList.toggle("bi-eye");
            this.classList.toggle("bi-eye-slash");
        });
    </script>
    <script src="./js/query.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>