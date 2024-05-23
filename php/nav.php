
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
  <nav id="nav">
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
    </nav>
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
  var nav = document.querySelector('#nav');

  if (veil1.style.opacity === '0' || veil1.style.opacity === '') {
    veil1.style.opacity = '1';
    veil2.style.display = 'none';
    veil1.style.zIndex = '9';
    veil2.style.zIndex = '10';
    nav.style.zIndex = '11'
    nav.style.opacity = '0';
    nav.style.display = 'none';
  } else {
    veil1.style.opacity = '0';
    veil2.style.opacity = '1';
    veil2.style.display = 'block';
    veil1.style.zIndex = '11';
    veil2.style.zIndex = '9';
    nav.style.zIndex = '11'
    nav.style.opacity = '1';
    nav.style.display = 'block';
  }
}

</script>


</body>
</html>







