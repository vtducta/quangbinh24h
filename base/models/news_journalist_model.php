<?php
class NewsJournalistModel extends Model
{
    protected function do_insert($data)
    {          
        $this->db->insert( 'news_journalist' , $data );
        return $this->db->getAffectedRows();                   
    }

    protected function do_update($data,$condition)
    {
        $this->db->update( 'news_journalist' , $data , $condition );
        return $this->db->getAffectedRows();
    }

    protected function do_delete($condition)
    {
        $this->db->delete( 'news_journalist', $condition );
        return $this->db->getAffectedRows();  
    }

    protected function do_select($condition,$order,$offset,$limit)
    {
        return $this->db->buildAndFetchAll(array(
             'select'     => 'a.*',
             'from'        => array('news_journalist' => 'a'),
             'where'         => $condition,
             'order'        =>  $order,
             'limit'        => array($offset,$limit)
        ));                              
    }
    
    public function insert_news_journalist($news_id, $journalist_id)
    {
        $bean = $this->create_bean();
        $bean->set('news_id', $news_id);
        $bean->set('journalist_id', $journalist_id);
        $this->insert($bean);
        return $this->db->getInsertId();
    }    
    
    public function get_news_journalist_sql($news_id, $limit=1)
    {
        $result = $this->db->buildAndFetchAll(array(
            'select' => 'a.*',
            'from' => array('journalist'=>'a'),
            'where' => 'b.news_id =' . $news_id,
            'add_join' => array(
                0 => array(
                    'select' => 'b.news_id',
                    'from' => array('news_journalist' => 'b'),
                    'where' => 'a.id=b.journalist_id',
                    'type' => 'inner'
                )
            ),
            'limit' => array(0,$limit)
        ));
        if (isset($result[0])) {
            return $result;            
        }
        return array();
    }
    
    public function get_news_journalist($news_id, $limit=1)
    {
        $key = "#news#journalist#$news_id";
        if ($result = $this->mem_get(md5($key))) {
            return $result;
        }
        else {
            $result = $this->get_news_journalist_sql($news_id, $limit);
            $this->mem_set(md5($key), $result, 600);
            return $result;
        }
    }
    
    public function get_news_by_journalist($journalist_id) 
    {
        $result = $this->get_list("journalist_id=$journalist_id");
        if (count($result)) {
            return $result;
        }
        return array();
    }
    
    public function get_total_news_by_journalist($journalist_id)
    {
        $result = $this->db->buildAndFetchAll(array(
            'select' => 'sum(a.cnt) as total',
            'from' => array('news_journalist' => 'a'),
            'where' => "a.journalist_id=$journalist_id and b.id is not null",
            'add_join' => array(
                0 => array(
                    'select' => 'b.id',
                    'from' => array('news_articles'=>'b'),
                    'where' => 'b.id=a.news_id',
                    'type' => 'inner'
                ),
            )
        ));
        if (isset($result[0]))
            return $result[0]['total'];
        return 0;
    }
}
?>