<?php
class Shop extends CI_Controller {
    var $description;
    var $keywords;
       // var $indexpage;
    var $shop_url;
    var $asset_dir;
    var $manage_url;
    var $product_img_dir;

    function __construct()
    {
        parent::__construct();
        //モデル・ヘルパー・プラグイン等の読み込み
         $this->load->helper(array('url','shop'));
         $this->load->database();
         $this->load->model(array('shop_model'));
        //変数初期化
        $this->description="";
        $this->keywords="";
        $this->shop_url = "/CI_shop/shop/";
        $this->asset_dir = "/CI_shop/shop_assets/";
        $this->manage_url = "/CI_shop/shop_manage/shop_manage_login/";
        $this->product_img_dir = "/CI_shop//shop_products_img/";
    }

    function set_view($this_page,$data){
        $this->load->view('shop_templates/shop_head', $data);
        $this->load->view('shop_templates/shop_header', $data);
        $this->load->view('shop_pages/'.$this_page, $data);
        $this->load->view('shop_templates/shop_footer', $data);
    }

    function set_page_data($this_page){
        //*CSS設定*//
        $css = mk_css($this_page,$this->asset_dir);
        $this_page_js = mk_page_js($this_page,$this->asset_dir);
        $menu_ar = $this->shop_model->get_top_menu_ar();
        $top_menu = mk_top_menu($this->asset_dir,$menu_ar,$this->shop_url);
        //headデータの作成
        $data['this_page'] = $this_page;
        $data['title'] = $this->shop_model->get_shoppagetitle($this_page);
        $data['description'] = $this->description;
        $data['keywords'] = $this->keywords;
        $data['css'] = $css;
        $data['page_js'] = $this_page_js;
        //header周辺の要素作成
        if($this_page != 'shop_index'){
            //topberは表示しない
            $data['style_customize'] = mk_style_customizer();
        //    $data['topbar'] = ""; //set_topbar($this_page,$this->shop_url);
        }else{
            $data['style_customize'] = mk_style_customizer();
        //    $data['topbar'] = "";
        }
        $data['header'] = mk_header($this_page,$this->asset_dir,$top_menu,$this->shop_url);

        $data['fast_view_product'] = $this->shop_model->get_fast_view_of_product();
        return $data;
    }

    public function shop_index()
    {
        $this_page = 'shop_index';
        if  ($this->uri->segment(3) == "")
        {    
            $data = $this->set_page_data($this_page);
            $menu_ar = $this->shop_model->get_top_menu_ar();
            $data['sidebar'] = mk_sidebar($this_page,$menu_ar,$this->shop_url);
            //saleスライド作成
            $num = 6; 
            $id_ar = $this->shop_model->get_sale_product_id($num);
            $detail_ar = $this->shop_model->get_product_detaile($id_ar);
            $data['sale_product'] = mk_sale_product($detail_ar,$this->shop_url);

            //content作成：ランダム8個
            $num = 8;
            $id_ar = $this->shop_model->get_sale_product_id($num);
            $detail_ar = $this->shop_model->get_product_detaile($id_ar);
            $data['content'] = mk_content($detail_ar,$this->shop_url);

            //moreproduct
            $num = 5;
            $id_ar = $this->shop_model->get_sale_product_id($num);
            $detail_ar = $this->shop_model->get_product_detaile($id_ar);
            $data['more_products'] = mk_more_products($detail_ar,$this->shop_url);
            $this->set_view($this_page,$data);
        }
        else
        {
            http_response_code( 301 ) ;
            $location_url = $this->shop_url .  $this_page."/";
            header( "Location: {$location_url}" ) ;
            exit ;
        }
    }

