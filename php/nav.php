<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NAVVEIL</title>
<link rel="stylesheet" href="../css/navfooter.css">
<style>
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
    .nav-veil2{
      left: 13%;
    }
    .nav-veil2 img {
    width: 70%;
    height: 200px;
}

</style>
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
  <div class="nav-veil show" onclick="toggleImages()">
    <img src="../img/neil-nav.png" alt="Image 1">
  </div>
  <div class="nav-veil2 hide" onclick="toggleImages()">
    <img src="../img/navvasy.png" alt="Image 2">
  </div>
</header>

<script>
function toggleImages() {
    var veil1 = document.querySelector('.nav-veil');
    var veil2 = document.querySelector('.nav-veil2');
    var nav = document.querySelector('#nav');

    if (veil1.classList.contains('show')) {
        veil1.classList.remove('show');
        veil1.classList.add('hide');
        veil2.style.zIndex = '11';
        setTimeout(function() {
            veil2.classList.remove('hide');
            veil2.classList.add('show');
        }, 100); // Attendre que l'animation de la première image se termine
    } else {
        veil2.classList.remove('show');
        veil2.classList.add('hide');
        setTimeout(function() {
            veil1.classList.remove('hide');
            veil1.classList.add('show');
        }, 100); // Attendre que l'animation de la deuxième image se termine
    }
}
</script>
</body>
</html>
