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
                <div class="site-section-cover overlay">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h1 class="mb-3 text-primary">Properties</h1>
                            </div>

                            <div class="col-md-5">
                                <a href="add" class="btn-dark p-2" style="float: right; text-decoration: none;">Add New Property</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-section">
                <div class="container">
                    <div id="posts" class="row no-gutter">
                        <?php foreach ($data as $val) {?>
                             <div class="item web col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4 card" style="border: 1px solid #eee; padding: 20px">
                                 <a href="<?php echo $val->image; ?>" class="item-wrap" data-fancybox="gal">
                                     <picture class="card-img-top">
                                         <source srcset="<?php echo $val->image; ?>" type="image/svg+xml">
                                         <img src="<?php echo $val->image; ?>" class="img-fluid img-thumbnail" alt="...">
                                     </picture>
                                 </a>
                                 <strong>County: <?php echo $val->county; ?></strong>
                                 <small>Country: <?php echo $val->country; ?></small>
                                 <small>Town: <?php echo $val->town; ?></small>
                                 <small>Address:<?php echo $val->address; ?></small>
                                 <small><strong>Long:</strong> <?php echo $val->latitude; ?> <strong>Lat:</strong> <?php echo $val->longitude; ?></small>
                                 <small>No of Bedrooms: <?php echo $val->num_bedrooms; ?> -> No of Bathrooms: <?php echo $val->num_bathrooms; ?></small>
                                 <small><strong>Available for:</strong> <?php echo $val->type; ?></small>
                                 <small><strong>Date Posted:</strong> <?php echo $val->created_at; ?></small>
                                 <small>Price: <?php echo $val->price; ?></small>
                                 <?php $pro_type = json_decode($val->property_type, true); ?>
                                 <small><strong>Type:</strong> <?php echo($pro_type['type']); ?><br>
                                     <strong>Description:</strong> <?php echo($pro_type['description']); ?>
                                 </small><br>

                                 <a href="edit?page_no=<?php echo $val->id; ?>&token=<?php echo $crfToken; ?>" class="item-wrap btn btn-primary mb-4" data-fancybox="gal">Edit</a>
                             </div>
                        <?php } ?>
                    </div>
                    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                        <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
                    </div>
                    <ul class="pagination" style="width: 100%;">
                        <?php if ($page_no > 1) {
                            echo "<li style'margin-left: 50px;'><a href='?page_no=1'>First Page</a></li>";
                        } ?>

                        <li <?php if ($page_no > 1) {
                            echo "class='disabled'";
                        } ?> style="margin-left: 450px;">
                            <a <?php if ($page_no > 1) {
                                echo "href='?page_no=$previous_page&token=$crfToken'";
                            } ?><< Previous</a>
                        </li>

                        <li <?php if ($page_no > $total_no_of_pages) {
                            echo "class='disabled'";
                        } ?>>
                            <a <?php if ($page_no < $total_no_of_pages) {
                                echo "href='?page_no=$next_page&token=$crfToken'";
                            } ?> style="margin-right: 400px;">Next</a>
                        </li>
                        <?php if ($page_no < $total_no_of_pages) {
                            echo "<li style'margin-right 400px;'><a href='?page_no=$total_no_of_pages&token=$crfToken'>Last &rsaquo;&rsaquo;</a></li>";
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php

require_once SYS_PATH . '/inc/footer.php';


?>
