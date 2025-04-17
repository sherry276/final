<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Message</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h2>Submit a Message</h2>

<form method="POST" action="">
    <input type="text" name="message" placeholder="Enter message" required>
    <button type="submit" name="submit">Submit</button>
</form>

<br>
<a href="showAll.php">Show all records</a>

<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'finall');

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user input to prevent SQL injection
    $msg = $conn->real_escape_string($_POST['message']);

    // Insert message into the database
    if ($conn->query("INSERT INTO string_info (message) VALUES ('$msg')")) {
        echo "<p style='color: green;'>Message saved!</p>";
    } else {
        echo "<p style='color: red;'>Error saving message: " . $conn->error . "</p>";
    }

    //
}