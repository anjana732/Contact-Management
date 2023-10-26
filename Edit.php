<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "ContactManagement";
$con = mysqli_connect($server, $username, $password, $db_name);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Assuming you want to edit the contact with a specific ID
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather data from POST request
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phNum= $_POST["phNum"];
    $relationship = $_POST["relationship"];
    //... gather other fields similarly...

    // Use prepared statements for updating to avoid SQL injection
    $stmt = $con->prepare("UPDATE Contact SET name=?, email=?, phNum=?, relationship=? WHERE Sno=?");
    $stmt->bind_param("siss", $name, $phNum, $email, $relationship, $id);  // 'ssi' => string, string, integer

    if ($stmt->execute()) {
        echo "Record Updated";
        header('location:Contact.php');
        exit();
    } else {
        echo "Failed to update";
    }
    $stmt->close();
} else {
    // For GET request, retrieve current details for the contact
    $stmt = $con->prepare("SELECT * FROM Contact WHERE Sno=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        // Now, you can use $row['name'], $row['email'], etc. to display current details in your HTML form
    } else {
        echo "Error fetching contact details";
    }
    $stmt->close();
}

$con->close();
?>

// Your HTML form for editing goes here. Use PHP to populate current details.

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact</title>
</head>
<body>
    <div class="container">
        <h2>Add Contact</h2>
        <form method="post">
            <input type="hidden" value="<?php echo $Sno; ?>">
            <label>Name</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>">
            <label>Email</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>">
            <label>Mobile No</label>
            <input type="tel" name="phNum" id="phNum" value="<?php echo $phNum; ?>">
            <label>Relationship</label>
            <input type="text" name="relationship" id="reletionship" value="<?php echo $relationship; ?>">
            <button type="submit">Submit</button>
            <a href="Contact.php">Cancel</a>
        </form>
    </div>
</body>
</html>