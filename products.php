<?php
include("./config/config.php");
$searchTerm = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($connect, $_GET['search']);
    // $searchQuery = "SELECT * FROM products WHERE status='active' 
    //                 AND (product_name LIKE '%$searchTerm%' 
    //                 OR category LIKE '%$searchTerm%' 
    //                 OR Type LIKE '%$searchTerm%') 
    //                 ORDER BY product_id DESC";
   $searchQuery = "SELECT * FROM products AS p INNER JOIN user_details AS u ON p.merchant_id = u.user_id WHERE u.status = 'active' AND u.role = 'merchant' AND p.status = 'active' AND (p.product_name LIKE '%$searchTerm%' OR p.category LIKE '%$searchTerm%' OR p.Type LIKE '%$searchTerm%') ORDER BY p.product_id DESC";


    $searchResult = mysqli_query($connect, $searchQuery);
    // echo "<pre>$searchQuery</pre>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeetHub-product</title>
    <link rel="shortcut icon" href="./assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<style>

</style>

<body>
    <header>
        <div class="wrapper">
            <?php include("./components/nav.php") ?>

        </div>
    </header>
    <main>
        <div class="search">
            <div class="wrapper">
                <div class="search-box">
                    <span class="search-icon"><i class="bi bi-search"></i></span>
                    <form method="GET" action="products.php">
                        <input type="text" name="search" id="search-input" placeholder=""
                            value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    </form>
                </div>
            </div>
        </div>
        <section class="product-section" id="search-results">
            <div class="wrapper">


                <?php
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $search = mysqli_real_escape_string($connect, $_GET['search']);
                    ?>
                    <div class="heading">
                        <h4 style='text-align:start; margin-left: 75px;'>Search Results for '<span
                                style='color:#ff4d4d;'><?= $search ?></span>'</h4>
                    </div>
                    <div class="cards">
                        <?php
                        $query = "SELECT * FROM products AS p INNER JOIN user_details AS u ON p.merchant_id = u.user_id WHERE u.status = 'active' AND u.role = 'merchant' AND p.status = 'active' AND (LOWER(p.product_name) LIKE LOWER('%$searchTerm%') OR LOWER(p.category) LIKE LOWER('%$searchTerm%') OR LOWER(p.Type) LIKE LOWER('%$searchTerm%')) ORDER BY p.product_id DESC";
                        $res = mysqli_query($connect, $query);

                        if (!$res) {
                            echo "Error in query: " . mysqli_error($connect);
                            exit;
                        }


                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $product_id = $row['product_id'];
                                $productName = $row['product_name'];
                                $productCategory = $row['category'];
                                $productType = $row['Type'];
                                $productPrice = $row['price'];
                                $productDiscount = $row['discount'];
                                $productColourCount = $row['colour_count'];
                                $productStockstatus = $row['stock_status'];
                                $add_date = $row['created_at'];
                                $imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                                $imageResult = mysqli_query($connect, $imageQuery);
                                $img = mysqli_fetch_assoc($imageResult); // Fetch only one row
                    
                                ?>
                                <a href="./product_two.php?product_id=<?= $product_id; ?>">
                                    <div class="product" data-aos="zoom-in"
                                        style="display:block !important; visibility:visible !important; opacity:1 !important;">
                                        <div class="image">
                                            <?php
                                            if ($img) {
                                                ?>
                                                <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="images!">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="content">
                                            <div class="details">
                                                <h2><?= $productName; ?></h2>
                                                <h4><?= $productCategory; ?>             <?= $productType; ?> </h4>
                                                <h4><?= $productColourCount . ' ' . (($productColourCount) > 1 ? 'Colours' : 'Colour'); ?>
                                                </h4>

                                            </div>
                                            <div class="price">
                                                <h2>₹<?= $productPrice; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <?php
                            }
                        } else {
                            echo "<p style='color:red;font-weight:500;'>No products found for '$search'.</p>";
                        }

                        // 🚫 Stop other category sections from showing
                        exit;
                }
                ?>
                </div>
            </div>
        </section>
        <section class="product-section" id="Mens">
            <div class="wrapper" id="mens">
                <h1>Men's Footwear</h1>
                <div class="cards">
                    <?php
                    // $query = "select * from products where status='active' ORDER BY product_id DESC";
                    $query = "SELECT * FROM products AS p INNER JOIN user_details AS u ON p.merchant_id = u.user_id  WHERE u.status='active' AND u.role = 'merchant' AND p.status='active' ORDER BY p.product_id DESC";
                    $result = mysqli_query($connect, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $rowid = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $productName = $row['product_name'];
                            $productCategory = $row['category'];
                            $productType = $row['Type'];
                            $productPrice = $row['price'];
                            $productDiscount = $row['discount'];
                            $productColourCount = $row['colour_count'];
                            $productStockstatus = $row['stock_status'];
                            $add_date = $row['created_at'];
                            $imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                            $imageResult = mysqli_query($connect, $imageQuery);



                            if ($productCategory == 'Mens') {

                                ?>

                                <a href="./product_two.php?product_id=<?= $product_id; ?>">
                                    <div class="product" data-aos="zoom-in">
                                        <div class="image">
                                            <?php
                                            $img = mysqli_fetch_assoc($imageResult); // Fetch only one row
                                            if ($img) {
                                                ?>
                                                <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="images!">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="content">
                                            <div class="details">
                                                <h2><?= $productName; ?></h2>
                                                <h4><?= $productCategory; ?>             <?= $productType; ?> </h4>
                                                <h4><?= $productColourCount . ' ' . (($productColourCount) > 1 ? 'Colours' : 'Colour'); ?>
                                                </h4>

                                            </div>
                                            <div class="price">
                                                <h2>₹<?= $productPrice; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a><?php
                            }

                        }
                    }


                    ?>

                </div>
            </div>
        </section>
        <section class="product-section" id="Mens">
            <div class="wrapper" id="womens">
                <h1>Women's Collection</h1>
                <div class="cards">
                    <?php
                    // $query = "select * from products where status='active' ORDER BY product_id DESC";
                    $query = "SELECT * FROM products AS p INNER JOIN user_details AS u ON p.merchant_id = u.user_id  WHERE u.status='active' AND u.role = 'merchant' AND p.status='active' ORDER BY p.product_id DESC";
                    $result = mysqli_query($connect, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $rowid = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $productName = $row['product_name'];
                            $productCategory = $row['category'];
                            $productType = $row['Type'];
                            $productPrice = $row['price'];
                            $productDiscount = $row['discount'];
                            $productColourCount = $row['colour_count'];
                            $productStockstatus = $row['stock_status'];
                            $add_date = $row['created_at'];
                            $imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                            $imageResult = mysqli_query($connect, $imageQuery);



                            if ($productCategory == 'Women') {

                                ?>

                                <a href="./product_two.php?product_id=<?= $product_id; ?>">
                                    <div class="product" data-aos="zoom-in">
                                        <div class="image">
                                            <?php
                                            $img = mysqli_fetch_assoc($imageResult); // Fetch only one row
                                            if ($img) {
                                                ?>
                                                <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="images!">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="content">
                                            <div class="details">
                                                <h2><?= $productName; ?></h2>
                                                <h4><?= $productCategory; ?>             <?= $productType; ?> </h4>
                                                <h4><?= $productColourCount . ' ' . (($productColourCount) > 1 ? 'Colours' : 'Colour'); ?>
                                                </h4>

                                            </div>
                                            <div class="price">
                                                <h2>₹<?= $productPrice; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a><?php
                            }

                        }
                    }
                    ?>

                </div>
            </div>
        </section>
        <section class="product-section" id="Mens">
            <div class="wrapper" id="kids">
                <h1>Kids' Picks</h1>
                <div class="cards">
                    <?php
                    $query = "SELECT * FROM products AS p INNER JOIN user_details AS u ON p.merchant_id = u.user_id  WHERE u.status='active' AND u.role = 'merchant' AND p.status='active' ORDER BY p.product_id DESC";
                    $result = mysqli_query($connect, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $rowid = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $productName = $row['product_name'];
                            $productCategory = $row['category'];
                            $productType = $row['Type'];
                            $productPrice = $row['price'];
                            $productDiscount = $row['discount'];
                            $productColourCount = $row['colour_count'];
                            $productStockstatus = $row['stock_status'];
                            $add_date = $row['created_at'];
                            $imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                            $imageResult = mysqli_query($connect, $imageQuery);



                            if ($productCategory == 'Kids') {

                                ?>

                                <a href="./product_two.php?product_id=<?= $product_id; ?>">
                                    <div class="product" data-aos="zoom-in">
                                        <div class="image">
                                            <?php
                                            $img = mysqli_fetch_assoc($imageResult); // Fetch only one row
                                            if ($img) {
                                                ?>
                                                <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="images!">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="content">
                                            <div class="details">
                                                <h2><?= $productName; ?></h2>
                                                <h4><?= $productCategory; ?>             <?= $productType; ?> </h4>
                                                <h4><?= $productColourCount . ' ' . (($productColourCount) > 1 ? 'Colours' : 'Colour'); ?>
                                                </h4>

                                            </div>
                                            <div class="price">
                                                <h2>₹<?= $productPrice; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a><?php
                            }

                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <section class="product-section" id="Mens">
            <div class="wrapper" id="family">
                <h1>For the Family</h1>
                <div class="cards">
                    <?php
                    $query = "SELECT * FROM products AS p INNER JOIN user_details AS u ON p.merchant_id = u.user_id  WHERE u.status='active' AND u.role = 'merchant' AND p.status='active' ORDER BY p.product_id DESC";
                    $result = mysqli_query($connect, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $rowid = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $productName = $row['product_name'];
                            $productCategory = $row['category'];
                            $productType = $row['Type'];
                            $productPrice = $row['price'];
                            $productDiscount = $row['discount'];
                            $productColourCount = $row['colour_count'];
                            $productStockstatus = $row['stock_status'];
                            $add_date = $row['created_at'];
                            $imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                            $imageResult = mysqli_query($connect, $imageQuery);



                            if ($productCategory == 'Family') {

                                ?>

                                <a href="./product_two.php?product_id=<?= $product_id; ?>">
                                    <div class="product" data-aos="zoom-in">
                                        <div class="image">
                                            <?php
                                            $img = mysqli_fetch_assoc($imageResult); // Fetch only one row
                                            if ($img) {
                                                ?>
                                                <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="images!">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="content">
                                            <div class="details">
                                                <h2><?= $productName; ?></h2>
                                                <h4><?= $productCategory; ?>             <?= $productType; ?> </h4>
                                                <h4><?= $productColourCount . ' ' . (($productColourCount) > 1 ? 'Colours' : 'Colour'); ?>
                                                </h4>

                                            </div>
                                            <div class="price">
                                                <h2>₹<?= $productPrice; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a><?php
                            }

                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <section class="product-section" id="Mens">
            <div class="wrapper" id="formal">
                <h1>Formal</h1>
                <div class="cards">
                    <?php
                    $query = "SELECT * FROM products AS p INNER JOIN user_details AS u ON p.merchant_id = u.user_id  WHERE u.status='active' AND u.role = 'merchant' AND p.status='active' ORDER BY p.product_id DESC";
                    $result = mysqli_query($connect, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $rowid = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $productName = $row['product_name'];
                            $productCategory = $row['category'];
                            $productType = $row['Type'];
                            $productPrice = $row['price'];
                            $productDiscount = $row['discount'];
                            $productColourCount = $row['colour_count'];
                            $productStockstatus = $row['stock_status'];
                            $add_date = $row['created_at'];
                            $imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                            $imageResult = mysqli_query($connect, $imageQuery);



                            if ($productCategory == 'Formal') {

                                ?>

                                <a href="./product_two.php?product_id=<?= $product_id; ?>">
                                    <div class="product" data-aos="zoom-in">
                                        <div class="image">
                                            <?php
                                            $img = mysqli_fetch_assoc($imageResult); // Fetch only one row
                                            if ($img) {
                                                ?>
                                                <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="images!">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="content">
                                            <div class="details">
                                                <h2><?= $productName; ?></h2>
                                                <h4><?= $productCategory; ?>             <?= $productType; ?> </h4>
                                                <h4><?= $productColourCount . ' ' . (($productColourCount) > 1 ? 'Colours' : 'Colour'); ?>
                                                </h4>

                                            </div>
                                            <div class="price">
                                                <h2>₹<?= $productPrice; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a><?php
                            }

                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <section class="product-section" id="Mens">
            <div class="wrapper" id="seasonal">
                <h1>Seasonal</h1>
                <div class="cards">
                    <?php
                    $query = "SELECT * FROM products AS p INNER JOIN user_details AS u ON p.merchant_id = u.user_id  WHERE u.status='active' AND u.role = 'merchant' AND p.status='active' ORDER BY p.product_id DESC";
                    $result = mysqli_query($connect, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $rowid = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $productName = $row['product_name'];
                            $productCategory = $row['category'];
                            $productType = $row['Type'];
                            $productPrice = $row['price'];
                            $productDiscount = $row['discount'];
                            $productColourCount = $row['colour_count'];
                            $productStockstatus = $row['stock_status'];
                            $add_date = $row['created_at'];
                            $imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                            $imageResult = mysqli_query($connect, $imageQuery);



                            if ($productCategory == 'Seasonal') {

                                ?>

                                <a href="./product_two.php?product_id=<?= $product_id; ?>">
                                    <div class="product" data-aos="zoom-in">
                                        <div class="image">
                                            <?php
                                            $img = mysqli_fetch_assoc($imageResult); // Fetch only one row
                                            if ($img) {
                                                ?>
                                                <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="images!">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="content">
                                            <div class="details">
                                                <h2><?= $productName; ?></h2>
                                                <h4><?= $productCategory; ?>             <?= $productType; ?> </h4>
                                                <h4><?= $productColourCount . ' ' . (($productColourCount) > 1 ? 'Colours' : 'Colour'); ?>
                                                </h4>

                                            </div>
                                            <div class="price">
                                                <h2>₹<?= $productPrice; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </a><?php
                            }

                        }
                    }
                    ?>
                </div>
            </div>
        </section>

    </main>
    <?php include("./components/footer.php") ?>
    <button id="floatBtn" class="floating-btn"><i class="bi bi-chevron-up"></i></button>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="./js/query.js"></script>
    <script src="./js/script.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        // search

        let input = document.getElementById('search-input');
        let texts = ["Search for your favorite item", "Find your perfect fit…", "Search for comfort that walks with you…", "Step into style – search here…"];
        let index = 0, char = 0;

        function typeNextSuggestion() {
            let current = texts[index];
            char = 0;
            input.placeholder = "";
            let type = setInterval(() => {
                if (char < current.length) {
                    input.placeholder += current.charAt(char++);
                } else {
                    clearInterval(type);
                    setTimeout(() => {
                        index = (index + 1) % texts.length;
                        typeNextSuggestion();
                    }, 2000); // Wait 2 seconds before next word
                }
            }, 100); // Typing speed
        }
        window.onload = () => {
            typeNextSuggestion();
        };

        // dropdown
        //   function toggleDropdown() {
        //      document.getElementById("dropdownMenu").classList.toggle("show");
        //   }

        // Close dropdown when clicking outside
        //   window.onclick = function (event) {
        //     if (!event.target.closest('.dropbtn')) {
        //         let dropdowns = document.getElementsByClassName("dropdown-content");
        //         for (let i = 0; i < dropdowns.length; i++) {
        //             let openDropdown = dropdowns[i];
        //             if (openDropdown.classList.contains('show')) {
        //                 openDropdown.classList.remove('show');
        //             }
        //          }
        //     }
        //  }

    </script>
</body>

</html>