<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "ContactManagement";
$con = mysqli_connect($server, $username, $password, $db_name);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phNum= $_POST["phNum"];
    $relationship = $_POST["relationship"];

    // $stmt = $con->prepare("UPDATE Contact SET name=?, email=?, phNum=?, relationship=? WHERE Sno=?");
    // $stmt->bind_param("sissi", $name, $phNum, $email, $relationship, $id); 

    $stmt = "UPDATE `Contact` SET `name`= `$name`,`email`='$email',`phNum`='$phNum',`relationship`='$relationship' WHERE Sno='$id';";

    if ($stmt->execute()) {
        echo "Record Updated";
        header('location:Contact.php');
        exit();
    } else {
        echo "Failed to update";
    }
    $stmt->close();
} else {
    
    $stmt = $con->prepare("SELECT * FROM Contact WHERE Sno=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
       
    } else {
        echo "Error fetching contact details";
    }
    $stmt->close();
}

$con->close();
?>


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