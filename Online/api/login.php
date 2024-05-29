<?php
session_start();
include("connect.php");

// Ensure database connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";

// Check if the POST variables are set
if (isset($_POST['text']) && isset($_POST['password']) && isset($_POST['choice'])) {
    // Extract form data
    $mobile = $_POST['text'];
    $password = $_POST['password'];
    $role = $_POST['choice'];

    // Debugging output to confirm form data is received
    echo "Received Values:<br>";
    echo "Mobile: $mobile<br>";
    echo "Password: $password<br>";
    echo "Role: $role<br>";

    // Ensure the table name 'users' is correct
    $query = "SELECT * FROM users WHERE mobile = '$mobile' AND password = '$password' AND role = '$role'";
    $check = mysqli_query($connect, $query);

    // Debug: Print out the query result
    if (!$check) {
        die("Error executing query: " . mysqli_error($connect));
    }

    if (mysqli_num_rows($check) > 0) {
        $userdata = mysqli_fetch_array($check);

        // Fetch groups with role = 2 (ensure this is the correct logic)
        $groups = mysqli_query($connect, "SELECT * FROM users WHERE role = '2'");
        if (!$groups) {
            die("Error fetching groups: " . mysqli_error($connect));
        }
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        // Store data in session
        $_SESSION['userdata'] = $userdata;
        $_SESSION['groupsdata'] = $groupsdata;

        // Use PHP header for redirection
        header("Location: ../Routes/dashboard.php");
        exit();
    } else {
        echo '<script>alert("Invalid Credentials or User not found"); window.location="../";</script>';
    }
} else {
    // Debugging output to confirm which POST variables are missing
    if (!isset($_POST['text'])) echo "Missing 'text' parameter<br>";
    if (!isset($_POST['password'])) echo "Missing 'password' parameter<br>";
    if (!isset($_POST['choice'])) echo "Missing 'choice' parameter<br>";

    echo "Error: Required POST parameters are missing.";
}
