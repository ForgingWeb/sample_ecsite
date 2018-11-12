<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shop_manage_lib {
        public function upload_exe($products_dir,$input_name)
        {
                #画像のアップロード
                $CI =& get_instance();
                $error = "";
                $data = [];
                $filename = "";
                
                        if ( ! $CI->upload->do_upload($input_name))
                        {
                                $error = $CI->upload->display_errors();
                        }
                        else
                        {
                                $data = $CI->upload->data();
                                $filename = $data["file_name"];//
                                
                        }
echo $error;

                return array("error"=>$error,"filename"=>$filename);
        }


        public function img_rename_make_thumb($tmp_dir,$filename){
                $CI =& get_instance();
                #画像のリネーム、リサイズ、サムネイル作成
                $CI->load->helper('string');
                $rn = random_string('alnum', 5);
                #リネーム
                $newname = "A".date("YmdHis").$rn.".jpg";
                $source_image = $tmp_dir.$filename;
                $rename_path = $tmp_dir.$newname;
                
                $rename_path_thumb = $tmp_dir."thumb_".$newname;
                rename($source_image,$rename_path);
                
                $config['image_library'] = 'ImageMagick';
                
                        if(DIRECTORY_SEPARATOR == '\\'){
                                #サーバがwindowsの場合のパス
                                $config['library_path'] = 'C:\\xampp\\php\\ext\\bin';
                        }else{
                                $config['library_path'] = '/usr/bin';
                        }

                $config['source_image'] = $rename_path;
                $config['maintain_ratio'] = TRUE;
                $config['new_image'] = $rename_path_thumb;
                $config['height']       = 150;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                

                return $newname;
            }
}