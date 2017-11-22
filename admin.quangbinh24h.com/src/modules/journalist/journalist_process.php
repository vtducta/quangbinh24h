<?php
    class JournalistProcess extends Module implements IModule
    {        
        /**
        * permission  model
        * 
        * @var PermissionModel
        */
        private $permission_model;
        /**
        * TmUsersModel
        * 
        * @var TmUsersModel
        */
        private $tm_users_model; 
        /**
        * journalist model
        * @var JournalistModel
        */
        private $journalist_model;

        public function __construct($param=null)
        {
            $this->init(get_class($this));

            $this->permission_model = Loader::load_model('permission');
            $this->tm_users_model = Loader::load_model("tm_users");
            $this->journalist_model = Loader::load_model("journalist");

            $this->template->assign('link_helper', $this->linkHelper);
            $this->template->assign('template_helper', $this->templateHelper);
            $this->tm_users_model = Loader::load_model("tm_users");
            $user_id = $this->session->get_session("userid");   
            if(!$user_id || !is_integer($user_id)){            
                Application::redirect($this->linkHelper->linkhome("Login"));
            }else{
                $user_info = $this->tm_users_model->get_list("user_id = '{$user_id}' AND user_deleted=1","",0,1); 
                if(!$user_info) 
                    Application::redirect($this->linkHelper->linkhome("Login"));
                
            }
        }

        public function run()
        {
            $user_id = $this->session->get_session("userid");
            if(!$user_id)
            {
                Application::redirect($this->linkHelper->linkhome("login"));
            }
            $this->data['user_info'] = $this->tm_users_model->get_once("user_id={$user_id}");
            if(!$this->permission_model->check_permission($user_id,array(1,4)))
            {
                die('no permission');
            }  

            $mode = isset($this->input['mode']) ? $this->input['mode'] : "";
            switch ($mode) {
                case 'create' :
                    $this->create_journalist();
                    break;
                case 'edit' : 
                    $this->edit_journalist();
                    break;
                default :
                    exit();
            }
        }

        public function create_journalist()
        {
            $full_name = isset($this->input['full_name']) ? $this->input['full_name'] : "";
            $pen_name = isset($this->input['pen_name']) ? $this->input['pen_name'] : "";
            $email = isset($this->input['email']) ? $this->input['email'] : "";
            $facebook = isset($this->input['facebook']) ? $this->input['facebook'] : "";
            $facebook_link = isset($this->input['facebook_link']) ? $this->input['facebook_link'] : "";
            $twitter = isset($this->input['twitter']) ? $this->input['twitter'] : "";
            $gplus = isset($this->input['gplus']) ? $this->input['gplus'] : "";
            $gplus_link = isset($this->input['gplus_link']) ? $this->input['gplus_link'] : null;
            $birthday = isset($this->input['birthday']) ? $this->input['birthday'] : "";
            $avatar = isset($this->input['avatar']) ? $this->input['avatar'] : "";
            $biography = isset($this->input['biography']) ? $this->input['biography'] : "";
            $rate = isset($this->input['rate']) ? $this->input['rate'] : 0; 
            
            $check = $this->journalist_model->check_valid_journalist($email, $pen_name);
            if ($check) {
                $this->session->set_session('msg', "Tác giả đã tồn tại");
                Application::redirect($this->linkHelper->link_to_action('CreateJournalist'));
            }
            $journalist = array(
                'full_name' => $full_name,
                'pen_name' => $pen_name,
                'email' => $email,
                'facebook' => $facebook,
                'twiter' => $twiter,
                'gplus' => $gplus,
                'gplus_link'=> $gplus_link,
                'birthday' => $birthday,
                'avatar' => $avatar,
                'facebook_link' => $facebook_link,
                'biography' => $biography,
                'rate' => $rate
            );
            $id = $this->journalist_model->insert_journalist($journalist);
            $this->session->set_session('msg', 'Tao thanh cong tac gia: ' . $pen_name);
            Application::redirect($this->linkHelper->link_admin('CreateJournalist'));
        }

        public function edit_journalist()
        {
            $full_name = isset($this->input['full_name']) ? $this->input['full_name'] : "";
            $pen_name = isset($this->input['pen_name']) ? $this->input['pen_name'] : "";
            $email = isset($this->input['email']) ? $this->input['email'] : "";
            $facebook = isset($this->input['facebook']) ? $this->input['facebook'] : "";
            $twitter = isset($this->input['twitter']) ? $this->input['twitter'] : "";
            $gplus = isset($this->input['gplus']) ? $this->input['gplus'] : "";
            $gplus_link = isset($this->input['gplus_link']) ? $this->input['gplus_link'] : null;
            $birthday = isset($this->input['birthday']) ? $this->input['birthday'] : "";
            $avatar = isset($this->input['avatar']) ? $this->input['avatar'] : "";
            $facebook_link = isset($this->input['facebook_link']) ? $this->input['facebook_link'] : "";
            $biography = isset($this->input['biography']) ? $this->input['biography'] : "";
            $rate = isset($this->input['rate']) ? $this->input['rate'] : 0;
            $id = isset($this->input['id']) ? $this->input['id'] : 0;                        
          
          /*  $check = $this->journalist_model->check_valid_journalist($email, $pen_name);
            if (!$check || $check !== $id) {
                $this->session->set_session('msg', "Tác giả không tồn tại");
                Application::redirect($this->linkHelper->link_admin('ListJournalist'));
            }
            $journalist = array();
            if ($full_name !== "") $journalist['full_name'] = $full_name;
            if ($pen_name !== "") $journalist['pen_name'] = $pen_name;
            if ($email !== "") $journalist['email'] = $email;
            if ($facebook !== "") $journalist['facebook'] = $facebook;
            if ($facebook_link !== "") $journalist['facebook_link'] = $facebook_link;
            if ($gplus !== "") $journalist['gplus'] = $gplus;
            if ($gplus_link !== "") $journalist['gplus_link'] = $gplus_link;
            if ($birthday !== "") $journalist['birthday'] = $birthday;
            if ($avatar !== "") $journalist['avatar'] = $avatar;
            if ($biography !== "") $journalist['biography'] = $biography;
            if ($rate !== "") $journalist['rate'] = $rate;
            if ($id != 0) $journalist['id'] = $id;        */
            
            $bean = $this->journalist_model->create_bean();
            $bean->set("full_name",$full_name);
            $bean->set("pen_name",$pen_name);
            $bean->set("email",$email);
            $bean->set("facebook",$facebook);
            $bean->set("twiter",$twitter);
            $bean->set("gplus",$gplus);
            $bean->set("gplus_link",$gplus_link);
            $bean->set("birthday",$birthday);
            $bean->set("facebook_link",$facebook_link)  ;
            $bean->set("avatar",$avatar);
            $bean->set("biography",$biography);
            $bean->set("rate",$rate);           
           
            $this->journalist_model->update($bean,"id={$id}");
            $this->session->set_session('msg', 'Edit thanh cong tac gia: ' . $pen_name);
            Application::redirect($this->linkHelper->linkhome('ListJournalist'));
        }
        
        public function destroyed()
        {

        }
    }  
?>