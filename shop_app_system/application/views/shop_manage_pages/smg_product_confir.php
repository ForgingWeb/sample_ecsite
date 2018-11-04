<?php
/* 
           echo "<br>商品の名前:" . $productname."<br>";//商品の名前
            echo "商品の値段:" . $price."<br>";//商品の値段
            echo "カテゴリ１のid:" . $role0_id."<br>";//カテゴリ１のid
            echo "カテゴリ２のid:" . $role1_id."<br>";//カテゴリ２のid
            echo "カテゴリ３のid:" . $role2_id."<br>";//カテゴリ３のid
                
            echo "商品の概要:" . $text_overview."<br>";//商品の概要
            echo "商品の詳細:" . $text_etailed."<br>";//商品の詳細
            echo "メインにするカラー:" . $maincolor."<br>";//

            foreach($color_data_ar as $key => $val)
            {
                $color_id[$key] = $val["color_id"];//=> string(1) "2" 
                $photoname[$key] = $val["photoname"];//=> string(36) "28c60c45d533a3071d4f53115f9ac019.jpg" 
                $size_id[$key] = $val["size_id"];//=> int(2) 
                $stock_num[$key] = $val["stock_num"];//=> string(1) "7" } 
            }

            if(count($photo_other_upnames) > 0)
            {
                foreach($photo_other_upnames as $key => $val)
                {
                    $photo_other_upnames[$key] = $val;
                }
            }
           $data[$color_data_ar];
            var_dump($color_data_ar);
            print "sucsess";
            exit;
*/
//input hiddenの作成

$hidden_arr["productname"]= $productname;//商品の名前
$hidden_arr["price"] = $price;//商品の値段
$hidden_arr["role0_id"] =  $role0_id;//カテゴリ１のid
$hidden_arr["role1_id"] = $role1_id;//カテゴリ２のid
$hidden_arr["role2_id"] = $role2_id;//カテゴリ３のid
$hidden_arr["text_overview"] = $text_overview;//商品の概要
$hidden_arr["text_etailed"] = $text_etailed;//商品の詳細
$hidden_arr["maincolor"] = $maincolor;

$i=0;
foreach($color_data_ar as $key1 => $val_ar)
{
  $name = "color_".$i;
  $color_id = $val_ar["color_id"];
  $hidden_arr[$name] = $color_id;
  $name = "color_".$i."_photoname";
  $photoname = $val_ar["photoname"];
  $hidden_arr[$name]=$photoname;
  $n=0;
    foreach($val_ar["stock_num_ar"] as $key2 => $val_ar2)
    {          
      $name = "color_".$i."_".$n."_sizeid";
      $size_id = $val_ar2["size_id"];//
      $hidden_arr[$name] = $size_id;

      $name = "color_".$i."_".$n."_stocknum";
      $stocknum = $val_ar2["stock_num"];
      $hidden_arr[$name] = $stocknum;
      $n++;
    }
    $i++;
}
$icnt = $i;
if(count($photo_other_upnames) > 0)
{
    foreach($photo_other_upnames as $key => $val)
    {
        $photo_other_upnames[$key] = $val;

        $name = "photo_other_upnames[]";
        $photoname = $val;
        $hidden_arr[$name] = $photoname;
    }
}
?>

<!-- contents -->
<div class="my-3 my-md-5">
          <div class="container">
            <!-- div class="row" -->
        <!-- contents inner -->

              <div class="col-12">
                <?php echo form_open('/shop_manage/smg_product_exe/','class=card');?>
                  <div class="card-header">
                    <h3 class="card-title">商品の登録の確認</h3>
                  </div>
                  <div class="card-body">
                          <div class="form-group">
                              <label class="form-label">商品名</label>
                              <div class="form-control"><?php echo $productname; ?></div>
                          </div>
                          <div class="form-group">
                              <label class="form-label">価格</label>

                              <div class="form-control">
                                <span class="">￥</span><?php echo $price; ?>
                              </div>

                          </div>

                          <div class="row">
                            
                              <div class="col-sm-4 col-md-4">

                                <div class="form-group">
                                      <label class="form-label">カテゴリ 1 </label>
                                      <div class="form-control"><?php
                                      $table = "categories";
                                      $id = $role0_id;
                                      $column = "category_name";
                                      $category = $this->shop_model->get_value_one_column($table,$id,$column);
                                      echo $category; ?></div>
                                </div>

                              </div>

                              <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">カテゴリ 2 </label>
                                    <div class="form-control"><?php
                                      $table = "categories";
                                      $id = $role1_id;
                                      $column = "category_name";
                                      $category = $this->shop_model->get_value_one_column($table,$id,$column);
                                      echo $category; ?></div>
                                </div>
                              </div>

                              <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">カテゴリ 3 </label>
                                    <div class="form-control"><?php
                                      $table = "categories";
                                      $id = $role2_id;
                                      $column = "category_name";
                                      $category = $this->shop_model->get_value_one_column($table,$id,$column);
                                      echo $category; ?></div>
                                </div>
                              </div> 
                              
                          </div> 

                        <div class="form-group">
                        <label class="form-label">商品の説明：概要 <!-- span class="form-label-small">56/100</span --></label>
                         <div class="form-control"><?php echo $text_overview; ?></div>
                        </div>
                        <div class="form-group">
                          <label class="form-label">商品の説明：詳細 <!-- span class="form-label-small">56/100</span --></label>
                         <div class="form-control"><?php echo $text_etailed; ?></div>
                        </div>            

                      
                  </div>
                  <div class="card-header">
                    <h3 class="card-title">色別の在庫数</h3>
                  </div>
                  <div class="card-body">
