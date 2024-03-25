<?php

// GitHub felhasználónév és jelszó
$username = 'YOUR_GITHUB_USERNAME';
$password = 'YOUR_GITHUB_PASSWORD';

// A GitHub repository neve, ahová feltöltjük a képet
$repository = 'YOUR_REPOSITORY_NAME';

// A feltöltendő kép elérési útja a helyi fájlrendszeren
$imagePath = $_FILES['file']['tmp_name']; // Az uploaded file temporary neve

// A fájl tartalma
$fileContent = file_get_contents($imagePath);

// A feltöltött fájl neve
$filename = $_FILES['file']['name'];

// GitHub API végpont, ahol feltöltjük a fájlt
$url = "https://api.github.com/repos/$username/$repository/contents/$filename";

// A fájl tartalmának base64 kódolása
$base64Content = base64_encode($fileContent);

// JSON payload előkészítése
$data = [
    'message' => 'Add image',
    'content' => $base64Content
];

// JSON payload elkészítése
$dataJson = json_encode($data);

// GitHub API hívás
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
$response = curl_exec($ch);
curl_close($ch);

// A válasz feldolgozása
$responseData = json_decode($response, true);

// Ellenőrzés, hogy a fájl sikeresen fel lett-e töltve
if (isset($responseData['content'])) {
    $imageLink = $responseData['content']['download_url'];

    // Tárold el az elérési utat a képhez a saját adatbázisodban vagy fájlodban
    // Például, ha egy fájlban tárolod az elérési utakat:
    $fileStorage = 'path/to/your/fileStorage.txt';
    file_put_contents($fileStorage, $imageLink . PHP_EOL, FILE_APPEND);

    // Vagy ha adatbázisban tárolod:
    /*
    $pdo = new PDO('mysql:host=localhost;dbname=YOUR_DATABASE_NAME', 'YOUR_USERNAME', 'YOUR_PASSWORD');
    $stmt = $pdo->prepare('INSERT INTO image_links (link) VALUES (:link)');
    $stmt->bindParam(':link', $imageLink);
    $stmt->execute();
    */

    echo "A kép sikeresen fel lett töltve és a linkje tárolva lett.";
} else {
    echo "Hiba történt a kép feltöltése közben.";
}
