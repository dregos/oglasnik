<?php include 'db.php'; ?>
<?php

  $ad_id = $_GET["id"];
  if(!isset($ad_id)){
      echo("Niste predali ID!");
      die();
  }
  $record = $dbOglasnik->getAdById($ad_id);
  //var_dump($record[0]);
  $adObj = new Ad($record[0]);

  //var_dump($adObj);

?>
<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">
                <div class="container">
                    <h1>Ad</h1>

                      <form action="/ad.php">
                        <input type="text" value="<?php echo $adObj->title ?>" name="title" placeholder="Title" readonly>
                        <input type="text" value="<?php echo $adObj->created ?>" name="title" placeholder="Created" readonly>
                        <input type="text" value="<?php echo $adObj->expires ?>" name="title" placeholder="Expires" readonly>
                        <input type="text" value="<?php echo $adObj->category_name ?>" name="title" placeholder="Category" readonly>
                        <input type="text" value="<?php echo $adObj->first_name ?>" name="title" readonly>
                        <input type="text" value="<?php echo $adObj->last_name ?>" name="title" readonly>
                        <textarea rows="10" name="text" placeholder="Type in the text of your ad..." readonly><?php echo $adObj->text ?></textarea>
                      </form>
                        <!-- Dodati dropdown iz koga ce moci da se odabere kategorija oglasa -->


					<?php





                        // Display single ad (all the fields including the ones from users profile)
                        // using the query parameter

                        // Below the ad, add a delete link

                        // Also, add an edit link with a query parameter
                        // which should redirect to edit ad page

					?>

                </div>
            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
