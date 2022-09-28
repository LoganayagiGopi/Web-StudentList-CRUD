<?php

if ( isset($_GET["id"]) )
{
    $id = $_GET["id"];

$servername = "localhost";
$username = "root";
$password = "";
$database = "studentcrud";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$sql = "DELETE  FROM students WHERE id=$id";
$connection->query($sql);

}

header("location: /studentcrud/index.php");
exit;
?>