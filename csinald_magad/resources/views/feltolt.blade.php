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
session_start();
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
} 
?>
    </nav>
        <div class="container">
            <div class="row position-absolute top-50 start-50 translate-middle">
                <div class="login rounded">
                  <form method="POST" action="upload.php" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="cím" class="form-label">Cím</label>
                          <input type="text" class="form-control" id="cím" name="cím">
                      </div>
                      <div class="mb-3">
                          <label for="leiras" class="form-label">leírás</label>
                          <input type="text" class="form-control" id="leiras" name="leiras">
                      </div>
                      <div class="mb-3">
                          <label for="utmutato" class="form-label">Útmutató</label>
                          <textarea type="text" class="form-control" id="utmutato" name="utmutato"></textarea>
                      </div>
                      <div class="mb-3">
                          <label class="form-label" for="kep">kép</label>
                          <input type="file" class="form-control" id="kep" name="kep">
                      </div>
                      <button type="submit" class="btn btn-primary">Feltöltés</button>
                  </form>
                </div>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>