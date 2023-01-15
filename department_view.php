<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmaceutical Department</title>
</head>

<body>
    <h1>Requests</h1>
    <a class="btn btn-primary" href="/DAPPI 2.0/create.php" role="button">Edit request</a>
    <br>
    <br>
    <h2>List of Requests</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date of request</th>
                <th>Item</th>
                <th>Room</th>
                <th>Problem category</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Response message</th>
                <th>Solution category</th>
                <th>Expected SLA (Days)</th>
                <th>Date of response</th>
                <th>Date of fulfillment</th>
                <th>Actual SLA (Days)</th>
            </tr>
            <t /head>

        <tbody>
            <?php
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
            
            $sql = "SELECT * FROM requests, items WHERE items.department_responsible = 2";
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
                <td>$row[image]</td>
                <td>$row[status]</td>
                <td>$row[response_message]</td>
                <td>$row[solution_category]</td>
                <td>$row[expected_SLA_days]</td>
                <td>$row[date_response]</td>
                <td>$row[date_fulfillment]</td>
                <td>$row[actual_SLA_days]</td>
                <td>
                <a class ='btn btn-primary btn-sm' href='/DAPPI 2.0/edit.php?id=$row[id]'>Edit</a>
                </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>