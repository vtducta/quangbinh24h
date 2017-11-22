<?php
    class TinMoiModel extends Model 
    {                          
        protected function do_insert($data)
        {                                  
            $this->db->insert( 'table' , $data );
            return $this->db->getInsertId(); 
        }

        protected function do_update($data,$condition)
        {                                             
            $this->db->update( 'table' , $data , $condition );
            return $this->db->getAffectedRows();
        }

        protected function do_delete($condition)
        {                                       
            $this->db->delete( 'table', $condition );
            return $this->db->getAffectedRows();     
        }

        protected function do_select($condition,$order,$offset,$limit)
        {
            return $this->db->buildAndFetchAll(array(
            'select'     => '*',                
            'from'        => 'table',           
            'where'         => $condition,      
            'order'        =>  $order,          
            'limit'        => array($offset,$limit)
            ));                                         
        }                                                       
        public function get_content()
        {
            $key ="content#tinmoi#";
            $list_content = $this->mem_get(md5($key));            
            if(!$list_content)
            {
                $list_content = $this->get_content_json();    
            }            
            if(!$list_content)
            {
                return array();              
            }else{
                $this->mem_set(md5($key),$list_content,2*24*60*60);
            }                
            return $list_content;
        }        
        public function reset_get_content()
        {
            $key ="content#tinmoi#";            
            $list_content = $this->get_content_json();
            if(!count($list_content['tinmoi']) || !count($list_content['thethao']['data']) )
            {
                return false;              
            }            
            $this->mem_set(md5($key),$list_content,2*24*60*60);
            return true;   
        }
        public function reset_get_content_tinmoi()
        {
            $file_name ="tinmoi.txt";            
            $content = $this->get_content_json2();
            $upload_dir = "/www/media.nguoiduatin.vn/public_html". DS ."API";
            $file_name = $upload_dir."/".$file_name;                       
            if($content)
            {
                file_put_contents($file_name,$content);    
                return true;
            }
        }

        public function content_nhadat_tinmoi($data)
        {
            $key = "content#nhadat#tinmoi#a";
            $this->mem_set(md5($key),$data,24*7*3600);
        }
        public function get_content_nhadat_tinmoi()
        {
            $key = "content#nhadat#tinmoi#a";
            $content = $this->mem_get(md5($key));            
            if($content)
            {
                $this->mem_set(md5($key),$content,24*7*3600);    
            }
            return $content;            
        }
        
        public function video_nguoiduatin($data)
        {
            $key = "video#nguoiduatin#2014###";           
            $this->mem_set(md5($key),$data,24*7*3600);
        }
        public function get_video_nguoiduatin()
        {
            $key = "video#nguoiduatin#2014###";           
            $content = $this->mem_get(md5($key));            
            if($content)
            {
                $this->mem_set(md5($key),$content,24*7*3600);    
            }
            return $content;            
        }

        public function content_tinmoi()
        {            
            $key ="content#tinmoi#home#";
            $list_content = $this->mem_get(md5($key));                       
            if(!$list_content)
            {
                $list_content = file_get_contents("/www/media.nguoiduatin.vn/public_html/API/tinmoi.txt");             
            }            
            $this->mem_set(md5($key),$list_content,15*3600);            
            return $list_content;
        }
        public function reset_content_tinmoi()
        {
            $key ="content#tinmoi#home#";            
            $list_content = file_get_contents("media.nguoiduatin.vn/API/tinmoi.txt");
            $this->mem_set(md5($key),$list_content,15*3600);            
            return true;
        }


        /**
        * get content api tinmoi.vn
        * @author tann        
        * @return string
        */
        public function get_content_json2()
        {
            $ctx=stream_context_create(array('http'=>
            array(
            'timeout' => 2 // 20s 
            )
            ));

            $content_thethao247 = file_get_contents("http://thethao247.vn/tinmoi.html",false,$ctx);
            $content_thethao247 = json_decode($content_thethao247,true);

            $content_giaitri_tinmoi = file_get_contents("http://giaitri.tinmoi.vn/?act=manual_rss&limit=6&type=json",false,$ctx);            
            $content_giaitri_tinmoi = preg_replace('#^.*?(\{|\[]})#is', '\\1', $content_giaitri_tinmoi);            
            $content_giaitri_tinmoi = json_decode($content_giaitri_tinmoi,true);           

            /*            $rss_edaily = simplexml_load_file("http://edaily.vn/rss/trang-chu.rss");             
            $content_edaily = array();            
            if($rss_edaily)
            {
            foreach ($rss_edaily->channel->item as $item) {
            $title = (string) $item->title; // Title
            $link = (string) $item->link; //link
            $image = (string) $item->image;//image
            $content_edaily[] = array('title' => $title,'link'=>$link,'images'=>$image);
            }               
            } */           

            $array = array(
            'tinmoi' =>$content_giaitri_tinmoi,
            'thethao' => $content_thethao247,
            );                        
            return json_encode($array);
        }
        public function get_content_json()
        {
            $ctx=stream_context_create(array('http'=>
            array(
            'timeout' => 2 // 20s 
            )
            ));

            $content_thethao247 = file_get_contents("http://thethao247.vn/tinmoi.html",false,$ctx);
            $content_thethao247 = json_decode($content_thethao247,true);
            $content_giaitri_tinmoi = file_get_contents("http://giaitri.tinmoi.vn/?act=manual_rss&limit=6&type=json",false,$ctx);            
            $content_giaitri_tinmoi = preg_replace('#^.*?(\{|\[]})#is', '\\1', $content_giaitri_tinmoi);            
            $content_giaitri_tinmoi = json_decode($content_giaitri_tinmoi,true);           
            $array = array(
            'tinmoi' =>$content_giaitri_tinmoi,
            'thethao' => $content_thethao247
            );                        
            return $array;
        }
        /*public function get_data($url)
        {
            $key = "ndt#get#data#{$url}";
            $result = $this->mem_get(md5($key));
            if(empty($result)){
                $ctx = stream_context_create(array(
                    'http' => array(
                        'timeout' => 10
                        )
                    )
                );
                $html = file_get_contents($url,false,$ctx);
                echo '<!--kq1234';
                var_dump($html); 
                echo '-->'; 
                $html = json_decode($html,true);
                $this->mem_set(md5($key),$html,15*60);              
            }
            return $result;
        }*/ 
    }
?>
