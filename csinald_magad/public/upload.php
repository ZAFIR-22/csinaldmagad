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
    $cím = $_POST['cím'];
    $leiras = $_POST["leiras"];
    $utmutato = $_POST["utmutato"];
    $profilePictureTmpPath = $_FILES["kep"]["tmp_name"];
    $profilePictureFileName = $_FILES["kep"]["name"];
    $user_id = $_SESSION["user_id"];

    $githubUsername = "ZAFIR-22";
    $githubRepository = "csinaldmagadkepek";
    $githubFilePath = "contents/creationimages/" . $profilePictureFileName;

    $base64Content = base64_encode(file_get_contents($profilePictureTmpPath));

    $data = [
        'message' => 'Add profile picture',
        'content' => $base64Content
    ];

    $dataJson = json_encode($data);

    $githubUrl = "https://api.github.com/repos/$githubUsername/$githubRepository/$githubFilePath";

    $ch = curl_init($githubUrl);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$githubUsername:$githubPersonalAccessToken");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
    $response = curl_exec($ch);
    curl_close($ch);

    $githubResponse = json_decode($response, true);
    $githubPictureUrl = "https://github.com/ZAFIR-22/csinaldmagadkepek/blob/main/creationimages/$profilePictureFileName?raw=true";

    $sql = "INSERT INTO creations (user_id, title, description, image, instruction) VALUES ('$user_id','$cím', '$leiras', '$githubPictureUrl', '$utmutato')";

    if ($conn->query($sql) === TRUE) {
        header( "Location: /account" );
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
