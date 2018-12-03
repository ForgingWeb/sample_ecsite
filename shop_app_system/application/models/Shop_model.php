<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_model extends CI_Model
{
	function __construct(){
		parent::__construct();
	}

	function get_shoppagetitle($this_page)
	{
        return ucfirst($this_page);
    }
    
    function get_fast_view_of_product()
    {
        $shopurl = $this->shop_url;
        $asset_dir = $this->asset_dir;
        $html = "";
        $html = <<<EOM
        <div id="product-pop-up" style="display: none; width: 700px;">
        <div class="product-page product-pop-up">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-3">
              <div class="product-main-image">
                <img src="{$asset_dir}pages/img/products/model7.jpg" alt="Cool green dress with red bell" class="img-responsive">
              </div>
              <div class="product-other-images">
                <a href="javascript:;" class="active"><img alt="Berry Lace Dress" src="{$asset_dir}pages/img/products/model3.jpg"></a>
                <a href="javascript:;"><img alt="Berry Lace Dress" src="{$asset_dir}pages/img/products/model4.jpg"></a>
                <a href="javascript:;"><img alt="Berry Lace Dress" src="{$asset_dir}pages/img/products/model5.jpg"></a>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-9">
              <h2>Cool green dress with red bell</h2>
              <div class="price-availability-block clearfix">
                <div class="price">
                  <strong><span>$</span>47.00</strong>
                  <em>$<span>62.00</span></em>
                </div>
                <div class="availability">
                  Availability: <strong>In Stock</strong>
                </div>
              </div>
              <div class="description">
                <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat 
Nostrud duis molestie at dolore.</p>
              </div>
              <div class="product-page-options">
                <div class="pull-left">
                  <label class="control-label">Size:</label>
                  <select class="form-control input-sm">
                    <option>L</option>
                    <option>M</option>
                    <option>XL</option>
                  </select>
                </div>
                <div class="pull-left">
                  <label class="control-label">Color:</label>
                  <select class="form-control input-sm">
                    <option>Red</option>
                    <option>Blue</option>
                    <option>Black</option>
                  </select>
                </div>
              </div>
              <div class="product-page-cart">
                <div class="product-quantity">
                    <input id="product-quantity2" type="text" value="1" readonly class="form-control input-sm">
                </div>
                <button class="btn btn-primary" type="submit">Add to cart</button>
                <a href="{$shopurl}shop_item/" class="btn btn-default">More details</a>
              </div>
            </div>

            <div class="sticker sticker-sale"></div>
          </div>
        </div>
</div>

EOM;

return $html;

    }
    
    


  function get_id($table,$num,$first)
  {
    $this->db->order_by("id", "DESC");
    $this->db->limit($num, $first);
    $query = $this->db->get($table);
    $ar = array();
    foreach ($query->result_array() as $row)
    { 
      $ar[] = $row['id'];
    }
    return $ar;
  }

  /*
    function get_id($table,$num,$first)
    {
      $this->db->order_by("id", "DESC");
      $this->db->limit($num, $first);
      $query = $this->db->get($table);
      return $query;
    }
*/

    function get_sale_product_id($num)
    {
      $table = "products";
      $first = 0;
      return $this->shop_model->get_id($table,$num,$first);
    }
    
    function get_product_detaile($id_ar,$flag=""){
      //prodauctのidの配列を受け取り、各商品の詳細データを取得する
      //詳細データ　＝　id、商品名、説明、在庫数、色数、色別の在庫数,画像ファイル名
      //id,商品名、画像ファイル名を取得
      if(! is_array($id_ar)){
        $n = $id_ar;
        $id_ar = array($n);
      }

      for($i=0;$i<count($id_ar);$i++)
      {
      if($flag == ""){
      $this->db->select("id,name,id_color_main,text_overview,listprice");
      }
      $this->db->where("id",$id_ar[$i]);
      $query = $this->db->get("products");

      if($query->num_rows() > 0){
        $row = $query->row_array();
        $data[$i]["id"] = $row["id"];
        $data[$i]["name"] = $row["name"];
        $data[$i]["id_color_main"] = $row["id_color_main"];
        $data[$i]["name_color_main"]  = $this->shop_model->get_value_one_column("products_colors",$row["id_color_main"],"color_name");
        

        $data[$i]["listprice"] = $row["listprice"];
        $data[$i]["text_overview"] = $row["text_overview"];
        if($flag != ""){
          $data[$i]["id_lastcategory"] = $row["id_lastcategory"];
          $data[$i]["in_tax"] = $row["text_etailed"];
          $data[$i]["text_etailed"] = $row["text_etailed"];
          $data[$i]["photo_other_01"] = $row["photo_other_01"];
          $data[$i]["photo_other_02"] = $row["photo_other_02"];
          $data[$i]["photo_other_03"] = $row["photo_other_03"];
          $data[$i]["photo_other_04"] = $row["photo_other_04"];
          $data[$i]["photo_other_05"] = $row["photo_other_05"];
        }

        
        $this->db->where('id_products_colors', $row["id_color_main"]);
        $this->db->where('id_product', $id_ar[$i]);
        $this->db->limit(1,1);
        $this->db->select("id,photoname");
        //sort id_products_colors	id_size
          $query_sts = $this->db->get("products_stocks");
          $row_sts = $query_sts->row_array();
          $data[$i]["photoname"] = $row_sts["photoname"];
          if($flag != ""){
             /* $this->db->where('id_product', $id_ar[$i]);
            //sort id_products_colors	id_size
              $query_sts = $this->db->get("products_stocks");*/
              //もう一度id,photonameに接続して、サイズの抽出をする
              $this->db->where('id_products_colors', $row["id_color_main"]);
              $this->db->where('id_product', $id_ar[$i]);
              //$this->db->limit(1,1);
              $this->db->select("id,photoname,id_size,stock");
              $query_sts2 = $this->db->get("products_stocks");
              $row_sts2 = $query_sts2->row_array();
              $t=0;
              foreach ($query_sts2->result_array() as $row_sts)
              {
                /*id ,id_product,id_products_colors,
                id_size,photoname
                stock*/
              //$data[$i]["color"][$t] = $row_sts["photoname"];
              /*/color_ar["size_id"=size_id,
              20181114　itemページではメインカラー写真のみが反映される。
              カラー毎のサイズと在庫データは後日実装予定  ]
        
                */
                  $id_size = $row_sts2['id_size'];
                  $stock = $row_sts2['stock'];
                  $data[$i]["size"][$t]["id_size"]=$id_size;
                  $name_size = $this->shop_model->get_value_one_column("sizes",$id_size,"name");
                  $data[$i]["size"][$t]["name_size"]=$name_size;
                  $data[$i]["size"][$t]["stock"]=$stock;
              $t++;

              }

          }
        }

      }

      return $data;

    }

    function get_top_menu_ar()
    {
      #categoriesテーブルから全カテゴリ取得
      #roleに沿って配列を作成する。
      /* 配列の例
      $menu_ar[0]["id"] = "a_role1_id";//一つ目のルートカテゴリ
      $menu_ar[0]["name"] = "男性";
      $menu_ar[0][0]["id"] = "a_lole2a_id";//一つ目のルートカテゴリの下のカテゴリ
      $menu_ar[0][0]["name"] = "a_lole2a_name";
      $menu_ar[0][0][0]["id"] = "a_lole2aa_id";//一つ目のルートカテゴリの下のカテゴリの下のカテゴリ
      $menu_ar[0][0][0]["name"] = "a_lole2aa_name";
      $menu_ar[0][0][1]["id"] = "a_lole2ab_id";//一つ目のルートカテゴリの下のカテゴリの下のカテゴリ
      $menu_ar[0][0][1]["name"] = "a_lole2ab_name";
      $menu_ar[0][1]["id"] = "a_lole2b_id";//
      $menu_ar[0][1]["name"] = "a_lole2b_name";
      $menu_ar[1]["id"] = "b_role1_id";
      $menu_ar[1]["name"] = "b_role1_name";
      $menu_ar[1][0]["id"] = "b_lole2a_id";
      $menu_ar[1][0]["name"] = "b_lole2a_name";
      $menu_ar[1][0][0]["id"] = "b_lole3a_id";
      $menu_ar[1][0][0]["name"] = "b_lole3a_name";
      $menu_ar[2]["id"] = "c_role1_id";
      $menu_ar[2]["name"] = "c_role1_name";
      */
      $category_ar = $this->shop_model->get_category_ar();

      $r0_ar = $category_ar[0];
      $r1_ar = $category_ar[1];
      $r2_ar = $category_ar[2];
      $menu_ar = array();
      //role0
      $r0 = 0;
      foreach ($r0_ar as $r0val)
      {
        
        $menu_ar[$r0]["id"] = $r0val["id"];
        $menu_ar[$r0]["name"] = $r0val["name"];

        //role1
        $r1 = 0;
        foreach ($r1_ar as $r1val)
        {
          $parent_id_1 = $r1val["parent_id"];


          if($r0val["id"] == $parent_id_1)
          {
          $menu_ar[$r0][$r1]["id"] =  $r1val["id"];
          $menu_ar[$r0][$r1]["name"] = $r1val["name"];

            //role2
            $r2 = 0;
            foreach ($r2_ar as $r2val)
            {
              
              $parent_id_2 = $r2val["parent_id"];

              if($r1val["id"] == $parent_id_2)
              {
              $menu_ar[$r0][$r1][$r2]["id"] = $r2val["id"];
              $menu_ar[$r0][$r1][$r2]["name"] = $r2val["name"];
              $r2++;
              }

            }


          $r1++;
          }
        }
        
        $r0++;
      }

      return $menu_ar;

    }


    function get_value_one_column($table,$id,$column)
    {
      //$tableからidでデータを検索して、指定columnの値を返す
      $this->db->select("id,".$column);
      $this->db->where('id', $id);
      $query = $this->db->get($table);
      if ($query->num_rows() > 0){
        $row = $query->row_array();
        $value = $row[$column];
      return $value;
      }else{
        return false;
      }
    }


    function get_category_ar()
    {
      #categoriesテーブルから全カテゴリ取得
      #role別に配列を作成する。
      $category_ar = array();
      $r0_ar = array();
      $r1_ar = array();
      $r2_ar = array();
      $menu_ar = array();
      
      $table = "categories";
      $this->db->order_by("parent_id", "asc");
      $query = $this->db->get($table);
      $i=0;
      $r0 = 0;
      $r1 = 0;
      $r2 = 0;
      foreach ($query->result_array() as $row)
			{
				$id = $row['id'];
				$category_name = $row['category_name'];
        $role = $row['role'];
        $parent_id = $row['parent_id'];
        if($role == 0)
        {
          $r0_ar[$r0]["id"]=$id;
          $r0_ar[$r0]["name"]=$category_name;
          $r0++;
        }elseif($role == 1){
          $r1_ar[$r1]["id"]=$id;
          $r1_ar[$r1]["name"]=$category_name;
          $r1_ar[$r1]["parent_id"]=$parent_id;
          $r1++;
        }elseif($role == 2){
          $r2_ar[$r2]["id"]=$id;
          $r2_ar[$r2]["name"]=$category_name;
          $r2_ar[$r2]["parent_id"]=$parent_id;
          $r2++;
        }
      }
      
      $category_ar[0] = $r0_ar;
      $category_ar[1] = $r1_ar;
      $category_ar[2] = $r2_ar;

      return $category_ar;
    }


    function get_id_name_ar($table,$calamnname='name'){
      $query = $this->db->get($table);
      $ar=array();
      foreach ($query->result_array() as $row)
			{
        $id = $row['id'];
        $name = $row[$calamnname];
        $ar[$id] = $name;
      }
      return $ar;
    }

    function insert_get_id($table,$insert_data)
    {
      $this->db->insert($table, $insert_data);
      return $this->db->insert_id();
    }


    function insert($table,$insert_data)
    {
      $this->db->insert($table, $insert_data);
    }

    
    function get_count_all($table,$like = array())
    {
        if(! empty($like))
        {
        $this->db->where($like["clamn"], $like['val']);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    
    function get_product_list_ar($table,$table_stocks,$per_page,$pagen)
    {
      
      $this->db->select("id,name,id_color_main,listprice");
      $this->db->limit($per_page,$pagen);//limit
      $this->db->order_by("id", "DESC");
      $query = $this->db->get($table);
      

      $cnt = 0;
      foreach ($query->result_array() as $row){
          $products_data[$cnt]["id"] = $row["id"];
          $products_data[$cnt]["name"] = $row["name"];
          $products_data[$cnt]["id_color_main"] = $row["id_color_main"];
          
          //色別の情報を取得
          //$this->db->select("id,name,id_color_main,listprice");
          $this->db->where('id_product', $products_data[$cnt]["id"]);
              //sort id_products_colors	id_size
          $query_sts = $this->db->get($table_stocks);


          $i=$t=0;
          $firstsize = "";
          foreach ($query_sts->result_array() as $row_sts)
          {
            if($firstsize == ""){
              $firstsize = $row_sts["id_size"];
            }
            else if($firstsize  == $row_sts["id_size"])
            {
              $i++;
              $t = 0;
            }
            if($row["id_color_main"] == $row_sts["id_products_colors"])
            {   
              $products_data[$cnt]["photoname"] = $row_sts["photoname"];
            }
            $id_products_colors = $row_sts["id_products_colors"];
            //カラー名取得
            $color_name = $this->shop_model->get_value_one_column("products_colors",$id_products_colors,"color_name");
            $products_data[$cnt]["colors"][$i]["color_name"] = $color_name;
            $products_data[$cnt]["colors"][$i]["size"][$t]["id"] = $row_sts["id"];
            $products_data[$cnt]["colors"][$i]["size"][$t]["id_size"] = $row_sts["id_size"];
            $products_data[$cnt]["colors"][$i]["size"][$t]["stock"] = $row_sts["stock"];

            
            $t++;

          }
          $cnt++;
              
          
      }
      return $products_data;
  }

}