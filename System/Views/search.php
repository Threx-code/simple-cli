<?php

require_once "syspath.php";
require_once SYS_PATH . '/inc/header.php';
require_once "nav_bar.php";
?>
<main role="main" class="container starter-template">
	 <?php require_once "search_form.php"; ?>
    <div class="row">

        <!--error / success message will apprear here -->
        <div id="response"></div>
        <div class="col-lg-12 col-xs-12 tab-content">
            <div class="ftco-blocks-cover-1">
                <div class="site-section-cover overlay" style="background-image: url('<?php echo(APP_URI) ?>/images/img1.jpeg')">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                 <?php
                                    if (!empty(json_decode($data, true))) { ?>
                                        <p>Your Search Result</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-section">
                <div class="container">
                    <div id="posts" class="row no-gutter">

                        <?php
                        if (!empty(json_decode($data, true))) {
                            foreach ($data as $val) { ?>
                             <div class="item web col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4" style="border: 1px solid #eee; padding: 20px">
                                <strong>County: <?php echo $val->county; ?></strong>
                                <small>Country: <?php echo $val->country; ?></small>
                                <small>Town: <?php echo $val->town; ?></small>
                                <small><p>Address:<?php echo $val->address; ?></p></small>
                                <small>Long: <?php echo $val->latitude; ?> Lat: <?php echo $val->longitude; ?></small>
                                <a href="<?php echo $val->image; ?>" class="item-wrap" data-fancybox="gal">
                                    <span class="icon-search2"></span>
                                    <img class="img-fluid" src="<?php echo $val->image; ?>">
                                     <img src="<?php echo $val->thumbnail; ?>" style="z-index: 10; position: relative; margin-top: -100px; margin-left:240px;">
                                </a>
                                 <small>No of Bedrooms: <?php echo $val->num_bedrooms; ?> -> No of Bathrooms: <?php echo $val->num_bathrooms; ?></small>
                                <p style="font-size: 12px;"><?php echo $val->description; ?></p>

                                    <p>Price: <?php echo $val->price; ?></p>
                                    <?php $pro_type = json_decode($val->property_type, true); ?>
                                    <small><strong>Type:</strong> <?php echo($pro_type['type']); ?><br>
                                    <strong>Description:</strong> <?php echo($pro_type['description']); ?></small><br>
                                    <small><strong>Available for:</strong> <?php echo $val->type; ?></small>
                                    <small><strong>Date Posted:</strong> <?php echo $val->created_at; ?></small>
                                </div>

                            <?php
                            }
                        } else {
                            ?>

                           <div class="row align-items-center">
                           	<p style="margin-left: 200px; font-size: 20px; margin-top: 20px;">No result on your search....try something new</p>
                           </div>

                    <?php } ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php

require_once SYS_PATH . '/inc/footer.php';


?>
