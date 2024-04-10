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


$sql = "SELECT * FROM creations";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <title>Csináld Magad</title>
</head>
<body>
<?php 
if (isset($_SESSION["user_id"])){
    echo '
    <nav class="navbar navbar-expand-lg mb-2" style="background-color: rgba(6, 6, 6, 0.353);">
        <div class="container-fluid">
          <a class="navbar-brand navbartext" href="#">Csináld magad</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link navbartext" aria-current="page" href="/">Főoldal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navbartext" href="keszitmenyek">Készítmények</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navbartext" href="/account" >Fiók</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>';
} else {
    echo '
    <nav class="navbar navbar-expand-lg mb-2" style="background-color: rgba(6, 6, 6, 0.353);">
        <div class="container-fluid">
          <a class="navbar-brand navbartext" href="#">Csináld magad</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link navbartext" aria-current="page" href="/">Főoldal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navbartext" href="keszitmenyek">Készítmények</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navbartext" href="/login" >Bejelentkezés</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>';
}
?>

<div class="container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div class="card mb-3" data-creation-id="' . $row["creation_id"] . '">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img class="img-fluid rounded-start" alt="..." src="data:image/jpeg;base64,'.base64_encode($row["image"]).'"/>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["title"] . '</h5>
                            <p class="card-text">' . $row["description"] . '</p>
                        </div>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo "Nincsenek adatok.";
    }
    ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var cards = document.querySelectorAll('.card');

    cards.forEach(function(card) {
        card.addEventListener('click', function() {
            var creationId = this.dataset.creationId;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'store_creation_id.php?id=' + creationId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    window.location.href = '/creationdetail';
                }
            };
            xhr.send();
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
