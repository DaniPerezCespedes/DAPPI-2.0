<?php

//Define variables for Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "dappi";

//Create connection

$connection = mysqli_connect($servername,$username,$password,$database);
//define variables
$id ="";
$first_name ="";
$last_name ="";
$email ="";
$phone ="";
$address="";
$errorMessage="";
$errorMessage2="";
$successMessage="";

//check if we recieve the request by get method (show data of the employee)

if($_SERVER['REQUEST_METHOD']=='GET')
{
    if (lisset($_GET["id"])){
        header("location:/DAPPI 2.0/index.php");
        exit;
    }

    $id=$_GET["id"]; //get ID from database

    //read the row of selected client from db table
    $sql="SELECT * employees WHERE id=$id";
    $result = $connection -> query($sql);
    $row = mysqli_fetch_assoc($result);

    if(!$row) {
        header("location:/DAPPI 2.0/index.php");
        exit;    
    }
    $first_name =$row["first_name"];
    $last_name = $row["last_name"];
    $email = $row["email"];
    $phone =$row["phone"];
    $address=$row["address"];
}
else{
    //post method: update the data of the client
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAPPI</title>
</head>
<body>
    <h2>New Employee</h2>
    <?php
    //check if error message is not empy. If not empty, show error message
    if (!empty($errorMessage)){
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
        <input type ="hidden" value="<?php echo $id;?>">
        <!--Create different variables-->
        <label>First Name</label>
        <input type ="text" class="form-control" name="first_name" value="<?php echo $first_name;?>">
        <br>
        <label>Last name</label>
        <input type ="text" class="form-control" name="last_name" value="<?php echo $last_name;?>">  
        <br>
        <label>Email</label>
        <input type ="text" class="form-control" name="email" value="<?php echo $email;?>">    
        <br>
        <label>Phone number</label>
        <input type ="text" class="form-control" name="phone" value="<?php echo $phone;?>">      
        <br>
        <label>Address</label>
        <input type ="text" class="form-control" name="address" value="<?php echo $address;?>">  
        <br>
        <br>  
        
        <!- check if success message is not empty, if is not, display success message->
        <?php
    if (!empty($successMessage)){
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
        <button type="submit" class = #btn btn-primary">Submit</button>
        <a class="btn btn-outline-primary" href="/DAPPI 2.0/index.php" role="button">Cancel</a>
    </form>
    </body>
</html>