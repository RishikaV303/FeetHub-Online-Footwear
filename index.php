<?php
session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('./config/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeetHub-Home</title>
    <link rel="shortcut icon" href="./assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <div class="wrapper">
            <?php include("./components/nav.php") ?>
            <div id="banner">
                <div class="carousel">
                    <div class="image">
                        <img src="./assests/images/home/Banner1-C1.png" alt="image1">
                    </div>
                    <div class="content contentOne">
                        <h1>Steps Into</h1>
                        <h2>Style</h2>
                        <p>Discover premium footwear that defines your journey</p>

                    </div>
                </div>
                <div class="carousel adjust">
                    <div class="image">
                        <img src="./assests/images/home/Banner1-C2.png" alt="image2">
                    </div>
                    <div class="content contentTwo">
                        <h1>Trusted by Thousands of Happy Feet</h1>
                        <p>Focus on materials or brand philosophy</p>

                    </div>
                </div>
                <div class="carousel adjust">
                    <div class="image">
                        <img src="./assests/images/home/Banner1-C3.png" alt="image3">
                    </div>
                    <div class="content contentThree">
                        <h1>Fast, Reliable Delivery to Your Doorstep</h1>
                        <p>Get your favorite pairs delivered lightning-fast with real-time tracking support.</p>

                    </div>
                </div>
                <div class="carousel adjust">
                    <div class="image">
                        <img src="./assests/images/home/Banner1-C4.png" alt="image4">
                    </div>
                    <div class="content contentFour">
                        <h1>Engineered for All-Day Comfort</h1>
                        <p>Designed with ergonomic precision for those who stay on their feet all day.</p>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>

        <!-- best-seller -->
        <section id="best-seller">
            <div class="wrapper">
                <h1>Bestsellers</h1>
                <div class="cards">
                    <?php
                    $query = "select * from products where is_best_seller = 1";
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

                            ?>


                            <a href="./product_two.php?product_id=<?= $product_id; ?>">
                                <div class="product">
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
                                            <h4><?= $productCategory; ?>         <?= $productType; ?> </h4>
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


                    ?>

                </div>
            </div>
            </div>
        </section>
        <!-- featured categories -->
        <section id="featured-categories">
            <div class="wrapper">
                <h1>Featured Categories</h1>
                <div class="navs">
                    <a class="active" href="#family">
                        <h1>For the Family</h1>
                    </a>
                    <a href="#adults">
                        <h1>For Adults</h1>
                    </a>
                    <a href="#seasonal">
                        <h1>Seasonal Picks</h1>
                    </a>
                </div>
                <div class="tab-content">
                    <div class="cards active" id="family">
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/home/fcOne.png" alt="images!">

                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Indoor Flip-Flops</h2>
                                    <h4>Everyday Comfort for Everyone at Home</h4>

                                </div>
                                <a href="./products.php#family" class="button">Shop Flip-Flops</a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/home/fcTwo.png" alt="images!">

                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Kids Footwear</h2>
                                    <h4>Playful Steps, Durable Design</h4>
                                </div>
                                <a href="./products.php#kids" class="button">Shop Kids</a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/home/fcThree.png" alt="images!">
                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Family Sneakers</h2>
                                    <h4>Matching Styles for All Ages</h4>
                                </div>
                                <a href="./products.php#family" class="button">Shop Family Sneakers</a>
                            </div>
                        </div>
                    </div>
                    <div class="cards" id="adults">
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/home/fc2One.png" alt="images!">

                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Men's Shoes</h2>
                                    <h4>Refined Shoes for Any Moment</h4>

                                </div>
                                <a href="./products.php#mens" class="button">Shop Men’s</a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/home/fc2Two.png" alt="images!">

                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Women's Shoes</h2>
                                    <h4>Elegance & Trend for Her</h4>
                                </div>
                                <a href="./products.php#womens" class="button">Shop Women’s</a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/home/fc2Three.png" alt="images!">
                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Formal Footwear</h2>
                                    <h4>Perfect Picks for Work & Events</h4>
                                </div>
                                <a href="./products.php#formal" class="button">Shop Formal Wear</a>
                            </div>
                        </div>
                    </div>
                    <div class="cards" id="seasonal">
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/home/fc3One.png" alt="images!">

                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Summer Sandals</h2>
                                    <h4>Light & Breezy for Warm Days</h4>

                                </div>
                                <a href="./products.php#seasonal" class="button">Shop Sandals</a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/home/fc3Two.png" alt="images!">

                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Winter Boots</h2>
                                    <h4>Stay Warm & Stylish</h4>
                                </div>
                                <a href="./products.php#seasonal" class="button">Shop Boots</a>
                            </div>
                        </div>
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/home/fc3Three.png" alt="images!">
                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Rainy Day Footwear</h2>
                                    <h4>Dry Steps in Wet Weather</h4>
                                </div>
                                <a href="./products.php#seasonal" class="button">Shop Rainwear</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- testimonial -->
        <section id="testimonials">
            <div class="wrapper">
                <h1>What Our Customers Say</h1>
                <div class="testimonial-list">
                    <div class="testimonial-item">
                        <div class="wrapper">
                            <div class="testimonial-content">
                                <div class="image">
                                    <img src="./assests/images/home/review1.png" alt="Sarah Johnson">
                                </div>
                                <div>
                                    <h3>Sarah Johnson</h3>
                                    <div class="stars"><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="para">
                                <p>"Amazing quality and comfort. These shoes are perfect for my daily runs!"</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="wrapper">
                            <div class="testimonial-content">
                                <div class="image">
                                    <img src="./assests/images/home/review2.png" alt="Mike Chen">
                                </div>
                                <div>
                                    <h3>Mike Chen</h3>
                                    <div class="stars"><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="para">
                                <p>"Stylish and durable. I've been wearing them for months and they still look new."</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="wrapper">
                            <div class="testimonial-content">
                                <div class="image">
                                    <img src="./assests/images/home/review3.png" alt="Emma Davis">
                                </div>
                                <div>
                                    <h3>Emma Davis</h3>
                                    <div class="stars"><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="para">
                                <p>"Best customer service and fast delivery. Highly recommend FeetHub!"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include("./components/footer.php") ?>
    <button id="floatBtn" class="floating-btn"><i class="bi bi-chevron-up"></i></button>

    <!-- <button id="floatBtn" class="floating-btn">+</button> -->
    <script src="./js/query.js"></script>
    <script src="./js/script.js"></script>

</body>

</html>