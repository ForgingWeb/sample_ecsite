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
                    <a href="/CI_shop/shop_manage/shop_manage_top/" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link"><i class="fe fe-box"></i><i class="fe fe-file"></i> Interface</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
<?php endif; ?>
        <!-- end header -->