<?php include 'db.php'; ?>

<?php

  $log->writeLog("test",null);

    $ad_id = $_GET["id"];
    if(!isset($ad_id) || $ad_id==""){
        echo("Niste predali ID!");
        $log->writeLog("Nije predan ID za zapis AD.", null);
        die();
    }

    $adObj = new Ad($dbOglasnik->getAdById($ad_id)[0]);


    $sql = "SELECT * FROM categories";
    $categories = $dbOglasnik->fetchData($sql);


    //var_dump($categories);
?>

<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">

                <div class="container">
                    <form action="" method="POST">
                        <input type="text" value="<?php echo $adObj->title ?>" name="title" placeholder="Title" required>
                        <textarea rows="10" name="text" placeholder="Type in the text of your ad..." required><?php echo $adObj->text ?></textarea>

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
