<?php
    class ListAdvertise extends Module implements IModule
    {
        private $tm_users_model;
        private $news_category_model;
        private $tm_groups_cat_model;
        private $premission_model;
        private $advertise_model;

        public function __construct($param=null)
        {
            $this->init(get_class($this));

            $this->tm_users_model       = Loader::load_model("tm_users");
            $this->news_category_model  = Loader::load_model("news_category");
            $this->tm_groups_cat_model  = Loader::load_model("tm_groups_cat");
            $this->premission_model     = Loader::load_model("permission");
            $this->advertise_model      = Loader::load_model('advertise');

            $this->template->assign('link_helper',$this->linkHelper);
            $this->template->assign('template_helper',$this->templateHelper);
        }

        public function run()
        {
            $user_id = $this->session->get_session("userid");
            if(!$user_id){
                Application::redirect($this->linkHelper->linkhome("login"));
            }

            if (isset($_POST['action'])) {
                $action = stripslashes($_POST['action']);
                if ($action == 'add' || $action == 'update'){
                    $this->update_advertise($user_id);
                }
                else if ($action == 'delete') {
                    $this->delete_advertise($user_id);
                }
            }
            else if (isset($_GET['action'])) {
                $action = stripslashes($_GET['action']);
                if ($action == 'active') {
                    $this->set_advertise_status(1);
                }
                else if ($action == 'deactive') {
                    $this->set_advertise_status(0);
                }
            }

            $position_id = isset($this->input['position_id']) ? $this->input['position_id'] : '';
            $position_id = stripslashes($position_id);
            if($position_id=="") $position_id = "all";

            $this->data['position_id'] = $position_id;
            $this->data['filter'] = array('position_id' => $position_id);
            $ext = '';
            if ($this->data['filter']['position_id'] != ''){
                $ext = '&position_id=' . $this->data['filter']['position_id'];
            }
            $this->data['ext'] = $ext;

            $this->data['positions'] = $this->assign_array_position();

            $position_id_query = "";
            if ($position_id=="all")
                $position_id_query = "all";
            else
                $position_id_query = "{$position_id}";

            $list_category = $this->news_category_model->get_list_category_mysql("parent_id=0 AND status=1","ordering ASC",0,"");
            $this->data['list_category'] = $list_category;
            //Get list tin theo quyền, filter...
            $limit = 10;
            $offset = ($current_page - 1) * $limit;
            $total_page = 1000;
            $this->data['pager'] = array(
                'current' => $current_page,
                'total' => $total_page,
                'paging' => Application::paging($current_page, $total_page, 5)
            );

            $this->data['site'] = array(
                'title' => 'Danh sách quản lý quảng cáo',
                'description' => 'Danh sách quản lý quảng cáo',
                'keywords' => ''
            );

            $type = 'pc';
            if(isset($_GET['type'])){
                $type = $_GET['type'];
            }
            $this->data['type'] = $type;
            #
            $module = 'home';
            if(isset($_GET['module'])){
                $module = $_GET['module'];
            }
            $this->data['module'] = $module;
            #
            if(isset($_GET['advertise_position'])) $advertise_position = $_GET['advertise_position']; else $advertise_position = 'top-header';
            $advertise = $this->advertise_model->get_list_advertise(array(
                'module'  => $module,
                'advertise_position'  => $advertise_position
            ), 0, 1);
            
            //list_cat_selected
            $list_cat_selected = $advertise['category_ids'];
            $list_cat_selected = explode('|',$list_cat_selected);
            $list_cat_selected = array_filter($list_cat_selected);

            $this->data['advertise'] = $advertise;
            $this->data['advertise_position'] = $advertise_position;
            $this->data['list_cat_selected'] = $list_cat_selected;
            #
            $arr = $this->assign_array_position();
            $this->data['positions'] = $arr[$type][$module];
            $this->template->assign('data', $this->data);
            $this->template->display('advertise/list_advertise.tpl');
        }

        public function assign_array_position()
        {
            //$listads = $this->advertise_model->get_ads('home','pc');
            //print_r($listads);die();
            $positions = array();
            $positions['pc']['home'] = array(
                'top-header' => 'Top header 700x100',
                'header-1'    => 'Header 1 334x100',
                'header-2'    => 'Header 2 334x100',
                'header-3'    => 'Header 3 334x100',
                'float-left' => 'Float left 120x300',
                'float-right' => 'Float right 120x300',
                'top-hot' => 'Top hot 300x250',
                'top' => 'Top 300x250',
                'middle' => 'Middle 970x90',
                'home-content' => 'Home content 300x300',
                'top-sidebar' => 'Top sidebar 300x300',
                'sidebar-1' => 'Sidebar 1 300x300',
                'sidebar-2' => 'Sidebar 2 300x600',
            );
            $positions['pc']['cat'] = array(
                'top-header' => 'Top header 700x100',
                'header-1'    => 'Header 1 334x100',
                'header-2'    => 'Header 2 334x100',
                'header-3'    => 'Header 3 334x100',
                'float-left' => 'Float left 120x300',
                'float-right' => 'Float right 120x300',
                'cat-sidebar-1' => 'Sidebar 1 300x300',
                'cat-sidebar-2' => 'Sidebar 2 300x300',
                'cat-sidebar-3' => 'Sidebar 3 300x300',
            );
            $positions['pc']['detail'] = array(
                'top-header' => 'Top header 700x100',
                'header-1'    => 'Header 1 334x100',
                'header-2'    => 'Header 2 334x100',
                'header-3'    => 'Header 3 334x100',
                'float-left' => 'Float left 120x300',
                'float-right' => 'Float right 120x300',
                'detail-top-content' => 'Top content 300x300',
                'detail-middle-vertical-content-1' => 'Middle vertical content 1 120x600',
                'detail-middle-vertical-content-2' => 'Middle vertical content 2 120x600',
                'detail-top-sidebar' => 'Top sidebar content 300x300',
                'detail-sidebar-1' => 'Sidebar 1 300x600',
                'detail-sidebar-2' => 'Sidebar 2 300x300',
            );
            $positions['mobile']['home'] = array(
                'mobile-top-header' => 'Top header 320x90',
                'mobile-middle' => 'Middle 320x90',
            );
            $positions['mobile']['cat'] = array(
                'mobile-top-header' => 'Top header 320x90',
            );
            $positions['mobile']['detail'] = array(
                'mobile-top-header' => 'Top header 320x90',
                'mobile-under-title-content' => 'Under title content 300x250',
                'mobile-middle-content' => 'Auto middle content 300x250',
                'mobile-below-content' => 'Below content 300x250',
            );
            return $positions;
        }

        private function update_advertise($userId)
        {
            $flag            = false;
            $title = isset($this->input['advertise_title']) ? $this->input['advertise_title'] : '';
            $embed = isset($this->input['advertise_embed']) ? $this->input['advertise_embed'] : '';
            $order = isset($this->input['advertise_order']) ? $this->input['advertise_order'] : '';
            $width = isset($this->input['advertise_width']) ? $this->input['advertise_width'] : '';
            $height = isset($this->input['advertise_height']) ? $this->input['advertise_height'] : '';
            $publishdate = isset($this->input['publishdate']) ? $this->input['publishdate'] : '';
            $start_date = isset($this->input['start_date']) ? $this->input['start_date'] : '';
            $end_date = isset($this->input['end_date']) ? $this->input['end_date'] : '';
            $active = isset($this->input['advertise_active']) && $this->input['advertise_active'] == 'on' ? 1 : 0;
            $position = isset($_GET['advertise_position']) ? $this->input['advertise_position'] : 'top-header';
            $type = isset($this->input['type']) ? $this->input['type'] : '';
            $module = isset($this->input['module']) ? $this->input['module'] : '';
            $category_id = isset($this->input['news_focus']) ? $this->input['news_focus'] : array();
            $category_id = array_filter($category_id);
            $category_id = implode('|',$category_id);
            $category_id = '|'.$category_id.'|';

            $advertiseId = isset($this->input['id']) ? $this->input['id'] : 0;

            if (!isset($embed) || $embed == ''){
                if (isset($image['src']) && $image['src'] != ''){
                    $embed = '<a href="' . $link .'" target="blank"><img src="' . Application::$config['global']['URL']['Media'] . $image['src'] . '" title="' . $title . '" ></a>';
                }
            }else{
                $embed = str_replace('\r','', $embed);
                $embed = str_replace('\n','', $embed);
                $embed = stripslashes($embed);
            }
            if (trim($title) != '') {
                if ($advertiseId > 0) {
                    $flag = $this->advertise_model->update_advertise(array(
                        'advertise_title'             => $title,
                        'advertise_position'          => $position,
                        'advertise_width'             => $width,
                        'advertise_height'            => $height,
                        'advertise_embed'             => $embed,
                        'advertise_order'             => $order,
                        'advertise_published_date'    => strtotime($publishdate),
                        'start_date'                  => strtotime($start_date),
                        'end_date'                    => strtotime($end_date),
                        'advertise_active'            => $active,
                        'advertise_id'                => $advertiseId,
                        'type'                        => $type,
                        'module'                      => $module,
                        'category_ids'                => $category_id
                    ));
                    if ($flag) {
                        $this->session->set_session('msg', "Cập nhật quảng cáo thành công.");
                    }
                    else {
                        $this->session->set_session('error', 'Có lỗi xảy ra. Xin thử lại sau.');
                    }
                }
                else {
                    $advertiseId = $this->advertise_model->insert_advertise(array(
                        'advertise_title'            => $title,
                        'advertise_position'         => $position,
                        'advertise_width'            => $width,
                        'advertise_height'           => $height,
                        'advertise_embed'            => $embed,
                        'advertise_order'            => $order,
                        'advertise_published_date'   => strtotime($publishdate),
                        'start_date'                 => strtotime($start_date),
                        'end_date'                   => strtotime($end_date),
                        'user_id'                    => $userId,
                        'advertise_active'           => $active,
                        'type'                       => $type,
                        'module'                     => $module,
                        'category_ids'               => $category_id
                    ));
                    if ($advertiseId) {
                        $flag = true;
                        $this->session->set_session('msg', "Tạo quảng cáo thành công.");
                    }
                    else {
                        $this->session->set_session('error', 'Có lỗi xảy ra. Xin thử lại sau.');
                    }
                }
            }else {
                $this->session->set_session('error', 'Chưa nhập tên quảng cáo.');
            }
            header('Location: '.$_SERVER['REQUEST_URI']);
        }

        public function destroyed()
        {

        }
    }
?>