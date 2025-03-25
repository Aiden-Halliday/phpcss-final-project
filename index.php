    <?php
        $title = "Renting Games Done Nice & Easy! | Rent N' Run";
        $description = "the official homepage Rent N' Run";
        include("./includes/global-header.php");
        $conn = null;
    ?>
    <section id="bannerSpace">
        <h1>Making Renting Games a Walk in the Park!</h1>
    </section>
    <section id="retailDetails">
        <h2>See our Rentals Below!</h2>
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
        <?php
	        include("./includes/global-footer.php");
        ?>