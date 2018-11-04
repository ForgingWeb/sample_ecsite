<?php

  ########### バリデーションエラーが起きたときの対応
  $role0_id = $role1_id = $role2_id = "" ;
  $flag = $this->input->post("productname");
  $role0_id = "";//カテゴリ１のid
  $role1_id = "";//カテゴリ２のid
  $role2_id = "";//カテゴリ３のid
  $select_1_idname = $select_2_idname = "";
  if (isset($flag)){
  $role0_id = $this->input->post("role0_id");//カテゴリ１のid
  $role1_id = $this->input->post("role1_id");//カテゴリ２のid
  $role2_id = $this->input->post("role2_id");//カテゴリ３のid
  }
            //$css = 'class="form-control"';
            $colornum = $this->colornum;//選択できる色数
            $sizenum = $this->sizenum;//選択できるサイズ数
            $other_photo_num = $this->other_photo_num;//補足写真として選択できる数
            $c0_select = "";
            $c1_select = "<div id=\"1_default\" class=\"form-control\"> カテゴリ 1 を選択してください。 </div>";
            $c2_select = "<div id=\"2_default\" class=\"form-control\"> カテゴリ 2 を選択してください。 </div>";
            $control_css = "<style>\n";
            $non["non"] = "ーー";
            #カテゴリ1のフォーム作成
            foreach($category_options[0] as $key => $val){
                $id = $val["id"];
                $name =  $val["name"];
                $ar[$id] = $name;
            }
              $css = 'class="form-control" id="role0_id"';
              $c0_select .= form_dropdown('role0_id', $non+$ar, $role0_id,$css);
              $ar=$ar1=array();

              #カテゴリ2のフォーム作成
            foreach($category_options[1] as $key1 => $val){
              $id = $val["id"];
              $name =  $val["name"];
              $parent_id = $val["parent_id"];
              $ar[$parent_id][$id] = $name;
            }
            foreach($ar as $pid => $val_ar){
              $selected = "";
              foreach($val_ar as $key => $val )
              {
              $id = $key;
              $name =  $val;
              $ar1[$id] = $name;
              }
              $input_name = "-";
              $c_idname = "a{$pid}_chaild";
              if($pid == $role0_id){
                $selected = $role1_id;
                $input_name = "role1_id";
                $select_1_idname = $c_idname;
              }
              $control_css .= "#a{$pid}_chaild{display:none;}";
                $css = "id=\"$c_idname\" class=\"ct2 orm-control custom-select\" ";
                $c1_select .= form_dropdown($input_name, $non+$ar1 ,$selected,$css );
                $c1_select .= "\n";
                $ar1=array();
            }
 
            $ar=$ar1=array();

            #カテゴリ3のフォーム作成
            foreach($category_options[2] as $key1 => $val){
              $id = $val["id"];
              $name =  $val["name"];
              $parent_id = $val["parent_id"];
              $ar[$parent_id][$id] = $name;
            }
            foreach($ar as $pid => $val_ar){
              $selected = "";
              foreach($val_ar as $key => $val )
              {
              $id = $key;
              $name =  $val;
              $ar2[$id] = $name;
              }
              
              $input_name = "-";
              $c_idname = "b{$pid}_chaild";
              if($pid == $role1_id){
                $selected = $role2_id;
                $input_name = "role2_id";
                $select_2_idname = $c_idname;
              }
              $control_css .= "#b{$pid}_chaild{display:none;}";
                $css = "id=\"{$c_idname}\" class=\"ct3 orm-control custom-select\" ";
                $c2_select .= form_dropdown($input_name, $non+$ar2 ,$selected,$css);
                $ar2=array();
            }

            $control_css .= "\n</style>\n";
?>
  <?php echo $control_css; ?>

<!-- contents -->
<div class="my-3 my-md-5">
          <div class="container">
            <!-- div class="row" -->
        <!-- contents inner -->

              <div class="col-12">
                <?php echo form_open_multipart('/shop_manage/smg_product_confir/','class=card');?>
                  <div class="card-header">
                    <h3 class="card-title">商品の登録</h3>
                  </div>
                  <div class="card-body">
