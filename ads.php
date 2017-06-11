<?php include "db.php"; ?>

<?php 

    //delete ADD
    
    if(isset($_GET)){
        if(isset($_GET["delete_id"])){
            $d_id =$_GET["delete_id"];
            $sql = "DELETE FROM ads WHERE id=$d_id";
            $statement = $conn->prepare($sql);
            $statement->execute();
            header('Location: ads.php');
        }
    }
    

?>

<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">
                <div class="container">
                    <h1>Ads</h1>

					<?php

                        // Prepare statement
                        $sql = "SELECT * FROM ads";
                        $statement = $conn->prepare($sql);

                        // execute statement
                        $statement->execute();

                        // set the resulting array to associative
                        $statement->setFetchMode(PDO::FETCH_ASSOC);

                        // gets data from DB
                        $ads = $statement->fetchAll();

                        // uncomment to see if it works
                        //var_dump($ads);
                        echo ("<table>");

                            foreach ($ads as $ad) {
                                echo("<tr>");
                                    echo("<td>");
                                        echo("<a href='ad.php?id=".$ad["id"]."'>". $ad["title"] ."</a>");
                                    echo("</td>");
                                    echo("<td>");
                                        echo("<a href='ads.php?delete_id=".$ad["id"]."'> - Delete ad -</a>");
                                    echo("</td>");
                                    echo("<td>");
                                        echo("<a href='ad-edit.php?id=".$ad["id"]."'> - Edit ad -</a>");
                                    echo("</td>");
                                echo("</tr>");
                            }
                        echo ("</table>");


                        // Display all ads - title and first 100 characters of text
                        // Make title and text clickable - click takes you to the single ad page

                        // Below every ad, add a delete link

                        // Also, add an edit link with a query parameter
                        // which should redirect to edit ad page

					?>

                </div>
            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
