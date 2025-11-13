<?php
session_start();
include_once('../config/config.php');


if (!isset($_SESSION['manager_id'])) {
    header("Location: ../admin/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub-Admin Dashboard - FeetHub</title>
    <link rel="shortcut icon" href="../assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/admin-dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="#"><img src="../assests/images/home/logo.svg" alt="logo"></a>
                <!-- <h1 class="sidebar-title">Owner</h1> -->
            </div>
            <div class="sidebar-nav">
                <a href="#dashboard" class="nav-item active" data-section="dashboard">
                    <span class="nav-item-icon"><i class="bi bi-speedometer2 i"></i></span>
                    <span class="nav-item-label">Dashboard</span>
                </a>
                <a href="#users" class="nav-item" data-section="users">
                    <span class="nav-item-icon"><i class="bi bi-people"></i></span>
                    <span class="nav-item-label">Manage Users</span>
                </a>
                <a href="#merchants" class="nav-item" data-section="merchants">
                    <span class="nav-item-icon"><i class="bi bi-shop"></i></span>
                    <span class="nav-item-label">Manage Merchants</span>
                </a>
                <a href="#products" class="nav-item" data-section="products">
                    <span class="nav-item-icon"><i class="bi bi-box-seam"></i></span>
                    <span class="nav-item-label">View Products</span>
                </a>
                <a href="#orders" class="nav-item" data-section="orders">
                    <span class="nav-item-icon"><i class="bi bi-list-check"></i></span>
                    <span class="nav-item-label">View Orders</span>
                </a>
            </div>
        </nav>

        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navbar -->
            <header class="top-navbar">
                <?php
                if (isset($_SESSION['manager_id'])) {
                    $manager_id = $_SESSION['manager_id'];
                }
                $query = "SELECT * FROM sub_admins WHERE `manager_id`= '$manager_id'";
                $result = mysqli_query($connect, $query);
                if ($result) {
                    $row = mysqli_fetch_array($result);
                    $manager_id = $row['manager_id'];
                    $manager_name = $row['name'];
                }
                ?>
                <div class="navbar-left">
                    <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>
                    <h2 class="page-title">Manager - <?= $manager_id; ?> </h2>
                    <!-- <h2 class="page-title">Dashboard Overview</h2> -->
                </div>
                <div class="navbar-right">
                    <div class="profile-dropdown">
                        <button class="profile-btn" id="profileBtn">
                            <div class="profile-avatar">MA</div>
                            <span class="profile-name"><?= $manager_name; ?></span>
                            <span>▼</span>
                        </button>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="../admin/logout.php" class="dropdown-item logout">
                                <span><i class="bi bi-box-arrow-left"></i></span>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content">
                <!-- Dashboard Section -->
                <div class="content-section active" id="dashboard">
                    <!-- Stats Cards -->
                    <div class="stat-card revenue-card">
                        <div class="header">
                            <span class="stat-title">Revenue</span>
                        </div>
                        <?php
                        $query = "SELECT SUM(total_amount) AS total_revenue FROM orders";
                        $result = mysqli_query($connect, $query);
                        $row = mysqli_fetch_assoc($result);
                        $total_products = $row['total_revenue'];
                        ?>
                        <div class="stat-value">₹<?= $total_products; ?></div>
                    </div>
                    <!-- Stats Cards -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-title">Total Products</span>
                                <span class="stat-icon"><i class="bi bi-box-seam"></i></span>
                            </div>
                            <?php
                            $query = "SELECT COUNT(*) AS total_products FROM products";
                            $result = mysqli_query($connect, $query);
                            $row = mysqli_fetch_assoc($result);
                            $total_products = $row['total_products'];

                            ?>
                            <div class="stat-value"><?= $total_products; ?></div>
                            <div class="stat-change positive">
                                <span>↗</span>
                                <span>Current Month</span>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-title">Total Orders</span>
                                <span class="stat-icon"><i class="bi bi-list-check"></i></span>
                            </div>
                            <?php
                            $query = "SELECT COUNT(*) AS total_orders FROM orders";
                            $result = mysqli_query($connect, $query);
                            $row = mysqli_fetch_assoc($result);
                            $total_orders = $row['total_orders'];

                            ?>
                            <div class="stat-value"><?= $total_orders; ?></div>
                            <div class="stat-change positive">
                                <span>↗</span>
                                <span>Current Month</span>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-title">Total Merchants</span>
                                <span class="stat-icon"><i class="bi bi-shop"></i></span>
                            </div>
                            <?php
                            $query = "SELECT COUNT(*) AS total_merchants FROM user_details WHERE role = 'merchant';";
                            $result = mysqli_query($connect, $query);
                            $row = mysqli_fetch_assoc($result);
                            $total_merchants = $row['total_merchants'];

                            ?>
                            <div class="stat-value"><?= $total_merchants; ?></div>
                            <div class="stat-change positive">
                                <span>↗</span>
                                <span>Current Month</span>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-title">Total Users</span>
                                <span class="stat-icon"><i class="bi bi-people"></i></span>
                            </div>
                            <?php
                            $query = "SELECT COUNT(*) AS total_customers FROM user_details WHERE role = 'customer';";
                            $result = mysqli_query($connect, $query);
                            $row = mysqli_fetch_assoc($result);
                            $total_customers = $row['total_customers'];

                            ?>
                            <div class="stat-value"><?= $total_customers; ?></div>
                            <div class="stat-change positive">
                                <span>↗</span>
                                <span>Current Month</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders Table -->
                    <div class="recent-orders">
                        <div class="section-header">
                            <h3 class="section-title">Recent Orders</h3>
                        </div>
                        <div class="table-container">
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM orders ORDER BY order_id DESC LIMIT 4";
                                    $result = mysqli_query($connect, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        $rowid = 1;
                                        while ($row = mysqli_fetch_array($result)) {
                                            $order_id = $row['order_id'];
                                            $username = $row['username'];
                                            $productname = $row['product_name'];
                                            $quantity = $row['quantity'];
                                            $tolamt = $row['total_amount'];
                                            $payment_method = $row['payment_method'];
                                            $orderdate = $row['order_date'];
                                            ?>
                                            <tr>
                                                <td><?= $rowid; ?></td>
                                                <td><?= $order_id; ?></td>
                                                <td><?= $username; ?></td>
                                                <td><?= $productname; ?></td>
                                                <td><span class="order-status processing">Processing</span></td>
                                                <td>₹<?= $tolamt; ?></td>
                                                <td><?= $orderdate; ?></td>
                                                <td>
                                                    <a href="./flows/view.php?recentorder_id=<?= $order_id; ?>"
                                                        class="btn-view">View</a>
                                                </td>
                                            </tr>

                                            <?php
                                            $rowid++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">no data found!</td>
                                        </tr>
                                    <?php }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="content-section" id="products">
                    <h2 class="page-heading">Products Management</h2>
                    <div class="section-card">
                        <?php include_once('../flows/message.php'); ?>
                        <div class="card-header">
                            <h3>All Products</h3>
                        </div>

                        <?php
                        $query = "SELECT * FROM products AS p INNER JOIN user_details AS u ON p.merchant_id = u.user_id  WHERE u.status='active' AND u.role = 'merchant' AND p.status='active' ORDER BY p.product_id DESC";
                        $result = mysqli_query($connect, $query);

                        if (mysqli_num_rows($result) > 0) {
                            echo '<div class="products-grid">'; // ✅ open grid once
                        
                            while ($row = mysqli_fetch_array($result)) {
                                $merchant_id = $row['merchant_id'];
                                $product_id = $row['product_id'];
                                $productName = $row['product_name'];
                                $productCategory = $row['category'];
                                $productPrice = $row['price'];
                                $productDiscount = $row['discount'];
                                $productColourCount = $row['colour_count'];
                                $productStockstatus = $row['stock_status'];

                                // Fetch merchant details
                                $merchant_query = "SELECT * FROM user_details WHERE user_id = $merchant_id";
                                $merchant_result = mysqli_query($connect, $merchant_query);
                                $merchant_row = mysqli_fetch_array($merchant_result);
                                $shopName = $merchant_row['shop_name'];
                                $brandType = $merchant_row['brand_name'];

                                // Fetch product image
                                $imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                                $imageResult = mysqli_query($connect, $imageQuery);
                                $img = mysqli_fetch_assoc($imageResult);
                                ?>
                                <div class="product-card">
                                    <div class="product-image">
                                        <?php if ($img) { ?>
                                            <img src="../<?= htmlspecialchars($img['image_path']); ?>" alt="Product Image">
                                        <?php } else { ?>
                                            <img src="../assets/images/no-image.png" alt="No Image">
                                        <?php } ?>
                                    </div>
                                    <div class="product-info">
                                        <h4><?= htmlspecialchars($productName); ?></h4>
                                        <p><?= htmlspecialchars($shopName); ?></p>
                                        <p><?= htmlspecialchars($productCategory); ?></p>
                                        <span class="price">₹<?= htmlspecialchars($productPrice); ?></span>
                                    </div>
                                    <div class="product-actions">
                                        <a href="./flows/view.php?product_id=<?= $product_id ?>" class="btn-view">View</a>
                                        <a href="./flows/edit.php?product_id=<?= $product_id ?>" class="btn-edit">Edit</a>
                                        <form action="./flows/process.php" method="post" class="inline-form">
                                            <input type="hidden" name="id" value="<?= $product_id; ?>">
                                            <input type="submit" name="delete_product" value="Delete" class="btn-delete">
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }

                            echo '</div>'; // ✅ close grid after loop ends
                        } else {
                            echo "<h2>No products found!</h2>";
                        }
                        ?>
                    </div>
                </div>

                <!-- Orders Section -->
                <div class="content-section" id="orders">
                    <h2 class="page-heading">Orders Management</h2>
                    <div class="section-card">
                        <div class="card-header">
                            <h3>All Orders</h3>
                        </div>
                        <div class="table-container">
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select* from orders ORDER BY order_id DESC";
                                    $result = mysqli_query($connect, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        $rowid = 1;
                                        while ($row = mysqli_fetch_array($result)) {
                                            $order_id = $row['order_id'];
                                            $username = $row['username'];
                                            $productname = $row['product_name'];
                                            $quantity = $row['quantity'];
                                            $tolamt = $row['total_amount'];
                                            $payment_method = $row['payment_method'];
                                            $orderdate = $row['order_date'];
                                            ?>
                                            <tr>
                                                <td><?= $rowid; ?></td>
                                                <td><?= $order_id; ?></td>
                                                <td><?= $username; ?></td>
                                                <td><?= $productname; ?></td>
                                                <td><span class="order-status processing">Processing</span></td>
                                                <td>₹<?= $tolamt; ?></td>
                                                <td><?= $orderdate; ?></td>
                                                <td>
                                                    <a href="./flows/view.php?order_id=<?= $order_id; ?>"
                                                        class="btn-view">View</a>
                                                </td>
                                            </tr>

                                            <?php
                                            $rowid++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">no data found!</td>
                                        </tr>
                                    <?php }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Users Section -->
                <div class="content-section" id="users">
                    <h2 class="page-heading">User Management</h2>
                    <div class="section-card">
                        <?php include_once('../flows/message.php'); ?>
                        <div class="card-header">
                            <h3>All Users</h3>
                        </div>
                        <div class="table-container">
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile no.</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select* from user_details where role='customer' ORDER BY user_id DESC";
                                    $result = mysqli_query($connect, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        $rowid = 1;
                                        while ($row = mysqli_fetch_array($result)) {
                                            $userid = $row['user_id'];
                                            $username = $row['user_name'];
                                            $email = $row['email'];
                                            $phone = $row['phone'];
                                            $role = $row['role'];
                                            $status = $row['status'];
                                            ?>
                                            <tr>
                                                <td><?= $rowid; ?></td>
                                                <td><?= $userid; ?></td>
                                                <td><?= $username; ?></td>
                                                <td><?= $email; ?></td>
                                                <td><?= $phone; ?></td>
                                                <td><?= $role; ?></td>
                                                <td class="status-badge<?= ($status == 'active') ? 'active' : 'inactive'; ?>">
                                                    <?= $status; ?>
                                                </td>
                                                <td>
                                                    <a href="./flows/view.php?user_id=<?= $userid ?>" class="btn-view">View</a>
                                                    <button class="del">
                                                        <?php if ($status == "active") { ?>
                                                            <form action="./flows/process.php" method="post">
                                                                <input type="hidden" name="id" value=<?= $userid; ?>>
                                                                <input type="submit" name="delete_user" value="Delete"
                                                                    class="btn-delete">

                                                            </form>
                                                        <?php } else { ?>
                                                            <form action="./flows/process.php" method="post">
                                                                <input type="hidden" name="id" value=<?= $userid; ?>>
                                                                <input type="submit" name="add_user" value="Revert"
                                                                    class="btn-revert">

                                                            </form><?php
                                                        } ?>

                                                    </button>
                                                </td>
                                            </tr>

                                            <?php
                                            $rowid++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">no data found!</td>
                                        </tr>
                                    <?php }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Merchants Section -->
                <div class="content-section" id="merchants">
                    <h2 class="page-heading">Merchant Management</h2>
                    <div class="section-card">
                        <?php include_once('../flows/message.php'); ?>
                        <div class="card-header">
                            <h3>All Merchants</h3>
                            <!-- <button class="btn-primary">Add New Merchant</button> -->
                        </div>
                        <?php
                        $query = "select* from user_details where role='merchant' ORDER BY user_id DESC";
                        $result = mysqli_query($connect, $query);
                        if (mysqli_num_rows($result) > 0) {
                            $rowid = 1;
                            while ($row = mysqli_fetch_array($result)) {
                                $userid = $row['user_id'];
                                $username = $row['user_name'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $role = $row['role'];
                                $status = $row['status'];
                                $shopName = $row['shop_name'];
                                $brandType = $row['brand_name'];
                                $businessNum = $row['business_number'];
                                $shopAddress = $row['shop_address'];
                                // total products and orders
                                $query_products = "SELECT COUNT(*) AS total_products FROM products WHERE merchant_id = '$userid'";
                                $result_products = mysqli_query($connect, $query_products);
                                $row_products = mysqli_fetch_assoc($result_products);
                                $total_products = $row_products['total_products'];

                                $query_orders = "SELECT COUNT(*) AS total_orders FROM orders WHERE merchant_id = '$userid'";
                                $result_orders = mysqli_query($connect, $query_orders);
                                $row_orders = mysqli_fetch_assoc($result_orders);
                                $total_orders = $row_orders['total_orders'];
                                if ($role == 'merchant') {
                                    ?>
                                    <div class="adjust">
                                        <div class="merchants-grid">
                                            <div class="merchant-card">
                                                <div class="merchant-info">
                                                    <h4><?= $shopName; ?></h4>
                                                    <p><?= $brandType; ?></p>
                                                    <span
                                                        class="merchant-status <?= ($status == 'active') ? 'active' : 'inactive'; ?>"><?= ucfirst($status); ?></span>
                                                </div>
                                                <div class="merchant-stats">
                                                    <div class="stat">
                                                        <span class="stat-label">Products</span>
                                                        <span class="stat-value"><?= $total_products ?></span>
                                                    </div>
                                                    <div class="stat">
                                                        <span class="stat-label">Orders</span>
                                                        <span class="stat-value"><?= $total_orders ?></span>
                                                    </div>
                                                </div>
                                                <div class="merchant-actions">
                                                    <a href="./flows/view.php?user_id=<?= $userid ?>" class="btn-view">View</a>
                                                    <button class="del"> <?php if ($status == "active") { ?>
                                                            <form action="./flows/process.php" method="post"> <input type="hidden"
                                                                    name="id" value=<?= $userid; ?>> <input type="submit"
                                                                    name="delete_user" value="Delete" class="btn-delete"> </form>
                                                        <?php } else { ?>
                                                            <form action="./flows/process.php" method="post"> <input type="hidden"
                                                                    name="id" value=<?= $userid; ?>> <input type="submit" name="add_user"
                                                                    value="Revert" class="btn-revert"> </form><?php } ?>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php
                                            ?>
                                        </div>
                                        <?php
                                }
                            }
                            $rowid++;


                        } else {
                            ?>
                                <h3>no data found!</h3>
                                <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>


    <footer class="footer">
        <p>© 2025 <span>FeetHub</span> . All rights reserved.</p>
        <div class="footer-links">
            <a href="#">Terms & Conditions</a>
            <span>|</span>
            <a href="#">Privacy Policy</a>
        </div>
    </footer>
    <script>
        // Mobile sidebar toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('show');
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('show');
        }

        mobileMenuBtn.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);

        // Profile dropdown toggle
        const profileBtn = document.getElementById('profileBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');

        function toggleDropdown() {
            dropdownMenu.classList.toggle('show');
        }

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDropdown();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });

        // Section switching functionality (supports hash-based navigation and graceful fallback)
        const navItems = document.querySelectorAll('.nav-item');
        const contentSections = document.querySelectorAll('.content-section');

        function switchSection(targetSection) {
            // Remove active class from all nav items and sections
            navItems.forEach(nav => nav.classList.remove('active'));
            contentSections.forEach(section => section.classList.remove('active'));

            // Add active class to clicked nav item
            const activeNavItem = document.querySelector(`[data-section="${targetSection}"]`);
            if (activeNavItem) {
                activeNavItem.classList.add('active');
            }

            // Show corresponding section
            const targetSectionElement = document.getElementById(targetSection);
            if (targetSectionElement) {
                targetSectionElement.classList.add('active');
            }
        }

        // Handle hash (so links with #section work even if JS runs late)
        function handleHash() {
            const hash = window.location.hash ? window.location.hash.replace('#', '') : 'dashboard';
            switchSection(hash);
        }

        // Initialize after DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            // clicking a nav item updates the hash (makes navigation bookmarkable and works with back/forward)
            navItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    const targetSection = item.getAttribute('data-section');
                    if (targetSection) {
                        if (window.location.hash.replace('#', '') !== targetSection) {
                            window.location.hash = targetSection;
                        } else {
                            // already on this hash; ensure it is switched
                            switchSection(targetSection);
                        }
                    }

                    // Close sidebar on mobile after navigation
                    if (window.innerWidth <= 1024) {
                        closeSidebar();
                    }
                });
            });

            // Initial load: respect existing hash or default to dashboard
            handleHash();
        });

        // Support back/forward navigation
        window.addEventListener('hashchange', handleHash);

        // Close sidebar on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1024) {
                closeSidebar();
            }
        });

        // Logout functionality
        // const logoutBtn = document.querySelector('.dropdown-item.logout');
        // logoutBtn.addEventListener('click', (e) => {
        //     e.preventDefault();
        //     if (confirm('Are you sure you want to logout?')) {
        //         +                header('Location: ../index.php');
        //         // Add logout logic here
        //         alert('Logged out successfully!');
        //     }
        // });
    </script>
</body>

</html>