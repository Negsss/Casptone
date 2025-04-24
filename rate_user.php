<?php
// rate_user.php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reviewer_id = $_SESSION['user_id'];
    $seller_id = $_POST['seller_id'];
    $rating = $_POST['rating'];
    $comment = $conn->real_escape_string($_POST['comment']);

    $conn->query("INSERT INTO reviews (reviewer_id, seller_id, rating, comment) VALUES ('$reviewer_id', '$seller_id', '$rating', '$comment')");

    // Update trust score
    $avgResult = $conn->query("SELECT AVG(rating) AS avg_score FROM reviews WHERE seller_id = '$seller_id'");
    $avg = $avgResult->fetch_assoc();
    $conn->query("UPDATE users SET trust_score = '{$avg['avg_score']}' WHERE id = '$seller_id'");

    echo "<p>Review submitted!</p>";
}

$users = $conn->query("SELECT id, username FROM users WHERE user_type = 'seller'");
?>

<h2>Rate a Seller</h2>
<form method="POST">
    <label for="seller_id">Choose Seller:</label>
    <select name="seller_id" required>
        <?php while ($u = $users->fetch_assoc()): ?>
            <option value="<?php echo $u['id']; ?>"><?php echo htmlspecialchars($u['username']); ?></option>
        <?php endwhile; ?>
    </select><br>

    <label>Rating:</label>
    <select name="rating" required>
        <option value="1">1 Star</option>
        <option value="2">2 Stars</option>
        <option value="3">3 Stars</option>
        <option value="4">4 Stars</option>
        <option value="5">5 Stars</option>
    </select><br>

    <textarea name="comment" placeholder="Write a review..." required></textarea><br>
    <button type="submit">Submit Rating</button>
</form>
