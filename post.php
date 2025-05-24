<?php include 'header.php'; ?>

<div class="container">
  <h2>Post Your Thought</h2>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = trim($_POST['category']);
    $message = trim($_POST['message']);

    if ($category && $message) {
      $conn = new mysqli('localhost', 'root', '', 'echowall');
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $stmt = $conn->prepare("INSERT INTO posts (category, message, date_posted) VALUES (?, ?, NOW())");
      $stmt->bind_param("ss", $category, $message);
      $stmt->execute();
      $stmt->close();
      $conn->close();

      echo "<p>Your post has been added anonymously.</p>";
    } else {
      echo "<p>Please fill in all fields.</p>";
    }
  }
  ?>

  <form method="POST" action="post.php">
    <label for="category">Category:</label>
    <select id="category" name="category" required>
      <option value="">--Select--</option>
      <option value="School">School Stress</option>
      <option value="Family">Family Pressure</option>
      <option value="Loneliness">Loneliness</option>
      <option value="Anxiety">Anxiety</option>
      <option value="Hope">Hope</option>
    </select>

    <label for="message">Your Thought:</label>
    <textarea id="message" name="message" rows="6" required></textarea>

    <button type="submit">Post Anonymously</button>
  </form>
</div>

<?php include 'footer.php'; ?>
