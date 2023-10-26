<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4800d7071c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="Contact.css">
    <title>Contacts</title>
</head>
<body>
    <nav>
        <ul>
            <li> <i class="fa-solid fa-house"></i>Home</li>
            <li><i class="fa-solid fa-address-book"></i><a href="Contact.html">Contacts</a></li>
        </ul>
    </nav>
    <div class="header">
        <h3>Manage Contacts </h3>
        <button onclick="openNewPage()" type="submit"><i class="fa-solid fa-plus"></i> Add Contact</button>
    </div>
    <h3>List of Contacts</h3>
    <table class="tab">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Num</th>
                <th>relationship</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $servername = "localhost";
                $username = "root";
                $password ="";
                $database ="ContactManagement";

                $connection = new mysqli($servername, $username, $password, $database);

                if($connection->connect_error){
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM Contact";
                $result = $connection->query($sql);

                if(!$result){
                    die("Invalid query: " . $connection->error);
                }

                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                        <td>{$row['Sno']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phNum']}</td>
                        <td>{$row['relationship']}</td>
                        <td>
                            <a href='Edit.php?id={$row['Sno']}'><i class='fa-solid fa-file-pen'></i></a>
                            <a href='Delete.php?id={$row['Sno']}'><i class='fa-solid fa-trash'></i></a>
                        </td>
                    </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
    <script>
function openNewPage() {
    window.open('AddContact.php', '_blank');
}
</script>
</body>
</html>
