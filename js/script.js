// banner carousel
$(document).ready(function () {
  let carousel = $("header .wrapper #banner .carousel");
  let currentIndex = 0;
  let carouselLength = carousel.length;
  carousel.first().addClass("active");
  function shownItem(currInd) {
    carousel.removeClass("active");
    carousel.eq(currInd).addClass("active");
  } 
  function autoplay() {
    currentIndex = (currentIndex + 1) % carouselLength;
    shownItem(currentIndex);
  }
  setInterval(autoplay, 5000);
});
// navs and tabs
$(document).ready(function () {
  $("#featured-categories .wrapper .navs a").click(function (e) {
    e.preventDefault();
    $("#featured-categories .navs a").removeClass("active");
    $(this).addClass("active");
    let targetId = $(this).attr("href");
    $("#featured-categories .cards").removeClass("active");
    $(targetId).addClass("active");
  });
});
// modal
$(document).ready(function () {
  // ---- Modal open ----
  $("#open").click(function (e) {
    e.preventDefault();

    var isLoggedIn = $(this).data("loggedin") == 1;
    if (!isLoggedIn) {
      window.location.href = $(this).data("login-url");
      return;
    }

    // Update size display before opening modal
    const checkedSize = $('input[name="size"]:checked').val();
    $("#selectedSize").text(checkedSize ? checkedSize : "—");

    // Show modal
    $("#modal").css({ display: "flex" }).fadeIn(300);
  });

  // ---- Modal close ----
  $("#confirm, #close").click(function () {
    $("#modal").fadeOut(300);
  });

  // ---- When user changes size ----
  $(document).on("change", 'input[name="size"]', function () {
    const selectedValue = $(this).val();
    $("#selectedSize").text(selectedValue);
  });
});


// floating btn
document.getElementById("floatBtn").addEventListener("click", function () {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});

// form validation
const districtData = {
  "Tamil Nadu": ["Madurai", "Chennai", "Coimbatore", "Salem", "Tirunelveli"],
  Kerala: ["Kochi", "Thiruvananthapuram", "Kozhikode", "Thrissur"],
  Karnataka: ["Bengaluru", "Mysuru", "Mangaluru", "Hubli"],
  "Andhra Pradesh": ["Vijayawada", "Visakhapatnam", "Guntur", "Nellore"],
};

function populateDistricts() {
  const stateSelect = document.getElementById("state");
  const districtSelect = document.getElementById("district");
  const selectedState = stateSelect.value;
  districtSelect.innerHTML = '<option value="">Select District</option>';
  if (districtData[selectedState]) {
    districtData[selectedState].forEach((district) => {
      const option = document.createElement("option");
      option.value = district;
      option.text = district;
      districtSelect.appendChild(option);
    });
  }
}
// merchant or user
function toggleMerchantFields() {
  let role = document.getElementById("role").value;
  document.getElementById("merchantFields").style.display =
    role === "merchant" ? "block" : "none";
}
document.addEventListener("DOMContentLoaded", function() {
    toggleMerchantFields();
});

// First Name Validation
let validateFirstName = () => {
  let inputs = document.querySelectorAll("#user_name");
  let spans = document.querySelectorAll("#name_err");
  let namePatt = /^[A-Za-z]{3,}$/;
  let valid = true;
  inputs.forEach((input, index) => {
    let val = input.value.trim();
    if (val.length === 0) {
      spans[index].innerHTML = "First name cannot be empty";
      valid = false;
    } else if (!namePatt.test(val)) {
      spans[index].innerHTML = "Only alphabets, min 3 letters";
      valid = false;
    } else {
      spans[index].innerHTML = "<i class='bi bi-check-square'></i>";
    }
  });
  return valid;
};

// Last Name Validation
let validateLastName = () => {
  let inputs = document.querySelectorAll("#last_name");
  let spans = document.querySelectorAll("#last_err");
  let namePatt = /^[A-Za-z]{1,}$/;
  let valid = true;
  inputs.forEach((input, index) => {
    let val = input.value.trim();
    if (val.length === 0) {
      spans[index].innerHTML = "Last name cannot be empty";
      valid = false;
    } else if (!namePatt.test(val)) {
      spans[index].innerHTML = "Only alphabets, at least 1 letter";
      valid = false;
    } else {
      spans[index].innerHTML = "<i class='bi bi-check-square'></i>";
    }
  });
  return valid;
};

// Address Validation
let validateAddress = () => {
  let addr = document.getElementById("address").value.trim();
  let err = document.getElementById("address_err");
  let addrPatt = /^[A-Za-z0-9\s,.-]{10,}$/;
  if (addr.length < 10) {
    err.innerHTML = "Address must be at least 10 characters";
    return false;
  } else if (!addrPatt.test(addr)) {
    err.innerHTML = "No special characters like @ # $ % allowed";
    return false;
  }
  err.innerHTML = "<i class='bi bi-check-square'></i>";
  return true;
};

