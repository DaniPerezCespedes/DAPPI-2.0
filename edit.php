<?php

//Define variables for Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "dappi 2.0";

//Create connection

$connection = mysqli_connect($servername, $username, $password, $database);

//define variables
$id = "";
$user_id = "";
$date_request = "";
$item = "";
$room = "";
$problem_category = "";
$description = "";
$status = "";
$response_message = "";
$solution = "";
$expected_SLA_days = "";
$date_response = "";
$current_date = "";

//check if we recieve the request by get method (show data of the request)

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $id = $_GET['id']; //get ID from database

    //read the row of selected request from db table
    $sql = "SELECT * FROM requests WHERE id=$id";
    $result = $connection->query($sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        header("location:/DAPPI 2.0/department_view.php");
        exit();
    }

    //store info from db in these variables

    $user_id = $row["user_id"];
    $date_request = $row["date_request"];
    $item = $row["item"];
    $room = $row["room"];
    $problem_category = $row["problem_category"];
    $description = $row["description"];
    $status = $row["status"];
    $response_message = $row["response_message"];
    $solution = $row["solution"];
    $expected_SLA_days = $row["expected_SLA_days"];
    $date_response = $row["date_response"];
    $successMessage = "";
    $current_date = date("Y-m-d H:i:s");
} else {
    //POST method: update the data
    $id = $_POST["id"];
    $status = $_POST["status"];
    $response_message = $_POST["response_message"];
    $solution = $_POST["solution"];
    $expected_SLA_days = $_POST["expected_SLA_days"];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST["status"];
    $response_message = $_POST["response_message"];
    $solution = $_POST["solution"];
    $expected_SLA_days = $_POST["expected_SLA_days"];

    do {
        //check if there are no empy fields
        if (empty($status) || empty($expected_SLA_days)) {
            $errorMessage = "Please fill all fields required";
            break;
        }
        $current_date = date("Y-m-d H:i:s");
        /*$sql2 = "INSERT INTO requests (user_id, item, room, problem_category, description)
        VALUES ($_SESSION[id], '$item','$room','$problem','$description') WHERE id= $id";*/
        $sql = "UPDATE requests  
        SET status ='$status', response_message='$response_message',solution ='$solution',expected_SLA_days='$expected_SLA_days',date_response='$current_date'
        WHERE id= $id";
        $result = $connection->query($sql);
        //check if query is correct or not
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break; //break the while loop
        }
        $successMessage = "Request edited successfully";
        //redirect user to main page
        header("location:/DAPPI 2.0/department_view.php");
        exit();
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit employee</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <h2>Edit Request</h2>
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
    <!-- get ID from employee and store ir -->
    <table class="request">
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!--Create different variables-->
            <tr>
                <td><label>User ID</label></td>
                <td><input type="text" class="form-control" name="user_id" value="<?php echo $user_id; ?>" disabled>
                </td>
            </tr>
            <tr>
                <td><label>Request date</label></td>
                <td><input type="text" class="form-control" name="date_request" value="<?php echo $date_request; ?>"
                        disabled>
                </td>
            </tr>
            <tr>
                <td><label>Item</label></td>
                <td><input type="text" class="form-control" name="item" value="<?php echo $item; ?>" disabled></td>
            </tr>
            <tr>
                <td><label>Room</label></td>
                <td><input type="text" class="form-control" name="room" value="<?php echo $room; ?>" disabled>
                </td>
            </tr>
            <tr>
                <td><label>Problem category</label></td>
                <td><input type="text" class="form-control" name="problem_category"
                        value="<?php echo $problem_category; ?>" disabled></td>
            </tr>
            <tr>
                <td><label>Description</label></td>
                <td><input type="text" class="form-control" name="description" value="<?php echo $description; ?>"
                        disabled></td>
            </tr>
            <tr>
                <td><label>Status*</label></td>
                <td>
                    <?php $options = array("Received", "Being processed", "Implementing solution", "Solved");
                    echo '<select name="status">';
                    foreach ($options as $option) {
                        $selected = ($option == $status) ? 'selected'
                            : '';
                        echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                    }
                    echo '</select>'; ?>
                </td>
            </tr>
            <tr>
                <td><label>Response message</label></td>
                <td><input type="text" class="form-control" name="response_message"
                        value="<?php echo $response_message; ?>"></td>
            </tr>
            <tr>
                <td><label>Solution</label></td>
                <td><input type="text" class="form-control" name="solution" value="<?php echo $solution; ?>"></td>
            </tr>
            <tr>
                <td><label>Expected SLA in days*</label></td>
                <td><input type="number" class="form-control" name="expected_SLA_days"
                        value="<?php echo $expected_SLA_days; ?>"></td>
            </tr>
            <tr>
                <td><label>Response date</label></td>
                <td><input type="text" class="form-control" name="date_response" value="<?php echo $current_date; ?>"
                        disabled></td>
            </tr>
            <tr>
                <td>
                    <a href="/DAPPI 2.0/department_view.php">
                        <button type="submit" id="log" style="margin: 30px;"
                            class=" btn btn-primary">Submit</button></a>
                </td>
                <td><a id="cancel" style="margin: 30px;" class="btn btn-outline-primary"
                        href="/DAPPI 2.0/department_view.php" role="button">Cancel</a></td>
            </tr>
        </form>
    </table>
    <br>



    <br>
    <br>
    <!-- check if success message is not empty, if is not, display success message-->
    <?php
    if (!empty($successMessage)) {
        echo "
        <div class='alert' role='alert'>
          <strong>$successMessage</strong>
        </div>
        ";
    }
    ?>
</body>

</html>