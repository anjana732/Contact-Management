<?php
    $server ="localhost";
    $username ="root";
    $password ="";
    $database = "ContactManagement";

    $conn = new mysqli($server, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $Sno="";
    $name = "";
    $email = "";
    $phNum = "";
    $relationship = "";

    $errorMessage = "";
    $successMessage ="";

  /*  if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(!isset($_GET["Sno"])){
            header("location: index.html");
            exit;
        }
    
    $Sno = $_GET["Sno"];

    $sql="SELECT * FROM Contact where Sno=$Sno";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: index.html");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phNum = $row["phNum"];
    $relationship = $row["relationship"];
    
    }
   else {
    $Sno = $row["Sno"];
    $name = $row["name"];
    $email = $row["email"];
    $phNum = $row["phNum"];
    $relationship = $row["relationship"];
   
    $sql = "UPDATE Contact SET name='$name', email= '$email', phNum=$phNum, relationship='$relationship' WHERE Sno=$Sno";

    $result = $connection->query($sql);

    if(!$result){
        $errorMessage = "Invalid query" .$connection->error;
        break;
    }

    $successMessage = "Contact Added Successfully";
    header("location: index.html");
    exit;

}*/
if($_SERVER["REQUEST_METHOD"] == "GET") {
    //... [Your GET request handling remains largely unchanged]
    
    $sql = "SELECT * FROM Contact WHERE Sno=$Sno";
    $result = $conn->query($sql);  // changed $connection to $conn
    //... rest of the GET handling code remains unchanged
}
else {
    // Get data from POST
    $Sno = $_POST["Sno"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phNum = $_POST["phNum"];
    $relationship = $_POST["relationship"];

    // Update using prepared statement
    $stmt = $conn->prepare("UPDATE Contact SET name=?, email=?, phNum=?, relationship=? WHERE Sno=?");
    $stmt->bind_param('ssiss', $name, $email, $phNum, $relationship, $Sno);


    if($stmt->execute()) {
        $successMessage = "Contact Updated Successfully";
        header("location: Edit.php?Sno=".$Sno);
        exit;
    } else {
        $errorMessage = "Invalid query: " . $stmt->error;
    }
    $stmt->close();
}
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
        <form action="Edit.php" method="post">
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