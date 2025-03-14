<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- metadata -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="the official homepage Rent N' Run">
        <meta name="robots" content="noindex, nofollow">
        <title>Renting Games Done Nice & Easy! | Rent N' Run</title>
        <link rel="shortcut icon" href="./imgs/icon.png" type="image/x-icon">
        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Jersey+15&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
        <!-- css -->
        <link rel="stylesheet" href="./css/reset.css">
        <link rel="stylesheet" href="./css/style.css">
        <!-- Javascript -->
         <script src="js/script.js" defer></script>
    </head>
    <body>
        <header>
            <?php
	            include("./includes/global-header.html");
            ?>
        </header>
        <section id="bannerSpace">
            <h1>Making Renting Games a Walk in the Park!</h1>
        </section>
        <section id="retailDetails">
            <h2>See our rentals below!</h2>
        </section>
        <section id="gameCategories">
            <div id="mostRented">
                <img src="./imgs/Bg1.jpg" alt="Background image for the 'rented games' sections">
                <h3>Most Rented</h3>
            </div>

            <div id="newReleases">
                <img src="./imgs/Bg2.jpg" alt="Background image for the 'new releases' sections">
                <h3>New Releases</h3>
            </div>
                
            <div id="onSale">
                <img src="./imgs/Bg3.jpg" alt="Background image for the 'games on sale' sections">
                <h3>Games on Sale</h3>   
            </div>
        </section>
        <section id="recomendedSection">
            <section> 
                <div> <!-- This bit here will be for showing a selection of games on a menu, with users being able to look through them either by pressing arrows, or hitting buttons underneath to go to one of three sections -->

                </div>
            </section>
        </section>
        <footer>
            <?php
	            include("./includes/global-footer.html");
            ?>
        </footer>
    </body>
</html>