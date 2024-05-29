<?php

$connect = mysqli_connect("localhost:3308", "root", "Yatriroad#03", "user") or die("Connection failed");

if ($connect) {
    echo "Connected";
} else {
    echo "Not Connected";
}
