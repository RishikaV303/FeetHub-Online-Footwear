<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeetHub-About</title>
            <link rel="shortcut icon" href="./assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/products.css"> 
    <link rel="stylesheet" href="./css/about.css">
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
    <main>
        <section id="story">
            <div class="wrapper">
                <div class="heading">
                    <h1>Our Story</h1>
                    <p>At <span>FeetHub</span>, we believe every step you take should be a comfortable, stylish, and
                        confident one. Our journey began with a passion for quality footwear, crafted to bring joy and
                        lasting wear to your everyday life.</p>
                </div>
                <div class="accordion">
                    <div class="setOne common">
                        <div class="name">
                            <span>Our Philosophy</span>
                            <span><i class="bi bi-chevron-down"></i></i></span>
                        </div>
                        <div class="content ">
                            <p>Dedicated to providing comfort, quality, and style in every step. We carefully select
                                each design, ensuring it meets our high standards for your ultimate satisfaction. Our
                                goal is to be your trusted source for footwear that feels as good as it looks.</p>
                        </div>
                    </div>
                    <div class="setTwo common">
                        <div class="name">
                            <span>Our Materials</span>
                            <span><i class="bi bi-chevron-down"></i></span>
                        </div>
                        <div class="content">
                            <p>We believe true quality starts with the best components. That's why we source sustainable
                                and premium materials, from supple leathers to plush memory foams and durable outsoles,
                                ensuring lasting wear and an unparalleled feel with every pair.</p>
                        </div>
                    </div>
                    <div class="setThree common">
                        <div class="name">
                            <span>Craftsmanship</span>
                            <span><i class="bi bi-chevron-down"></i></span>
                        </div>
                        <div class="content">
                            <p>Each shoe and slipper in our collection reflects our commitment to expert construction.
                                We partner with skilled artisans and manufacturers who share our passion for detail,
                                bringing you hand-picked designs built to provide exceptional support and comfort for
                                your feet.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <section id="contact_us">
            <h2>Contact Us</h2>
            <div class="container">
                <!-- Left Section -->
                <div class="contact-details">
                    <p class="intro">
                        We’re here to help you put your best foot forward! <br>
                        Whether you have questions about your order, need help choosing the right pair, or just want to
                        say hello — we’d love to hear from you.
                    </p>

                    <div class="info-block">
                        <h4><i class="bi bi-envelope"></i>&nbsp;&nbsp;&nbsp;&nbsp;Email Us</h4>
                        <a href="mailto:feethub@gmail.com">support@feethub.com</a>
                    </div>

                    <div class="info-block">
                        <h4><i class="bi bi-telephone"></i> &nbsp;&nbsp;&nbsp;&nbsp;Call Us</h4>
                        <p>+91 9865541187</p>
                    </div>

                    <div class="info-block">
                        <h4><i class="bi bi-geo-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;Visit Us</h4>
                        <p>FEETHUB Headquarters<br>KK Nagar, Madurai, Tamil Nadu – 625020</p>
                    </div>

                    <div class="info-block">
                        <h4><i class="bi bi-hand-thumbs-up"></i>&nbsp;&nbsp;&nbsp;&nbsp;Follow Us</h4>
                        <div class="social-icons">
                            <a href="https://www.instagram.com/accounts/login/?hl=en" target="_blank"><i class="bi bi-instagram"></i></a>
                            <a href="https://www.linkedin.com/feed/" target="_blank"><i class="bi bi-linkedin"></i></a>
                            <a href="https://www.threads.com/?hl=en" target="_blank"><i class="bi bi-threads"></i></a>
                            <a href="https://www.youtube.com/" target="_blank"><i class="bi bi-youtube"></i></a>
                            <a href="https://www.facebook.com/" target="_blank"><i class="bi bi-facebook"></i></a>
                            <a href="https://x.com/?lang=en" target="_blank"><i class="bi bi-twitter-x"></i></a>
                        </div>
                    </div>

                    <div class="info-block">
                        <h4><i class="bi bi-info-circle"></i> &nbsp;&nbsp;&nbsp;&nbsp;Order Tracking & Returns</h4>
                        <p>
                            Need to track your order or request a return?<br>
                            Visit our <a href="#" class="highlight">Help Center</a> for quick solutions.
                        </p>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="contact-right">
                    <img src="./assests/images/about/contact-image.png" alt="images">
                </div>
            </div>
        </section>
    </main>

        <?php include("./components/footer.php") ?>
            <button id="floatBtn" class="floating-btn"><i class="bi bi-chevron-up"></i></button>
    <script src="./js/query.js"></script>
    <script src="./js/script.js"></script>
    <script>
        // accordion
$(document).ready(function () {
  $('.common .name').click(function () {
    const parent = $(this).parent();

    if (!parent.hasClass('active')) {
      $('.common').removeClass('active');
      $('.common .content').slideUp();

      parent.addClass('active');
      parent.find('.content').slideDown();
    } else {
      parent.removeClass('active');
      parent.find('.content').slideUp();
    }
  });
});
    </script>
</body>

</html>