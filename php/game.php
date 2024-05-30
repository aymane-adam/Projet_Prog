<?php 
    include('nav.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="wheel-container">
            <img id="wheel" src="../img/GOUVERNAIL2-Photoroom.png-Photoroom.png" alt="Wheel">
            <img id="center-image1" class="center-image" src="../img/community_.png" alt="Center Image 1">
            <img id="center-image2" class="center-image" src="../img/campagne.png" alt="Center Image 2">
        </div>
        <div id="description-container" class="description-container">
            <img id="description-image1" class="description-image" src="../img/144579-OTMY9E-805.jpg" alt="Description Image 1">
            <div id="description-text1" class="description-text">
                <h2>Community Mode</h2>
                <p>The purpose of this mode is to play or level created by playing them in the level editor</p>
            </div>
            <img id="description-image2" class="description-image" src="../img/Votre texte de paragraphe (1).png" alt="Description Image 2" style="display: none;">
            <div id="description-text2" class="description-text" style="display: none;">
                <h2>Campaign Mode</h2>
                <p>The goal of the campaign is to do the levels made by the game masters to learn how to play and use the objects</p>
            </div>
        </div>
        <p id="game-mode"></p>
        <button class="button-10" id="change-mode">
            <span class="text">Change Mode</span>
        </button>
        <div class="playyy">
            <img id="play-button" src="../img/PLAYY.png" alt="Play" class="clickable-image">
        </div>
    </div>
    <script>
        let rotation = 0;
        let modeToggle = true;

        document.getElementById('change-mode').addEventListener('click', () => {
            rotation += 360;
            document.getElementById('wheel').style.transform = `rotate(${rotation}deg)`;

            const centerImage1 = document.getElementById('center-image1');
            const centerImage2 = document.getElementById('center-image2');
            const gameMode = document.getElementById('game-mode');
            const descriptionImage1 = document.getElementById('description-image1');
            const descriptionImage2 = document.getElementById('description-image2');
            const descriptionText1 = document.getElementById('description-text1');
            const descriptionText2 = document.getElementById('description-text2');

            if (centerImage1.style.display === 'none') {
                centerImage1.style.display = 'block';
                centerImage2.style.display = 'none';
                gameMode.textContent = '';
                descriptionImage1.style.display = 'block';
                descriptionText1.style.display = 'block';
                descriptionImage2.style.display = 'none';
                descriptionText2.style.display = 'none';
            } else {
                centerImage1.style.display = 'none';
                centerImage2.style.display = 'block';
                gameMode.textContent = '';
                descriptionImage1.style.display = 'none';
                descriptionText1.style.display = 'none';
                descriptionImage2.style.display = 'block';
                descriptionText2.style.display = 'block';
            }
            modeToggle = !modeToggle;
        });

        document.getElementById('play-button').addEventListener('click', () => {
            if (modeToggle) {
                document.location.href = "community.php";
            } else {
                window.location = "compaign.php"; 
            }
        });
    </script>
    <style>
        body {
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
            background: url(../img/mapuii.webp) center/cover no-repeat;
        }
      
        .container {
            text-align: center;
            justify-content: center;
            align-items: center;
            position: relative;
            height: 100vh;
        }

        .wheel-container {
            position: relative;
          
            width: 24%;
            height: 30%;
            margin: auto;
            top: 10%;
        }

        #wheel {
            width: 100%;
            height: auto;
            transition: transform 1s ease;
        }

        .center-image {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        #center-image2 {
            display: none;
        }

        .description-container {
            position: absolute;
            top: 15%;
            left: 5%;
            width: 20%;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            font-size: 18px;
        }

        .description-image {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .description-text {
            text-align: left;
        }

        #game-mode {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        .clickable-image {
            cursor: pointer;
            width: 150px; /* Adjust the size as needed */
            margin: 10px;
        }

        button.button-10 {
            touch-action: manipulation;
            position: relative;
            display: inline-block;
            cursor: pointer;
            outline: none;
            border: 0;
            top: 45%;
            vertical-align: middle;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: 600;
            color: #382b22;
            text-transform: uppercase;
            padding: 1.25em 2em;
            background: #EE8E60;
            border: 2px solid #b18597;
            border-radius: 0.75em;
            transform-style: preserve-3d;
            transition: transform 150ms cubic-bezier(0, 0, 0.58, 1), background 150ms cubic-bezier(0, 0, 0.58, 1);
        }

        button.button-10::before {
            position: absolute;
            content: "";
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #FCAA83;
            border-radius: inherit;
            box-shadow: 0 0 0 2px #b18597, 0 0.625em 0 0 #ffe3e2;
            transform: translate3d(0, 0.75em, -1em);
            transition: transform 150ms cubic-bezier(0, 0, 0.58, 1), box-shadow 150ms cubic-bezier(0, 0, 0.58, 1);
        }

        button.button-10:hover {
            background: #FFBA9A;
            transform: translate(0, 0.25em);
        }

        button.button-10:hover::before {
            box-shadow: 0 0 0 2px #b18597, 0 0.5em 0 0 #ffe3e2;
            transform: translate3d(0, 0.5em, -1em);
        }

        button.button-10:active {
            background: #ffe9e9;
            transform: translate(0em, 0.75em);
        }

        button.button-10:active::before {
            box-shadow: 0 0 0 2px #b18597, 0 0 #ffe3e2;
            transform: translate3d(0, 0, -1em);
        }

        #play-button {
            position: absolute;
            top: 77%;
            height: 13%;
            width: 10%;
            right: 30%;
            transition: transform 0.3s ease;
        }

        #play-button:hover {
            transform: scale(0.8);
        }
    </style>
</body>
</html>
