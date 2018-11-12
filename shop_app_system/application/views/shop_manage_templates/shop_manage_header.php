<body class="<?php echo $this_page; ?>">
    <div class="page">
      <div class="page-main">
        <!-- div class="header py-4">
          <div class="container">
                <?php //echo $title; ?>
          </div>
        </div -->
        <!-- header -->
<?php if($this_page != "shop_manage_login"): ?>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="/CI_shop/shop/shop_index/" class="nav-link"><i class="fe fe-home"></i> ECサイト</a>
                  </li>
                  <li class="nav-item">
                    <a href="/CI_shop/shop_manage/smg_product_list/" class="nav-link">　 商品一覧</a>
                  </li>
                  <li class="nav-item">
                    <a href="/CI_shop/shop_manage/smg_product_registration/" class="nav-link">　 新規商品追加</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
<?php endif; ?>
        <!-- end header -->