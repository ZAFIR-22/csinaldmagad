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

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
        $response["success"] = true;
        $_SESSION["user_id"] = $row["user_id"];
        setcookie('user_id', $_SESSION['user_id'], time() + (86400 * 30), "/");
    } else {
        $response["success"] = false;
    }
} else {
    $response["success"] = false;
}

echo json_encode($response);

$conn->close();
?>
