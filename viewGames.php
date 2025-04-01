<?php
    $title = "View Games | Rent N' Run";
    $description = "content page of Rent N' Run";
    include './includes/global-header.php';
    require_once ('./includes/database.php');
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'All';
    if ($filter == "All")
    {
        $sql = "SELECT * FROM gameinfo WHERE accountid IS NULL";
    }
    else if ($filter == "Recent"){
        $sql = "SELECT * FROM gameinfo WHERE accountid IS NULL ORDER BY gameid DESC LIMIT 5";
    }
    else if ($filter == "Sale"){
        $sql = "SELECT * FROM gameinfo WHERE accountid IS NULL AND sale = 1";
    }
    else if ($filter == "Adventure"){
        $sql = "SELECT * FROM gameinfo WHERE accountid IS NULL AND genre = 'Adventure'";
    }
    else if ($filter == "Action"){
        $sql = "SELECT * FROM gameinfo WHERE accountid IS NULL AND genre = 'Action'";
    }
    else if ($filter == "Horror"){
        $sql = "SELECT * FROM gameinfo WHERE accountid IS NULL AND genre = 'Horror'";
    }
    else if ($filter == "Platformer"){
        $sql = "SELECT * FROM gameinfo WHERE accountid IS NULL AND genre = 'Platformer'";
    }
    else if ($filter == "RPG"){
        $sql = "SELECT * FROM gameinfo WHERE accountid IS NULL AND genre = 'RPG'";
    }
    else{
        header('location:viewGames.php?filter=All');
        exit();
    }
    if (isset($_POST['rent'])) {
        $rentedGame = ($_POST['rent']); 
        if($loggedIn == 0){
            $conn = null;
            header('location:register.php');
            exit();
        }
        else{
            $accountQuery = "SELECT * FROM useraccounts WHERE accountid = '$account_id'";
            $accountResult = $conn->prepare($accountQuery);
            $accountResult->execute();
            if ($accountResult->rowCount() > 0){
                $gameQuery = "UPDATE gameinfo SET accountid = '$account_id' WHERE gameid = '$rentedGame'";
                $gameResult = $conn->prepare($gameQuery);
                $gameResult->execute();
                $conn = null;
                header('location:userLibrary.php');
                exit();
            }
            else{
                echo "<p>No account detected</p>";
            }
        }
    }
    // run the query and store the results
    $result = $conn->prepare($sql);
    $result->execute();
    if($result->rowCount() > 0){
        echo "<section class='gameList'>";
        foreach($result as $row){
            echo "<section class='gameContainer'>";
                echo "<div class='gameInfo'>
                    <h2>" . $row['title'] . "</h2>
                    <div>
                        <p>" . $row['description'] . "</p>
                        <p>" . $row['genre'] . "</p> 
                    </div>
                    <div>
                        <p>" . $row['publisher'] . "</p> 
                        <p>" .$row['rating'] . "</p>
                    </div>
                </div>
                <div class='gameImage'>";
                    if($row['sale'] == 1)
                    {
                        echo "<h2 class='saleNotif'>On Sale!</h2>";
                    }
                    echo "<img src='" . $row['gameimage'] . "'>
                    <form method='POST' action='viewGames.php'>
                        <button type='submit' name='rent' value='{$row['gameid']}'>Rent</button>
                    </form>
                </div>
            </section>";
        }
        echo "</section>";
    }
    else{
        echo "<section class='noData'>";
            echo "<h2>No games available</h2>";
            echo "<p>There are no games available to rent at the moment, please check back later</p>";
        echo "</section>";
    }

        include './includes/global-footer.php';
?>
