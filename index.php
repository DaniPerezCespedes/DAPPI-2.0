<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
    <link rel="stylesheet" type="text/css" href="style.css"/> 
</head>
<body>
<img src="Logo DAPPI.JPG" 
        alt="logo" 
        width="100" 
        height="50"
        style="float: right"
        margin-right="50"
        />    
<h1>Employees</h1>
    <a class ="btn btn-primary" href="/DAPPI 2.0/create.php">
    <button type="submit" class = #btn btn-primary" id="log">Create new employee</button>
    </a>
    <br>
    <h2>List of Current Employees</h2>
    <div id="main-container">
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
                <td>$row[id]</td>
                <td>$row[first_name]</td>
                <td>$row[last_name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>
                <a class ='btn btn-primary' href='/DAPPI 2.0/edit.php?id=$row[id]'>
                <button type='submit' class = 'btn btn-primary' id='edit'>Edit</button>
                </a>
                <!-- <a class ='btn btn-primary btn-sm' href='/DAPPI 2.0/edit.php?id=$row[id]'>Edit</a> -->
                </td>
                </tr>";
            }
            ?>
            </tbody>
        </table>
        </div>
</body>
</html>