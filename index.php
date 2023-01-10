<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>List of Employees</h1>
    <a class ="btn btn-primary" href="/DAPPI 2.0/create.php" role="button">Create a new employee</a>
    <br>
    <br>
    <h2>List of Current Employees</h2>
    <table class = "table">
        <thead>
            <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            </tr>
            <t/head>

            <tbody>
                <?php
            //Define variables for connection

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "dappi";

            //Create connection

            $connection = mysqli_connect($servername,$username,$password,$database);
            
            // Check connecion
            if ($connection ->connect_error){
                die("Connection failed: ". $connection ->connect_error);
            }

            //read all row from database table

            $sql = "SELECT * FROM employees";
            $result = $connection -> query($sql);

            //check if query is correct or not

            if(!$result){
                die("Invalid query: ". $connection ->error);
            }
            
            // read data of each row
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                <td>" .$row["id"]. "</td>
                <td>" .$row["first_name"]. "</td>
                <td>" .$row["last_name"]. "</td>
                <td>" .$row["email"]. "</td>
                <td>" .$row["phone"]. "</td>
                <td>" .$row["address"]. "</td>
                </tr>";
            }
            ?>
            </tbody>
</table>
</body>
</html>