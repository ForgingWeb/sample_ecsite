<?php if (!defined('BASEPATH')) exit ('NO direct script access allowed');

/**
 * @ccess public
 * @param integer
 * @return string
 */
/*cssパス作成*/
    function mk_css($this_page="",$asset_dir=array())
    {
      $page_plugin_css = <<<EOM
      <link href="{$asset_dir}plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
      <link href="{$asset_dir}plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
EOM;
      $theme_css = <<<EOM

      <link href="{$asset_dir}pages/css/components.css" rel="stylesheet">
      <link href="{$asset_dir}corporate/css/style.css" rel="stylesheet">
      <link href="{$asset_dir}pages/css/style-shop.css" rel="stylesheet" type="text/css">
      <link href="{$asset_dir}corporate/css/style-responsive.css" rel="stylesheet">
      <link href="{$asset_dir}corporate/css/themes/red.css" rel="stylesheet" id="style-color">
      <link href="{$asset_dir}corporate/css/custom.css" rel="stylesheet">

EOM;

      switch($this_page){
        case "shop_index":
        $page_plugin_css = <<<EOM
        <link href="{$asset_dir}pages/css/animate.css" rel="stylesheet">
        <link href="{$asset_dir}plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
        <link href="{$asset_dir}plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
EOM;

        $theme_css = <<<EOM

        <link href="{$asset_dir}pages/css/components.css" rel="stylesheet">
        <link href="{$asset_dir}pages/css/slider.css" rel="stylesheet">
        <link href="{$asset_dir}pages/css/style-shop.css" rel="stylesheet" type="text/css">
        <link href="{$asset_dir}corporate/css/style.css" rel="stylesheet">
        <link href="{$asset_dir}corporate/css/style-responsive.css" rel="stylesheet">
        <link href="{$asset_dir}corporate/css/themes/red.css" rel="stylesheet" id="style-color">
        <link href="{$asset_dir}corporate/css/custom.css?16" rel="stylesheet">

EOM;
        break;
        case "shop_shopping_cart":
        case "shop_search_result" :
        case "shop_item" :
        case "shop_product_list" :
        $page_plugin_css = <<<EOM
        <link href="{$asset_dir}plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
        <link href="{$asset_dir}plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
        <link href="{$asset_dir}plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
        <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"><!-- for slider-range -->
        <link href="{$asset_dir}plugins/rateit/src/rateit.css" rel="stylesheet" type="text/css">
      
EOM;

        break;
        case "shop_checkout":
        case "shop_standart_form":
        $page_plugin_css = <<<EOM
        <link href="{$asset_dir}plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
        <link href="{$asset_dir}plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
        <link href="{$asset_dir}plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
      
EOM;
        $theme_css = <<<EOM

        <link href="{$asset_dir}pages/css/components.css" rel="stylesheet">
        <link href="{$asset_dir}corporate/css/style.css" rel="stylesheet">
        <link href="{$asset_dir}pages/css/style-shop.css" rel="stylesheet" type="text/css">
        <link href="{$asset_dir}corporate/css/style-responsive.css" rel="stylesheet">
        <link href="{$asset_dir}corporate/css/themes/red.css" rel="stylesheet" id="style-color">
        <link href="{$asset_dir}corporate/css/custom.css" rel="stylesheet">

EOM;
        break;
        case "shop_account":

        break;
      }
                //*CSS設定*//
                $css;
                $css = <<<EOM
                
  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"><!--- fonts for slider on the index page -->  
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="{$asset_dir}plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="{$asset_dir}plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  {$page_plugin_css}
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
{$theme_css}
  <!-- Theme styles END -->
  
EOM;
		return $css;
    }
  /*js　パス作成*/
  function mk_page_js($this_page="",$asset_dir=array())
  {

    $this_page_js = <<<EOM

    <script src="{$asset_dir}plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="{$asset_dir}plugins/owl.carousel/owl.carousel.js" type="text/javascript"></script><!-- slider for products -->
    <script src='{$asset_dir}plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src="{$asset_dir}plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
    
    <script src="{$asset_dir}corporate/scripts/layout.js" type="text/javascript"></script>
    <script src="{$asset_dir}pages/scripts/bs-carousel.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initTwitter();
        });
    </script>
    
EOM;

