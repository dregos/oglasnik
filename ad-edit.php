<?php include 'db.php'; ?>

<?php

    if(!isset($_GET)){
        return;
        die();
    }

    $ad_id = $_GET["id"];
    if(!isset($ad_id)){
        echo("Niste predali ID!");
        die();
    }
    
    $sql = "SELECT * FROM ads WHERE id=$ad_id";
    $ad = fetchSQLData($conn, $sql);

    $ad_title=$ad[0]["title"];
    $ad_location=$ad[0]["location"];
    $ad_created=$ad[0]["created"];

    $sql = "SELECT * FROM categories";
    $categories = fetchSQLData($conn, $sql);
   

    //var_dump($categories);
?>

<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">

                <div class="container">
                    <form action="" method="POST">
                        <input type="text" value="<?php echo $ad_title ?>" name="title" placeholder="Title" required>
                        <!--<textarea rows="10" name="text" placeholder="Type in the text of your ad..." required></textarea>-->

						<!-- Dodati dropdown iz koga ce moci da se odabere kategorija oglasa -->
                        <select name="categories">
                            <?php
                                foreach($categories as $key => $category){
                                    echo ("<option value='$key'>".$category["name"]."</option>");
                                }
                            ?>
                        </select>
                        
                        <input type="submit" value="Update" name="submit">
                    </form>
                </div>

            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
