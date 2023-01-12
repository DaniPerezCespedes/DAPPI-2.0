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
$successMessage="";

//check if we recieve the request by get method (show data of the employee)

if($_SERVER['REQUEST_METHOD']=='GET'){

    $id = $_GET['id']; //get ID from database


    //read the row of selected client from db table
    $sql ="SELECT * FROM employees WHERE id=$id";
    $result = $connection -> query($sql);
    $row = mysqli_fetch_assoc($result);

    if(!$row) {
        header("location:/DAPPI 2.0/index.php");
        exit;    
    }

    //store info from db in this variables
    $first_name =$row["first_name"];
    $last_name = $row["last_name"];
    $email = $row["email"];
    $phone =$row["phone"];
    $address=$row["address"];
}
else{
    //POST method: update the data of the client
    $id=$_POST["id"];
    $first_name =$_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone =$_POST["phone"];
    $address=$_POST["address"];
}
    do{
       //check if there are no empy fields
       if (empty($first_name) || empty($last_name)||empty($email)||empty($phone)||empty($address))
       {
           $errorMessage ="Please fill all fields required";
       break; 
       }
      $sql ="UPDATE employees  
                SET first_name ='$first_name', last_name='$last_name',email ='$email',phone='$phone',address='$address'
                WHERE id= $id";
        $result = $connection -> query($sql);

             //check if query is correct or not

             if(!$result){
                $errorMessage = "Invalid query: ". $connection ->error;
                break; //break the while loop
             }

            // $successMessage ="Employee edited correctly";
        //redirect user to main page
       // header("location:/DAPPI 2.0/index.php");
        //exit;

    

    } while(false);

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
    <h2>Edit Employee</h2>
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
        <input type ="hidden" name="id" value="<?php echo $id;?>">
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
        <a href="/DAPPI 2.0/index.php">
        <button type="submit" class = "btn btn-primary" onclick ="/DAPPI 2.0/index.php">Submit</button>
        </a>
        <a class="btn btn-outline-primary" href="/DAPPI 2.0/index.php" role="button">Cancel</a>
    </form>
    </body>
</html>