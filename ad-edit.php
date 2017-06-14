<?php include 'db.php'; ?>

<?php

    if (isset($_POST['submit'])) {
      //echo "stisnjeno dugme update";
      $updatedAd = new Ad($_POST);
      //var_dump($_POST);
      //echo("SESSION ad_id v:");
      //var_dump($_SESSION['ad_id']);
      $updatedAd->ad_id = (int)$_SESSION['ad_id'];
      echo("updatedAd->ad_id:".$updatedAd->ad_id);
      $dbOglasnik->updateAd($updatedAd);
      header ('Location: ?id='.$updatedAd->ad_id);
    }

    $ad_id = $_GET["id"];
    if(!isset($ad_id) || $ad_id==""){
        echo("Niste predali ID!");
        $log->writeLog("Nije predan ID za zapis AD.", null);
        die();
    }
    $_SESSION['ad_id'] = $ad_id;
    //echo("SESSION ad_id:".$_SESSION['ad_id']);
    $adObj = new Ad($dbOglasnik->getAdById($ad_id)[0]);

    $sql = "SELECT * FROM categories";
    $allCategories = $dbOglasnik->fetchData($sql);

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
                        <select name="category_id">
                          <?php
                            foreach ($allCategories as $category){
                              $tmp = "<option value=".$category['id'];
                              $tmp = $category['id']==$adObj->category_id ? $tmp. " selected>" : "$tmp>";
                              $tmp = $tmp.$category['name'] . "</option>";
                              echo($tmp);
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