    public function shop_item()
    {
        $this_page = 'shop_item';
        //**商品詳細ページ */
        $product_id = $this->uri->segment(3);

        $data = $this->set_page_data($this_page);
        $menu_ar = $this->shop_model->get_top_menu_ar();
        $data['sidebar'] = mk_sidebar($this_page,$menu_ar,$this->shop_url);
        
        //bestsellers
        $num = 5;
        $id_ar = $this->shop_model->get_sale_product_id($num);
        $detail_ar = $this->shop_model->get_product_detaile($id_ar);
        $data['bestsellers'] = mk_bestsellers($detail_ar,$this->shop_url);
        
        //bestsellers_mobile
        $num = 5;
        $id_ar = $this->shop_model->get_sale_product_id($num);
        $detail_ar = $this->shop_model->get_product_detaile($id_ar);
        $data['bestsellers_mobile'] = mk_bestsellers_mobile($detail_ar,$this->shop_url);
        
        //moreproduct
        $num = 5;
        $id_ar = $this->shop_model->get_sale_product_id($num);
        $detail_ar = $this->shop_model->get_product_detaile($id_ar);
        $data['more_products'] = mk_more_products($detail_ar,$this->shop_url);

        //description
        $num = 1;
        //$id_ar = $this->shop_model->get_sale_product_id($num);
        //$detail_ar = $this->shop_model->get_product_detaile($id_ar);
       
        

        $data['pull_sizes'] = "<option values='L'>--</option><option>--</option><option>--</option>";
        $data['pull_colors'] = "<option>--</option><option>--</option><option>--</option>";

        $detail_ar = $this->shop_model->get_product_detaile($product_id,"all");
        $data['text_overview'] = $detail_ar[0]['text_overview'];
;
        //ターゲット商品の写真表示部分のHTML作成
       // $photonames_color = $detail_ar["photonames_color"] = array("model10.jpg","model5.jpg","model5.jpg","model6.jpg");
        
        $data["mainphotos"] = mk_mainphotos($detail_ar,$this->asset_dir);

        //平均評価の★を設定
        $data["avarage"] = "3.75";

        //レビューの取得
        $data["reviews_cnt"] = "(4)";
        $data["reviews"] = mk_reviews();
        $data["price"] = mk_price(number_format($detail_ar[0]["listprice"]) );

        $this->set_view($this_page,$data);
    }
    public function shop_product_list()
    {
        $this_page = 'shop_product_list';
        //**カテゴリ別に表示するページ */
        $data = $this->set_page_data($this_page);
        $menu_ar = $this->shop_model->get_top_menu_ar();
        $data['sidebar'] = mk_sidebar($this_page,$menu_ar,$this->shop_url);
        $this->set_view($this_page,$data);
    }
    public function shop_search_result()
    {
        $this_page = 'shop_search_result';
        $data = $this->set_page_data($this_page);
        $this->set_view($this_page,$data);
    }
    public function shop_shopping_cart()
    {
        $this_page = 'shop_shopping_cart';
        $data = $this->set_page_data($this_page);
        $this->set_view($this_page,$data);
    }
    public function shop_forms()
    {
        $this_page = 'shop_forms';
        $data = $this->set_page_data($this_page);
        $this->set_view($this_page,$data);
    }
    public function shop_login()
    {
        $this_page = 'shop_login';
        $data = $this->set_page_data($this_page);
        $this->set_view($this_page,$data);
    }
    public function shop_account()
    {
        $this_page = 'shop_account';
        $data = $this->set_page_data($this_page);
        $this->set_view($this_page,$data);
    }
    public function shop_checkout()
    {
        $this_page = 'shop_checkout';
        $data = $this->set_page_data($this_page);
        $this->set_view($this_page,$data);
    }
    public function shop_asset($this_page = 'shop_asset')
    {
        $this_page = 'shop_asset';
        $data = $this->set_page_data($this_page);
        $this->set_view($this_page,$data);
    }

    private function ifnon_shop_page($this_page){
    //存在しないURLにアクセスがあったときに表示する。
    if ( ! file_exists(APPPATH.'views/shop_pages/'.$this_page.'.php'))
     {
     //ページなし
    show_404();
     }
    }
}