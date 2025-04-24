<?php
// dashboard.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'config/db.php';

$username = $_SESSION['username'];
$user_type = $_SESSION['user_type'];
?>

<h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
<p>You are logged in as a <strong><?php echo $user_type; ?></strong>.</p>

<nav>
    <a href="post_item.php">Post an Item</a> |
    <a href="item_list.php">View Items</a> |
    <a href="rate_user.php">Rate Seller</a> |
    <a href="logout.php">Logout</a>
</nav>
