<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "ContactManagement";

// Connect to the database
$con = mysqli_connect($server, $username, $password, $db_name);

// Check the connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$id = $_GET['id'];

// Use prepared statements to avoid SQL injection
$stmt = $con->prepare("DELETE FROM Contact WHERE Sno = ?");
$stmt->bind_param("i", $id);  // 'i' specifies the variable type => 'integer'

if ($stmt->execute()) {
    echo "Record Deleted";
    header('location:Contact.php');
    exit();
} else {
    echo "Failed to delete";
}

$stmt->close();
$con->close();
?>