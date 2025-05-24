<?php include 'header.php'; ?>

<div class="container">
  <?php
  $category = isset($_GET['category']) ? $_GET['category'] : 'all';
  echo "<h2>Posts in category: " . htmlspecialchars($category) . "</h2>";

  $conn = new mysqli('localhost', 'root', '', 'echowall');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($category === 'all') {
    $sql = "SELECT category, message, date_posted FROM posts ORDER BY date_posted DESC";
    $stmt = $conn->prepare($sql);
  } else {
    $sql = "SELECT category, message, date_posted FROM posts WHERE category = ? ORDER BY date_posted DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
  }

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="post">';
      echo '<div class="category">' . htmlspecialchars($row['category']) . '</div>';
      echo '<p>' . nl2br(htmlspecialchars($row['message'])) . '</p>';
      echo '<small>' . $row['date_posted'] . '</small>';
      echo '</div>';
    }
  } else {
    echo "<p>No posts found in this category.</p>";
  }

  $stmt->close();
  $conn->close();
  ?>
</div>

<?php include 'footer.php'; ?>
