<?php

session_start();
$githubPersonalAccessToken = "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";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doityourself";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $imageName = $_FILES['profile_picture']['name'];
    $imageData = addslashes(file_get_contents($_FILES['profile_picture']['tmp_name']));
    $imageType = $_FILES['profile_picture']['type'];
    $sql = "INSERT INTO users (username, password, email, profile_picture) VALUES ('$username', '$hashedPassword', '$email', '$imageData')";
    
    if ($conn->query($sql) === TRUE) {
        $userId = $conn->insert_id;
        $_SESSION["user_id"] = $userId;
        setcookie('user_id', $_SESSION['user_id'], time() + (86400 * 30), "/");
        header( "Location: /" );
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
