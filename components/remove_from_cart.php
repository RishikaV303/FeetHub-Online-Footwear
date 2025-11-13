<?php
include_once('../config/config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
if ($cart_id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid cart id']);
    exit;
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
if (!$user_name) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

// Verify the cart item belongs to this user
$stmt = $connect->prepare('SELECT cart_id FROM cart WHERE cart_id = ? AND user_name = ? LIMIT 1');
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $connect->error]);
    exit;
}
$stmt->bind_param('is', $cart_id, $user_name);
$stmt->execute();
$res = $stmt->get_result();
if (!$res || $res->num_rows === 0) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Cart item not found']);
    exit;
}

// Delete the cart item
$del = $connect->prepare('DELETE FROM cart WHERE cart_id = ? AND user_name = ?');
if (!$del) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $connect->error]);
    exit;
}
$del->bind_param('is', $cart_id, $user_name);
if ($del->execute()) {
    // Recalculate remaining count and total (server-side)
    $totStmt = $connect->prepare('SELECT COUNT(*) AS cnt, IFNULL(SUM((p.price - (p.price * p.discount / 100))),0) AS total FROM cart c JOIN products p ON c.product_id = p.product_id WHERE c.user_name = ?');
    if ($totStmt) {
        $totStmt->bind_param('s', $user_name);
        $totStmt->execute();
        $totRow = $totStmt->get_result()->fetch_assoc();
        $remaining = intval($totRow['cnt']);
        $total = floatval($totRow['total']);
        $delivery = ($remaining > 0) ? 50 : 0;
        $total_with_delivery = $total + $delivery;
    } else {
        $remaining = 0;
        $total_with_delivery = 0;
    }

    echo json_encode(['success' => true, 'remaining' => $remaining, 'total' => $total_with_delivery]);
    exit;
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to delete cart item']);
    exit;
}
