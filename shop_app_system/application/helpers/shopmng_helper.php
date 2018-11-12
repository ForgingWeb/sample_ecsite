<?php if (!defined('BASEPATH')) exit ('NO direct script access allowed');

/**
 * @ccess public
 * @param integer
 * @return string
 */
    function get_product_list_html($products_data){
        $CI =& get_instance();
        $CI->load->helper('html');
        $products_url = $CI->products_url;
        $html = "";

        /*/商品名（id）、メインカラー、カラー、サイズ1-5在庫1-5、在庫追加ボタン、削除ボタン
        *
        *
        *
        */
            //商品リストヘッダタイトル
            $list_head = <<<EOM
            <div class="table-responsive">
            <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
              <thead>
            <tr>
            <th class="text-center">商品番号</th>
            <th class="text-center">商品名</th>
            <th class="text-center">メインカラー写真</th>
            <th class="text-center">
            <div class="row">
                <div class="col-sm-2 col-md-2">カラー</div>
                <div class="col-sm-2 col-md-2">XSの在庫</div>
                <div class="col-sm-2 col-md-2">Sの在庫</div>
                <div class="col-sm-2 col-md-2">Mの在庫</div>
                <div class="col-sm-2 col-md-2">Lの在庫</div>
                <div class="col-sm-2 col-md-2">XLの在庫</div>
            </div>
            </th>
            </thead>
            </th>
            <tbody>

EOM;
            
        foreach($products_data as $key => $val)
        {
                //<div class="row">■
                //<div class="col-sm-1 col-md-1">
                $val["id"];//bootstarap 1/12
                //</div>
                
                //<div class="col-sm-3 col-md-3+">
                $val["name"];//bootstarap 2/12
                //</div>

                //<div class="col-sm-2 col-md-2">
                $val["id_color_main"];//bootstarap 2/12
                //</div>

                $color_data = $val["colors"];
                
                //<div class="col-sm-6 col-md-5">★
                //begin_forms//bootstarap 5/12 縦1
                
                    //<div class="row color_unit">
                    
                        //<div class="col-sm-9 col-md-9">★★
                $html .= <<<EOM
                <tr>
                <td class="text-center">
                {$val["id"]}
                </td>
                
                <td class="text-center">
                {$val["name"]}
                </td>

                <td class="text-center">
                <img src="/CI_shop{$products_url}/thumb_{$val["photoname"]}" />
                </td>
                
                <td class="text-center">
                <!-- //begin_forms// -->
                
                    <div class="col">
                    
EOM;
                foreach($color_data as $color_val)
                {
                    

                    //<div class="col-sm-4 col-md-4">
                    $color_val["color_name"];//bootstarap 4/12　縦1　縦1　横1
                    //</div>
                    $size_data = $color_val["size"];
                    //<div class="col-sm-8 col-md-8">

                    $html .= <<<EOM
                    
                    <div class="row cl_row">
                        <div class="col-sm-2 col-md-2 text-left">
                        {$color_val["color_name"]}
                        </div>


EOM;
                    foreach($size_data as $size_val){
                        //<div>

                        //<span>
                        $products_stocks_id = $size_val["id"];//bootstarap 4/12　縦1　縦1　横1
                        $id_size = $size_val["id_size"];//bootstarap 4/12　縦1　縦1　横2

                        $sizename = $CI->shop_model->get_value_one_column("sizes",$id_size,"name");
                        //</span>

                        //<span>
                        $stock = $size_val["stock"];//bootstarap 4/12　縦1　縦1　横3
                        if(! $stock)
                        {
                            $stock = "--";
                        }
                        //</span>

                        //<span>
                        //<input type="text" name="{$products_stocks_id}_{$id_size}_stock_plus" >のテキストフォーム  
                        //</span>

                        //</div>

/*
                        <div class="col-sm-4 col-md-4">
                        $sizename
                        </div>
                        */

                        $html .= <<<EOM
                        
                        <div class="col-sm-2 col-md-2 text-right">
                        {$stock}
                        <!-- input type="text" name="{$products_stocks_id}_{$id_size}_stock_plus" class="form-control pstock" -->  
                        </div>


EOM;
                        }
                        $html .= <<<EOM
                            </div>

EOM;

                }
                        $html .= <<<EOM
                                </td>
                            </tr>

EOM;
        }
                
                $html .= <<<EOM

                            
                    </tbody>
                    </table>
        </div>

           

EOM;

        return $list_head.$html;
            

    }