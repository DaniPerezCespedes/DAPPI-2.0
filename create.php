<?php
//Define variables for Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "dappi";

//Create connection

$connection = mysqli_connect($servername,$username,$password,$database);

//define variables
$first_name ="";
$last_name ="";
$email ="";
$phone ="";
$address="";
$errorMessage="";
$successMessage="";

//obtain the information filled by user in webpage

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $first_name =$_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone =$_POST["phone"];
    $address=$_POST["address"];

    do{
        if (empty($first_name) || empty($last_name)||empty($email)||empty($phone)||empty($address))
        {
            $errorMessage ="Please fill all fields required";
        break;
        }
        //add a new employee from the for, to the table "employees"

        $sql="INSERT INTO employees (first_name,last_name,email,phone,address)
                VALUES ('$first_name','$last_name','$email','$phone', '$address')";
        $result = $connection -> query($sql);

         //check if query is correct or not

        if(!$result){
           $errorMessage = "Invalid query: ". $connection ->error;
           break; //break the while loop
        }


        $first_name ="";
        $last_name ="";
        $email ="";
        $phone ="";
        $address="";

        $successMessage ="Employee added correctly";
        //redirect user to main page
       // header("location:/DAPPI 2.0/index.php");
        //exit;

    } while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new employee</title>
    <link rel="stylesheet" type="text/css" href="style.css"/> 
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
    <form method="post">
        <!-add rows of information->
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
        <button type="submit" class = #btn btn-primary" id="log">Submit</button>
        <br>
        <a class="btn btn-outline-primary" href="/DAPPI 2.0/index.php" role="button">Cancel</a>
    </form>
    </body>
</html>