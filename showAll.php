<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Records</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h2>All Records</h2>

<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'finall');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion if form is submitted
if (isset($_POST['delete'])) {
    $id = intval($_POST['delete_id']);
    if ($conn->query("DELETE FROM string_info WHERE string_id = $id")) {
        echo "<p style='color: green;'>Record deleted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error deleting record: " . $conn->error . "</p>";
    }
}

// Fetch and display all records
$result = $conn->query("SELECT * FROM string_info");

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>ID:</strong> " . $row['string_id'] . " - <strong>Message:</strong> " . htmlspecialchars($row['message']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No records found.</p>";
}
?>

<h3>Delete Record</h3>
<form method="POST" action="">
    <input type="number" name="delete_id" placeholder="Enter string_id to delete" required>
    <button type="submit" name="delete">Delete</button>
</form>

</body>
</html>