switch($this_page){
  case "shop_account" :
  $this_page_js = <<<EOM

  <script src="{$asset_dir}plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
  <script src="{$asset_dir}plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->

  <script src="{$asset_dir}corporate/scripts/layout.js" type="text/javascript"></script>
  <script type="text/javascript">
      jQuery(document).ready(function() {
          Layout.init();    
          Layout.initOWL();
          Layout.initTwitter();
      });
</script>

EOM;
  break;
  case "shop_shopping_cart" :
  $this_page_js .= <<<EOM

  <script type="text/javascript">
  
  jQuery(document).ready(function() {
  $('.cart_k').on('change', function(event){
    n = $(this).val();
    target = $(this).attr('title');
    t = $("#"+target+"_price").text();
    $("#"+target+"_total").text(t * n);
    allt();

});
$('.del-goods').on('click', function(event){
  target = $(this).attr('id') + "_crm";
  $("#"+target).remove();

  allt();
});
function allt(){

  v=0;
  $(".c_total").each(function(i, o){
    v += Number($(o).text());
  });

  $("#total_all").text(v);
}
});

 </script>

EOM;
  break; 
  case "shop_shopping_cart_null" :
  $this_page_js = <<<EOM

  <script src="{$asset_dir}plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
  <script src="{$asset_dir}plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
  <script src='{$asset_dir}plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
  <script src="{$asset_dir}plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

  <script src="{$asset_dir}corporate/scripts/layout.js" type="text/javascript"></script>
  <script type="text/javascript">
      jQuery(document).ready(function() {
          Layout.init();    
          Layout.initOWL();
          Layout.initTwitter();
          Layout.initImageZoom();
          Layout.initTouchspin();
      });
  </script>

EOM;
  break;
  case "shop_checkout" :
  $this_page_js = <<<EOM

  <script src="{$asset_dir}plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
  <script src="{$asset_dir}plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
  <script src='{$asset_dir}plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
  <script src="{$asset_dir}plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
  <script src="{$asset_dir}plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

  <script src="{$asset_dir}corporate/scripts/layout.js" type="text/javascript"></script>
  <script src="{$asset_dir}pages/scripts/checkout.js" type="text/javascript"></script>
  <script type="text/javascript">
      jQuery(document).ready(function() {
          Layout.init();    
          Layout.initOWL();
          Layout.initTwitter();
          Layout.initImageZoom();
          Layout.initTouchspin();
          Layout.initUniform();
          Checkout.init();
      });
  </script>

EOM;
  break;
  case "shop_item" :
  $this_page_js = <<<EOM

  <script src="{$asset_dir}plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
  <script src="{$asset_dir}plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
  <script src='{$asset_dir}plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
  <script src="{$asset_dir}plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
  <script src="{$asset_dir}plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
  <script src="{$asset_dir}plugins/rateit/src/jquery.rateit.js" type="text/javascript"></script>

  <script src="{$asset_dir}corporate/scripts/layout.js" type="text/javascript"></script>
  <script type="text/javascript">
      jQuery(document).ready(function() {
          Layout.init();    
          Layout.initOWL();
          Layout.initTwitter();
          Layout.initImageZoom();
          Layout.initTouchspin();
          Layout.initUniform();
      });
  </script>

EOM;
  break;
  case "shop_product_list" :
  case "shop_search_result":
  case "shop_shopping_cart":
  $this_page_js = <<<EOM

  <script src="{$asset_dir}plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
  <script src="{$asset_dir}plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
  <script src='{$asset_dir}plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
  <script src="{$asset_dir}plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
  <script src="{$asset_dir}plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
  <script src="{$asset_dir}plugins/rateit/src/jquery.rateit.js" type="text/javascript"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script><!-- for slider-range -->

  <script src="{$asset_dir}corporate/scripts/layout.js" type="text/javascript"></script>
  <script type="text/javascript">
      jQuery(document).ready(function() {
          Layout.init();    
          Layout.initOWL();
          Layout.initTwitter();
          Layout.initImageZoom();
          Layout.initTouchspin();
          Layout.initUniform();
          Layout.initSliderRange();
      });
      </script>

EOM;
  break;
  case "shop_standart_forms":
  $this_page_js = <<<EOM

  <script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
  <script src="assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
  <script src='assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
  <script src="assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
  <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

  <script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>
  <script type="text/javascript">
      jQuery(document).ready(function() {
          Layout.init();    
          Layout.initOWL();
          Layout.initTwitter();
          Layout.initImageZoom();
          Layout.initTouchspin();
          Layout.initUniform();
      });
  </script>

EOM;
  break;


}

    return $this_page_js;
  }

  function mk_style_customizer($this_page="")
  {
    $CI =& get_instance();
    $manage_url = $CI->manage_url;
    //<!-- BEGIN STYLE CUSTOMIZER -->

    $html;
    $html = <<<EOM

    <!-- BEGIN STYLE CUSTOMIZER -->
    <div class="color-panel hidden-sm">
    <a href="{$manage_url}">
      <div class="color-mode-icons icon-color"></div>
      </a>
      <!-- div class="color-mode-icons icon-color-close"></div>
      <div class="color-mode">
        <p>THEME COLOR</p>
        <ul class="inline">
          <li class="color-red current color-default" data-style="red"></li>
          <li class="color-blue" data-style="blue"></li>
          <li class="color-green" data-style="green"></li>
          <li class="color-orange" data-style="orange"></li>
          <li class="color-gray" data-style="gray"></li>
          <li class="color-turquoise" data-style="turquoise"></li>
        </ul>
      </div -->
    </div>
    <!-- END BEGIN STYLE CUSTOMIZER --> 

EOM;

return $html;

  }
  function mk_topbar($this_page="",$this_shop_url="")
  {
    //<!-- BEGIN TOP BAR -->
    $html;
    $html = <<<EOM

    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-phone"></i><span>+1 456 6717</span></li>
                        <!-- BEGIN CURRENCIES -->
                        <li class="shop-currencies">
                            <a href="javascript:void(0);">€</a>
                            <a href="javascript:void(0);">£</a>
                            <a href="javascript:void(0);" class="current">$</a>
                        </li>
                        <!-- END CURRENCIES -->
                        <!-- BEGIN LANGS -->
                        <li class="langs-block">
                            <a href="javascript:void(0);" class="current">English </a>
                            <div class="langs-block-others-wrapper"><div class="langs-block-others">
                              <a href="javascript:void(0);">French</a>
                              <a href="javascript:void(0);">Germany</a>
                              <a href="javascript:void(0);">Turkish</a>
                            </div></div>
                        </li>
                        <!-- END LANGS -->
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <li><a href="{$this_shop_url}shop_account/">My Account</a></li>
                        <li><a href="{$this_shop_url}shop_wishlist/">My Wishlist</a></li>
                        <li><a href="{$this_shop_url}shop_checkout/">Checkout</a></li>
                        <li><a href="page_login/">Log In</a></li>
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->

EOM;

return $html;
}
  function mk_top_menu($asset_dir,$menu_ar,$this_shop_url)
  {
    //$menu_arからページトップのメニューを作成する。

    $html = "";
    $cnt = count($menu_ar); 
for($i=0;  $i < $cnt;$i++){//ルートカテゴリの数を繰り返す★１
  $id1 = $menu_ar[$i]["id"];
  $name1 = $menu_ar[$i]["name"];
  if(count($menu_ar[$i]) > 2){//中カテゴリがあればULを入れる 
    $html .= <<<EOM
  <li class="dropdown dropdown-megamenu" >
  <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="{$this_shop_url}shop_product_list/category/{$id1}">
EOM;
    $html .= $name1;
    
  $html .= <<<EOM
  </a>
    <ul class="dropdown-menu">
      <li>
        <div class="header-navigation-content">
          <div class="row">

EOM;
  }else{
    $html .= <<<EOM
  <li>
  <a href="{$this_shop_url}shop_product_list/category/{$id1}">
EOM;
    $html .= $name1;
    
  $html .= <<<EOM
  </a>

EOM;

  }
  if(count($menu_ar[$i])>2)
  {
  $coln = 12/(count($menu_ar[$i])-2);
  }
for($i2=0;  $i2 < (count($menu_ar[$i])-2);$i2++)
{//2番目のカテゴリの数を繰り返す★2:-2は、nameとidを引いている
  $id2 = $menu_ar[$i][$i2]["id"];
  $name2 = $menu_ar[$i][$i2]["name"];
  $html .= <<<EOM
          <div class="col-md-{$coln} header-navigation-col">
EOM;

            
            $html .= "<a href=\"{$this_shop_url}shop_product_list/category/{$id2} \">";
            $html .= "<h4>". $name2 ."</h4>";
            $html .= "</a>";
//3番目のカテゴリがあれば入れる
if(count($menu_ar[$i][$i2]) > 2){
            $html .= "<ul>";
for($i3=0; $i3 < (count($menu_ar[$i][$i2])-2); $i3++)//3番目
{
  $id3 = $menu_ar[$i][$i2][$i3]["id"];
  $name3 = $menu_ar[$i][$i2][$i3]["name"];

$html .= <<<EOM
              <li><a href="{$this_shop_url}shop_product_list/category/{$id3}">{$name3}</a></li>
EOM;

}//END ★3
$html .= "</ul>";
}

$html .= <<<EOM
          </div>
EOM;
}//END ★2
if(count($menu_ar[$i]) > 2){//中カテゴリがあるならば
  $html .= <<<EOM
          </div>
        </div>
      </li>
    </ul>
EOM;
}
$html .= <<<EOM
</li>
EOM;
}
//END ★1
    return $html;

  }

  function mk_header($this_page="",$asset_dir,$top_menu,$this_shop_url )
  {
    //<!-- BEGIN HEADER -->
    $html;
    $html = <<<EOM

    <!-- BEGIN HEADER -->
    <div class="header">
      <div class="container">
        <a class="site-logo" href="{$this_shop_url}shop_index/"><img src="{$asset_dir}corporate/img/logos/logo-shop-red.png" alt="Metronic Shop UI"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

    <div class="header_right">
        <div class="account_check">
        <!-- BEGIN Login -->
        <span>
        <a href="{$this_shop_url}shop_account/">My Account</a> | 
        <a href="">Log In</a>
        </span>　
        <!-- END Login -->

          <!-- div class="top-cart-info">
            <span>
                <a href="javascript:void(0);" class="top-cart-info-count">3 items</a>
                <a href="javascript:void(0);" class="top-cart-info-value">$1260</a>
            </span>
          </div -->
          </div>

        <!-- BEGIN CART -->
        <div class="top-cart-block">



          <i class="fa fa-shopping-cart"></i>
                        
          <div class="top-cart-content-wrapper">
            <div class="top-cart-content">
              <ul class="scroller" style="height: 250px;">
                <li>
                  <a href="{$this_shop_url}shop_item/"><img src="{$asset_dir}pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                  <span class="cart-content-count">x 1</span>
                  <strong><a href="{$this_shop_url}shop_item/">Rolex Classic Watch</a></strong>
                  <em>$1230</em>
                  <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                </li>
                <li>
                  <a href="{$this_shop_url}shop_item/"><img src="{$asset_dir}pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                  <span class="cart-content-count">x 1</span>
                  <strong><a href="{$this_shop_url}shop_item/">Rolex Classic Watch</a></strong>
                  <em>$1230</em>
                  <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                </li>
                <li>
                  <a href="{$this_shop_url}shop_item/"><img src="{$asset_dir}pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                  <span class="cart-content-count">x 1</span>
                  <strong><a href="{$this_shop_url}shop_item/">Rolex Classic Watch</a></strong>
                  <em>$1230</em>
                  <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                </li>
                <li>
                  <a href="{$this_shop_url}shop_item/"><img src="{$asset_dir}pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                  <span class="cart-content-count">x 1</span>
                  <strong><a href="{$this_shop_url}shop_item/">Rolex Classic Watch</a></strong>
                  <em>$1230</em>
                  <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                </li>
                <li>
                  <a href="{$this_shop_url}shop_item/"><img src="{$asset_dir}pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                  <span class="cart-content-count">x 1</span>
                  <strong><a href="{$this_shop_url}shop_item/">Rolex Classic Watch</a></strong>
                  <em>$1230</em>
                  <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                </li>
                <li>
                  <a href="{$this_shop_url}shop_item/"><img src="{$asset_dir}pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                  <span class="cart-content-count">x 1</span>
                  <strong><a href="{$this_shop_url}shop_item/">Rolex Classic Watch</a></strong>
                  <em>$1230</em>
                  <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                </li>
                <li>
                  <a href="{$this_shop_url}shop_item/"><img src="{$asset_dir}pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                  <span class="cart-content-count">x 1</span>
                  <strong><a href="{$this_shop_url}shop_item">Rolex Classic Watch</a></strong>
                  <em>$1230</em>
                  <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                </li>
                <li>
                  <a href="{$this_shop_url}shop_item/"><img src="{$asset_dir}pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                  <span class="cart-content-count">x 1</span>
                  <strong><a href="{$this_shop_url}shop_item/">Rolex Classic Watch</a></strong>
                  <em>$1230</em>
                  <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                </li>
              </ul>
              <div class="text-right">
                <a href="{$this_shop_url}shop_shopping_cart/" class="btn btn-default">View Cart</a>
                <!-- a href="{$this_shop_url}shop_checkout/" class="btn btn-primary">Checkout</a -->
              </div>
            </div>
          </div>            
        </div>
        <!--END CART -->

        </div>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation">
          <ul>
            {$top_menu}
            <!-- BEGIN TOP SEARCH -->
            <li class="menu-search">
              <span class="sep"></span>
              <i class="fa fa-search search-btn"></i>
              <div class="search-box">
                <form action="#">
                  <div class="input-group">
                    <input type="text" placeholder="Search" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                  </div>
                </form>
              </div> 
            </li>
            <!-- END TOP SEARCH -->
          </ul>
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->
 

EOM;

return $html;
}

