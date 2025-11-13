<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
// if (isset($_SESSION['user_id'])) {
//     if ($_SESSION['role'] == 'merchant') {
//         header("Location: ./merchant-dashboard/merchant-dashboard.php");
//         exit();
//     } else if ($_SESSION['role'] == 'customer') {
//         header("Location: ./index.php");
//         exit();
//     }
// }
include("./config/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./components/head.php") ?>
    <title>Login - FeetHub</title>
</head>
<?php
$userNameErr = $userPasswordErr = "";
$login_id = "";
$password = "";

if (isset($_POST['login'])) {
    $login_id = strtolower(trim(string: $_POST['login_id']));
    $password = trim($_POST['password']);

    if (empty($login_id)) {
        $userNameErr = "Please enter your email";
    } elseif (empty($password)) {
        $userPasswordErr = "Please enter your password.";
    } else {
        // check if email/admin exists
        $queryUser = "SELECT * FROM user_details WHERE email='$login_id' LIMIT 1";
        $resultUser = mysqli_query($connect, $queryUser);

        if ($resultUser && mysqli_num_rows($resultUser) > 0) {
            $row = mysqli_fetch_assoc($resultUser);
            $dbPassword = $row['password'];
            $status = $row['status'];
            $role = $row['role'];

            // 1️⃣ Check password
            if ($dbPassword === $password) {

                // 2️⃣ Check if active
                if ($status !== 'active') {
                    $userNameErr = "Your account has been deactivated by admin. Please contact support.";
                } else {
                    // 3️⃣ Allow login
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['role'] = $role;
                    $_SESSION['user_name'] = $row['user_name'];

                    // 4️⃣ Redirect by role
                    if ($role === 'admin') {
                        header('Location: ./admin-dashboard.php');
                    } elseif ($role === 'merchant') {
                        header('Location: ./merchant-dashboard/merchant-dashboard.php');
                    } else {
                        header('Location: ./index.php');
                    }
                    exit();
                }
            } else {
                $userPasswordErr = "Incorrect password";
            }
        } else {
            $userNameErr = "Email ID not found";
        }
    }
}
?>

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
        <section id="login">
            <div class="wrapper">
                <form class="form-container" method="post"
                    action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="header-section">
                        <h2 class="sub-head"><i class="bi bi-person-add personi"></i> Login</h2>
                        <h4>Welcome back to FeetHub</h4>
                    </div>



                    <div class="info">
                        <div class="full-width">
                            <label>Email</label>
                            <span style="font-size: 12px; color: white;">(Customer or Merchant)</span>
                            <input type="text" placeholder="Enter Email "
                                name="login_id" value="<?php echo htmlspecialchars($login_id); ?>" />
                            <span style="color:red; font-size:14px;"><?php echo $userNameErr; ?></span>
                        </div>

                        <div class="full-width" style="position: relative;">
                            <label>Password</label>
                            <input type="password" id="password" placeholder="Enter your Password" name="password" />
                            <i class="bi bi-eye-slash" id="togglePassword"
                                style="position:absolute; right:10px; top:45px; cursor:pointer; color:#555;"></i>
                            <span style="color:red; font-size:14px;"><?php echo $userPasswordErr; ?></span>
                        </div>
                    </div>

                    <div class="last-section">
                        <button type="submit" class="proceed button-primary" name="login">
                            <i class="bi bi-person-add personi"></i> Login
                        </button>
                        <h4>Don't have an account? <a href="./register.php">Register here</a></h4>
                    </div>
                </form>
            </div>
        </section>

    </main>
    <?php include("./components/footer.php") ?>
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


    <script src="./js/query.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>