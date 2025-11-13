<?php
session_start();
include_once('../../config/config.php');


// Initialize variables
$nameErr = $passwordErr = $mailErr = $mobileErr = "";
$name = $managerId = $password = $mobile_number = $mail = $status = "";
$successMsg = "";

// Generate next Manager ID pattern (mg-1, mg-2, ...)
$query = "SELECT MAX(id) AS max_id FROM sub_admins";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$next_id = $row['max_id'] + 1;
$auto_manager_id = "mg-" . $next_id;

// Form validation
if (isset($_POST['create'])) {
    $name = trim($_POST['name']);
    $managerId = trim($_POST['manager-id']);
    $password = trim($_POST['password']);
    $mobile_number = trim($_POST['mobile_number']);
    $mail = trim($_POST['email']);

    // patterns
    $namePatt = '/^[A-Za-z]{3,}$/';
    $numPatt = '/^[6-9][0-9]{9}$/';
    $emailpatt = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $passPatt = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    // Name validation
    if (empty($name)) {
        $nameErr = "Please enter the User Name";
    } elseif (strlen($name) < 3) {
        $nameErr = "First name must be at least 3 characters long";
    } elseif (strlen($name) > 30) {
        $nameErr = "First name Less than 30 character only allowed";
    } else {
        if (!preg_match($namePatt, $name)) {
            $nameErr = "Please enter a valid User Name";
        }
    }
    // password validation
    if (empty($password)) {
        $passwordErr = "Please enter the Password";
    } elseif (strlen($password) < 8) {
        $passwordErr = "Password must be at least 8 characters long";
    } elseif (strlen($password) > 20) {
        $passwordErr = "Password Less than 20 character only allowed";
    } else {
        if (!preg_match($passPatt, $password)) {
            $passwordErr = "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character";
        }
    }
    // email validation
    if (empty($mail)) {
        $mailErr = "Please enter the Email id";
    } elseif (strlen($mail) > 50) {
        $mailErr = "Email id Less than 50 character only allowed";
    } else {
        if (!preg_match($emailpatt, $mail)) {
            $mailErr = "Please enter a valid Email id";
        }
    }
    // mobile number validation
    if (empty($mobile_number)) {
        $mobileErr = "Please enter the Mobile number";
    } else {
        if (!preg_match($numPatt, $mobile_number)) {
            $mobileErr = "Please enter a valid Mobile number";
        }
    }

    $checkQuery = "SELECT * FROM sub_admins WHERE name='$name' OR phone='$mobile_number' OR email_id='$mail'";
    $checkResult = mysqli_query($connect, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // If record exists, find which one matches
        $existing = mysqli_fetch_assoc($checkResult);
        if ($existing['name'] === $name) {
            $nameErr = "This name is already created. Please use another name.";
        }
        if ($existing['phone'] === $mobile_number) {
            $mobileErr = "This phone number is already created. Please use another number.";
        }
        if ($existing['email_id'] === $mail) {
            $mailErr = "This mail id is already created. Please use another mail.";
        }
    } else {
        if (empty($nameErr) && empty($passwordErr) && empty($mobileErr)) {
            // query execution
            $query = "INSERT INTO sub_admins(name, manager_id, password, email_id, phone) values('$name','$managerId', '$password', '$mail', '$mobile_number')";
            // echo $query;
            $result = mysqli_query($connect, $query);
            if ($result) {
                $_SESSION['message'] = "Inserted successfully";
                header('Location: ../admin-dashboard.php#sub-admins');
                exit();
            } else {
                $_SESSION['message'] = "not inserted";
                header('Location: ../admin-dashboard.php#sub-admins');
                exit();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/register.css">
    <link rel="stylesheet" href="../../css/admin-dashboard.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/view.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Create Manager</title>
</head>
<style>
    .error {
        color: red;
        font-size: 14px;
        margin-top: 3px;
    }

    .success {
        color: green;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
</style>

<body>


    <header>
        <div class="wrapper">
            <nav class="nav">
                <div class="wrap">
                    <div class="back">
                        <a href="../admin-dashboard.php#users"><i class="bi bi-arrow-left"></i>
                            <p>Back to Dashboard</p>
                        </a>
                    </div>
                    <div class="logo">
                        <a href="../../index.php"><img src="../../assests/images/home/logo.svg" alt="logo"></a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="content">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Create New Manager</div>
            </div>
            <div class="card-body">
                <?php if ($successMsg): ?>
                    <p class="success"><?= $successMsg ?></p>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="details-grid">

                        <div class="label">Name</div>
                        <div class="value">
                            <input type="text" name="name" class="input-field" value="<?= htmlspecialchars($name) ?>">
                            <div class="error"><?= $nameErr ?></div>
                        </div>

                        <div class="label">Manager ID</div>
                        <div class="value">
                            <input type="text" name="manager-id" class="input-field"
                                value="<?= htmlspecialchars($auto_manager_id) ?>" readonly>
                        </div>

                        <div class="label">Password</div>
                        <div class="value" style="position: relative;">
                            <input type="password" id="password" name="password" class="input-field"
                                value="<?= htmlspecialchars($password) ?>">
                            <i class="bi bi-eye-slash" id="togglePassword"
                                style="position:absolute; right:10px; top:7px; cursor:pointer; color:#555;"></i>
                            <div class="error"><?= $passwordErr ?></div>
                        </div>

                        <div class="label">Mail</div>
                        <div class="value">
                            <input type="mail" name="email" class="input-field" value="<?= htmlspecialchars($mail) ?>">
                            <div class="error"><?= $mailErr ?></div>
                        </div>
                        <div class="label">Mobile Number</div>
                        <div class="value">
                            <input type="text" name="mobile_number" class="input-field"
                                value="<?= htmlspecialchars($mobile_number) ?>">
                            <div class="error"><?= $mobileErr ?></div>
                        </div>

                        <div class="label"></div>
                        <button type="submit" class="create-btn btn-primary" name="create">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include("../../components/footer-two.php") ?>
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

</body>

</html>