<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corememories"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get island ID from URL
$islandID = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch island data
$islandQuery = "SELECT * FROM islandsofpersonality WHERE islandOfPersonalityID = ?";
$islandStmt = $conn->prepare($islandQuery);
$islandStmt->bind_param("i", $islandID);
$islandStmt->execute();
$islandResult = $islandStmt->get_result();
$island = $islandResult->fetch_assoc();

// Fetch content data
$contentQuery = "SELECT * FROM islandContent WHERE islandOfPersonalityID = ?";
$contentStmt = $conn->prepare($contentQuery);
$contentStmt->bind_param("i", $islandID);
$contentStmt->execute();
$contentResult = $contentStmt->get_result();

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $island['name']; ?> - Island of Personality</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
body {
  font-family: "Montserrat", sans-serif;
  background-color: #222;
  color: white;
  margin: 0;
  padding: 0;
}
header {
  text-align: center;
  padding: 50px 0;
}
header h1 {
  font-size: 50px;
}
.content {
  padding: 20px;
}
.content-item {
  margin: 20px 0;
  background: #333;
  padding: 15px;
  border-radius: 5px;
}
</style>
</head>
<body>

<!-- Header -->
<header>
  <h1><?php echo $island['name']; ?></h1>
  <p><?php echo $island['shortDescription']; ?></p>
</header>

<!-- Content -->
<div class="content">
  <?php
  if ($contentResult->num_rows > 0) {
      while ($row = $contentResult->fetch_assoc()) {
          echo '<div class="content-item">';
          echo '<p>' . $row['content'] . '</p>';
          echo '</div>';
      }
  } else {
      echo "<p>No content available for this island.</p>";
  }
  ?>
</div>

</body>
</html>

<?php
// Close connections
$islandStmt->close();
$contentStmt->close();
$conn->close();
?>
