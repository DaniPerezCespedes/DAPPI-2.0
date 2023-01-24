<?php
//Define variables for Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "dappi 2.0";

//Create connection

$connection = mysqli_connect($servername, $username, $password, $database);

//define variables

$item = "";
$room = "";
$problem = "";
$description = "";
$image = "";
$errorMessage = "";
$successMessage = "";

//obtain the information filled by user in webpage

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $_POST["item"];
    $room = $_POST["room"];
    $problem = $_POST["problem_category"];
    $description = $_POST["description"];
    $image = $_POST["image"];

    do {
        if (empty($item) || empty($room) || empty($problem)) {
            $errorMessage = "Please fill all fields required (*)";
            break;
        }
        //add a new request from the for, to the table "request"

        $sql = "INSERT INTO requests (item, room, problem_category, description, image)
                VALUES ('$item','$room','$problem','$description','$image')";
        $result = $connection->query($sql);

        //check if query is correct or not

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break; //break the while loop
        }

        $item = "";
        $room = "";
        $problem = "";
        $description = "";
        $image = "";



        $successMessage = "Request added correctly";

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Request</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <img src="Logo DAPPI.JPG" alt="logo" width="100" height="50" style="float: right" margin-right="50" />
    <h2>New Request</h2>
    <?php
    //check if error message is not empy. If not empty, show error message
    if (!empty($errorMessage)) {
        echo "
        <div class='alert' role='alert'>
            <strong>$errorMessage</strong>
        </div>
        ";
    }
    ?>
    <br>
    <table class="request">
    <form method="post">
        <tr>
        <td><label>Item that shows problem*</label></td>
        <td><?php 
        $select_items='SELECT * FROM items';
        $result = $connection->query($select_items);
  
        echo "<select name='item'>";
        echo "<option value='0'>Select</option>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<option value='".$row['name']."'>".$row['name']."</option>";
        }
        echo "</select>";
        ?></td>
        <tr>
        <td><label>Room*</label></td>
        <td><?php 
        $select_room='SELECT * FROM rooms';
        $result = $connection->query($select_room);
  
        echo "<select name='room'>";
        echo "<option value='0'>Select</option>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<option value='".$row['room']."'>".$row['room']."</option>";
        }
        echo "</select>";
        ?></td>
        <tr>
        <td><label>Type of problem*</label></td>
        <td><?php 
        $select_problem='SELECT * FROM problem_category';
        $result = $connection->query($select_problem);
  
        echo "<select name='problem_category'>";
        echo "<option value='0'>Select</option>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<option value='".$row['problem_category']."'>".$row['problem_category']."</option>";
        }
        echo "</select>";
        ?></td>  
        <tr>
        <td><label>Description</label></td>
        <td><input type ="text" class="form-control" name="description" value="<?php echo $description;?>">  </td>    
        <tr>
        <td><label>Image</label></td>
        <td><input type ="text" class="form-control" name="image" value="<?php echo $image;?>"></td>   
        <tr>
        <td><td><br><button type="submit" class = #btn btn-primary" id="log">Submit</button></br></td></td> 
</table>  
        <!-- check if success message is not empty, if is not, display success message-->
        <?php
    if (!empty($successMessage)){
        echo "<div class='alert' role='alert'>
            <strong>$successMessage</strong>
        </div>
        ";
    }
    ?>
    <br>
    <br>
    <br>
    <a class="btn btn-outline-primary" href="/DAPPI 2.0/user_view.php" role="button">Go back to My Requests</a>
    </form>
</body>

</html>