<script>
  requirejs(['jquery'], function( jq ) {
    categori2="a";
        $('select#role0_id').change(function() {
        var thisid = $('#role0_id option:selected').val();

        var target = "a" + thisid + "_chaild";
        var keyid = "#1_default";
        var n = "2";
        categori2 = target;
        set_category(target,keyid,n);
        });

        $('select.ct2').change(function() {
        var idname = $(this).attr("id");
        var thisid = $('#'+idname+' option:selected').val();

        var target = "b" + thisid + "_chaild";
        var keyid = "#2_default";
        var n = "3";
        set_category(target,keyid,n);
        });
        
        $("input.photo").change(function () {
          
          var image_ = $(this).prop('files')[0]; 
          try {
          $(this).parent().find(".filename").text(image_.name);
          } catch (error) {
          $(this).parent().find(".filename").text("画像選択");
          } 
        });
        function set_category(target,keyid,n){
            $(".ct"+n+".orm-control").each(function() {
                idname = $(this).attr('id');
                $(keyid).css("display","none");
                if(idname != target)
                {
                  $(this).css("display","none");
                  $(this).attr('name', '-');

                }else if(idname == target)
                {
                  $("#"+target).css("display","block");
                  t=n-1;
                  $(this).attr('name', "role"+t+"_id");
                }
            });
            if($("#"+target).length != 1){
              $(keyid).css("display","block");
              $(keyid).text("カテゴリ"+n+"は設定されていません。");
            }
         }
<?php
if($select_2_idname != "")
{
echo <<<EOM

$("#1_default").css("display","none");
$("#2_default").css("display","none");
$("#{$select_1_idname}").css("display","block");
$("#{$select_2_idname}").css("display","block");

EOM;

}
?>
});
</script>

                          <div class="form-group">
                              <label class="form-label">商品名入力</label>
                              <?php echo form_error('productname'); ?>
                              <input class="form-control name" placeholder="商品名" name="productname" value="<?php echo set_value('productname'); ?>" />
                          </div>
                          <div class="form-group">
                              <label class="form-label">価格入力</label>
                              <?php echo form_error('price'); ?>
                              <div class="input-group yen">
                              <span class="input-group-prepend">
                                <span class="input-group-text">￥</span>
                              </span>
                              <input type="number" class="form-control" name="price" value="<?php echo set_value('price'); ?>" />
                              </div>
                          </div>

                          <div class="row">
                            
                              <div class="col-sm-4 col-md-4">

                                <div class="form-group">
                                      <label class="form-label">カテゴリ 1 の選択</label>
                                     <?php echo form_error('role0_id'); ?>
                                      <?php echo $c0_select; ?>
                                </div>

                              </div>

                              <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">カテゴリ 2 の選択</label>
                                     <?php 
                                     if(isset($error["role1_id"]))
                                     {
                                       echo $error["role1_id"];
                                     }
                                     echo form_error('role1_id'); ?>
                                    <?php echo $c1_select; ?>
                                </div>
                              </div>

                              <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">カテゴリ 3 の選択</label>
                                     <?php
                                     if(isset($error["role2_id"]))
                                     {
                                       echo $error["role2_id"];
                                     }
                                      echo form_error('role2_id'); ?>
                                    <?php echo $c2_select; ?>
                                </div>
                              </div> 
                              
                          </div> 

                        <div class="form-group">
                        <label class="form-label">商品の説明：概要の入力 <!-- span class="form-label-small">56/100</span --></label>
                        <?php echo form_error('text_overview'); ?>
                        <textarea class="form-control" name="text_overview" rows="6"><?php echo set_value('text_overview'); ?></textarea>
                        </div>
                        <div class="form-group">
                          <label class="form-label">商品の説明：詳細の入力 <!-- span class="form-label-small">56/100</span --></label>
                          <?php echo form_error('text_etailed'); ?>
                          <textarea class="form-control" name="text_etailed" rows="6"><?php echo set_value('text_etailed'); ?></textarea>
                        </div>            

                      
                  </div>
                  <div class="card-header">
                    <h3 class="card-title">色別の在庫数の入力（５色まで選択できます。）</h3>
                  </div>
                  <div class="card-body">
<!--　以下縦に５並ぶ1 -->
<div class="row color_units"><!-- begin color_units -->
  <?php for($i=0;$i<$colornum; $i++): ?>
