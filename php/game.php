<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAIN</title>
    <link rel="stylesheet" href="../css/test.css">
</head>
<body>
    <!-- Ajoutez votre vidéo de fond -->
    <video autoplay muted loop id="background-video">
        <source src="../animation.mp4" type="video/mp4">
    </video>

    <!-- Navigation incluse -->
    <?php include("../php/nav.php") ?>

    <!-- Images clignotantes -->
    <img src="../img/wooow.png" alt="side1" class="side-image blink" id="side-image1">
    <img src="../img/wooow.png" alt="side2" class="side-image blink" id="side-image2">

    <!-- Contenu principal -->
    <div class="container" id="container1">
        <img src="../img/canon_bateau.png" alt="canon" class="main-image">
        <div class="info-bubble">
            <img src="image.png" alt="Megalopolis" class="info-image">
            <div class="info-text">
                <h3>Megalopolis</h3>
                <p>Film de <a href="#">Francis Ford Coppola</a> - 2024</p>
            </div>
        </div>
    </div>

    <!-- Deuxième section avec la même fonctionnalité -->
    <div class="container container-second" id="container2">
        <img src="../img/canon_bateau.png" alt="second" class="main-image">
        <div class="info-bubble">
            <img src="../img/community.png" alt="Another Film" class="info-image">
            <div class="info-text">
                <h3>Community Mode</h3>
                
            </div>
        </div>
    </div>

    <!-- Image secondaire -->
    <div class="matuu">
        <img src="../img/matbateau (2).png">
    </div>

    <!-- JavaScript pour la bulle d'info -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const containers = [
                { container: document.getElementById('container1'), sideImage: document.getElementById('side-image1') },
                { container: document.getElementById('container2'), sideImage: document.getElementById('side-image2') }
            ];

            containers.forEach(function(item) {
                const { container, sideImage } = item;

                container.addEventListener('mouseover', function() {
                    sideImage.style.opacity = '0'; // Masque progressivement l'image clignotante
                    setTimeout(() => {
                        sideImage.remove(); // Retire l'image du DOM après la transition
                    }, 500); // Durée de l'animation (500ms)
                });

                const mainImage = container.querySelector('.main-image');
                const infoBubble = container.querySelector('.info-bubble');

                mainImage.addEventListener('mouseover', function() {
                    infoBubble.style.display = 'block';
                });

                mainImage.addEventListener('mouseout', function() {
                    infoBubble.style.display = 'none';
                });
            });
        });
    </script>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Ton lost island. Tous droits réservés.</p>
    </footer>
</body>
</html>
