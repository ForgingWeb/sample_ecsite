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
    function get_sale_product_id($n)
    {
      //sale6点のidを抽出
      $sale_ar = array();
      for($i=0;$i<$n;$i++){
        $sale_ar[] = $i;
      }
    return $sale_ar;
    }
    function get_product_detaile($id_ar){
      //prodauctのidの配列を受け取り、各商品の詳細データを取得する
      //詳細データ　＝　id、商品名、説明、在庫数、色数、色別の在庫数,画像ファイル名
      $detail_ar = array();
      $n = count($id_ar);
      for($i=0;$i<$n;$i++){
        $detail_ar[] = $i;
      }
      return $detail_ar;

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
      $category_ar = array();
      $r0_ar = array();
      $r2_ar = array();
      $menu_ar = array();
      
      $table = "categories";
      $this->db->order_by("parent_id", "asc");
      $query = $this->db->get($table);
      $i=0;
      $r0 = 0;
      $r2 = 0;
      foreach ($query->result_array() as $row)
			{
				$id = $row['id'];
				$category_name = $row['category_name'];
        $role = $row['role'];
        $parent_id = $row['parent_id'];

        $category_ar[$i]["id"] = $id;
        $category_ar[$i]["category_name"] = $category_name;
        $category_ar[$i]["parent_id"] = $parent_id;
        $category_ar[$i]["role"] = $role;

        if($parent_id == null){
          $r0_ar[$r0]["id"] = $id;
          $r0_ar[$r0]["name"] = $category_name;
          $r0++;
        }
        if($role == 2)
          {
            $r2_ar[$r2]["id"] = $r2_id =  $id;
            $r2_ar[$r2]["name"] = $r2_name =  $category_name;
            $r2_ar[$r2]["p_id"] =$r1_id = $parent_id;
            $r2++;
          }
        $i++;
      }
      
      $r0 = 0;
      foreach ($r0_ar as $r0val)
      {
        $menu_ar[$r0]["id"] = $r0val["id"];
        $menu_ar[$r0]["name"] = $r0val["name"];

        for($t=0;$t<$i;$t++)
        {
          $r1=0;
          $role = $category_ar[$t]["role"];
          if($role == 1)
          {
            $r2=0;
              if($r0val["id"] == $category_ar[$t]["parent_id"])
              {
                $r1_id = $category_ar[$t]["id"];
                $r1_name = $category_ar[$t]["category_name"];
                $menu_ar[$r0][$r1]["id"] = $r1_id;
                $menu_ar[$r0][$r1]["name"] = $category_ar[$t]["category_name"];
                foreach($r2_ar as $key => $r2val)
                {
                  $p_id = $r2val["p_id"];
                  if($p_id == $r1_id){
                    $menu_ar[$r0][$r1][$r2]["id"] = $r2val["id"];
                    $menu_ar[$r0][$r1][$r2]["name"] = $r2val["name"];
                    $r2++;
                  }
                }
                $r1++;
              }
          }
        
        }
        $r0++;
      }
      return $menu_ar;

    }


    function get_value_one_column($table,$id,$column)
    {
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


    function get_select_limit($table,$num,$limit)
    {
      $this->db->order_by("FJ_id", "asc");
      $this->db->limit($num, $limit);
      $query = $this->db->get($table);
      return $query;
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
        $this->db->like($like["clamn"], $like['val']);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    
    function get_product_list_ar($table,$table_stocks)
    {
      foreach ($query->result_array() as $row){
          $products_data["id"] = $row["id"];
          $products_data["name"] = $row["name"];
          $products_data["id_color_main"] = $row["id_color_main"];
          
          //色別の情報を取得
          //$this->db->select("id,name,id_color_main,listprice");
          $this->db->where('id_product', $products_data["id"]);
              //sort id_products_colors	id_size
          $query_sts = $this->db->get($products_stocks);

          $before_color_id = "";

          $i=$t=0;
          foreach ($query_sts->result_array() as $row_sts)
          {

            if(($before_color_id != $row_sts["d_products_colors"])&&($before_color_id != ""))
            {
              $i++;
              $t = 0;
            }
            $products_data["colors"][$i]["d_products_colors"] = $row_sts["d_products_colors"];
            $products_data["colors"][$i][$t]["id"] = $row_sts["id"];
            $products_data["colors"][$i][$t]["id_size"] = $row_sts["id_size"];
            $products_data["colors"][$i][$t]["stock"] = $row_sts["stock"];

            $before_color_id = $row_sts["d_products_colors"];
            $t++;

          }
              
          
      }
      return $products_data;
  }

}