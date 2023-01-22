<?php

//Create connection
$connection = mysqli_connect("localhost", "root", "", "dappi 2.0");

//define variables
$item = "";
$room = "";
$problem_category = "";
$description = "";
$image = "";

//obtain the information filled by user in webpage

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $_POST["item"];
    $room = $_POST["room"];
    $problem_category = $_POST["problem_category"];
    $description = $_POST["description"];
    $image = $_POST["image"];

    do {
        if (empty($item) || empty($room) || empty($problem_category) || empty($description) || empty($image)) {
            $errorMessage = "Please fill all fields required";
            break;
        }
        //add a new request from the form, to the table "requests"

        $sql = "INSERT INTO requests (item, room, problem_category, description, image)
                VALUES ('$item','$room','$problem_category','$description', '$image')";
        $result = $connection->query($sql);

        //check if query is correct or not

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break; //break the while loop
        }


        $item = "";
        $room = "";
        $problem_category = "";
        $description = "";
        $image = "";

        $successMessage = "Request submitted successfully!";
        //redirect user to main page
        // header("location:/DAPPI 2.0/index.php");
        //exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new request</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <h2>Issue form</h2>
    <?php
    //check if error message is not empy. If not empty, show error message
    if (!empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
        </div>
        ";
    }
    ?>
    <br>
    <form method="post">
        <!-add rows of information->
            <label>Item</label>
            <input type="text" class="form-control" name="item" value="<?php echo $item; ?>">
            <br>
            <label>Room</label>
            <input type="text" class="form-control" name="room" value="<?php echo $room; ?>">
            <br>
            <label>Problem category</label>
            <input type="text" class="form-control" name="problem_category" value="<?php echo $problem_category; ?>">
            <br>
            <label>Description</label>
            <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
            <br>
            <label>Image</label>
            <input type="text" class="form-control" name="image" value="<?php echo $image; ?>">
            <br>
            <br>

            <!- check if success message is not empty, if is not, display success message->
                <?php
                if (!empty($successMessage)) {
                    echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <a href='index.php'> Go to main page </a>
        </div>
        ";
                }
                ?>
                <br>
                <br>
                <button type="submit" class=#btn btn-primary" id="log">Submit</button>
                <br>
                <a class="btn btn-outline-primary" href="/DAPPI 2.0/index.php" role="button">Cancel</a>
    </form>
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
            session_start();

            //Create connection
            $connection = mysqli_connect("localhost", "root", "", "dappi 2.0");

            // Check connecion
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            //read all row from database table
            
            $sql = "SELECT DISTINCT * FROM requests INNER JOIN items ON requests.item = items.name WHERE requests.user_id = $_SESSION[id] ";
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
            <td>$row[image]</td>
            <td>$row[status]</td>
            <td>$row[response_message]</td>
            <td>$row[solution_category]</td>
            <td>$row[expected_SLA_days]</td>
            <td>$row[date_response]</td>
            <td>$row[date_fulfillment]</td>
            <td>$row[actual_SLA_days]</td>
            </tr>";
            }
            ?>
        </tbody>
</body>

</html>