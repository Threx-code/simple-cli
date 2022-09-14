  <div class="header">
    <p class="errorResult"></p>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-9 col-sm-12 col-xs-12">
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form action="search" method="post" class="searchCodeForm">
                            <div class="input-group">
                                <input type="text" class="form-control search_input" name="search" placeholder="Enter your search" autofocus>
                            </div>

                             <input type="hidden" class="form-control" name="token" value="<?php echo $crfToken; ?>">
                            <img src="System/assets/images/search-grey.png" class="searchImg" style="position: relative; z-index: 10; float: right; margin-top: -30px; cursor: pointer;">
                            <input type="submit" style="display: none;" class="searchButton">
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".searchImg").on("click", function(){
            $(".searchButton").click();
        })
    })


    $( ".search_input" ).autocomplete({
        source: 'autocomplete.php'
    });
</script>
