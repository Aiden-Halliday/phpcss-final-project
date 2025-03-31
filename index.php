    <?php
        $title = "Renting Games Done Nice & Easy! | Rent N' Run";
        $description = "the official homepage Rent N' Run";
        include("./includes/global-header.php");
        $conn = null;
    ?>
    <section id="masthead">
        <div>
            <h2>Making Renting Games a Walk in the Park!</h2>
            <p>At Rent N' Run, we make renting games as easy and enjoyable as a stroll through your favorite park. Whether you're looking for the latest releases, timeless classics, or hidden gems, our hassle-free process ensures you'll have access to your next gaming adventure in no time.</p>
        </div>
    </section>
    <section id="rentalDetails">
        <h2>See our Rentals Below!</h2>
    </section>
    <section id="gameCategories">

        <div id="newReleases">
            <a href="viewGames.php?filter=Recent">New Releases</a>
            <div class="background-zoom"></div>
        </div>

        <div id="onSale">
            <a href="viewGames.php?filter=Sale"> Games on Sale </a>
            <div class="background-zoom"></div>
        </div>

        <?php
            $genreChoices = ["Action", "Adventure", "Horror", "Platformer", "RPG"];
            $randomGenre = array_rand($genreChoices);
            $randomGenre = $genreChoices[$randomGenre];
        ?>

        <div id="randomGenre">
            <?php
                echo "<a href='viewGames.php?filter=" . urlencode($randomGenre) . "'>" . $randomGenre . "</a>";
            ?>
            <div class="background-zoom"></div>
        </div>

    </section>

        <div id="allGamesContainer"> 
            <a href="viewGames.php?filter=All" id="allGameButton"> All Games </a>
        </div>
        <?php
	        include("./includes/global-footer.php");
        ?>