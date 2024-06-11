
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost Island Wiki</title>
    <link rel="stylesheet" href="../css/regles.css">
</head>
<body>
    <header>
        <?php 
    include('nav.php' )
    
    ?>
      
    </header>
    <div class="azerty">  
        
    <img src="../img/seaofcir.png" alt="Logo" class="logo">
        
        <div class="container">
    <div class="image-container">
        <img src="../img/reglement2.png" alt="Règle" class="regle">
        <div class="texte">
            Welcome sailor !<br>
            Le but du jeu est d'atteindre en bateau le coffre.
            Pour cela, avant de lever l'ancre dans chaque niveau, tu dois 
            placer les tridents de direction sur la mer, lorsque tu auras finis 
            tes placements, tu peux enfin lever l'ancre et le bateau avancera
            et tournera dans le sens du trident sur lequel il passera.
            Place le moins de trident possible et évite les différents mobs (voir wiki en base de la page)
            (La direction initiale du bateau variera selon les niveaux, ça sera indiqué.)
        </div>
    </div>
    <img src="../img/pero.png" alt="Perroquet" class="pero">
</div>
    <!-- <img src="../sprites/hd/shiphd.png" alt="bateau">
    <img src="../sprites/hd/chest.png" alt="coffre"> -->
        <br>
        <img src="../img/wiki_pancarte.png" alt="Wiki" class="wiki-image">

    <main>

        <div class="obstacle">
            <img src="../pixel_art_projet/gif/ship.gif" alt="Le bateau">
            <p>Le bateau : C'est lui que tu diriges à l'aide des tridents, sa direction initiale varie selon 
                les niveaux.
            </p>
        </div>
        
        <div class="obstacle">
            <img src="../pixel_art_projet/gif/trident.gif" alt="Les tridents">
            <p>Les tridents : ce sont des "flèches de directions", tu en as à chaque début de niveau dans ton inventaire, ce dernier se situe à gauche de l'écran, tu dois les placer avant de lever l'ancre du bateau.</p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/gif/krabby.gif" alt="Krabby">
            <p>Krabby : c'est un crabe, on ne sait pas d'où cette espèce vient, la légende raconte qu'il vient en réalité d'un autre univers où il existe plein de différentes créatures comme lui avec différentes capacités. Si tu croises son chemin, il va réussir avec la capacité de ses crochets de couper un trident.</p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/gif/pieuvre.gif" alt="Pieuvre crocheteuse">
            <p>Pieuvre crocheteuse : Description de la pieuvre crocheteuse.</p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/32x32/la_main.png" alt="La main de l'eau">
            <p>La main de l'eau : Caché dans un mer corrompue, elle t'attrapes et te
               remontes dans une autre partie de la mer (apparition rare)
            </p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/gif/guardian.gif" alt="Guardian">
            <p>Guardian : 3 phases :<br>
                -Oeil fermé : aucun effet <br>
                -Oeil ouvert : (9-20cases) aucun effet <br>
                -Oeuil laser : (1-8cases) détruit ton bateau si il te laser pendant 6 cases de déplacement 
            </p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/gif/wave.gif" alt="Vague">
            <p>Vague : Elle te propulse dans une autre case d'un rayon de 5 cases</p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/32x32/rock1.png" alt="Rocher">
            <p>Rocher : si tu passes dessus t'exploses en gros.</p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/32x32/rock.png" alt="Rocher1">
            <p>Rocher : si tu passes dessus t'exploses en gros.</p>
        </div>
    </main>
 </div>
   
</body>
</html>


