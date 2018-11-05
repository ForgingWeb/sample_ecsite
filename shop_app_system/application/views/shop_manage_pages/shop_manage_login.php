 <?php
 
 $str = random_string('alpha', 3);
 $str .= random_string('alnum', 3);
 $input_hidden = form_hidden('str_org', $str);
 ?>
        <!-- contents -->
        <div class="my-3 my-md-5">
          <div class="container">
            <!-- div class="row" -->
        <!-- contents inner -->
              
                <?php echo form_open('/shop_manage/smg_product_registration/','class=card');?>
                  <div class="card-header">
                    <h3 class="card-title">ログイン</h3>
                  </div>
                  <div class="card-body">
                  <div class="form-group">
                      <!-- label class="form-label">ユーザー名</label -->
                      <!-- input class="form-control" placeholder="ユーザー名"/ -->
                      <div class="form-control"><?php echo $str; ?></div>
                      <?php echo $input_hidden; ?>
                    </div>
                    <div class="form-group">
                      <label class="form-label">上の文字列を入力してください。</label>
                      <!-- input type="password" class="form-control" value="password" / -->
                      <input class="form-control" name="str_input" placeholder=""/>
                    </div>
                    <div class="form-footer">
                      <button class="btn btn-primary btn-block">ログイン</button>
                    </div>
                    </div>
                </form>
              
            <!--end contents inner -->
          <!-- /div --><!-- row コメントアウト　-->
        </div>
      </div>
    </div>