function mk_sidebar($this_page,$menu_ar,$this_shop_url )
{
  $html;
  $html = <<<EOC

  <!-- BEGIN SIDEBAR -->
  <div class="sidebar col-md-3 col-sm-4">
    <ul class="list-group margin-bottom-25 sidebar-menu">
      
    
      <li class="list-group-item clearfix dropdown">
        <a href="{$this_shop_url}shop_product_list/">
          <i class="fa fa-angle-right"></i>
          Mens
          
        </a>
        <ul class="dropdown-menu">
          <li class="list-group-item dropdown clearfix">
            <a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> Shoes </a>
              <ul class="dropdown-menu">
                <li class="list-group-item dropdown clearfix">
                  <a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> Classic </a>
                  <ul class="dropdown-menu">
                    <li><a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> Classic 1</a></li>
                    <li><a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> Classic 2</a></li>
                  </ul>
                </li>
                <li class="list-group-item dropdown clearfix">
                  <a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> Sport  </a>
                  <ul class="dropdown-menu">
                    <li><a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> Sport 1</a></li>
                    <li><a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> Sport 2</a></li>
                  </ul>
                </li>
              </ul>
          </li>
          <li><a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> Trainers</a></li>
          <li><a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> Jeans</a></li>
          <li><a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> Chinos</a></li>
          <li><a href="{$this_shop_url}shop_product_list/"><i class="fa fa-angle-right"></i> T-Shirts</a></li>
        </ul>
      </li>
      
    </ul>
  </div>
  <!-- END SIDEBAR -->

EOC;
$html = <<<EOC

<!-- BEGIN SIDEBAR -->
  <ul class="list-group margin-bottom-25 sidebar-menu">
    
EOC;

$cnt = count($menu_ar); 
for($i=0;  $i < $cnt;$i++){//ルートカテゴリの数を繰り返す★１
  $id1 = $menu_ar[$i]["id"];
  $name1 = $menu_ar[$i]["name"];
    $html .= <<<EOM
    <li class="list-group-item clearfix dropdown">
    <a href="{$this_shop_url}shop_product_list/category/{$id1}">
      <i class="fa fa-angle-right"></i>{$name1}
  </a>
EOM;
   
  if(count($menu_ar[$i]) > 2){//中カテゴリがあればULを入れる  
  $html .= "<ul class=\"dropdown-menu\">";
  }
  
for($i2=0;  $i2 < (count($menu_ar[$i])-2);$i2++){//2番目のカテゴリの数を繰り返す★2:-2は、nameとidを引いている
  $id2 = $menu_ar[$i][$i2]["id"];
  $name2 = $menu_ar[$i][$i2]["name"];
  $html .= <<<EOM
          
    <li class="list-group-item dropdown clearfix">
    <a href="{$this_shop_url}shop_product_list/category/{$id1}"><i class="fa fa-angle-right"></i> {$name2} </a>
EOM;
//3番目のカテゴリがあれば入れる
if(count($menu_ar[$i][$i2]) > 2)
{
$html .= '<ul class="dropdown-menu">';
for($i3=0; $i3 < (count($menu_ar[$i][$i2])-2); $i3++)//3番目
{
  $id3 = $menu_ar[$i][$i2][$i3]["id"];
  $name3 = $menu_ar[$i][$i2][$i3]["name"];

$html .= <<<EOM
              <li><a href="{$this_shop_url}shop_product_list/category/{$id3}"><i class="fa fa-angle-right"></i> {$name3}</a></li>
EOM;
}//END ★3
$html .= '</ul>';
}

$html .= <<<EOM
          </li>
EOM;
}//END ★2

if(count($menu_ar[$i]) > 2)
{//中カテゴリがあるならばulで閉じる
  $html .= <<<EOM
    </ul>
</li>
EOM;
}
$html .= <<<EOM
</li>
EOM;
}
//END ★1


$html .= <<<EOC

</ul>
<!-- END SIDEBAR -->

EOC;

return $html;

}

