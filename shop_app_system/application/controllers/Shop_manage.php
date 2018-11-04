<?php
class Shop_manage extends CI_Controller {
    var $description;
    var $keywords;
       // var $indexpage;
    var $shop_url;
    var $asset_dir;
    var $colornum;//選択できる色数
    var $sizenum;//選択できるサイズ数
    var $other_photo_num;//補足写真として選択できる数
    var $tmp_dir;
    var $products_url;
    var $tmp_url;

    public function __construct()
    {
        parent::__construct();
        //モデル・ヘルパー・プラグイン等の読み込み
        $this->load->helper(array('form', 'url','shop','shopmng','html'));
        $this->load->database(); 
        $this->load->library(array('shop_manage_lib',"image_lib"));
        $this->load->model(array('shop_model'));
        //変数初期化
        $this->description="";
        $this->keywords="";
        $this->shop_url = "/CI_shop/shop/";
        $this->tmp_dir = "/var/www/html/CI_shop/shop_tmp/";
        $this->tmp_url = "/shop_tmp";
        $this->products_dir = "/var/www/html/CI_shop/shop_products_img/";
        $this->products_url = "/shop_products_img";
        $this->colornum = 5;//選択できる色数
        $this->sizenum = 5;//選択できるサイズ数
        $this->other_photo_num = 3;//補足写真として選択できる数
        //ログイン監視
        $this->login_check();
    }


    public function set_view($data){
        $this->load->view('shop_manage_templates/shop_manage_head', $data);
        $this->load->view('shop_manage_templates/shop_manage_header', $data);
        $this->load->view('shop_manage_pages/'.$data['this_page'], $data);
        $this->load->view('shop_manage_templates/shop_manage_footer', $data);
    }


    function set_page_data($this_page){
        //*CSS設定*//
       /* $css = set_css($this_page,$this->asset_dir);
        $this_page_js = set_page_js($this_page,$this->asset_dir);
        $menu_ar = $this->shop_model->get_top_menu_ar();
        $top_menu = set_top_menu($this->asset_dir,$menu_ar,$this->shop_url);
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
            $data['style_customize'] = set_style_customizer();
        //    $data['topbar'] = ""; //set_topbar($this_page,$this->shop_url);
        }else{
            $data['style_customize'] = set_style_customizer();
        //    $data['topbar'] = "";
        }
        $data['header'] = set_header($this_page,$this->asset_dir,$top_menu,$this->shop_url);

        $data['fast_view_product'] = $this->shop_model->get_fast_view_of_product();*/
        $data['title'] = $this_page;
        $data['this_page'] = $this_page;
        return $data;
    }


    public function shop_manage_login(){
        #ログイン
        $this_page = 'shop_manage_login';
        $data = $this->set_page_data($this_page);
        $this->set_view($data);
    }


    public function smg_product_registration(){
        /*
        商品の登録
        登録内容：
        商品名、カラー、サイズ、値段、メインの画像、サブの画像、カラー別画像、カラー別価格、メイン画像
        商品説明概要、商品説明詳細。
        */
            //$this->load->view('shop_manage/shop_manage_top', array('error' => '' ));

            $this->smg_product_registration_inner();
            

    }


    protected function smg_product_registration_inner($error = array(),$repage=false){
        //$this->load->view('shop_manage/shop_manage_top', array('error' => '' ));
        $this_page = 'smg_product_registration';
        $data = $this->set_page_data($this_page);

        $data["error"] = $error;

        //カテゴリを多次元配列で取得する
        $category_ar = $this->shop_model->get_category_ar();
        $data["category_options"] = $category_ar;

        //カラーを、idがkey、色名が値の配列で取得する
        $table = "products_colors";
        $color_ar = $this->shop_model->get_id_name_ar($table,"color_name");
        $non["non"] = "ーー";
        $data["color_ar"] = $non + $color_ar;
        
        //サイズを、idがkey、サイズ名が値の配列で取得する
        $table = "sizes";
        $size_ar = $this->shop_model->get_id_name_ar($table);
        $i=0;
        foreach($size_ar as $k => $v)
        {
            $size_ar_o[$i]["id"]=$k;
            $size_ar_o[$i]["name"]=$v;
            $i++;
        }
        $data["size_ar"] = $size_ar_o;
        $data["repage"] = $repage;

        $this->set_view($data);
    }


