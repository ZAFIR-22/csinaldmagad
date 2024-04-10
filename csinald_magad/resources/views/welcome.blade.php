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
      <div id="carouselExampleCaptions" class="carousel slide mb-2" >
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="container">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="diy_jelentese.jpg" class="d-block w-100 rounded shadow p-3 mb-5 bg-body-tertiary rounded" alt="..." style="max-height: 50dvh;">
          </div>
          <div class="carousel-item">
            <img src="DIY-During-Lockdown.jpg" class="d-block w-100 rounded shadow p-3 mb-5 bg-body-tertiary rounded" alt="..." style="max-height: 50dvh;">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div class="container shadow p-3 mb-5 rounded" style="height:max-content; background-color: rgba(0, 0, 0, 0.5);">
        <div class="row justify-content-center align-items-start">
            <h1 class="bemut">Bemtatkozás</h1>
            <h5 class="szoveg"><br>
                Üdvözöllek a Csináld Magad nevű weboldalon! Ez a közösségi platform arra szolgál, hogy mindenki megmutathassa saját kreatív alkotásait, és mások is láthassák azokat. Itt az alkotók bemutathatják létrehozott műveiket, valamint lépésről lépésre megoszthatják az alkotás folyamatát. Legyen szó barkácsolásról, varrásról, kézművességről, főzésről vagy bármilyen más házi készítésű dologról, itt találhatsz ötleteket és inspirációt. Emellett nem csak arról van szó, hogy bemutatod, mit alkottál - hanem arról is, hogy tanulsz másoktól és kapcsolatba lépsz hasonlóan gondolkodó alkotókkal. Böngészd át a folyamatosan bővülő projektgyűjteményünket, inspirálódj mások által elért eredményekből, és csatlakozz a közösséghez, hogy te is megoszd saját alkotásaidat és technikáidat. Legyen szó egy tapasztalt házi készítőről vagy épp csak a kézműves útjára lépő kezdőről, itt mindenki megtalálja a kreativitás végtelen lehetőségeit. Indulj velünk a DIY kalandban!
            </h5>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>