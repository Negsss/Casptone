<?php
// item_list.php
include 'config/db.php';

$result = $conn->query("SELECT items.*, users.username FROM items JOIN users ON items.user_id = users.id ORDER BY created_at DESC");
?>

<h2>Available Items</h2>
<?php while ($row = $result->fetch_assoc()): ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
        <h3><?php echo htmlspecialchars($row['title']); ?> - ₱<?php echo $row['price']; ?></h3>
        <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
        <small>Posted by: <?php echo htmlspecialchars($row['username']); ?> on <?php echo $row['created_at']; ?></small>
    </div>
<?php endwhile; ?>
