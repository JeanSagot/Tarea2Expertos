<?php
$servername = "remotemysql.com";
$username = "gHUm7JxWIX";
$password = "HUYWVKHP9v";
$db = "gHUm7JxWIX";
// Create connection
$connection = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
