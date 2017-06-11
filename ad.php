<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">
                <div class="container">
                    <h1>Ad</h1>


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
