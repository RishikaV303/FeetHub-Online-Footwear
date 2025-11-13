<!DOCTYPE html>
<html lang="en">

<?php include("./components/head.php") ?>

<body>
    <header>
        <div class="wrapper">
            <?php include("./components/nav.php") ?>
        </div>
    </header>
    <main>
        <section id="buynow-form">
            <div class="wrapper">
                <form class="form-container">
                    <div class="customer-info">
                        <h2 class="sub-head">Customer Info</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" placeholder="Vimala" id="user_name" onkeyup="validateFirstName()"/>
                                <span id="name_err"></span>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" placeholder="Jothi" id="last_name" onkeyup="validateLastName()"/>
                                <span id="last_err"></span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="state">State</label>
                                <select id="state" onchange="populateDistricts()" required>
                                    <option value="">Select State</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                </select>
                                <span id="state_err"></span>
                            </div>
                            <div class="form-group">
                                <label for="district">City / District</label>
                                <select id="district">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                        </div>

                        <div class=" full-width">
                            <label>Address</label>
                            <textarea placeholder="Type your Address" id="address" onkeyup="validateAddress()"></textarea>
                            <span id="address_err"></span>
                        </div>

                        <div class="form-group ">
                            <label>Landmark</label>
                            <input type="text" placeholder="Vetri cinemas Opp" id="landmark" onkeyup="validateLandmark()"/>
                            <span id="landmark_err"></span>
                        </div>

                        <div class="form-group ">
                            <label>Mobile Number</label>
                            <input type="text" placeholder="6381182890" id="userNum" onkeyup="validateMobile()"/>
                            <span id="num_err"></span>
                        </div>
                    </div>
                    <div class="payment-info">
                        <h2 class="sub-head">Payment Method</h2>
                        <div class="payment-section">
                            <p class="sub-head-two">Your available balance</p>
                            <div class="nobalance">
                                <label>
                                    <input type="radio" name="payment" disabled />
                                    Feethub pay balance ₹0.00 <span class="unavailable">Unavailable</span>
                                </label>
                                <p class="warning"><i class="bi bi-info-circle"></i>Insufficient balance. <a
                                        href="#">Add money & get rewarded</a></p>
                            </div>
                            <div class="form-row coupon-row">
                                <div class="forgap">
                                <input type="text" placeholder="Enter Code" id="code"  onkeyup="forcode()" required/>
                                <button type="submit" class="apply">Apply</button>
                                </div>
                                <span id="code_err"></span>
                            </div>

                            <p class="sub-head-two">Another payment method</p>
                            <label><input type="radio" name="payment" /> Credit or debit card</label>
                            <div class="card-icons">
                                <img src="./assests/images/form/visa.png" alt="VISA" />
                                <img src="./assests/images/form/mastercard.png" alt="MasterCard" />
                                <img src="./assests/images/form/Rupay.png" alt="RuPay" />
                                <img src="./assests/images/form/Maestro.png" alt="Maestro" />
                            </div>

                            <label><input type="radio" name="payment" /> Other UPI Apps</label>
                            <label><input type="radio" name="payment" /> Cash on Delivery/Pay on Delivery</label>
                            <p class="info">Cash, UPI and Cards accepted. <a href="#">Know more.</a></p>
                        </div>
                    </div>

                    <button type="button" class=" proceed button-primary" onclick="finalSubmit()">Proceed</button>
                </form>
            </div>
        </section>

    </main>
        <?php include("./components/footer.php") ?>
        <button id="floatBtn" class="floating-btn"><i class="bi bi-chevron-up"></i></button>

    <script src="./js/query.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>