<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("Location:../");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="/css/stylesheet.css">
    <style>
        #backbtn {
            padding: 8px;
            border-radius: 5px;
            background-color: blue;
            color: white;
            width: 10%;
            float: left;
        }

        #logout {
            padding: 8px;
            border-radius: 5px;
            background-color: blue;
            color: white;
            width: 10%;
            float: right;
        }
    </style>
</head>

<body>
    <button id="backbtn">Back</button>
    <button id="logout">Logout</button>
    <h1>Online Voting System</h1>
    <hr>
    <div id="Voter"></div>
    <div id="Group"></div>
</body>

</html>