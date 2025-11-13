<?php
session_start();
include_once('../../config/config.php');

// delete
if (isset($_POST['delete_product'])) {
    $userid = $_POST['id'];
    $userstatus = 'inactive';
    echo $userid;
    $query = "update products set status='$userstatus' where product_id='$userid'";
    echo $query;
    $res = mysqli_query($connect, $query);
    if ($res) {
        $_SESSION['message'] = "deleted successfully";
        header('Location: ../merchant-dashboard.php');
        exit();
    } else {
        $_SESSION['message'] = "not deleted";
        header('Location: ../merchant-dashboard.php');
        exit();
    }
}
?>  