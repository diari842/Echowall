<?php include 'header.php'; ?>
<div class="container">
  <h2>Welcome to EchoWall</h2>
  <p>Choose a category to view or post anonymous thoughts.</p>
  <ul>
    <li><a href="wall.php?category=School">School Stress</a></li>
    <li><a href="wall.php?category=Family">Family Pressure</a></li>
    <li><a href="wall.php?category=Loneliness">Loneliness</a></li>
    <li><a href="wall.php?category=Anxiety">Anxiety</a></li>
    <li><a href="wall.php?category=Hope">Hope</a></li>
  </ul>
</div>

<div class="container">
  <h3>Recent Posts</h3>
  <?php
  $conn = new mysqli('localhost', 'root', '', 'echowall');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT message, category, date_posted FROM posts ORDER BY date_posted DESC LIMIT 10";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo '<div class="post">';
      echo '<div class="category">' . htmlspecialchars($row['category']) . '</div>';
      echo '<p>' . nl2br(htmlspecialchars($row['message'])) . '</p>';
      echo '<small>' . $row['date_posted'] . '</small>';
      echo '</div>';
    }
  } else {
    echo "<p>No posts yet.</p>";
  }
  $conn->close();
  ?>
</div>

<div class="container">
  <h3>Positive Thought of the Day</h3>
  <?php
  $messages = [
    "You matter more than you know.",
    "Every storm passes.",
    "You are not alone.",
    "There’s always hope.",
    "Keep going. You’re doing better than you think."
  ];
  shuffle($messages);
  echo "<p>" . $messages[0] . "</p>";
  ?>
</div>
<?php include 'footer.php'; ?>