    public function smg_product_list(){
        /*商品一覧ページ*/     
        /*
        商品の登録
        登録内容：
        メインの画像、商品名、値段、カラー、サイズ、メイン画像、商品説明概要、セール期間
        */
    
    }


    public function smg_product_confir()
    {
        /*商品登録確認画面*/

        //$error = $this->shop_manage_lib->upload($this->products_dir);
       // $this->load->view('shop_manage/shop_manage_top', $error);
       $tmp_dir = $this->tmp_dir;

       #上限の数の取得
       $colornum = $this->colornum;//選択できる色数
       $sizenum = $this->sizenum;//選択できるサイズ数
       $other_photo_num = $this->other_photo_num;//補足写真として選択できる数

       #画像ライブラリの用意
        $config['upload_path'] = $tmp_dir;
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 1000;
        $config['max_width'] = 6000;
        $config['max_height'] = 6000;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

       #post受け取り

       $productname = $this->input->post("productname", TRUE);//商品の名前
       $price = $this->input->post("price", TRUE);//商品の値段
       $role0_id = $this->input->post("role0_id", TRUE);//カテゴリ１のid
       $role1_id =  $this->input->post("role1_id", TRUE);//カテゴリ２のid
       $role2_id =  $this->input->post("role2_id", TRUE);//カテゴリ３のid
      
       $text_overview = $this->input->post("text_overview", TRUE);//商品の概要
       $text_etailed = $this->input->post("text_etailed", TRUE);//商品の詳細
       $maincolor = $this->input->post("maincolor", TRUE);//

       $error = [];
       $errcnt = 0;

        $photo_error = 0;
        if($role1_id == null)
        {
            $error["role1_id"] = "カテゴリの選択をしてください。";
            $errcnt++;
        }
        if($role2_id == null)
        {
            $error["role2_id"] = "カテゴリの選択をしてください。";
            $errcnt++;
        }
       for($i=0;$i<$colornum;$i++)
       {
         $color_id = "color_".$i;
         $this_color_id = $this->input->post($color_id, TRUE);//$i番目に選択した色のid
         if($this_color_id == "non"){ continue; }
         //$i番目に選択した色の指定された色idを配列に入れる
         $color_data_ar[$i]["color_id"] = $this_color_id;
         //画像のnameを作成
         $this_photo_name = "color_photo_". $i;
        
         //画像をアップロードして、画像選択の有無、ファイル形式、ファイルサイズに問題がないか確認をする

         if(isset($_FILES[$this_photo_name]['tmp_name'][0]))
         {
            $this->upload->initialize($config);
            $photo_data = $this->shop_manage_lib->upload_exe($tmp_dir,$this_photo_name);
            $photo_error = $photo_data["error"];
            
            if($photo_error != "")
            {
               // print "<br>-ファイルのアップロードにエラーがありました。-<br>";
               $error["this_photo_err"] = "jpg・png形式で、1MB以下の写真を選択してください。";
               $errcnt++;
            }else{
            //このカラーの写真のファイル名を配列に入れる
            $color_data_ar[$i]["photoname"] = $photo_data["filename"];
            }
        }else{
            $error["this_photo_err"] = "画像を選択してください。";
                $errcnt++;

        }

            for($n=0;$n<$sizenum;$n++)
            {
                //$i番目のサイズの在庫数の受け取り
               //サイズidの受け取り
               $size_id = $n+1;
                $stock_num =  $this->input->post("color_{$i}_size_{$size_id}_stock", TRUE);//サイズの在庫を受け取り
                

                //在庫数が入力されていない場合はサイズのは登録しない。
                //　在庫数は数字で入力されているか？
                if($stock_num != "" ){
                    if (preg_match('/^[0-9０-９]+$/u', $stock_num)) 
                    {
                        //数字であれば半角に統一
                        $stock_num = mb_convert_kana($stock_num, 'n');
                        //このカラーのこのサイズの在庫数を配列に入れる
                        //$color_data_ar[$i]["size_id"] = $size_id;
                        $color_data_ar[$i]["stock_num_ar"][$n] = array("size_id"=>$size_id,"stock_num"=>$stock_num);

                    }else{
                        if(isset($error["size_id"]))
                        {
                        $error["size_id"] ="在庫数は数字で入力してください。";
                        $errcnt++;
                        }
                    }
                 }else{
                    if(isset($error["size_id"]))
                    {
                    //$error["size_id"] ="在庫数を入力してください。";
                    //$errcnt++;
                    }
                    $color_data_ar[$i]["stock_num_ar"][$n] = array("size_id"=>$size_id,"stock_num"=>"--");

                 }

            }
        }



        ######補助写真のinput　name　作成######
        $photo_other_upnames = [];
        $photo_error = "";
            for($i=0;$i<$other_photo_num;$i++)
            {
                $other_photo_name= "other_photo_". $i;
                //画像をアップロードして、画像選択の有無、ファイル形式、ファイルサイズに問題がないか確認をする

                if(isset($_FILES[$other_photo_name]['tmp_name'][0]))
                {
                    $photo_data =  $this->shop_manage_lib->upload_exe($tmp_dir,$other_photo_name);
                    $photo_error = $photo_data["error"];
                    

                        if($photo_error != "")
                        {
                        // print "<br>-ファイルのアップロードにエラーがありました。-<br>";
                            $error["other_photo_err"] = "jpg・pngの画像を選択してください。";
                           // print "jpg・pngの画像を選択してください。";
                            $errcnt++;
                            
                        }else{
                            #エラーがなければ画像の保存ファイル名を取得
                            $photo_other_upnames[$i] = $photo_data["filename"];

                        }
                     }

           // }
            }

        /*/エラーがあった場合、エラーのない写真のエラーに""を入れる。
        if(count($error)>0){
            
            for($i=0;$i<$colornum;$i++)
            {
                if(! isset($error["photo_". $i]))
                {
                    $error["photo_". $i]="";
                    $errcnt++;
                }
            }
        }*/
            $this_page = 'smg_product_confir';
        if (($this->product_validation() === FALSE) or ($errcnt>0) or($this->input->post("flag") == "repage"))
        {
            $this->smg_product_registration_inner($error);
        }else{
/*            echo "<br>商品の名前:" . $productname."<br>";//商品の名前
            echo "商品の値段:" . $price."<br>";//商品の値段
            echo "カテゴリ１のid:" . $role0_id."<br>";//カテゴリ１のid
            echo "カテゴリ２のid:" . $role1_id."<br>";//カテゴリ２のid
            echo "カテゴリ３のid:" . $role2_id."<br>";//カテゴリ３のid
                
            echo "商品の概要:" . $text_overview."<br>";//商品の概要
            echo "商品の詳細:" . $text_etailed."<br>";//商品の詳細
            echo "商品の詳細:" . $maincolor."<br>";//

            foreach($color_data_ar as $key1 => $val_ar)
            {
                foreach($val_ar as $key2 => $val)
                {                
                $color_data_ar[$key1]["color_id"] = $val["color_id"];//=> string(1) "2" 
                $$color_data_ar[$key1]["photoname"] = $val["photoname"];//=> string(36) "28c60c45d533a3071d4f53115f9ac019.jpg" 
                $color_data_ar[$key1]["size_id"] = $val["size_id"];//=> int(2) 
                $color_data_ar[$key1]["stock_num"] = $val["stock_num"];//=> string(1) "7" } 
                }
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
*/
#############画像ファイルのリネームとサムネイルの作成
            
            #イメージライブラリ読み込み$tmp_dir//tmpパス$tmp_dir
            
            foreach($color_data_ar as $key1 => $val_ar)
            {
                foreach($val_ar as $key2 => $val)
                {
                    if($key2 == "photoname")
                    {            
                        $newname = $this->shop_manage_lib->img_rename_make_thumb($tmp_dir,$val);
                        $color_data_ar[$key1][$key2] = $newname;

                        if ( ! $this->image_lib->resize())
                        {
                            echo $this->image_lib->display_errors();
                        }
                     }
                }
            }

            if(count($photo_other_upnames) > 0)
            {
                foreach($photo_other_upnames as $key => $val)
                {
                        $newname = $this->shop_manage_lib->img_rename_make_thumb($tmp_dir,$val);
                        $photo_other_upnames[$key] = $newname;

                }
            }

        $data = $this->set_page_data($this_page);
        $data["productname"] =  $productname;//商品の名前
        $data["price"] = $price;//商品の値段
        $data["role0_id"] = $role0_id;//カテゴリ１のid
        $data["role1_id"] = $role1_id;//カテゴリ２のid
        $data["role2_id"] = $role2_id;//カテゴリ３のid
       
        $data["text_overview"]  = $text_overview;//商品の概要
        $data["text_etailed"]  = $text_etailed;//商品の詳細
        $data["maincolor"]  = $maincolor;//
 
        $data["color_data_ar"] = $color_data_ar;//カラー別のデータ
        $data["photo_other_upnames"] = $photo_other_upnames;//補助写真

        $this->set_view($data);

        }
    }


