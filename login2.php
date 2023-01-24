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
            echo "Invalid user type.";
        }
    } else {
        // Display an error message
        echo "Invalid username or password.";
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
    <p>DAPPI is a ticketing system that will allow you to do the following: <br>
    <ul>
        <li>Report issues in an fast and easy way</li>
        <li>Obtain standardized information from the problems reported</li>
        <li>Facilitate communication between requester and responsible department </li>
        <li>Request follow up in real time </li>
        <li>Generation of database for future analysis </li>
    </ul>
    </p>
    <p><a href="https://docs.google.com/presentation/d/1zPqIvt_HKnMoKB0DvZh4wnbXhgShyC4FXL8vkAJ0fzI/edit#slide=id.p">Go
            to Presentation</a>
    </p>
    <br>
    <br>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" value="Login">
        <input type="checkbox" id="check">
        <span>Remember me</span>
        <br><br>
        <a href="#">Forgot Password</a>
    </form>
</body>

</html>