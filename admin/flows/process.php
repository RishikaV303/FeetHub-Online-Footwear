<?php
session_start();
include_once('../../config/config.php');



// update sub-admin
// if (isset($_POST['update'])) {
//     $userid = $_POST['id'];
//     $managerName = $_POST['name'];
//     $managerId = $_POST['manager-id'];
//     $password = $_POST['password'];
//     $managerPhone = $_POST['mobile_number'];
//     $managerMail = $_POST['mail'];
//     $userstatus = $_POST['status'];
//     $query = "update sub_admins set name='$managerName', manager_id='$managerId', password='$password', phone='$managerPhone', email_id='$managerMail', status='$userstatus' where id='$userid'";
//     echo $query;
//     $res = mysqli_query($connect, $query);
//     if ($res) {
//         $_SESSION['message'] = "update successfully";
//         header('Location: ../admin-dashboard.php#sub-admins');
//         exit();
//     } else {
//         $_SESSION['message'] = "not update";
//         header('Location: ../admin-dashboard.php#sub-admins');
//         exit();
//     }
// }

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
    header('Location: ../admin-dashboard.php#users');
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
    header('Location: ../admin-dashboard.php#users');
    exit();

}

// Activate subadmin
if (isset($_POST['add_subadmin'])) {
    $userid = $_POST['id'];
    $userstatus = 'active';
    $query = "UPDATE sub_admins SET status='$userstatus' WHERE id='$userid'";
    $res = mysqli_query($connect, $query);

    if ($res) {
        $_SESSION['message'] = "deleted successfully";
    } else {
        $_SESSION['message'] = "Failed to activate user";
    }
    header('Location: ../admin-dashboard.php#sub-admins');
    exit();

}

// Deactivate subadmin
if (isset($_POST['delete_subadmin'])) {
    $userid = $_POST['id'];
    $userstatus = 'inactive';
    $query = "UPDATE sub_admins SET status='$userstatus' WHERE id='$userid'";
    $res = mysqli_query($connect, $query);

    if ($res) {
        $_SESSION['message'] = "subadmin inactivated successfully";
    } else {
        $_SESSION['message'] = "Failed to inactivate user";
    }
    header('Location: ../admin-dashboard.php#sub-admins');
    exit();
}




// delete sub-admin

if (isset($_POST['delete_subadmin'])) {
    $userid = $_POST['id'];
    $userstatus = 'inactive';
    echo $userid;
    $query = "update sub_admins set status='$userstatus' where id='$userid'";
    echo $query;
    $res = mysqli_query($connect, $query);
    if ($res) {
        $_SESSION['message'] = "deleted successfully";
        header('Location: ../admin-dashboard.php#sub-admins');
        exit();
    } else {
        $_SESSION['message'] = "not deleted";
        header('Location:../admin-dashboard.php#sub-admins');
        exit();
    }
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
        header('Location: ../admin-dashboard.php#products');
        exit();
    } else {
        $_SESSION['message'] = "not deleted";
        header('Location:../admin-dashboard.php#products');
        exit();
    }
}
?>