<?php
require_once "syspath.php";
require_once SYS_PATH . '/inc/header.php';
require_once "nav_bar.php";
?>

<main role="main" class="container starter-template">
    <div class="row">
        <!--error / success message will apprear here -->
        <div id="response"></div>
        <div class="col-lg-12 col-xs-12 tab-content">
            <div class="ftco-blocks-cover-1">
                <div class="site-section-cover overlay">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h1 class="mb-3 text-primary">Edit</h1>
                            </div>
                            <div class="col-md-5">
                                <a href="index" class="btn-dark p-2" style="float: right; text-decoration: none;">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-section">
                <div class="container">
                    <div id="posts" class="row no-gutter">

                        <div class="col-lg-8 offset-lg-2 col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <a href="<?php echo $data['image']; ?>" class="item-wrap" data-fancybox="gal">
                                        <picture class="card-img-top">
                                            <source srcset="<?php echo $data['image']; ?>" type="image/svg+xml">
                                            <img src="<?php echo $data['image']; ?>" class="img-fluid img-thumbnail" alt="...">
                                        </picture>
                                    </a>

                                    <form action="update" method="post" class="mt-4 updateForm" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">County</label>
                                            <input type="text" class="form-control" name="county" aria-describedby="emailHelp" value="<?php echo $data['county']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Country</label>
                                            <input type="text" class="form-control" name="country" aria-describedby="emailHelp" value="<?php echo $data['country']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Town</label>
                                            <input type="text" class="form-control" name="town" aria-describedby="emailHelp" value="<?php echo $data['town']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address</label>
                                            <input type="text" class="form-control" name="address" aria-describedby="emailHelp" value="<?php echo $data['address']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" name="description" rows="3"><?php echo $data['description']; ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Image</label>
                                            <input type="file" class="form-control-file" name="image">
                                            <small id="emailHelp" class="form-text text-muted">This image will serve as Image and thumbnail</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Longitude</label>
                                            <input type="text" class="form-control" name="longitude"  aria-describedby="emailHelp" value="<?php echo $data['longitude']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Latitude</label>
                                            <input type="text" class="form-control" name="latitude" aria-describedby="emailHelp" value="<?php echo $data['latitude']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Number of Bedroom</label>
                                            <select class="form-control" name="num_bedrooms">
                                                <option><?php echo $data['num_bedrooms']; ?></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" >Number of Bathroom</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="num_bathrooms">
                                                <option><?php echo $data['num_bathrooms']; ?></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Price</label>
                                            <input type="text" class="form-control" name="price" aria-describedby="emailHelp" value="<?php echo $data['price']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Property type</label>
                                            <?php
                                            $type = json_decode($data['property_type'], true);
                                            ?>
                                            <input type="text" class="form-control" name="property_type" aria-describedby="emailHelp" value="<?php echo $type['type']; ?>">
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="sale" <?php
                                            if($data['type'] == 'sale'){  ?> checked <?php } ?>>
                                            <label class="form-check-label" for="inlineRadio1">Sale</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="rent" <?php
                                            if($data['type'] == 'rent'){  ?> checked <?php } ?>>
                                            <label class="form-check-label" for="inlineRadio2">Rent</label>
                                        </div>

                                        <input type="hidden" class="form-control" name="token" value="<?php echo $crfToken; ?>">
                                        <input type="hidden" class="form-control" name="id" value="<?php echo $data['id']; ?>">
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary mb-4">Submit</button>
                                        </div>

                                            <div class="submitLoader searchLoader" style="margin-left: 100px; margin-top: -73px;"></div>
                                        <p class="alert alert-info result" style="margin-left: 0px; margin-top: -3px; display: none;"></p>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script type="text/javascript">
    $(document).ready(function(){
        $(".updateForm").on("submit", (function(e){
            e.preventDefault();
            $(".submitLoader").show();
            $.ajaxSetup({
                headers:{
                    "X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")
                }
            });

            $.ajax({
                url:'update',
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data){
                    $(".submitLoader").hide();
                    $('.result').show();
                    $('.result').html(data);
                    $(".updateForm")[0].reset();
                }
            })
        }))
    })

</script>

<?php
require_once SYS_PATH . '/inc/footer.php';
?>
