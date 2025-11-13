<?php
include_once('./config/config.php');


// update sub-admin
if (isset($_POST['update'])) {

    $user_id = $_POST['id'];
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

    $query = "UPDATE `user_details` SET 
        first_name = '$firstName',
        last_name = '$lastName',
        user_name = '$userName',
        email = '$userMail',
        phone = '$userNum',
        password = '$userPassword',
        state = '$state',
        district = '$district',
        address = '$address',
        landmark = '$landmark',
        role = '$role',
        shop_name = '$shopName',
        brand_name = '$brandType',
        business_number = '$bNum',
        shop_address = '$shopAddress'
        WHERE user_id = '$user_id'";

    $result = mysqli_query($connect, $query);

    if ($result) {
        $_SESSION['message'] = "Profile updated successfully!";
        header('Location: ./index.php');
        exit();
    } else {
        $_SESSION['message'] = "Update failed. Please try again.";
        header('Location:  ./index.php');
        exit();
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile - FeetHub</title>
    <link rel="shortcut icon" href="./assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/form.css">
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="./css/profile-edit.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <div class="wrapper">
            <?php include("./components/nav.php") ?>

        </div>
    </header>
    <div class="container">
        <div class="order-header">
            <h2>Edit My Profile</h2>
        </div>
        <?php
        $firstName = $lastName = $username = $email = $phone = $password = $state = $district = $address = $landmark = $role = $shopName = $brandType = $businessNum = $shopAddress = '';
        if (isset($_GET['user_id'])) {
            $user_id = intval($_GET['user_id']); // Always sanitize user input
            $query = "SELECT * FROM user_details WHERE user_id=$user_id";
            $res = mysqli_query($connect, $query);

            if ($res && mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_array($res);
                $userid = $row['user_id'];
                $firstName = $row['first_name'];
                $lastName = $row['last_name'];
                $username = $row['user_name'];
                $email = $row['email'];
                $phone = $row['phone'];
                $password = $row['password'];
                $state = $row['state'];
                $district = $row['district'];
                $address = $row['address'];
                $landmark = $row['landmark'];
                $role = $row['role'];
                $joindate = $row['created_at'];
                $shopName = $row['shop_name'];
                $brandType = $row['brand_name'];
                $businessNum = $row['business_number'];
                $shopAddress = $row['shop_address'];
            } else {
                echo "<p style='color:red;'>No user found for ID: $user_id</p>";
            }
        }
        ?>
        <div class="order-tracking">

            <section id="register">
                <div class="wrapper">
                    <form class="form-container" method="POST"
                        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($userid); ?>">

                        <div class="info">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" placeholder="Enter your first name" name="first_name"
                                        value="<?= htmlspecialchars($firstName); ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" placeholder="Enter your last name" name="last_name"
                                        value="<?= htmlspecialchars($lastName); ?>" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input placeholder="Enter your username" name="user_name"
                                        value="<?= htmlspecialchars($username); ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="role">Register As:</label>
                                    <select name="role" id="role" onchange="toggleMerchantFields()">
                                        <option value="customer" <?= ($role == 'customer') ? 'selected' : '' ?>>Customer
                                        </option>
                                        <option value="merchant" <?= ($role == 'merchant') ? 'selected' : '' ?>>Merchant
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class=" full-width">
                                <div id="merchantFields" style="display:none;">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Shop Name</label>
                                            <input type="text" name="shop_name" placeholder="Shop Name"
                                                value="<?= htmlspecialchars($shopName); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Brand Name</label>
                                            <input type="text" name="brand_type" placeholder="Brand Type"
                                                value="<?= htmlspecialchars($brandType); ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Business Number</label>
                                            <input type="text" name="business_number"
                                                placeholder="Business Contact Number"
                                                value="<?= htmlspecialchars($businessNum); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Shop Address</label>
                                            <input type="text" name="shop_address" placeholder="Shop Address"
                                                value="<?= htmlspecialchars($shopAddress); ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class=" full-width">
                                <label>Email id</label>
                                <input placeholder="example@mail.com" name="user_mail"
                                    value="<?= htmlspecialchars(string: $email); ?>" />
                            </div>
                            <div class="full-width">
                                <label>Mobile Number</label>
                                <input placeholder="987564XXXX" name="userNum"
                                    value="<?= htmlspecialchars($phone); ?>" />
                            </div>
                            <div class="form-row">
                                <div class="form-group" style="position: relative;">
                                    <label>Password</label>
                                    <input type="password" id="password" placeholder="Create password"
                                        name="user_password" value="<?= htmlspecialchars($password); ?>" />
                                    <i class="bi bi-eye-slash" id="togglePassword1"
                                        style="position:absolute; right:10px; top:45px; cursor:pointer; color:#555;"></i>
                                </div>
                                <div class="form-group" style="position: relative;">
                                    <label>Confirm password</label>
                                    <input type="password" id="confirmPassword" placeholder="Re-enter password"
                                        name="confirm_password" value="<?= htmlspecialchars($password); ?>" />
                                    <i class="bi bi-eye-slash" id="togglePassword2"
                                        style="position:absolute; right:10px; top:45px; cursor:pointer; color:#555;"></i>
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
                                    name="address"><?= htmlspecialchars($address); ?></textarea>
                            </div>

                            <div class="full-width">
                                <label>Landmark</label>
                                <input type="text" placeholder="Enter lanmark here" name="landmark"
                                    value="<?= htmlspecialchars($landmark); ?>" />
                            </div>


                        </div>
                        <div class="last-section">
                            <button type="submit" class=" proceed button-primary" name="update"><i
                                    class="bi bi-pencil"></i> Edit</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <?php include("./components/footer.php") ?>
    <script>
        const districtsByState = {
            "Tamil Nadu": ["Madurai", "Chennai", "Coimbatore", "Trichy", "Salem"],
            "Kerala": ["Kochi", "Thiruvananthapuram", "Kozhikode", "Thrissur"],
            "Karnataka": ["Bangalore", "Mysore", "Mangalore", "Hubli"],
            "Andhra Pradesh": ["Vijayawada", "Visakhapatnam", "Guntur", "Tirupati"]
        };

        function populateDistricts() {
            const stateSelect = document.getElementById("state");
            const districtSelect = document.getElementById("district");
            const selectedState = stateSelect.value;
            const currentDistrict = "<?= htmlspecialchars($district); ?>"; // from PHP

            // Clear previous districts
            districtSelect.innerHTML = '<option value="">Select District</option>';

            if (districtsByState[selectedState]) {
                districtsByState[selectedState].forEach(dist => {
                    const option = document.createElement("option");
                    option.value = dist;
                    option.textContent = dist;
                    if (dist === currentDistrict) option.selected = true;
                    districtSelect.appendChild(option);
                });
            }
        }

        // Populate on page load (for edit form)
        window.addEventListener("DOMContentLoaded", populateDistricts);
        if (document.getElementById("role").value === "merchant") {
            document.getElementById("merchantFields").style.display = "block";
        }

        function toggleMerchantFields() {
            const role = document.getElementById("role").value;
            document.getElementById("merchantFields").style.display = role === "merchant" ? "block" : "none";
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