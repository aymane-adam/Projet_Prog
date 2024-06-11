
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
        <img src="../img/reglement.png" alt="Règle" class="regle">
        <div class="texte">
            Welcome sailor !<br>
            The goal of the game is to reach the chest by boat.
            For this, before raising the anchor in each level, you must 
            place the tridents of direction on the sea, when you have finished 
            your investments, you can finally anchor and the boat will advance
            and turn in the direction of the trident on which it will pass.
            Place as little trident as possible and avoid different mobs (see wiki at the base of the page)
            (The initial direction of the boat will vary according to the levels, it will be indicated.)
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
            <p>The boat : you direct it using the tridents, its initial direction varies depending on the level.
            </p>
        </div>
        
        <div class="obstacle">
            <img src="../pixel_art_projet/gif/trident.gif" alt="Les tridents">
            <p>The tridents :  They are "arrows of directions", you have them at the beginning of each level in your inventory, you must place them before lifting the anchor of the boat.</p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/gif/krabby.gif" alt="Krabby">
            <p>Krabby : it is a crab, we do not know where this species comes from, legend says that it actually comes from another universe where there are many different creatures like him with different abilities. If you cross his path, it’s over for you .</p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/gif/pieuvre.gif" alt="Pieuvre crocheteuse">
            <p>Crocheting octopus : if you touch it it will sink you.</p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/gif/guardian.gif" alt="Guardian">
            <p>Guardian : it’s a monster from the water temples.<br>
            </p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/gif/wave.gif" alt="Vague">
            <p>Wave : She smashes the boat.</p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/32x32/rock1.png" alt="Rocher">
            <p>Rock : it’s like the titanic and the iceburg.</p>
        </div>
        <div class="obstacle">
            <img src="../pixel_art_projet/32x32/rock.png" alt="Rocher1">
            <p>Rock : it’s like the titanic and the iceburg.</p>
        </div>
    </main>
 </div>
   
</body>
</html>


