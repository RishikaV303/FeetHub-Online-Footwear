<?php
session_start();
include_once('../config/config.php');


if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'merchant') {
    header("Location: ../login.php");
    exit();
}

// Now you can use merchant_id in queries like:

$merchant_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Dashboard - FeetHub</title>
    <link rel="shortcut icon" href="../assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/admin-dashboard.css">
    <link rel="stylesheet" href="../css/merchant-dashboard.css">
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
                <a href="#overview" class="nav-item active" data-section="overview">
                    <span class="nav-item-icon"><i class="bi bi-speedometer2 i"></i></span>
                    <span class="nav-item-label">Dashboard Overview</span>
                </a>
                <a href="#products" class="nav-item" data-section="products">
                    <span class="nav-item-icon"><i class="bi bi-box-seam"></i></span>
                    <span class="nav-item-label">Manage Products</span>
                </a>
                <a href="#orders" class="nav-item" data-section="orders">
                    <span class="nav-item-icon"><i class="bi bi-list-check"></i></span>
                    <span class="nav-item-label">Manage Orders</span>
                </a>
            </div>

        </nav>

        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <main class="main-content">
            <?php
            if (isset($_SESSION['user_id'])) {
                $userid = $_SESSION['user_id'];
            }
            $query = "SELECT * FROM user_details WHERE `user_id`= $userid";
            $result = mysqli_query($connect, $query);
            if ($result) {
                $row = mysqli_fetch_array($result);
                $shopName = $row['shop_name'];
                $name = $row['user_name'];
            }
            ?>
            <!-- Top Navbar -->
            <header class="top-navbar">
                <div class="navbar-left">
                    <button class="mobile-menu-btn" id="mobileMenuBtn">☰</button>
                    <h2 class="page-title"><?= $shopName; ?> - Merchant</h2>
                    <!-- <h2 class="page-title">Dashboard Overview</h2> -->
                </div>
                <div class="navbar-right">
                    <div class="profile-dropdown">
                        <button class="profile-btn" id="profileBtn">
                            <div class="profile-avatar">M</div>
                            <span class="profile-name"><?= $name; ?></span>
                            <span>▼</span>
                        </button>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="../index.php" class="dropdown-item">
                                <span><i class="bi bi-globe2"></i></span>
                                <span>View Site</span>
                            </a>
                            <a href="../logout.php" class="dropdown-item logout">
                                <span><i class="bi bi-box-arrow-left"></i></span>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content">
                <!-- Overview Cards -->
                <div class="content-section" id="overview">
                    <!-- Stats Cards -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-title">My Total Products</span>
                                <span class="stat-icon"><i class="bi bi-box-seam"></i></span>
                            </div>
                            <?php
                            $query = "SELECT COUNT(*) AS total_products FROM products WHERE merchant_id = '$merchant_id'";
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
                                <span class="stat-title">My Orders</span>
                                <span class="stat-icon"><i class="bi bi-list-check"></i></span>
                            </div>
                            <?php
                            $query = "SELECT COUNT(*) AS total_orders FROM orders WHERE merchant_id = '$merchant_id'";
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
                                <span class="stat-title">Revenue</span>
                                <span class="stat-icon"><i class="bi bi-people"></i></span>
                            </div>
                            <?php
                            $query = "SELECT SUM(total_amount) AS total_revenue FROM orders WHERE merchant_id = '$merchant_id'";
                            $result = mysqli_query($connect, $query);
                            $row = mysqli_fetch_assoc($result);
                            $total_revenue = $row['total_revenue'];

                            ?>
                            <div class="stat-value">₹<?= $total_revenue; ?></div>
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
                                    $query = "SELECT * from orders WHERE merchant_id = '$merchant_id' ORDER BY order_id DESC LIMIT 3";
                                    $res = mysqli_query($connect, $query);
                                    if (mysqli_num_rows($res) > 0) {
                                        $rowid = 1;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $order_id = $row['order_id'];
                                            $username = $row['username'];
                                            $product_id = $row['product_id'];
                                            $productname = $row['product_name'];
                                            $quantity = $row['quantity'];
                                            $tolamt = $row['total_amount'];
                                            $payment_method = $row['payment_method'];
                                            $orderdate = $row['order_date'];
                                            ?>
                                            <tr>
                                                <td><span><?= $rowid ?></span></td>
                                                <td><span class="product-id"><?= $order_id ?></span></td>
                                                <td><span class="product-name"><?= $username ?></span></td>
                                                <td><?= $productname ?></td>
                                                <td><span class="order-status delivered">Delivered</span></td>
                                                <td><span class="order-amount">₹<?= $tolamt ?></span></td>
                                                <td><?= $orderdate ?></td>
                                                <td class="product-actions">
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
                                            <td colspan="8">no data found!</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="content-section " id="products">
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title">My Products</h3>
                            <a href="./flows/create.php" class="btn-primary">Add New Product</a>
                        </div>
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Stock Status</th>
                                        <th>Added Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from products where merchant_id='{$_SESSION['user_id']}' AND status='active' ORDER BY product_id DESC";
                                    $result = mysqli_query($connect, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        $rowid = 1;
                                        while ($row = mysqli_fetch_array($result)) {
                                            $product_id = $row['product_id'];
                                            $product_name = $row['product_name'];
                                            $price = $row['price'];
                                            $discount = $row['discount'];
                                            $stock_status = $row['stock_status'];
                                            $add_date = $row['created_at'];
                                            ?>
                                            <tr>
                                                <td><?= $rowid; ?></td>
                                                <td><?= $product_id; ?></td>
                                                <td><?= $product_name; ?></td>
                                                <td>₹<?= $price; ?></td>
                                                <td><?= $discount; ?></td>
                                                <td><?= $stock_status; ?></td>
                                                <td><?= $add_date; ?></td>
                                                <td class="action">
                                                    <a href="./flows/view.php?product_id=<?= $product_id ?>"
                                                        class="btn-view">View</a>
                                                    <a href="./flows/edit.php?product_id=<?= $product_id ?>"
                                                        class="btn-edit">Edit</a>

                                                    <button class="del">
                                                        <form action="./flows/process.php" method="post">
                                                            <input type="hidden" name="id" value=<?= $product_id; ?>>
                                                            <input type="submit" name="delete_product" value="Delete"
                                                                class="btn-delete">

                                                        </form>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            $rowid++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="8">no data found!</td>
                                        </tr>
                                    <?php }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Orders Section -->
                <div class="content-section" id="orders">
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title">My Orders</h3>
                        </div>
                        <div class="table-container">

                            <table class="data-table">
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
                                    $query = "SELECT * from orders WHERE merchant_id = '$merchant_id' ORDER BY order_id DESC";
                                    $res = mysqli_query($connect, $query);
                                    if (mysqli_num_rows($res) > 0) {
                                        $rowid = 1;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $order_id = $row['order_id'];
                                            $username = $row['username'];
                                            $product_id = $row['product_id'];
                                            $productname = $row['product_name'];
                                            $quantity = $row['quantity'];
                                            $tolamt = $row['total_amount'];
                                            $payment_method = $row['payment_method'];
                                            $orderdate = $row['order_date'];
                                            ?>
                                            <tr>
                                                <td><span><?= $rowid ?></span></td>
                                                <td><span class="product-id"><?= $order_id ?></span></td>
                                                <td><span class="product-name"><?= $username ?></span></td>
                                                <td><?= $productname ?></td>
                                                <td><span class="order-status delivered">Delivered</span></td>
                                                <td><span class="order-amount">₹<?= $tolamt ?></span></td>
                                                <td><?= $orderdate ?></td>
                                                <td class="product-actions">
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
                                            <td colspan="8">no data found!</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>

                            </table>
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

        // Section switching functionality
        const navItems = document.querySelectorAll('.nav-item');
        const contentSections = document.querySelectorAll('.content-section');
        const pageTitle = document.getElementById('pageTitle');

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

            // Update page title
            const sectionTitles = {
                'products': 'Manage My Products',
                'orders': 'Manage Orders'
            };

            if (pageTitle && sectionTitles[targetSection]) {
                pageTitle.textContent = sectionTitles[targetSection];
            }
        }

        navItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const targetSection = item.getAttribute('data-section');
                switchSection(targetSection);

                // Close sidebar on mobile after navigation
                if (window.innerWidth <= 1024) {
                    closeSidebar();
                }
            });
        });

        // Close sidebar on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 1024) {
                closeSidebar();
            }
        });

        // Logout functionality


        // Add loading animation to cards
        const overviewCards = document.querySelectorAll('.overview-card');
        overviewCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.style.animation = 'fadeInUp 0.6s ease forwards';
        });

        // Add CSS for fadeInUp animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);

        // Add hover effects to table rows
        const tableRows = document.querySelectorAll('.data-table tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.transform = 'scale(1.01)';
                row.style.transition = 'transform 0.2s ease';
            });

            row.addEventListener('mouseleave', () => {
                row.style.transform = 'scale(1)';
            });
        });

        // Add click effects to buttons
        const buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', function (e) {
                // Create ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple effect CSS
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
            button {
                position: relative;
                overflow: hidden;
            }   
            
            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(rippleStyle);
        document.addEventListener("DOMContentLoaded", function () {
            // Initially hide all sections
            const contentSections = document.querySelectorAll('.content-section');
            contentSections.forEach(section => {
                section.classList.remove('active');
            });

            // Get the dashboard overview nav item and make it active initially
            const dashboardNavItem = document.querySelector('[data-section="overview"]');
            if (dashboardNavItem) {
                dashboardNavItem.click(); // Trigger click to show overview section
            }
        });
    </script>


</body>

</html>