<?php
session_start();

if (!isset($_SESSION['creation_id'])) {
    die("Nincs megadva létrehozás azonosítója.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doityourself";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$creationid = $_SESSION['creation_id'];

$deleteSavedCreationsSql = "DELETE FROM savedcreations WHERE creation_id = ?";
$stmtSavedCreations = $conn->prepare($deleteSavedCreationsSql);
$stmtSavedCreations->bind_param("i", $creationid);

if (!$stmtSavedCreations->execute()) {
    die("Error executing savedcreations delete query: " . $stmtSavedCreations->error);
}

$sql = "DELETE FROM creations WHERE creation_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $creationid);

if (!$stmt->execute()) {
    die("Error executing creations delete query: " . $stmt->error);
}

http_response_code(200);
exit();

?>
