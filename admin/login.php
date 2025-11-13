<?php
session_start();
include("../config/config.php");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Login - Feethub</title>
    <link rel="shortcut icon" href="../assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php


$userNameErr = $userPasswordErr = "";

if (isset($_POST['login'])) {
    $login_id = strtolower(trim($_POST['user_name']));
    $password = trim($_POST['password']);

    // Admin Login
    $userName = 'admin';
    $userPwd = 'admin@123';

    if ($userName == $login_id) {
        if ($userPwd == $password) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_name'] = $login_id;
            header("Location: ./admin-dashboard.php");
            exit;
        } else {
            $userPasswordErr = "Password mismatched";
        }
    } else {
        // Sub-admin Login
        $querySub = "SELECT * FROM sub_admins WHERE email_id='$login_id'";
        $resultSub = mysqli_query($connect, $querySub);

        if (mysqli_num_rows($resultSub) > 0) {
            $row = mysqli_fetch_assoc($resultSub);
            if ($row['password'] === $password) {
                $_SESSION['manager_id'] = $row['manager_id'];
                header("Location: ../sub-admin/sub-admin.php");
                exit;
            } else {
                $userPasswordErr = "Incorrect password!";
            }
        } else {
            $userNameErr = "Please enter your correct user id or mail id !";
        }
    }
}
?>

<body>
    <header>
        <div class="wrapper">
            <nav class="nav">
                <div class="wrap">
                    <!-- <div class="back">
                        <a href="../index.php"><i class="bi bi-arrow-left"></i>
                            <p>Back to Home</p>
                        </a>
                    </div> -->
                    <div class="logo">
                        <a href="#"><img src="../assests/images/home/logo.svg" alt="logo"></a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <section id="login">
            <div class="wrapper">
                <form class="form-container" method="post"
                    action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="header-section">
                        <h2 class="sub-head"><i class="bi bi-person-add personi"></i>Admin Login</h2>
                        <h4>Welcome back to FeetHub</h4>
                    </div>

                    <?php if ($userNameErr || $userPasswordErr): ?>
                        <div style="color:red; margin-bottom:10px;">
                            <?php
                            // Show a combined message or both field messages
                            echo htmlspecialchars($userNameErr ?: $userPasswordErr);
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="info">
                        <div class="full-width">
                            <label>User ID or Mail ID</label>
                            <span style="font-size: 12px; color: white;">(Admin or Sub Admin)</span>
                            <input type="text" placeholder="Enter your user name" name="user_name"
                                value="<?php echo isset($login_id) ? htmlspecialchars($login_id) : ''; ?>" />
                            <span style="color:red;"><?php echo $userNameErr; ?></span>
                        </div>

                        <div class="full-width" style="position: relative;">
                            <label>Password</label>
                            <input type="password" id="password" placeholder="Enter your Password" name="password" />
                            <i class="bi bi-eye-slash" id="togglePassword"
                                style="position:absolute; right:10px; top:45px; cursor:pointer; color:#555;"></i>
                            <span style="color:red;"><?php echo $userPasswordErr; ?></span>
                        </div>
                    </div>

                    <div class="last-section">
                        <button type="submit" class="proceed button-primary" name="login">
                            <i class="bi bi-person-add personi"></i> Login
                        </button>
                    </div>
                </form>
            </div>
        </section>

    </main>
    <footer>
        <div class="footer-wrapper">
            <div class="first-half">
                <div class="footer-section brand">
                    <div class="logo">
                        <img src="../assests/images/home/logo.svg" alt="logo">
                    </div>
                    <p>Stylish and comfortable shoes<br>
                        designed to elevate your<br>
                        everyday look with ease.</p>
                </div>

                <div class="footer-section">
                    <h2>Quick Links</h2>
                    <ul>
                        <li><a href="../products.php">Products</a></li>
                        <li><a href="../about_us.php">About us</a></li>
                        <li><a href="../about_us.php#contact_us">Contact us</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h2>Help</h2>
                    <ul>
                        <li><a href="#">Sizing</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h2>Follow Us</h2>
                    <div class="social-icons">
                        <a href="https://www.instagram.com/?flo=true" target="_blank"><i
                                class="bi bi-instagram"></i></a>
                        <a href="https://www.facebook.com/" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="https://x.com/?lang=en" target="_blank"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 FeetHub. All rights reserved.</p>
                <div class="policy-links">
                    <a href="#">Terms & Conditions</a>
                    <p>|</p>
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>


    </footer>
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            this.classList.toggle("bi-eye");
            this.classList.toggle("bi-eye-slash");
        });
    </script>


    <script src="../js/query.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>