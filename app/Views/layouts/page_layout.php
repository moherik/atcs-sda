<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pantau Embong | ATCS Sidoarjo</title>
  <link rel="stylesheet" href="app.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

  <?= $this->renderSection('css'); ?>
</head>

<body>
  <div class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-lg">
      <div class="container">
        <a class="navbar-brand" href="#">ATCS Sidoarjo </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">Peta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/about-us">Tentang Kami</a>
            </li>
          </ul>
          <span class="navbar-text">
            <a href="https://play.google.com/store/apps/details?id=com.cctv.dishub.sda" target="_blank">
              <img src="ic_gplay.png" alt="ic gplay" width="100px" />
            </a>
          </span>
        </div>
      </div>
    </nav>

    <?= $this->renderSection('content'); ?>

    <footer class="bg-white shadow-lg">
      <div class="container text-center p-3">
        &copy; <?= date('Y') ?> All rights reserved
      </div>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

  <?= $this->renderSection('js'); ?>
</body>

</html>