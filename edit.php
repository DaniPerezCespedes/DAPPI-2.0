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
$image = "";
$status = "";
$response_message = "";
$solution_category = "";
$expected_SLA_days = "";
$date_response = "";
$date_fulfillment = "";
$actual_SLA_days = "";

//check if we recieve the request by get method (show data of the request)

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $id = $_GET['id']; //get ID from database


    //read the row of selected request from db table
    $sql = "SELECT * FROM requests WHERE id=$id";
    $result = $connection->query($sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        header("location:/DAPPI 2.0/index0.php");
        exit;
    }

    //store info from db in these variables

    $user_id = $row["user_id"];
    $date_request = $row["date_request"];
    $item = $row["item"];
    $room = $row["room"];
    $problem_category = $row["problem_category"];
    $description = $row["description"];
    $image = $row["image"];
    $status = $row["status"];
    $response_message = $row["response_message"];
    $solution_category = $row["solution_category"];
    $expected_SLA_days = $row["expected_SLA_days"];
    $date_response = $row["date_response"];
    $date_fulfillment = $row["date_fulfillment"];
    $actual_SLA_days = $row["actual_SLA_days"];
} else {
    //POST method: update the data
    $id = $_POST["id"];
    $user_id = $_POST["user_id"];
    $date_request = $_POST["date_request"];
    $item = $_POST["item"];
    $room = $_POST["room"];
    $problem_category = $_POST["problem_category"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $status = $_POST["status"];
    $response_message = $_POST["response_message"];
    $solution_category = $_POST["solution_category"];
    $expected_SLA_days = $_POST["expected_SLA_days"];
    $date_response = $_POST["date_response"];
    $date_fulfillment = $_POST["date_fulfillment"];
    $actual_SLA_days = $_POST["actual_SLA_days"];
}
do {
    //check if there are no empy fields
    if (empty($status) || empty($expected_SLA_days)) {
        $errorMessage = "Please fill all fields required";
        break;
    }
    $sql = "UPDATE requests  
                SET status ='$status', response_message='$response_message',solution_category ='$solution_category',expected_SLA_days='$expected_SLA_days',date_response='$date_response',date_fulfillment='$date_fulfillment',actual_SLA_days='$actual_SLA_days'
                WHERE id= $id";
    $result = $connection->query($sql);

    //check if query is correct or not

    if (!$result) {
        $errorMessage = "Invalid query: " . $connection->error;
        break; //break the while loop
    }

    // $successMessage ="Employee edited correctly";
    //redirect user to main page
    // header("location:/DAPPI 2.0/index.php");
    //exit;



} while (false);

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
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <!--Create different variables-->
        <label>User ID</label>
        <input type="text" class="form-control" name="user_id" value="<?php echo $user_id; ?>" disabled>
        <br>
        <label>Request date</label>
        <input type="text" class="form-control" name="date_request" value="<?php echo $date_request; ?>" disabled>
        <br>
        <label>Item</label>
        <input type="text" class="form-control" name="item" value="<?php echo $item; ?>" disabled>
        <br>
        <label>Room</label>
        <input type="text" class="form-control" name="room" value="<?php echo $room; ?>" disabled>
        <br>
        <label>Problem category</label>
        <input type="text" class="form-control" name="problem_category" value="<?php echo $problem_category; ?>"
            disabled>
        <br>
        <label>Description</label>
        <input type="text" class="form-control" name="description" value="<?php echo $description; ?>" disabled>
        <br>
        <label>Image</label>
        <input type="text" class="form-control" name="image" value="<?php echo $image; ?>" disabled>
        <br>
        <label>Status*</label>
        <select name="status">
            <option value="Received" selected>Received</option>
            <option value="Being processed">Being processed</option>
            <option value="Implementing solution">Implementing solution</option>
            <option value="Solved">Solved</option>
        </select>
        <br>
        <label>Response message</label>
        <input type="text" class="form-control" name="response_message" value="<?php echo $response_message; ?>">
        <br>
        <label>Solution category</label>
        <input type="text" class="form-control" name="solution_category" value="<?php echo $solution_category; ?>">
        <br>
        <label>Expected SLA in days*</label>
        <input type="text" class="form-control" name="expected_SLA_days" value="<?php echo $expected_SLA_days; ?>">
        <br>
        <label>Response date</label>
        <input type="date" class="form-control" name="date_response" value="<?php echo $date_response; ?>" disabled>
        <br>
        <label>Fulfillment date</label>
        <input type="date" class="form-control" name="date_fulfillment" value="<?php echo $date_fulfillment; ?>"
            disabled>
        <br>
        <label>Actual SLA in days</label>
        <input type="text" class="form-control" name="actual_SLA_days" value="<?php echo $actual_SLA_days; ?>" disabled>
        <br>

        <!-- check if success message is not empty, if is not, display success message-->
        <?php
        //if (!empty($successMessage)){
        //  echo "
        //<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        //  <strong>$successMessage</strong>
        //</div>
        //";
        //}
        ?>
        <br>
        <br>
        <a href="/DAPPI 2.0/department_view.php">
            <button type="submit" class="btn btn-primary" onclick="/DAPPI 2.0/department_view.php">Submit</button>
        </a>
        <a class="btn btn-outline-primary" href="/DAPPI 2.0/department_view.php" role="button">Cancel</a>
    </form>
</body>

</html>