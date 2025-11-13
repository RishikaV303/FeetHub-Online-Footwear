<?php
include_once('./config/config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
$pagename = basename($_SERVER['PHP_SELF']);
?>
<nav>
    <div class="nav-wrap">
        <div class="logo">
            <a href="./index.php"><img src="./assests/images/home/logo.svg" alt="logo"></a>
        </div>

        <label for="check" class="menu_icon"> <i class="bi bi-list"></i></label>
        <input type="checkbox" id="check">
        <ul>
            <li><a href="./index.php">
                    <h3 class="<?php echo ($pagename == "index.php") ? "home" : " " ?>">
                        Home</h3>
                </a></li>
            <li id="opone"><a href="./products.php">
                    <h3
                        class="<?php echo ($pagename == "products.php" || $pagename == "product_two.php") ? "home" : " " ?>">
                        Products</h3>
                </a></li>
            <li id="opone"><a href="./about_us.php">
                    <h3 class="<?php echo ($pagename == "about_us.php") ? "home" : " " ?>">About us</h3>
                </a></li>
            <li id="opone"><a href="./about_us.php#contact_us">
                    <h3 class="<?php echo ($pagename == "about_us.php#contact_us") ? "home" : " " ?>">Contact us</h3>
                </a></li>
        </ul>
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="icon">
                <!-- After Login -->
                <a href="./my_cart.php" class="cart-icon ">
                    <i class="bi bi-bag <?php echo ($pagename == "my_cart.php") ? "active" : " " ?>"></i>
                </a>
                <a href="./my_order.php" class="cart-icon ">
                    <i class="bi bi-box <?php echo ($pagename == "my_order.php") ? "active" : " " ?>"></i>
                </a>


                <div class="profile-menu">
                    <i class="fa-regular fa-circle-user profile"></i>
                    <div class="dropdown">
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <p class="username">Hi, <?= htmlspecialchars($_SESSION['user_name']); ?></p>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'merchant'): ?>
                            <a href="./merchant-dashboard/merchant-dashboard.php">View Dashboard</a>
                        <?php endif;
                        $user_id = $_SESSION['user_id'] ?? null;
                        $query = "select * from user_details where user_id=$user_id";
                        $res = mysqli_query($connect, $query);
                        $row = mysqli_fetch_array($res);
                        $userid = $row['user_id'];
                        $username = $row['user_name']; ?>
                        <a href="./profile-edit.php?user_id=<?= $user_id; ?>">Edit Profile</a>
                        <a href="./logout.php">Logout</a>
                    </div>
                </div>

            </div>
        <?php else: ?>
            <div class="btn">
                <!-- Before Login -->
                <a href="./login.php" class="button-nav">Login</a>
                <a href="./register.php" class="button-nav">Register</a>
            </div>
        <?php endif; ?>


    </div>
</nav>