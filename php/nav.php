<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NAVVEIL</title>
<link rel="stylesheet" href="../css/navfooter.css">
</head>
<body>
<header>
  <div class="nav-veil" onclick="toggleImages()">
    <img src="../img/neil-nav.png" alt="Image 1">
  </div>
  <div class="nav-veil2" onclick="toggleImages()" style="display:none;">
    <img src="../img/Design sans titre (5).png" alt="Image 2">
  </div>
</header>

<script>
        
function toggleImages() {
  var veil1 = document.querySelector('.nav-veil');
  var veil2 = document.querySelector('.nav-veil2');

  if (veil1.style.opacity === '0' || veil1.style.opacity === '') {
    veil1.style.opacity = '1'; // Faire apparaître la première image
    veil2.style.display = 'none'; // Cacher la deuxième image
    veil1.style.zIndex = '9';
    veil2.style.zIndex = '10';
  } else {
    veil1.style.opacity = '0'; // Faire disparaître la première image
    veil2.style.opacity = '1';
    veil2.style.display = 'block'; // Afficher la deuxième image
    veil1.style.zIndex = '10';
    veil2.style.zIndex = '9';
  }
}

</script>


</body>
</html>




