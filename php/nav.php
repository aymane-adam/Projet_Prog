<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NAVVEIL</title>
<link rel="stylesheet" href="../css/navfooter.css">
<style>
  .nav-veil {
      position: relative;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1;
  }

  .nav-veil img {
      width: 100%;
      cursor: pointer;
  }

  .nav-veil .button-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: flex;
      gap: 10px;
  }

  .nav-veil .button-container button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      background-color: rgba(0, 0, 0, 0.5);
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
  }

  .nav-veil .button-container button:hover {
      background-color: rgba(0, 0, 0, 0.7);
  }

  .nav-veil2 {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 0;
      opacity: 0;
      z-index: 7;
      transition: opacity 1s ease, height 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55); /* Smooth transition */
  }

  .nav-veil2 img {
      width: 100%;
      height: 280px;
      z-index: 7;
  }

  .show {
      opacity: 1;
  }

  #nav {
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
  }

  #nav ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: space-around;
    width: 10%;
  }

  #nav a {
    text-decoration: none;
    color: #fff;
    font-size: 18px;
    padding: 10px 20px;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 5px;
  }

  #nav a:hover {
    background-color: rgba(0, 0, 0, 0.7);
  }

  @keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
  }

  @keyframes slideUp {
    from {
        transform: translateY(0);
        opacity: 1;
    }
    to {
        transform: translateY(-100%);
        opacity: 0;
    }
  }

  .nav-veil, .nav-veil2 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out;
  }

  .nav-veil.show, .nav-veil2.show {
    animation: slideDown 0.8s ease-in-out forwards;
    display: block;
  }

  .nav-veil.hide, .nav-veil2.hide {
    animation: slideUp 0.8s ease-in-out forwards;
    display: none;
  }
</style>
</head>
<body>
<header>
  <nav id="nav">
        
    </nav>
  <div class="nav-veil show" >
    <img src="../img/neil-nav.png" alt="Image 1">
    <div class="button-container">
    
      <button class="qsdf" onclick="location.href='../php/index.php'"><span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">Home</span></button>
      <button class="qsdf" onclick="location.href='../php/creation.php'"><span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">Editor</span></button>
      <button class="qsdf" onclick="location.href='../php/regles.php'"><span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">Wiki</span></button>
  <?php
    session_start();
    if(empty($_SESSION['pseudo'])){
      echo '<button class="qsdf" onclick="location.href=\'../php/connexion.php\'"><span class="transition"></span>
      <span class="gradient"></span>
      <span class="label">Sign up</span></button>';
    }
    else {
      echo '<button class="qsdf" onclick="location.href=\'../php/profil.php\'"><span class="transition"></span>
      <span class="gradient"></span>
      <span class="label">Profil</span></button>';
    }
    ?>
    </div>
  </div>
  <div class="nav-veil2 hide" onclick="toggleImages()">
    <img src="../img/voilerty.png" alt="Image 2">
  </div>
</header>
<script>
  function toggleImages() {
      const navVeil = document.querySelector('.nav-veil');
      const navVeil2 = document.querySelector('.nav-veil2');
      navVeil.classList.toggle('show');
      navVeil.classList.toggle('hide');
      navVeil2.classList.toggle('show');
      navVeil2.classList.toggle('hide');
  }
</script>
</body>
</html>