    public function smg_product_exe(){
        /*商品登録確認画面実行*/
        foreach($_POST as $idx => $val){echo "$idx = $val<br>";}
    
    }


    public function smg_category_edit()
    {
        /*カテゴリの追加・削除・名前変更画面*/
    }


    public function smg_category_edit_exe()
    {
        /*カテゴリの追加・削除・名前変更の実行*/
    }


    public function smg_sale_period_set()
    {
        /*セール期間の設定画面*/

    }


    public function smg_sale_period_confir()
    {
        /*セール期間の確認画面*/

    }


    public function smg_sale_period_exe()
    {
        /*セール期間の登録*/

    }


    public function login_check()
    {
        /**ログイン監視 */
        $this_page = $this->uri->segment(2);
        if($this_page == "shop_manage_login")
        {

        }else{

        }
    }

    public function login_validation(){
        $this->form_validation->set_rules('username', 'ユーザ名', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required',
                array('required' => '%s は必須です。')
        );
    }
    public function product_validation(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');
        $config = $this->validate_config();
        $this->form_validation->set_rules($config);

        if($this->form_validation->run() == FALSE)
        {
            return false;
        }else{
            return true;
        }
    }

    public function validate_config(){
      /*  
       $this->input->post("productname");//商品の名前
       $this->input->post("price");//商品の値段
       $this->input->post("role0_id");//カテゴリ１のid
       $this->input->post("role1_id");//カテゴリ２のid
       $this->input->post("role2_id");//カテゴリ３のid
       $this->input->post("text_overview");//商品の概要
       $this->input->post("text_etailed");//商品の詳細*/

        $config = array(
            array(
                    'field' => 'productname',
                    'label' => '商品の名前',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => '%s は必須です。',
                ),
            ),
            array(
                    'field' => 'price',
                    'label' => '商品の値段',
                    'rules' => 'required|numeric',
                    'errors' => array(
                        'required' => '%s は必須です。',
                        'numeric' => '%s は半角数字で記入してください。',
                ),
            ),
            array(
                    'field' => 'role0_id',
                    'label' => 'テゴリ１',
                    'rules' => 'callback_role0_id_check',
            ),
            array(
                    'field' => 'role1_id',
                    'label' => 'テゴリ2',
                    'rules' => 'callback_role1_id_check',
            ),
            array(
                    'field' => 'role2_id',
                    'label' => 'テゴリ3',
                    'rules' => 'callback_role2_id_check',
            ),
            array(
                    'field' => 'color_0',
                    'label' => '色選択',
                    'rules' => 'callback_color_0_check',
            ),
            array(
                    'field' => 'text_overview',
                    'label' => '商品の概要',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => '%s は必須です。',
                ),
            ),
            array(
                    'field' => 'text_etailed',
                    'label' => '商品の詳細',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => '%s は必須です。',
                ),
            ),
            array(
                'field' => 'maincolor',
                'label' => 'メイン画像',
            )


    );
    return $config;
    }


    public function role0_id_check($str)
    {
            if ($str == 'non')
            {
                    $this->form_validation->set_message('role0_id_check', 'カテゴリ1を選択してください。');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }
    }


    public function role1_id_check($str)
    {
            if ($str == 'non')
            {
                    $this->form_validation->set_message('role1_id_check', 'カテゴリ2を選択してください。');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }
    }


    public function role2_id_check($str)
    {
            if ($str == 'non')
            {
                    $this->form_validation->set_message('role2_id_check', 'カテゴリ3を選択してください。');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }
    }


    public function color_0_check($str)
    {
            if ($str == 'non')
            {
                    $this->form_validation->set_message('color_0_check', '色が選択されていません。');
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }
    }
}