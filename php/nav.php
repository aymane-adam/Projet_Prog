<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Naveil</title>

  <link rel="stylesheet" href="../css/navfooter.css">
</head>


<body>

<header>
<header>
    <div class="nav-veil" onclick="toggleImages()">
      <img src="../img/neil-nav.png" alt="veil">
    </div>
    <div class="nav-veil2" onclick="toggleImages()">
      <img src="../img/Design sans titre (5).png" alt="veil">
    </div>
  </header>
  
  <script>
   function toggleImages() {
      var veil1 = document.querySelector('.nav-veil');
      var veil2 = document.querySelector('.nav-veil2');

      if (veil1.style.opacity === '0') {
        veil1.style.opacity = '1';
        veil2.style.opacity = '0';
        veil2.style.height = '2%'; // Taille initiale de la deuxième image
      } else {
        veil1.style.opacity = '0';
        veil2.style.opacity = '1';
        veil2.style.height = '100%'; // Taille de la deuxième image lorsque la première est cliquée
}
}
        </script>

</body>
<footer id="footer-yu">
<div class="coque">
                <img src="../img/coque_pirate.png" alt="veil">
        </div>

</footer>