function mk_sale_product($data_ar,$this_shop_url)
{
  //salのスライドショー
  //product_img_dir 
  $CI =& get_instance();
  $imgdir = $CI->product_img_dir;

    $html = "";
    for($i=0;$i<count($data_ar);$i++)
    {
      $id = $data_ar[$i]["id"];//id
      $name = $data_ar[$i]["name"];//商品名
      $listprice = number_format($data_ar[$i]["listprice"]);//値段
      $photoname = $data_ar[$i]["photoname"];//写真ファイル名

    $html .= <<<EOM
    <div>
    <div class="product-item">
      <div class="pi-img-wrapper">
      <a href="{$this_shop_url}shop_item/{$id}">
        <img src="{$imgdir}{$photoname}" class="img-responsive" alt="Berry Lace Dress">
      </a>
        <div>
          <a href="{$imgdir}{$photoname}" class="btn btn-default fancybox-button">Zoom</a>
          <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
        </div>
      </div>
      <h3><a href="{$this_shop_url}shop_item/{$id}">Berry Lace Dress</a></h3>
      <div class="pi-price">￥{$listprice}</div>
      <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
      <div class="sticker sticker-sale"></div>
    </div>
  </div>
EOM;
    }

    return $html;
}

function mk_content($data_ar,$this_shop_url)
{
  $CI =& get_instance();
  $imgdir = $CI->product_img_dir;
  $html = "";
  for($i=0;$i<count($data_ar);$i++)
  {
    $id = $data_ar[$i]["id"];//id
    $name = $data_ar[$i]["name"];//商品名
    $listprice = number_format($data_ar[$i]["listprice"]);//値段
    $photoname = $data_ar[$i]["photoname"];//写真ファイル名

  $html .= <<<EOM
  <div>
  <div class="product-item">
    <div class="pi-img-wrapper">
    <a href="{$this_shop_url}shop_item/{$id}">
      <img src="{$imgdir}{$photoname}" class="img-responsive" alt="Berry Lace Dress">
    </a>
      <div>
        <a href="/CI_shop/shop_assets/pages/img/products/k1.jpg" class="btn btn-default fancybox-button">Zoom</a>
        <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
      </div>
    </div>
    <h3><a href="{$this_shop_url}shop_item/{$id}">Berry Lace Dress</a></h3>
    <div class="pi-price">￥{$listprice}</div>
    <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
    <div class="sticker sticker-new"></div>
  </div>
</div>
EOM;
  }

  return $html;
}