<div class="card-body">
  <div class="row color_unit">
                      <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                          <label class="form-label">色の選択 <?php echo $i+1 ?></label>
                          <?php
                          $tagname = "color_{$i}";
                           ?>
                          <?php
                          $css = "class=\"orm-control custom-select\" ";
                          $tagname = "color_{$i}";
                          $selected = set_value($tagname);
                          $color_select = form_dropdown($tagname, $color_ar ,$selected,$css);
                          echo $color_select;
                          if($i==0)
                          {
                            echo "<div class=\"attention\">色は必ず選択してください。</div>";
                            echo form_error($tagname);
                          }
                          
                          ?>
                        </div>
                      </div>
                          
                      <div class="col-sm-5 col-md-5">
                        <div class="form-group">
                          <label class="form-label">色別に写真をアップロード</label>
                        <?php 
                        if($i==0){
                          if(isset($error["this_photo_err"]) and ($error["this_photo_err"] != "")){
                            echo "<div class=\"invalid-feedback\">".$error["this_photo_err"]."</div>";
                          }
                        }
                        ?>
                            <div class="custom-file">
                          <?php
                          $op = array(
                                'type'         => "file",
                                'name'          => "color_photo_". $i,
                                'class' => 'custom-file-input photo',
                                'accept' => 'image/jpeg,image/png',
                                );
                                echo form_input($op);
                            ?>
                            <label class="custom-file-label filename">画像選択</label>
                        </div>
                          <label class="custom-control custom-radio custom-control-inline">
                          <?php if(($i==0) && (! isset($maincolor))):
                                 if(isset($flag)): ?>
                                <input type="radio" class="custom-control-input" name="maincolor" value="color_<?php echo $i; ?>" checked="checked">
                                <?php elseif(isset($maincolor)): ?>
                                <input type="radio" class="custom-control-input" name="maincolor" value="color_<?php echo $i; ?>" checked="checked" >
                                <?php else: ?>
                                <input type="radio" class="custom-control-input" name="maincolor" value="color_<?php echo $i; ?>">
                                <?php endif; ?>
                          <?php else: ?>
                            <input type="radio" class="custom-control-input" name="maincolor" value="color_<?php echo $i; ?>" <?php echo  set_radio('maincolor', 'color_'.$i); ?>" >
                          <?php endif; ?>
                            <span class="custom-control-label">この画像を商品のメイン画像に指定する。</span>
                          </label>
                        </div>
                      </div>
                          
                      <div class="col-sm-4 col-md-4 siz_stock_units">
                        
                        <div class="siz_stock_unit"><!-- begin siz_stock_units -->
<?php for($i2=0;$i2 < $sizenum;$i2++): ?>

                            <div class="form-group">
                            <?php if($i2==0): ?>
                              <label class="form-label">サイズ別の在庫数の入力</label>
                        <?php 
                        if($i==0){
                          if(isset($error["size_id"])and($error["size_id"] != "")){
                            echo "<div class=\"invalid-feedback\">".$error["this_photo_name"]."</div>";
                          }
                        }
                        ?>
                              <?php endif; ?>
                              <?php
                             /* $css = "class=\"orm-control custom-select\" ";
                              $tagname = "size_{$i}_{$i2}";
                              $size_select = form_dropdown($tagname, $size_ar ,'',$css);
                              echo $size_select;*/
                              $sizeid = $size_ar[$i2]["id"];
                              $sizename = $size_ar[$i2]["name"];
                              ?>
                               <div class="input-group">
                              <span class="input-group-prepend">
                                <span class="input-group-text size"><?php echo $sizename; ?></span>
                                
                              </span>
                              <?php
                              $tagname = "color_{$i}_size_{$sizeid}_stock";
                              $set_value = set_value($tagname);
                              $data = array(
                                'type' => "number",
                                'name'          => $tagname,
                                'value'         => $set_value,
                                'class' => 'form-control',
                                'placeholder' => "在庫の数",
                                'select' => $selected
                                );
                                echo form_input($data);
                                ?>
                              </div>
                              <?php echo form_error($tagname); ?>
                            </div>
<?php endfor;?>
                        </div>
                      </div><!-- end siz_stock_units -->
</div>
</div> 
<?php endfor; ?> 
</div><!-- ends color_units -->
</div>
                          <!-- end1-->
                    
                        



                  <div class="card-header">
                    <h3 class="card-title">補足写真（モデル別・シーン別の画像等）のアップロード</h3>
                  </div>
                  <div class="card-body">
                        <?php
                          if(isset($error["other_photo_err"])and($error["other_photo_err"] != "")){
                            echo "<div class=\"invalid-feedback\">".$error["other_photo_err"]."</div>";
                          }
                      
                        ?>
<div class="row">


<?php 
for($i=0;$i<$other_photo_num;$i++):
?>
<div class="col-sm-4 col-md-4">
<div class="custom-file">
<?php
                            $op = array(
                                  'type'         => "file",
                                  'name'          => "other_photo_". $i,
                                  'class' => 'custom-file-input photo',
                                  'accept'=>'image/jpeg,image/png',
                                  );
                                  echo form_input($op);
?>
      <label class="custom-file-label filename">画像選択</label>
      </div>

</div>
<?php 
endfor;
?>



</div>
</div>


                    <div class="card-footer text-right">
                      <div class="d-flex">
                        <?php
                        
                        if($repage)
                        {
                        echo "<a href=\"javascript:void(0)\" class=\"btn btn-link\"> 戻る </a> ";
                        }
                        ?>
                        <button type="submit" class="btn btn-primary ml-auto">確 認</button>
                      </div>
                     </div>

                 
                </form>
              
            <!--end contents inner -->
          <!-- /div --><!-- row コメントアウト　-->
        </div>
      </div>
    </div>