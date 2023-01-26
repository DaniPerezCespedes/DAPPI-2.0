<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review requests</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<img src="Logo DAPPI.JPG" alt="logo" width="100" height="50" style="float: right" margin-right="50" />
    <h2>List of Requests</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Requester's ID</th>
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

            //Create connection
            $connection = mysqli_connect("localhost", "root", "", "dappi 2.0");

            // Check connecion
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            //read all row from database table
            
            $sql = "SELECT DISTINCT * FROM requests INNER JOIN items ON requests.item = items.name WHERE items.department_responsible = $_SESSION[department] ORDER BY requests.date_request DESC";
            $result = $connection->query($sql);

            //check if query is correct or not
            
            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            // read data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>$row[id]</td>
                <td>$row[user_id]</td>
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
                <td>
                <a class ='btn btn-primary' href='/DAPPI 2.0/edit.php?id=$row[id]'>
                <button type='submit' class = 'btn btn-primary' id='edit'>Edit</button>
                </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>