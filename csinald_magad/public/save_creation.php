<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die('Nem vagy bejelentkezve!');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['creation_id']) && isset($_POST['user_id'])) {
        $creation_id = $_POST['creation_id'];
        $user_id = $_POST['user_id'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "doityourself";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO savedcreations (user_id, creation_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $creation_id);

        if ($stmt->execute()) {
            echo "Készítés sikeresen mentve!";
        } else {
            echo "Hiba történt a mentés során: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Hiányzó adatok!";
    }
} else {
    echo "Érvénytelen kérés!";
}
?>
