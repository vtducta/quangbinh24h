<?php
    class VideoModel extends Model 
    {                          
        protected function do_insert($data)
        {                                  
            $this->db->insert( 'video' , $data );
            return $this->db->getInsertId(); 
        }

        protected function do_update($data,$condition)
        {                                             
            $this->db->update( 'video' , $data , $condition );
            return $this->db->getAffectedRows();
        }

        protected function do_delete($condition)
        {                                       
            $this->db->delete( 'video', $condition );
            return $this->db->getAffectedRows();     
        }

        protected function do_select($condition,$order,$offset,$limit)
        {
            return $this->db->buildAndFetchAll(array(
                'select'     => '*',                
                'from'        => 'video',           
                'where'         => $condition,      
                'order'        =>  $order,          
                'limit'        => array($offset,$limit)
            ));                                         
        }
        public function insertVideo($title,$images,$link)
        {
            $bean = $this->create_bean();
            $bean->set("title",$title);
            $bean->set("images",$images);
            $bean->set('link',$link);
            $bean->set("create_date_int",time());
            $this->insert($bean);
        } 
        public function editVideo($id,$title,$images,$link)
        {
            $bean = $this->create_bean();
            $bean->set("title",$title);
            $bean->set("images",$images);
            $bean->set('link',$link);
            $this->update($bean,"id={$id}");
        }
        public function admin_get_video_by_mysql($condition,$order,$offset,$limit){
            $content = $this->get_list($condition,$order,$offset,$limit);                
            $array = array();
            if($content)
            {                    
                foreach($content as $key=>$value)   
                {
                    $array[$key] = array(
                        'id' => $value->get('id'),
                        'title' => $value->get('title'),
                        'images' => $this->get_image($value->get('images')),
                        'link' => $value->get('link'),
                        'create_date_int' => $value->get('create_date_int')
                    );
                }                         
                return $array;
            }else{
                return array();
            }
        }
        public function get_image($id)
        {
            $image =  $this->db->buildAndFetchAll(array(
                'select'     => 'a.*',
                'from'        => 'news_upload as a',
                'where'         => "a.id={$id}",
                'order'        => "a.id DESC",
                'limit'        => array(0,1)
            ));                                
            if($image)
            {
                return $image[0]['upload_url'];
            }
            else{
                $image_default = 'http://admin.nguoiduatin.vn/images/noimg.gif';
                return  $image_default;
            }
        }                                              
    }
?>
