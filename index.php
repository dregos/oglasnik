<?php include "db.php"; ?>

<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">
                <div class="container">
                    <h1>Adverts</h1>

					              <?php
                        // Display last 5 ads

                        // Prepare statement
                        $sql = "SELECT * FROM ads ORDER BY created_at DESC LIMIT 5";
                        $ads = $dbOglasnik->fetchData($sql);

                        //var_dump($ads);

                        foreach ($ads as $ad) {
                            echo("<a href='ad.php?id=".$ad["id"]."'>". $ad["title"] ."</a>");
                            echo("<br/>");
                        }

                        //var_dump($ads);
                        // Display link to all ads page
                        echo("<br/>");
                        echo("<br/>");
                        echo("<a href='ads.php'>See All Ads</a>");
					?>

                </div>
            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