<!--　以下縦に５並ぶ1 -->
  <?php 
  $i=0;
  foreach($color_data_ar as $key1 => $val_ar): 
  ?>
    <div class="card-body">
      <div class="row color_unit">
                      <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                          <label class="form-label">色の選択 <?php echo $i+1 ?></label>
                          <div class="form-control">
                          <?php
                                     $table = "products_colors";
                                      $id = $val_ar["color_id"];
                                      $column = "color_name";
                                      $colorname = $this->shop_model->get_value_one_column($table,$id,$column);
                                      echo $colorname; ?>
                          </div>
                        </div>
                      </div><!-- end "col-sm-3 col-md-3" -->
                          
                      <div class="col-sm-5 col-md-5">
                        <div class="form-group">
                          <label class="form-label">色別の写真 <?php echo $i+1; ?></label>
                            
                                <div class="form-control"><?php 
                                $image_properties = array(
                                  'src'   => $this->tmp_url."/".$val_ar["photoname"],
                                  'alt'   => '',
                                  'class' => '',
                                  'height'=> '200',
                                  'title' => '',
                                  );
                                  echo img($image_properties);
                                
                                ?>
                                </div>

                            <?php 
                            if($maincolor == "color_{$i}"){
                            echo '<div class="form-control">※ この画像を商品のメイン画像にします。</div>';
                            }
                            ?>
                            
                         
                        </div>
                      </div><!-- end "col-sm-5 col-md-5" -->
                          
                      <div class="col-sm-4 col-md-4 siz_stock_units">
                        
                        <div class="siz_stock_unit"><!-- begin siz_stock_units -->
                              <?php 
                              $n = 0;
                                  foreach($val_ar["stock_num_ar"] as $key2 => $val_ar2):
                                  $size_id = $val_ar2["size_id"];
                                  $stock_num = $val_ar2["stock_num"];
                              ?>

                              <div class="form-group">
                                  <?php if($n == 0): ?>
                                    <label class="form-label">サイズ別の在庫数 <?php echo $i+1; ?></label>
                                  <?php endif; ?>
                                  <div class="form-control">
                                    <span class="sizes">
                                      <?php 
                                            $table = "sizes";
                                            $id = $size_id;
                                            $column = "name";
                                            $sizename = $this->shop_model->get_value_one_column($table,$id,$column);
                                            echo $sizename; ?>
                                  
                                    </span>
                                    <span><?php echo $stock_num; ?></span>
                                  </div>
                              </div>
                              <?php 
                              $n++;
                              endforeach; 
                              ?>
                        </div><!-- endsiz_stock_units -->
                      </div><!-- "col-sm-4 col-md-4 siz_stock_units" -->
                      
                     
</div> <!-- ends row color_units --> 
</div>
<?php 
$i++;
endforeach; ?> 

</div><!-- end card-body -->
                          <!-- end1-->
                    

                  <div class="card-header">
                    <h3 class="card-title">補足写真（モデル別・シーン別の画像等）</h3>
                  </div>
                  <div class="card-body">
                  <div class="row">


                  <?php 
                    if(count($photo_other_upnames) > 0):
                      foreach($photo_other_upnames as $key => $val):
                        //for($i=0;$i<$other_photo_num;$i++):
                  ?>
                    <div class="col-sm-4 col-md-4">
                      <div class="">
                        <div>
                            <?php 
                                  $image_properties = array(
                                    'src'   => $this->tmp_url."/".$val,
                                    'alt'   => '',
                                    'class' => '',
                                    'height'=> '200',
                                    'title' => '',
                            );
                            echo img($image_properties);
                            ?>
                          </div>
                      </div>

                    </div>
                  <?php 
                  endforeach;
                  endif;
                  ?>



</div>
</div>
<?php
echo form_hidden($hidden_arr);
?>

                    <div class="card-footer text-right">
                      <div class="d-flex">
                        <a href="javascript:void(0)" class="btn btn-link" id="back"> 戻る </a> 

                        <button type="submit" class="btn btn-primary ml-auto">登 録</button>
                      </div>
                     </div>

                 
                </form>
              
            <!--end contents inner -->
          <!-- /div --><!-- row コメントアウト　-->
        </div>
      </div>
    </div>
    <div id="hidden_form">
<?php

 echo form_open('');
 
$hidden_arr["flag"] = "repage";
echo form_hidden($hidden_arr);
  echo form_submit('mysubmit', 'Submit Post!','id="repage"');

?>
</form>
<script>
  document.getElementById("back").onclick = function() {
    document.getElementById("repage").click();
};
</script>
    </div>