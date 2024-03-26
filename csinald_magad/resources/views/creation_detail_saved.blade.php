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

if (!isset($_SESSION['creation_id'])) {
    header("Location: /error_page.php");
    exit();
}
$creationid = $_SESSION['creation_id'];
$sql = "SELECT * FROM creations WHERE creation_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $creationid);

if (!$stmt->execute()) {
    die("Error executing query: " . $stmt->error);
}

$stmt->store_result();
$stmt->bind_result($creation_id, $user_id, $title, $description, $image, $instruction);
$stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
                <a class="nav-link navbartext" href="keszitmenyek">Készítények</a>
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
          <a class="navbar-brand navbartext" href="">Csináld magad</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link navbartext" aria-current="page" href="/">Főoldal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navbartext" href="keszitmenyek">Készítények</a>
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

<div class="container munkak p-2 rounded">
    <div class="row">
        <div class="col-md-6">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $description; ?></p>
            <?php echo '<img class="img-fluid" alt="'. $title . '" src="data:image/jpeg;base64,'.base64_encode($image).'"/>';?>
        </div>
        <div class="col-md-6">
            <h3>Útmutató</h3>
            <p class="instruction"><?php echo $instruction; ?></p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