// Landmark Validation
let validateLandmark = () => {
  let landmark = document.getElementById("landmark").value.trim();
  let err = document.getElementById("landmark_err");
  let landmarkPatt = /^[A-Za-z0-9\s,.-]+$/;
  if (landmark === "") {
    err.innerHTML = "Landmark cannot be empty";
    return false;
  } else if (!landmarkPatt.test(landmark)) {
    err.innerHTML = "No special characters allowed";
    return false;
  }
  err.innerHTML = "<i class='bi bi-check-square'></i>";
  return true;
};

// Mobile Number Validation
let validateMobile = () => {
  let unum = document.getElementById("userNum").value.trim();
  let phoneErr = document.getElementById("num_err");
  let numPatt = /^[6-9][0-9]{9}$/; // starts with 6,7,8,9 and total 10 digits

  if (unum.length === 0) {
    phoneErr.innerHTML = "Enter your mobile number";
    return false;
  } else if (!numPatt.test(unum)) {
    phoneErr.innerHTML =
      "Mobile number must start with 6, 7, 8, or 9 and be 10 digits";
    return false;
  }
  phoneErr.innerHTML = "<i class='bi bi-check-square'></i>";
  return true;
};

// Pincode Validation
let forcode = () => {
  let pin = document.getElementById("code").value.trim();
  let pinErr = document.getElementById("code_err");
  let pinPatt = /^[0-9]{6}$/;

  if (pin.length === 0) {
    pinErr.innerHTML = "Enter your coupon code";
    return false;
  } else if (!/^[0-9]+$/.test(pin)) {
    pinErr.innerHTML =
      "coupon code accepts numbers only, no alphabets or special characters";
    return false;
  } else if (!pinPatt.test(pin)) {
    pinErr.innerHTML = "Must be a valid 6-digit number";
    return false;
  }

  pinErr.innerHTML = "<i class='bi bi-check-square'></i>";
  return true;
};

let forState = () => {
  let state = document.getElementById("state").value;
  let err = document.getElementById("state_err");
  if (state === "") {
    err.innerHTML = "Select your state";
    return false;
  }
  err.innerHTML = "<i class='bi bi-check-square'></i>";
  return true;
};

let forPayment = () => {
  let selected = document.querySelector('input[name="payment"]:checked');
  if (!selected) {
    alert("Please select a payment method");
    return false;
  }
  return true;
};

let finalSubmit = () => {
  if (
    !validateFirstName() ||
    !validateLastName() ||
    !validateAddress() ||
    !validateLandmark() ||
    !validateMobile() ||
    !forState() ||
    !forState() ||
    !forPayment()
  ) {
    alert("Please Fill the form");
    return false;
  }

  alert("Form submitted successfully!");
  document.querySelector("form").submit();
  window.location.href = "./login.php";
};

// let iconOne=document.querySelector("#details .wrapper .right .product-right .header .wishlist");
// iconOne.addEventListener('click',function(){
//     iconOne.style.color="red";
// });
// floating btn
//     document.getElementById("floatBtn").addEventListener("click", function() {
//   window.scrollTo({
//     top: 0,
//     behavior: "smooth"
//   });
// });
// shoe
$(document).ready(function () {
  // Product variations with images
  const productData = {
    green: {
      big: "./assests/images/product-two/colorGreen.png",
      thumbs: [
        "./assests/images/product-two/colorGreen.png",
        "./assests/images/product-two/viewOne.png",
        "./assests/images/product-two/viewTwo.png",
        "./assests/images/product-two/viewThree.png",
        "./assests/images/product-two/viewFour.png",
      ],
    },
    yellow: {
      big: "./assests/images/product-two/colorYellow.png",
      thumbs: [
        "./assests/images/product-two/colorYellow.png",
        "./assests/images/product-two/YellowOne.png",
        "./assests/images/product-two/YellowTwo.png",
        "./assests/images/product-two/YellowThree.png",
        "./assests/images/product-two/YellowFour.png",
      ],
    },
  };

  const $bigImage = $(".big-image img");
  const $thumbnailGroup = $(".groups");
  const $colorOptions = $(".color-options img");

  // Function to update product images
  function updateProduct(color) {
    const data = productData[color];

    // Update main image
    $bigImage.attr("src", data.big);

    // Clear old thumbnails
    $thumbnailGroup.empty();

    // Add new thumbnails
    $.each(data.thumbs, function (index, src) {
      const $thumb = $("<img>").attr("src", src).addClass("images");
      if (index === 0) $bigImage.attr("src", src);

      // Click event for thumbnail
      $thumb.on("click", function () {
        $bigImage.attr("src", src);
      });

      $thumbnailGroup.append($thumb);
    });
  }

  // Handle color option click
  $colorOptions.on("click", function () {
    $colorOptions.removeClass("selected");
    $(this).addClass("selected");

    if ($(this).attr("alt").includes("Green")) {
      updateProduct("green");
    } else {
      updateProduct("yellow");
    }
  });

  // Load default (green)
  updateProduct("green");
});
