<?php
// post_item.php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'seller') {
    echo "Access denied.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);

    $user_id = $_SESSION['user_id'];

    $conn->query("INSERT INTO items (user_id, title, description, price) VALUES ('$user_id', '$title', '$description', '$price')");
    echo "<p>Item posted successfully!</p>";
}
?>

<h2>Post an Item for Sale</h2>
<form method="POST">
    <input type="text" name="title" placeholder="Item Title" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="number" name="price" step="0.01" placeholder="Price" required><br>
    <button type="submit">Post Item</button>
</form>
