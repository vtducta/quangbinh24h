<?php
    class AdvertiseModel extends Model
    {
        /**
        * template helper
        * @var TemplateHelper
        */
        private $template_helper;

        public function __construct()
        {
            parent::__construct();

            $this->template_helper  = Loader::load_helper('template_helper');
        }

        protected function do_insert($data)
        {
            $this->db->insert( 'advertise' , $data );
            return $this->db->getInsertId();
        }

        protected function do_update($data,$condition)
        {
            return $this->db->update( 'advertise' , $data , $condition );
        }

        protected function do_delete($condition)
        {
            return $this->db->delete( 'advertise', $condition );
        }

        protected function do_select($condition,$order,$offset,$limit)
        {
            return $this->db->buildAndFetchAll(array(
                'select'     => '*',
                'from'        => 'advertise',
                'where'         => $condition,
                'order'        =>  $order,
                'limit'        => array($offset,$limit)
            ));
        }

        public function get_advertise($options = array(), $offset=0, $limit=5, $is_cache=true)
        {

            // get result from memcache
            $mem_key = "qc1#" . __FUNCTION__ . $this->template_helper->build_mem_key($options) . "#offset:$offset#limit:$limit";
            if ($is_cache && $result = $this->mem_get(md5($mem_key))) {
                return $result;
            }
            // no cache
            $condition = "start_date<".time()." and end_date>".time().
            (isset($options['id'])              ? " and advertise_id          = {$options['id']} " : '').
            (isset($options['position'])         ? " and advertise_position     = '{$options['position']}' " : '').
            (isset($options['order'])             ? " and advertise_order         = {$options['order']} " : '').
            (isset($options['active'])             ? " and advertise_active          = {$options['active']} " : '') .
            (isset($options['category_id'])     ? " and category_id      = {$options['category_id']}%'" : '').
            (isset($options['category_ids'])     ? " and category_ids not like '%|{$options['category_ids']}|%'" : '');

            
            $result = $this->get_list($condition, "advertise_order asc", $offset, $limit);
            if (count($result)) {
                // set data to mem
                foreach ($result as $key=>$item) {
                    $result[$key] = $item->to_array();
                    $result[$key]['advertise_embed'] = str_replace("http://seatimes.com.vn", Application::$config['global']['URL']['Domain'], $item->get('advertise_embed'));
                }
                if ($limit == 1) $result = $result[0];
                $this->mem_set(md5($mem_key), $result, 500);
                return $result;
            }
            return array();
        }
        
        public function get_ads($module)
        {
            $mem_key = "get_ads4_".$module;
            $result = $this->mem_get(md5($mem_key));
            if($result) return $result;
            $condition = 'module="'.$module.'" AND advertise_active=1';
            $result = $this->get_list($condition, "advertise_order ASC", 0, 20);
            if($result) {
                foreach($result as $key=>$item) {
                    $result[$key] = $item->to_array();
                }
                $res = array();
                foreach($result as $one){
                    $res[$one['advertise_position']] = $one['advertise_embed'];
                }
                $this->mem_set(md5($mem_key), $res, 300);
                return $res;
            }
            return array();
        }
        
        public function reset_get_ads($module)
        {
            $mem_key = "get_ads4_".$module;
            $condition = 'module="'.$module.'" AND advertise_active=1';
            $result = $this->get_list($condition, "advertise_order ASC", 0, 20);
            if($result) {
                foreach($result as $key=>$item) {
                    $result[$key] = $item->to_array();
                }
                $res = array();
                foreach($result as $one){
                    $res[$one['advertise_position']] = $one['advertise_embed'];
                }
                $this->mem_set(md5($mem_key), $res, 300);
            }
        }

        public function get_advertise_by_id($advertiseId)
        {
            $mem_key = "#advertise#id:$advertiseId";
            if ($result = $this->mem_get(md5($mem_key))) {
                return $result;
            }

            $result = $this->get_once("advertise_id=$advertiseId");
            if (isset($result)) {
                $return = $result->to_array();
                $this->mem_set(md5($mem_key), $return, MEMCACHE_MAX_TIMEOUT);
                return $return;
            }
            return array();
        }

        public function push_advertise_by_id($advertiseId)
        {
            $mem_key = "#advertise#id:$advertiseId";
            $result = $this->get_once("advertise_id=$advertiseId");
            if (isset($result)) {
                $return = $result->to_array();
                $this->mem_set(md5($mem_key), $return, MEMCACHE_MAX_TIMEOUT);
            }
        }

        public function get_list_advertise($options = array(), $offset = 0, $limit = 10)
        {
            // no cache

            $select = "".
                (isset($options['join_user'])         ? 'u.fullname as create_name, ' : '') .
                (isset($options['field'])             ? $options['field'] : 'a.* ');

            $condition = "1" .
                (isset($options['status'])             ? ' and a.advertise_active     = ' . $options['status'] : '') .
                (isset($options['advertise_position']) ? " and a.advertise_position = '{$options['advertise_position']}'" : '') .
                (isset($options['module']) ? " and a.module = '{$options['module']}'" : '') .
                (isset($options['advertise_id'])     ? ' and a.advertise_id         = ' . $options['advertise_id'] : '');
                
            $sql = array(
                'select' => $select,
                'from' => array('advertise' => 'a'),
                'where' => $condition,
                'order' => 'a.advertise_position desc,a.advertise_order asc,a.advertise_active desc',
                'limit' => array($offset, $limit)
            );
            if (isset($options['join_user'])) {
                $sql['add_join'][] = array(
                    'from' => array('tm_users'=>'u'),
                    'where' => 'a.user_id = u.user_id',
                    'type' => 'inner'
                );
            }
            $result = $this->db->buildAndFetchAll($sql);
            if (count($result)) {
                if ($limit == 1) $result = $result[0];
                return $result;
            }
            return array();
        }

        public function insert_advertise($item)
        {

            if (!empty($item['advertise_photo']))
                $item['advertise_photo'] = Application::$config['global']['URL']['Media'] . $item['advertise_photo'];

            $flag = $this->do_insert($this->template_helper->stripslashes_deep($item));
            if ($flag) {
                $this->push_advertise_by_id($flag);
            }
            return $flag;
        }

        public function update_advertise($item)
        {

            if (!empty($item['advertise_photo']))
                $item['advertise_photo'] = Application::$config['global']['URL']['Media'] . $item['advertise_photo'];
            $id = isset($item['advertise_position']) ? $item['advertise_position'] : '';
            $module = isset($item['module']) ? $item['module'] : '';
            if (!$id) return false;
            if (!$module) return false;
            unset($item['advertise_position']);
            unset($item['advertise_id']);
            $flag = $this->do_update($this->template_helper->stripslashes_deep($item), "advertise_position = '$id' AND module='$module'");
            $this->reset_get_ads($module);
            return $flag;
        }

        public function delete_advertise($id)
        {
            return $this->do_delete("id=$id");
        }

        public function set_advertise_status($advertiseId, $status)
        {
            $flag = $this->do_update(array('advertise_active' => $status), "advertise_id in ($advertiseId)");
            if ($flag) {
                $this->push_advertise_by_id($advertiseId);
            }
            return $flag;
        }

        public function insert_advertise_route_rel($item = array())
        {
            if (isset($item['action']) && $item['action'] == 'update'){
                $this->do_delete("advertise_id = {$item['advertise_id']}");
            }

            $route_ids = explode(',', $item['route_ids']);
            foreach ($route_ids as $v) {
                $flag = $this->do_insert(array('advertise_id' => $item['advertise_id'], 'route_id' => $v));
            }
        }
    }
?>
