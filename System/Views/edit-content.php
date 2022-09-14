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
                                <h1 class="mb-3 text-primary">Add new Properties</h1>
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
                                    <form action="store" method="post" class="" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">County</label>
                                            <input type="text" class="form-control" name="county" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Country</label>
                                            <input type="text" class="form-control" name="country" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Town</label>
                                            <input type="text" class="form-control" name="town" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address</label>
                                            <input type="text" class="form-control" name="address" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" name="description" rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Image</label>
                                            <input type="file" class="form-control-file" name="image">
                                            <small id="emailHelp" class="form-text text-muted">This image will serve as Image and thumbnail</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Longitude</label>
                                            <input type="text" class="form-control" name="longitude"  aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Latitude</label>
                                            <input type="text" class="form-control" name="latitude" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Number of Bedroom</label>
                                            <select class="form-control" name="num_bedrooms">
                                                <option></option>
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
                                                <option></option>
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
                                            <input type="text" class="form-control" name="price" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Property type</label>
                                            <input type="text" class="form-control" name="property_type" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="sale">
                                            <label class="form-check-label" for="inlineRadio1">Sale</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="rent">
                                            <label class="form-check-label" for="inlineRadio2">Rent</label>
                                        </div>

                                        <input type="hidden" class="form-control" name="token" value="<?php echo $crfToken; ?>">

                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary mb-4">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <div class="submitLoader searchLoader" style="float: right; "></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php

require_once SYS_PATH . '/inc/footer.php';


?>
