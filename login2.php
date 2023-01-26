<?php
session_start();

// Connect to MySQL
$con = mysqli_connect("localhost", "root", "", "dappi 2.0");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Prepare a SQL statement to select the user type from the database
    $query = "SELECT user_type, department, id FROM users WHERE username='$username' AND u_password='$password'";
    // Execute the SQL statement
    $result = mysqli_query($con, $query);
    // If there is a result, get the user type
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_type = $row['user_type'];
        $department = $row['department'];
        $id = $row['id'];
        // Store user type in session
        $_SESSION['user_type'] = $user_type;
        $_SESSION['department'] = $department;
        $_SESSION['id'] = $id;
        // Redirect to the appropriate page based on user type
        if ($user_type == "ADMINSTRATOR") {
            header("Location: admin.php");
            exit();
        } else if ($user_type == "REVIEWER") {
            header("Location: department_view.php");
            exit();
        } else if ($user_type == "USER") {
            header("Location: user_view.php");
            exit();
        } else {
            echo "Invalid user type";
        }
    } else {
        // Display an error message
        echo "<div class='alert' role='alert'>Invalid username or password</div>";
    }
    // Close the connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>DAPPI</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <br>
    <img src="Logo DAPPI.JPG" alt="logo" width="100" height="50" style="float: right" margin-right="50" />
    <h1>Solutions for managing Assets and Supplies</h1>
    <br>
    <table>
        <tr>
            <td>
            <img src="DAPPI diagram.JPG" alt="logo" width="680" height="350" style="float: left" margin-right="200" />  
                <!--
    <p>DAPPI is a ticketing system that will allow you to do the following: <br>
    <ul>
        <li>Report issues in an fast and easy way</li>
        <li>Obtain standardized information from the problems reported</li>
        <li>Facilitate communication between requester and responsible department </li>
        <li>Request follow up in real time </li>
        <li>Generation of database for future analysis </li>
    </ul>
    </p>
    -->
    </td>
    <td>
    <table class="login">
    <tr>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <td><label for="username">Username:</label></td>
        <td><input type="text" name="username" id="username" required></td>
        </tr>
        <tr>
        <td><label for="password">Password:</label></td>
        <td><input type="password" name="password" id="password" required></td>
        </tr>
        <tr></tr>
        <tr>
        <td><input type="submit" value="Login" id="log"></td>
        </tr>
        <tr>
        <td><input type="checkbox" id="check"><span>Remember me</span></td>
        </tr>
        <tr>
        <td><a href="#">Forgot Password</a></td>
        </tr>
    </form>
</td>
</tr>
</table>
</body>

</html>