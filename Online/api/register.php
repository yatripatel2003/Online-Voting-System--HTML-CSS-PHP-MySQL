<?php
include("connect.php");

// Test database connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Print all POST data for debugging
    echo "Received POST data:<br>";
    print_r($_POST);
    echo "<br>";

    // Print all FILES data for debugging
    echo "Received FILES data:<br>";
    print_r($_FILES);
    echo "<br>";

    // Ensure all required POST and FILE variables are set
    if (isset($_POST['Name']) && isset($_POST['number']) && isset($_POST['password']) && isset($_POST['cPassword']) && isset($_POST['Address']) && isset($_FILES['file']['name']) && isset($_POST['Role'])) {
        // Extract form data
        $name = $_POST['Name'];
        $number = $_POST['number'];
        $password = $_POST['password'];
        $cPassword = $_POST['cPassword'];
        $address = $_POST['Address'];
        $file = $_FILES['file']['name'];
        $temp_name = $_FILES['file']['tmp_name'];
        $role = $_POST['Role'];

        // Debug: Print out the received values
        echo "Received Values:<br>";
        echo "Name: $name<br>";
        echo "Mobile: $number<br>";
        echo "Password: $password<br>";
        echo "Confirm Password: $cPassword<br>";
        echo "Address: $address<br>";
        echo "File: $file<br>";
        echo "Temp Name: $temp_name<br>";
        echo "Role: $role<br>";

        // Check if passwords match
        if ($password == $cPassword) {
            // Move uploaded file to destination directory
            if (move_uploaded_file($temp_name, "../uploads/$file")) {
                echo "File uploaded successfully<br>";

                // Insert data into database
                $insert = mysqli_query($connect, "INSERT INTO voting (Name, Mobile, Password, Address, Photo, Role, Status, Votes) VALUES ('$name', '$number', '$password', '$address', '$file', '$role', 0, 0)");

                if ($insert) {
                    echo '<script>alert("Registration successful"); window.location="../";</script>';
                } else {
                    die("Error: " . mysqli_error($connect));
                }
            } else {
                die("Error: File upload failed.");
            }
        } else {
            die('<script>alert("Password and confirmed password do not match!"); window.location="../Routes/register.html";</script>');
        }
    } else {
        die("Error: Required POST parameters are missing.");
    }
} else {
    die("Error: Request method is not POST.");
}
