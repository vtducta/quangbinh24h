<?php
class NewsEventModel extends Model{

    protected function do_insert($data)

    {          

        $this->db->insert( 'news_event' , $data );

        return $this->db->getInsertId();                   

    }

    protected function do_update($data,$condition)

    {

        $this->db->update( 'news_event' , $data , $condition );

        return $this->db->getAffectedRows();

    }

    protected function do_delete($condition)

    {

        $this->db->delete( 'news_event', $condition );

        return $this->db->getAffectedRows(); 

    }

    protected function do_select($condition,$order,$offset,$limit)

    {

        return $this->db->buildAndFetchAll(array(

             'select'     => '*',

             'from'        => 'news_event',

             'where'         => $condition,

             'order'        =>  $order,

             'limit'        => array($offset,$limit)

        ));                              

    }
    public function get_total_event()
    {
       $result = $this->db->buildAndFetchAll(array(

             'select'     => 'count(*) as total',

             'from'        => 'news_event',

             'where'         => "status=1",

             'order'        =>  ""
        ));                               
        return $result[0]['total'];
    }
    
    public function get_event($id)    
    {
        $key = get_class($this)."#event#{$id}";
        $event = $this->mem_get(md5($key));
        if(!$event)
        {
            $event = $this->get_once("id ='{$id}'");    
        }
        if(!$event)
        {
            return array();
        }else{
            $this->mem_set(md5($key),$event,60);   
        }
        return $event;
    }
    
    public function reset_get_event($id)    
    {
        $key = get_class($this)."#event#{$id}";
        $event = $this->get_once("id ='{$id}'");    
        if(!$event)
        {
            return false;
        }else{
            $this->mem_set(md5($key),$event,60);   
            return true;
        }    
    }
    
    public function get_total($condition="1")
    {
        $total = $this->db->buildAndFetchAll(array(
            'select'     => 'count(*) as total',
            'from'        => 'news_event as a',
            'where'         => $condition,
            'order'        =>  "",
            'limit'        => array()
        ));            
        if($total)
        {
            return $total[0]['total'];
        }
        else{
             return 0;
        }
    }
        
    public function get_active_event($limit,$offset=0){
      /*  if ($limit <= 0){
            return array();
        } */
        return $this->get_list("status = 1","id desc",$offset,$limit);
    }
    
    public function get_list_event($limit,$offset=0,$category_id="",$is_cache=true){
        $key = "get_list#event#{$offset}#{$limit}#{$category_id}#5";
         
        if($is_cache){
            $list_event = $this->mem_get(md5($key));  
            if($list_event)
                return $list_event;
        }    
        
        $list_event = array();
        $condition = "status =1";
        if($category_id)
            $condition .= " and category_id='{$category_id}'";
            
        $list_event = $this->get_list($condition,"id desc",$offset,$limit);    
        if(!$list_event)
        {
            return array();
        }else{
            $this->mem_set(md5($key),$list_event,5*60);    
        }
        return $list_event;           
    }   
     
    public function list_event($limit,$offset=0,$category_id="")
    {
        $key = "######1list#event#{$offset}#{$limit}#{$category_id}#555";
        $list_event = $this->mem_get(md5($key));  
        
        if(!$list_event) 
        {
            $condition = "status =1";
            $order = "`ordering` desc";
            if($category_id){
                $condition .= " and category_id='{$category_id}'";
             //   $order = "id desc";
            }else{
                $condition .= " and feature_home=1";               
            }
                
                //echo "<!-- {$condition}-->";
            $list_event = $this->get_list($condition,$order,$offset,$limit);    
        }
        
        if(!$list_event)
        {
            return array();
        }else{
            $this->mem_set(md5($key),$list_event,5*60);    
        }
        return $list_event;
    }
    
    public function reset_list_event($limit,$offset=0,$category_id="")
    {
        $key = "######1list#event#{$offset}#{$limit}#{$category_id}#555";
        $list_event = array();     
           if(!$list_event) 
            {
                $condition = "status =1";
                if($category_id){
                    $condition .= " and category_id='{$category_id}'";
                    $order = "id desc";
                }else{
                    $condition .= " and feature_home=1";
                    $order = "`ordering` desc";
                }
                    
                    //echo "<!-- {$condition}-->";
                $list_event = $this->get_list($condition,$order,$offset,$limit);    
            }
        if(!$list_event)
        {
            return array();
        }else{
            $this->mem_set(md5($key),$list_event,5*60);    
        }
        return $list_event;
    }

}
?>