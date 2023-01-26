<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAPPI-My Requests</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <img src="Logo DAPPI.JPG" alt="logo" width="100" height="50" style="float: right" margin-right="50" />
    <h2>My Requests</h2>
    <a class="btn btn-primary" href="/DAPPI 2.0/create_req.php">
        <button type="submit" class="btn btn-primary" id="log">New Request</button>
    </a>
    <br>
    <br>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date of request</th>
                <th>Item</th>
                <th>Room</th>
                <th>Problem category</th>
                <th>Description</th>
                <th>Status</th>
                <th>Response message</th>
                <th>Solution</th>
                <th>Expected SLA (Days)</th>
                <th>Date of response</th>
            </tr>
        </thead>

        <tbody>
            <?php
            session_start();
            //Define variables for connection
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "dappi 2.0";

            //Create connection
            
            $connection = mysqli_connect($servername, $username, $password, $database);

            // Check connecion
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            //read all row from database table
            //NEED TO ADD A COLUMN WITH USER
            
            $sql = "SELECT * FROM requests WHERE requests.user_id = $_SESSION[id]";
            $result = $connection->query($sql);

            //check if query is correct or not
            
            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            // read data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>$row[id]</td>
                <td>$row[date_request]</td>
                <td>$row[item]</td>
                <td>$row[room]</td>
                <td>$row[problem_category]</td>
                <td>$row[description]</td>
                <td>$row[status]</td>
                <td>$row[response_message]</td>
                <td>$row[solution]</td>
                <td>$row[expected_SLA_days]</td>
                <td>$row[date_response]</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>