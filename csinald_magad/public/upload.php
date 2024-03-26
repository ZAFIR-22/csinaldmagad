<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doityourself";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cím = $_POST['cím'];
    $leiras = $_POST["leiras"];
    $utmutato = $_POST["utmutato"];
    $user_id = $_SESSION["user_id"];
    $imageName = $_FILES['kep']['name'];
    $imageData = addslashes(file_get_contents($_FILES['kep']['tmp_name']));
    $imageType = $_FILES['kep']['type'];

    $sql = "INSERT INTO creations (user_id, title, description, image, instruction) VALUES ('$user_id','$cím', '$leiras', '$imageData', '$utmutato')";

    if ($conn->query($sql) === TRUE) {
        header( "Location: /account" );
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
