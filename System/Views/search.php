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
                                <div class="item web col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4 card data-div<?php echo $val->id; ?>" style="border: 1px solid #eee; padding: 20px">
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

                                    <a href="edit?item_no=<?php echo $val->id; ?>&token=<?php echo $crfToken; ?>" class="item-wrap btn btn-primary mb-4" data-fancybox="gal">Edit</a>
                                    <span class="item-wrap btn btn-primary mb-4 click-delete<?php echo $val->id; ?>" data-fancybox="gal">Delete</span>
                                    <form action="delete" method="post" class="mt-4 delete<?php echo $val->id; ?>" enctype="multipart/form-data">
                                        <input type="hidden" class="form-control" name="token" value="<?php echo $crfToken; ?>">
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $val->id; ?>">
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary mb-4 delete-button<?php echo $val->id; ?>" style="display: none;">Submit</button>
                                        </div>
                                        <script type="text/javascript">
                                            $(document).ready(function(){
                                                $(".click-delete<?php echo $val->id; ?>").on('click', function(){
                                                    $(".delete-button<?php echo $val->id; ?>").click();
                                                });

                                                $(".delete<?php echo $val->id; ?>").on("submit", (function(e){
                                                    e.preventDefault();
                                                    $.ajaxSetup({
                                                        headers:{
                                                            "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                                                        }
                                                    });
                                                    $.ajax({
                                                        url:'delete',
                                                        method:'POST',
                                                        data:new FormData(this),
                                                        contentType:false,
                                                        processData:false,
                                                        success:function(data){
                                                            if(data == "Deleted") {
                                                                $(".data-div<?php echo $val->id; ?>").fadeOut();
                                                            }
                                                        }
                                                    })
                                                }))
                                            })

                                        </script>

                                    </form>
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
