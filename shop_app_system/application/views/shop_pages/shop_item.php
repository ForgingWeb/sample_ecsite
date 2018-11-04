
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="shop_index/">Home</a></li>
            <li><a href="">Store</a></li>
            <li class="active">Cool green dress with red bell</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-5">
          <?php
        //<!-- BEGIN SIDEBAR -->
        print $sidebar;
        ?>

            <div class="sidebar-products clearfix">
              <h2>Bestsellers</h2>
              <?php print $bestsellers; ?>
            </div>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <div class="product-page">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                <?php
                print $mainphotos;
                ?>
                </div>
                <div class="col-md-6 col-sm-6">
                  <h1>Cool green dress with red bell</h1>
                  <div class="price-availability-block clearfix">
                    <?php
                    print $price;
                    ?>
                    <div class="availability">
                      Availability: <strong>In Stock</strong>
                    </div>
                  </div>
                  <div class="description">
                    <p><?php print $text_overview; ?></p>
                  </div>
                  <div class="product-page-options">
                    <div class="pull-left">
                      <label class="control-label">Size:</label>
                      <select name="size" class="form-control input-sm">
                        <?php print $pull_sizes; ?>
                      </select>
                    </div>
                    <div class="pull-left">
                      <label class="control-label">Color:</label>
                      <select name="color" class="form-control input-sm">
                        <?php print $pull_colors; ?>
                      </select>
                    </div>
                  </div>
                  <div class="product-page-cart">
                    <div class="product-quantity">
                        <input id="product-quantity" name="number" type="text" value="1" readonly class="form-control input-sm">
                    </div>
                    <button class="btn btn-primary" type="submit">Add to cart</button>
                  </div>
                  <div class="review">
                    <input type="range" value="<?php print $avarage ?>" step="0.25" id="backing4" readonly="readonly">
                    <div class="rateit" data-rateit-backingfld="#backing4" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                    </div>
                    <a href="javascript:;">7 reviews</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:;">Write a review</a>
                  </div>
                  <ul class="social-icons">
                    <li><a class="facebook" data-original-title="facebook" href="javascript:;"></a></li>
                    <li><a class="twitter" data-original-title="twitter" href="javascript:;"></a></li>
                    <li><a class="googleplus" data-original-title="googleplus" href="javascript:;"></a></li>
                    <li><a class="evernote" data-original-title="evernote" href="javascript:;"></a></li>
                    <li><a class="tumblr" data-original-title="tumblr" href="javascript:;"></a></li>
                  </ul>
                </div>

                <div class="product-page-content">
                  <ul id="myTab" class="nav nav-tabs">
                    <li><a href="#Description" data-toggle="tab">Description</a></li>
                    <?php
                    ###############Informationは非表示
                    ?>
                    <!-- li><a href="#Information" data-toggle="tab">Information</a></li -->
                    <li class="active"><a href="#Reviews" data-toggle="tab">Reviews <?php $reviews_cnt ?> ></a></li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade" id="Description">
                      <p><?php print $text_etailed; ?></p>
                    </div>
                    <!-- div class="tab-pane fade" id="Information">
                    <?php
                    ###############Informationは非表示
                    ?>
                      <table class="datasheet">
                        <tr>
                          <th colspan="2">Additional features</th>
                        </tr>
                        <tr>
                          <td class="datasheet-features-type">Value 1</td>
                          <td>21 cm</td>
                        </tr>
                        <tr>
                          <td class="datasheet-features-type">Value 2</td>
                          <td>700 gr.</td>
                        </tr>
                        <tr>
                          <td class="datasheet-features-type">Value 3</td>
                          <td>10 person</td>
                        </tr>
                        <tr>
                          <td class="datasheet-features-type">Value 4</td>
                          <td>14 cm</td>
                        </tr>
                        <tr>
                          <td class="datasheet-features-type">Value 5</td>
                          <td>plastic</td>
                        </tr>
                      </table>
                    </div -->
                    <div class="tab-pane fade in active" id="Reviews">
                      <!--<p>There are no reviews for this product.</p>-->
                      <?php
                      print $reviews;
                      ?>

                      <!-- BEGIN FORM-->
                      <form action="#" class="reviews-form" role="form" method="post">
                        <h2>Write a review</h2>
                        <div class="form-group">
                          <label for="name">Name <span class="require">*</span></label>
                          <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <!-- div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" id="email">
                        </div -->
                        <div class="form-group">
                          <label for="review">Review <span class="require">*</span></label>
                          <textarea class="form-control" rows="8" id="review"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="email">Rating</label>
                          <input type="range" value="4" step="0.25" id="backing5">
                          <div class="rateit" data-rateit-backingfld="#backing5" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                          </div>
                        </div>
                        <div class="padding-top-20">                  
                          <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                      </form>
                      <!-- END FORM--> 
                    </div>
                  </div>
                </div>

                <div class="sticker sticker-sale"></div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN SIMILAR PRODUCTS -->
        <!-- モバイルの時だけ表示する -->
        
        <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
              <h2>Bestsellers</h2>
        <div class="owl-carousel owl-carousel4">

              <?php print $bestsellers_mobile; ?>
              

            </div>
            </div>
        </div>
        <!-- END　モバイルの時だけ表示する -->

        <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
            <h2>Most popular products</h2>
            <div class="owl-carousel owl-carousel4">
              <?php
              print $more_products;
              ?>

            </div>
          </div>
        </div>
        <!-- END SIMILAR PRODUCTS -->
      </div>
    </div>

    <!-- BEGIN BRANDS -->
    <div class="brands">
      <div class="container">
            <div class="owl-carousel owl-carousel6-brands">
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/canon.jpg" alt="canon" title="canon"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/esprit.jpg" alt="esprit" title="esprit"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/gap.jpg" alt="gap" title="gap"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/next.jpg" alt="next" title="next"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/puma.jpg" alt="puma" title="puma"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/zara.jpg" alt="zara" title="zara"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/canon.jpg" alt="canon" title="canon"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/esprit.jpg" alt="esprit" title="esprit"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/gap.jpg" alt="gap" title="gap"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/next.jpg" alt="next" title="next"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/puma.jpg" alt="puma" title="puma"></a>
              <a href="shop_product_list"><img src="/CI_shop/shop_assets/pages/img/brands/zara.jpg" alt="zara" title="zara"></a>
            </div>
        </div>
    </div>
    <!-- END BRANDS -->

    <!-- BEGIN STEPS -->
    <div class="steps-block steps-block-red">
      <div class="container">
        <div class="row">
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-truck"></i>
            <div>
              <h2>Free shipping</h2>
              <em>Express delivery withing 3 days</em>
            </div>
            <span>&nbsp;</span>
          </div>
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-gift"></i>
            <div>
              <h2>Daily Gifts</h2>
              <em>3 Gifts daily for lucky customers</em>
            </div>
            <span>&nbsp;</span>
          </div>
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-phone"></i>
            <div>
              <h2>477 505 8877</h2>
              <em>24/7 customer care available</em>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END STEPS -->
