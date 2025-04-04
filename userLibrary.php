<?php
    $title = "User Library | Rent N' Run";
    $description = "Library of Rent N' Run";
	include './includes/global-header.php';
    require_once ('./includes/database.php');
    if (isset($_POST['return'])) {
        $returnedGame = ($_POST['return']); 
        if($loggedIn == 0){
            $conn = null;
            header('location:register.php');
            exit();
        }
        else{
            $libraryQuery = "UPDATE gameinfo SET accountid = NULL WHERE gameid = '$returnedGame'";
            $libraryResult = $conn->prepare($libraryQuery);
            $libraryResult->execute();
        }
    }
    $sql = "SELECT * FROM gameinfo WHERE accountid = '$account_id'";
    // run the query and store the results
    $result = $conn->prepare($sql);
    $result->execute();
    if($result->rowCount() > 0){
        echo "<h2 id='libraryTitle'>Your Games</h2>
         <section class='gameList'>";
        foreach($result as $row){
            echo "<section class='gameContainer'>";
                echo "<div class='gameInfo'>
                    <h2>" . $row['title'] . "</h2>
                    <p>" . $row['description'] . "</p>
                    <p>" . $row['genre'] . "</p> 
                    <p>" . $row['publisher'] . "</p> 
                    <p>" .$row['rating'] . "</p>
                </div>
                <div class='gameImage'>
                    <img src='" . $row['gameimage'] . "'>
                    <form method='POST' action='userLibrary.php'>
                        <button type='submit' name='return' value='{$row['gameid']}'>Return</button>
                    </form>
                </div>
            </section>";
        }
        echo "</section>";
        echo"<a href='logout.php' class='logoutButton'>Logout</a>";
    }
    else{
        echo "<section class='noData'>";
            echo "<div>";
                echo "<h2>No games in your library</h2>";
                echo "<p>There are currently no games in your library.</p> 
                <p><a href='index.php#gameCategories' id='gameCta'>Rent some games</a> first!</p>";
            echo "</div>";
            echo"<p>...or come back at a later date!</p>
            <a href='logout.php' class='logoutButton'>Logout</a>";
        echo "</section>";
    }
    include './includes/global-footer.php';
?>