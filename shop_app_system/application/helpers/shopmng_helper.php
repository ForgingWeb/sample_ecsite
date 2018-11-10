<?php if (!defined('BASEPATH')) exit ('NO direct script access allowed');

/**
 * @ccess public
 * @param integer
 * @return string
 */
    function get_product_list_html($products_data){
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
        //商品名（id）、メインカラー、カラー、サイズ1-5在庫1-5、在庫追加ボタン、削除ボタン
    }