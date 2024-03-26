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
    $profilePictureTmpPath = $_FILES["profile_picture"]["tmp_name"];
    $profilePictureFileName = $_FILES["profile_picture"]["name"];

    $githubUsername = "ZAFIR-22";
    $githubRepository = "csinaldmagadkepek";
    $githubFilePath = "contents/profilepictures/" . $profilePictureFileName;

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
    $githubPictureUrl = "https://github.com/ZAFIR-22/csinaldmagadkepek/blob/main/profilepictures/$profilePictureFileName?raw=true";

    $sql = "INSERT INTO users (username, password, email, profile_picture) VALUES ('$username', '$hashedPassword', '$email', '$githubPictureUrl')";

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