function mk_more_products($data_ar,$this_shop_url)
{
  $CI =& get_instance();
  $imgdir = $CI->product_img_dir;

  

  $html="";

  for($i=0;$i<count($data_ar);$i++)
  {
    $id = $data_ar[$i]["id"];//id
    $name = $data_ar[$i]["name"];//商品名
    $listprice = number_format($data_ar[$i]["listprice"]);//値段
    $photoname = $data_ar[$i]["photoname"];//写真ファイル名

  $html .= <<<EOM

  <div>
    <div class="product-item">
      <div class="pi-img-wrapper">
      <a href="{$this_shop_url}shop_item/{$id}">
        <img src="{$imgdir}{$photoname}" class="img-responsive" alt="Berry Lace Dress">
        </a>
        <div>
          <a href="/CI_shop/shop_assets/pages/img/products/k4.jpg" class="btn btn-default fancybox-button">Zoom</a>
          <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
        </div>
      </div>
      <h3><a href="shop_item">Berry Lace Dress</a></h3>
      <div class="pi-price">￥{$listprice}</div>
      <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
      <!-- div class="sticker sticker-new"></div -->
    </div>
  </div>

EOM;
  }

return $html;
}

function mk_bestsellers($data_ar,$this_shop_url)
{
  $CI =& get_instance();
  $imgdir = $CI->product_img_dir;

  $html="";
 
  for($i=0;$i<count($data_ar);$i++)
  {
    $id = $data_ar[$i]["id"];//id
    $name = $data_ar[$i]["name"];//商品名
    $listprice = number_format($data_ar[$i]["listprice"]);//値段
    $photoname = $data_ar[$i]["photoname"];//写真ファイル名
    $text_overview = $data_ar[$i]["text_overview"];//写真ファイル名

  $html .= <<<EOM

  <div class="item">
  <a href="{$this_shop_url}shop_item/{$id}"><img src="{$imgdir}{$photoname}" alt="Some Shoes in Animal with Cut Out"></a>
  <h3><a href="shop_item">{$text_overview}</a></h3>
  <div class="price">￥{$listprice}</div>
</div>

EOM;
  }

  return $html;
}

