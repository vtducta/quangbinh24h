<?php
    class NewsCategoryModel extends Model 
    {                          
        protected function do_insert($data)
        {                                  
            $this->db->insert( 'news_category' , $data );
            return $this->db->getInsertId(); 
        }

        protected function do_update($data,$condition)
        {                                             
            $this->db->update( 'news_category' , $data , $condition );
            return $this->db->getAffectedRows();
        }

        protected function do_delete($condition)
        {                                       
            $this->db->delete( 'news_category', $condition );
            return $this->db->getAffectedRows();     
        }

        protected function do_select($condition,$order,$offset,$limit)
        {
            return $this->db->buildAndFetchAll(array(
            'select'     => '*',                
            'from'        => 'news_category',           
            'where'         => $condition,      
            'order'        =>  $order,          
            'limit'        => array($offset,$limit)
            ));                                         
        }                                               
        public function get_category($slug_name)
        {
            $key = get_class($this)."#category#13#{$slug_name}";
            if($category = $this->mem_get(md5($key)))
            {
                return $category;
            }
            $category = $this->get_once("meta_slug ='{$slug_name}'");
            if(!$category)
            {
                return array();
            }
            $this->mem_set(md5($key),$category,60);
            return $category;
        }
         public function get_category_by_slug($slug_name)
        {
            $key = get_class($this)."#category#1446#{$slug_name}";
            $category = $this->mem_get(md5($key));
            if(!$category)
            {
                $category = $this->get_once("meta_slug ='{$slug_name}' AND status=1");    
            }            
            if(!$category)
            {
                return array();
            }else{
                $this->mem_set(md5($key),$category,60);    
            }            
            return $category;
        }
        public function reset_get_category_by_slug($slug_name)
        {
            $key = get_class($this)."#category#1446#{$slug_name}";
            $category = $this->get_once("meta_slug ='{$slug_name}' AND status=1");    
            if(!$category)
            {
                return array();
            }else{
                $this->mem_set(md5($key),$category,12*60*60);    
                return true;
            }                        
        }
        
        public function get_list_category_mysql($condition,$order,$offset,$limit)
        {
            $content = $this->get_list($condition,$order,$offset,$limit);
            return $content;
        } 
        public function get_name_category($cat_id)
        {
            $key = "name#category#13#{$cat_id}";
            $name_cat = $this->mem_get(md5($key));
            if(!$name_cat)
            {
              
                $name_cat = $this->get_once("id ={$cat_id}");    
            }            
            if(!$name_cat)
            {
                return array();
            }else{
                $this->mem_set(md5($key),$name_cat,60);    
            }            
            return $name_cat;
        }
        public function reset_name_category($cat_id)
        {
            $key ="name#category#13#{$cat_id}";
            $name_cat = $this->get_once("id ={$cat_id}");
            if(!$name_cat)
            {
                return false;
            }
            $this->mem_set(md5($key),$name_cat,15*60);
            return true;
        }
        
        public function build_child_category_sql1()
        {
            $list_category = $this->get_list("parent_id =0 and status = 1 AND home_display=0","ordering desc",0,"");                
            $cat_nguoiduatin = array();            
            foreach($list_category as $key=>$value)
            {
                $arr_child = array();
                $list_child = $this->get_list("parent_id={$value->get('id')} and status = 1 AND home_display=0","ordering desc",0,"");                                
                if($list_child)
                {
                    foreach($list_child as $k=>$v)
                    {
                        $arr_child[]= $v->to_array();
                    }
                }
                $cat_nguoiduatin[$value->get('id')]  = array(
                    'id' => $value->get('id'),
                    'title' => $value->get('title'),
                    'meta_slug' => $value->get('meta_slug'),
                    'parent_id' => $value->get('parent_id'),
                    'meta_title' => $value->get('meta_title'),
                    'description' => $value->get('description'),
                    'meta_keywork' => $value->get('meta_keywork'),
                    'meta_description' => $value->get('meta_description'),
                    'child' => $arr_child
                ); 
            }                 
            return $cat_nguoiduatin;
        }     
        
        public function build_child_category_sql()
        {
            $list_category = $this->get_list("parent_id =0 and status = 1 AND home_display=0","ordering desc",0,"");                
            $cat_nguoiduatin = array();            
            foreach($list_category as $key=>$value)
            {
                $arr_child = array();
                $list_child = $this->get_list("parent_id={$value->get('id')} and status = 1 AND home_display=0","ordering desc",0,"");                                
                if($list_child)
                {
                    foreach($list_child as $k=>$v)
                    {
                        $arr_child[]= $v->to_array();
                    }
                }
                $cat_nguoiduatin[$value->get('id')]  = array(
                    'id' => $value->get('id'),
                    'title' => $value->get('title'),
                    'meta_slug' => $value->get('meta_slug'),
                    'parent_id' => $value->get('parent_id'),
                    'meta_title' => $value->get('meta_title'),
                    'description' => $value->get('description'),
                    'meta_keywork' => $value->get('meta_keywork'),
                    'meta_description' => $value->get('meta_description'),
                    'child' => $arr_child
                ); 
            }                 
            return $cat_nguoiduatin;
        }        
        public function build_child_category()
        {
            $key ="category#child#nguoiduatin#1313";        
            $list_category = $this->mem_get(md5($key));
            if($list_category==false)
            {
                $list_category = $this->build_child_category_sql();    
            }            
            $this->mem_set(md5($key),$list_category,60*5);            
            return $list_category;
        }
        
        public function reset_build_child_category()
        {
            $key ="category#child#nguoiduatin#1313";
            $list_category = $this->build_child_category_sql();
            $this->mem_set(md5($key),$list_category,60*5);
            return true;
        }
        
        public function build_child_video_category_sql($video_id=219)
        {   
            $category = $this->get_once("id={$video_id} and status = 1 AND home_display=0");  
           // var_dump($category);    
            if($category && $category->get("id")){
               // echo "test";
                $arr_child = array();
                $list_child = $this->get_list("parent_id={$category->get('id')} and status = 1 AND home_display=0","ordering desc",0,"");                                
                if($list_child)
                {
                    foreach($list_child as $k=>$v)
                    {
                        $arr_child[]= $v->to_array();
                    }
                }
                $category = $category->to_array();
                $category["list_child"]  = $arr_child; 
                return $category;
            }else{
                return null;
            }       
        }
        
        public function build_child_video_category($video_id=219)
        {
            $key ="videocategory#child#nguoiduatin#131{$video_id}";        
            $list_category = $this->mem_get(md5($key));
            if($list_category==false)
            {
                $list_category = $this->build_child_video_category_sql($video_id);    
            }            
            $this->mem_set(md5($key),$list_category,60*10);            
            return $list_category;
        } 
        
        public function reset_build_child_video_category($video_id=219)
        {
            $key ="videocategory#child#nguoiduatin#131{$video_id}";
            $list_category = $this->build_child_video_category_sql($video_id);
            $this->mem_set(md5($key),$list_category,60*10);
            return true;
        }       
        
        
        
        public function get_list_category($condition,$order,$offset,$limit)
        {
            $key ="#category##nguoiduatin#131232232".$condition;         
            $list_category = $this->mem_get(md5($key));
            if($list_category ==false)
            {             
                $list_category = $this->get_list_category_mysql($condition,$order,$offset,$limit);
            }
            if(!count($list_category))
            {
                return array();
            }else{
                $this->mem_set(md5($key),$list_category,24*7*60*60);
            }
            return $list_category;
        }
        public function reset_get_list_category($condition,$order,$offset,$limit)
        {
            $key = "#category##nguoiduatin#131232232".$condition;
            $list_category = $this->get_list_category_mysql($condition,$order,$offset,$limit);         
            if(!count($list_category))
            {
                return false;
            }else{
                $this->mem_set(md5($key),$list_category,24*7*60*62);
                return true;
            }
        }
        public function get_name_category_by_id($id)
        {
            $content = $this->get_once("id={$id}");            
            if($content)
            {
                return $content->get('title');
            }else{
                return "Chuyên mục khác";
            }
        }
        
        public function get_category_by_id($cat_id)
        {
            $result = $this->get_once("id=$cat_id");
            if (isset($result)) {
                return $result->to_array();
            }
            return array();
        }
        
        /**
        * build category tree
        * 
        */
        public function get_category_tree(){
            $key = "global#categorytree#12";
            if ($data_cache = $this->mem_get($key)){
                $data = $data_cache;
            }
            else{
                $data = $this->get_category_tree_sql();
                $this->mem_set($key,$data,30*24*60*60);
            }
            return $data;
        }
        
        /**
        * build  cateogy tree from sql
        * 
        */
        public function get_category_tree_sql(){
            $list_category = $this->get_list("parent_id =0","ordering ASC",0,"");
            $arr_menu = array();
            foreach ($list_category as $item){
                $arr_menu[$item->get('id')]['info'] = $item->to_array();
                $list_child = $this->get_list("parent_id={$item->get('id')} and status=1","ordering ASC",0,"");
                $arr_child = array();
                foreach ($list_child as $value){
                    $arr_child[] = $value->to_array();
                }
                $arr_menu[$item->get('id')]['child'] = $arr_child;
            }
            return $arr_menu;
        }
        public function get_list_category_menu()
        {
            $key ="list#category#menu";         
            $list_category = $this->mem_get(md5($key));
            if($list_category) return $list_category;
            
            $list_category = $this->get_list_category_mysql("ordering>0","ordering ASC");
            
            if(!$list_category){
                return array();
            }else{
                $cat = array();
                foreach($list_category as $key=>$value){
                    $cat[$value->get('id')]  = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'meta_slug' => $value->get('meta_slug'),
                        'parent_id' => $value->get('parent_id'),
                        'meta_title' => $value->get('meta_title'),
                        'description' => $value->get('description'),
                        'meta_keywork' => $value->get('meta_keywork'),
                        'meta_description' => $value->get('meta_description'),
                        'child' => $arr_child
                    ); 
                }
                $this->mem_set(md5($key),$cat,5*60);
                return $cat;
            }
        }
    }
?>
