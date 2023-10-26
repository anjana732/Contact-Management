<?php
    $server ="localhost";
    $username ="root";
    $password ="";
    $database = "ContactManagement";

    // 1. Connect to the database
    $conn = new mysqli($server, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 2. Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 3. Get the form data and sanitize it
        $name = $conn->real_escape_string($_POST["name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $phNum = $conn->real_escape_string($_POST["phNum"]);
        $relationship = $conn->real_escape_string($_POST["relationship"]);

        // 4. Insert the data into the contact table
        $sql = "INSERT INTO Contact (name, phNum, email, relationship) VALUES ('$name', $phNum, '$email', '$relationship')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>

<!-- Your HTML content goes here -->

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
        <form action="AddContact.php" method="post">
            <label>Name</label>
            <input type="text" name="name" id="name">
            <label>Email</label>
            <input type="email" name="email" id="email">
            <label>Mobile No</label>
            <input type="tel" name="phNum" id="phNum">
            <label>Relationship</label>
            <input type="text" name="relationship" id="reletionship">
            <button type="submit">Submit</button>
            <a href="Contact.php">Cancel</a>
        </form>
    </div>
</body>
</html>