function mk_bestsellers_mobile($data_ar,$this_shop_url)
{
  $CI =& get_instance();
  $imgdir = $CI->product_img_dir;

  $html="";
  for($i=0;$i<count($data_ar);$i++)
  {
    $id = $data_ar[$i]["id"];//id
    $name = $data_ar[$i]["name"];//商品名
    $listprice = number_format($data_ar[$i]["listprice"]);//値段
    $photoname = $data_ar[$i]["photoname"];//写真ファイル名

  $html .= <<<EOM

  <div>
  <div class="product-item">
    <div class="pi-img-wrapper">
  <a href="{$this_shop_url}shop_item/{$id}"><img src="{$imgdir}{$photoname}" alt="Some Shoes in Animal with Cut Out"></a>
    </div>
  <h3><a href="shop_item">Some Shoes in Animal with Cut Out</a></h3>
  <div class="pi-price">￥{$listprice}</div>
    <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
</div>
</div>

EOM;
  }

  return $html;
}

function mk_mainphotos($detail_ar,$asset_dir)
{
  $CI =& get_instance();
  $imgdir = $CI->product_img_dir;

  $html="";
  $i=0;
  $photonames_main = array(
                          $detail_ar[$i]["photoname"],
                          $detail_ar[$i]["photo_other_01"],
                          $detail_ar[$i]["photo_other_02"],
                          $detail_ar[$i]["photo_other_03"],
                          $detail_ar[$i]["photo_other_04"],
                          $detail_ar[$i]["photo_other_05"]
                      );
$cnt = count($photonames_main);
$f = false;
for($i=0;$i<$cnt;$i++)
{
  $filename = $photonames_main[$i];
  if($filename == null){continue;}
  if($i == 0)
  {
  $html .= <<<EOM
  <div class="product-main-image">
  <img src="{$imgdir}{$filename}" alt="Cool green dress with red bell" class="img-responsive" data-BigImgsrc="{$imgdir}{$filename}">
  </div>
EOM;
  }

  if($i==1)
  {
  $html .= "<div class=\"product-other-images\">";
  $f = true;
  }

  if($i >= 1)
  {
  $html .= "<a href=\"{$imgdir}{$filename}\" class=\"fancybox-button\" rel=\"photos-lib\"><img alt=\"Berry Lace Dress\" src=\"{$imgdir}{$filename}\"></a>";
  }

}

if($f){
 $html .= "</div>";
}

return $html;

}

function mk_reviews()
{
  $html="";
  $name = "松本";
  $date_time = "30/12/2013 - 07:37";
  $rate = 4;//★の数
  $text = "Sed velit quam, auctor id semper a, hendrerit eget justo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis vel arcu pulvinar dolor tempus feugiat id in orci. Phasellus sed erat leo. Donec luctus, justo eget ultricies tristique, enim mauris bibendum orci, a sodales lectus purus ut lorem.";
  
  for($i=0;$i<4;$i++)
  {
  $html .= <<<EOM

  <div class="review-item clearfix">
  <div class="review-item-submitted">
    <strong>{$name}</strong>
    <em>{$date_time}</em>
    <div class="rateit" data-rateit-value="{$rate}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
  </div>                                              
  <div class="review-item-content">
      <p>{$text}</p>
  </div>
</div>

EOM;
  }

return $html;

}

function mk_price($val){
$html = "";
$html .= <<<EOM
<div class="price">
<strong><span>￥</span>$val</strong>
<!-- em>￥<span>6,200</span></em -->
</div>

EOM;

return $html;
}