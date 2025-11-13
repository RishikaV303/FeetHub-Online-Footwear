<?php
session_start();
include_once('../../config/config.php');


// Deactivate user
if (isset($_POST['delete_user'])) {
    $userid = $_POST['id'];
    $userstatus = 'inactive';

    $query = "UPDATE user_details SET status='$userstatus' WHERE user_id='$userid'";
    $res = mysqli_query($connect, $query);

    if ($res) {
        $_SESSION['message'] = "User inactivated successfully";
    } else {
        $_SESSION['message'] = "Failed to inactivate user";
    }
    header('Location: ../sub-admin.php');
    exit();
}

// Activate user
if (isset($_POST['add_user'])) {
    $userid = $_POST['id'];
    $userstatus = 'active';

    $query = "UPDATE user_details SET status='$userstatus' WHERE user_id='$userid'";
    $res = mysqli_query($connect, $query);

    if ($res) {
        $_SESSION['message'] = "User activated successfully";
    } else {
        $_SESSION['message'] = "Failed to activate user";
    }
    header('Location: ../sub-admin.php');
    exit();
}

// delete product

if (isset($_POST['delete_product'])) {
    $userid = $_POST['id'];
    $userstatus = 'inactive';
    echo $userid;
    $query = "update products set status='$userstatus' where product_id='$userid'";
    echo $query;
    $res = mysqli_query($connect, $query);
    if ($res) {
        $_SESSION['message'] = "deleted successfully";
        header('Location: ../sub-admin.php#products');
        exit();
    } else {
        $_SESSION['message'] = "not deleted";
        header('Location: ../sub-admin.php#products');
        exit();
    }
}
?>