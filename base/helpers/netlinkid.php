<?php
    class NetlinkID
    {
        private $client_id;
        private $client_secret;
        private $redirect_uri;
        private $url;
        private $channel_id;
        private $status;
        private $order;

        public function __construct($config)
        {
            $this->init();

            if (isset($config['client_id'])) {
                $this->client_id = $config['client_id'];
            }
            if (isset($config['client_secret'])) {
                $this->client_secret = $config['client_secret'];
            }
            if (isset($config['redirect_uri'])) {
                $this->redirect_uri = $config['redirect_uri'];
            }
            if (isset($config['url'])) {
                $this->url = $config['url'];
            }
            if (isset($config['channel_id'])) {
                $this->channel_id = $config['channel_id'];
            }
            if (isset($config['status'])) {
                $this->status = $config['status'];
            }
            if (isset($config['order'])) {
                $this->order = $config['order'];
            }
        }

        protected function init()
        {
            $this->client_id = null;
            $this->client_secret = null;
            $this->redirect_uri = null;
            $this->url = null;
            $this->channel_id = null;
            $this->status = null;
            $this->order = null;
        }

        public function re_config($config) 
        {
            if (isset($config['url'])) {
                $this->url = $config['url'];
            }
            if (isset($config['channel_id'])) {
                $this->channel_id = $config['channel_id'];
            }
            if (isset($config['status'])) {
                $this->status = $config['status'];
            }
            if (isset($config['order'])) {
                $this->order = $config['order'];
            }
        }
        
        public function get_config()
        {
            return array(
                'url' => $this->url,
                'channel_id' => $this->channel_id,
                'status' => $this->status,
                'order' => $this->order
            );
        }

        public function retrieve_comment($limit=1, $current_page=1, $comment_id=0)
        {
            $uri = $this->build_retrieve_comment_uri(); 
            $param = $this->build_retrieve_comment_param($limit, $current_page, $comment_id);
            $server_output = $this->exec_request($uri, $param);
            $server_output = json_decode($server_output, true);
            if (isset($server_output['status'])) {
                if ($server_output['status'] == 200 && count($server_output['data'])) {
                    return $server_output;
                }
            }
            return array();
        }
        
        protected function build_retrieve_comment_uri()
        {
            $uri = "http://idcm.nguoiduatin.vn:8088/api/comment.retrieve";
            return $uri;
        }
        
        protected function build_retrieve_comment_param($limit=1, $current_page=1, $comment_id=0)
        {
            $param = array();
            if (isset($this->client_id)) {
                $param['client_id'] = $this->client_id;
            }
            if (isset($this->client_secret)) {
                $param['client_secret'] = $this->client_secret;
            }
            if (isset($this->redirect_uri)) {
                $param['redirect_uri'] = $this->redirect_uri;
            }
            if (isset($this->url)) {
                $param['url'] = $this->url;
            }
            if (isset($this->status)) {
                $param['status'] = $this->status;
            }
            if (isset($this->channel_id)) {
                $param['channel_id'] = $this->channel_id;
            }
            if (isset($this->order)) {
                $param['order'] = $this->order;
            }
            if (isset($current_page)) {
                $param['p'] = $current_page;
            }
            if (isset($limit)) {
                $param['limit'] = $limit;
            }
            if ($comment_id) {
                $param['comment_id'] = $comment_id;
            }
            return $param;
        }

        protected function exec_request($uri, $param , $post_json=0)
        {
            $curl = curl_init();
            
            curl_setopt($curl, CURLOPT_AUTOREFERER, true);
            curl_setopt( $curl, CURLOPT_URL, $uri);
            curl_setopt( $curl, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
            curl_setopt($ch ,CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt( $curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
            if ($post_json) {
                $datapost = json_encode($param);
                $data = array('json' => json_encode($datapost));
                curl_setopt( $curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));   
            }
            else {
                curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query($param));
                curl_setopt( $curl, CURLOPT_HTTPHEADER, $header );
            }
            curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $curl, CURLOPT_TIMEOUT, 10 );
            $server_output = curl_exec( $curl );
            $header = curl_getinfo( $curl );
            curl_close( $curl );
            return $server_output;
        }

        protected function build_alter_comment_uri()
        {
            $uri = "http://idcm.nguoiduatin.vn:8088/api/comment.alter";
            return $uri;
        }

        protected function build_alter_comment_param($comment_ids=array(), $active=1)
        {
            $param = array();
            if (isset($this->client_id)) {
                $param['client_id'] = $this->client_id;
            }
            if (isset($this->client_secret)) {
                $param['client_secret'] = $this->client_secret;
            }
            if (isset($this->redirect_uri)) {
                $param['redirect_uri'] = $this->redirect_uri;
            }
            if (isset($this->url)) {
                $param['url'] = $this->url;
            }
            if (isset($this->channel_id)) {
                $param['channel_id'] = $this->channel_id;
            }
            if (count($comment_ids)) {
                $param['comment_ids'] = json_encode($comment_ids);
            }
            $param['active'] = $active;
            return $param;
        }

        public function alter_comment($comment_ids=array(), $active=1)
        {
            $uri = $this->build_alter_comment_uri();
            $param = $this->build_alter_comment_param($comment_ids, $active);
           
            $server_output = $this->exec_request($uri, $param);
            $server_output = json_decode($server_output, true);
            if (isset($server_output['status'])) {
                if ($server_output['status'] == 200) {
                    return 1;
                }
            }
            return 0;
        }

        protected function build_delete_comment_uri()
        {
            return "http://idcm.nguoiduatin.vn:8088/api/comment.delete";
        }

        protected function build_delete_comment_param($comment_ids,$active=1)
        {
            $param = array();
            if (isset($this->client_id)) {
                $param['client_id'] = $this->client_id;
            }
            if (isset($this->client_secret)) {
                $param['client_secret'] = $this->client_secret;
            }
            if (isset($this->redirect_uri)) {
                $param['redirect_uri'] = $this->redirect_uri;
            }
            if (isset($this->url)) {
                $param['url'] = $this->url;
            }
            if (isset($this->channel_id)) {
                $param['channel_id'] = $this->channel_id;
            }
            if (count($comment_ids)) {
                $param['comment_ids'] = json_encode($comment_ids);
            }
            $param['active'] = $active;
            return $param;
        }

        public function delete_comment($comment_ids=array()) 
        {
            $uri = $this->build_delete_comment_uri();
            $param = $this->build_delete_comment_param($comment_ids);          
            $server_output = $this->exec_request($uri, $param);            
            $server_output = json_decode($server_output, true);            
            if (isset($server_output['status'])) {
                if ($server_output['status'] == 200) {
                    return 1;
                }
            }
            return 0;
        }

        protected function build_edit_comment_uri()
        {
            $uri = "http://idcm.nguoiduatin.vn:8088/api/comment.edit";
            return $uri;
        }

        protected function build_edit_comment_param($comment_id=0, $content='')
        {
            $param = array();
            if (isset($this->client_id)) {
                $param['client_id'] = $this->client_id;
            }
            if (isset($this->client_secret)) {
                $param['client_secret'] = $this->client_secret;
            }
            if (isset($this->redirect_uri)) {
                $param['redirect_uri'] = $this->redirect_uri;
            }
            if (isset($this->url)) {
                $param['url'] = $this->url;
            }
            if (isset($this->channel_id)) {
                $param['channel_id'] = $this->channel_id;
            }
            if (isset($comment_id)) {
                $param['comment_id'] = $comment_id;
            }
            if (isset($content)) {
                $param['content'] = $content;
            }
            return $param;
        }

        public function edit_comment($comment_id=0, $content='')
        {
            $uri = $this->build_edit_comment_uri();
            $param = $this->build_edit_comment_param($comment_id, $content);
            $server_output = $this->exec_request($uri, $param);
            $server_output = json_decode($server_output, true);
            if (isset($server_output['status']) && $server_output['status'] == 200) {
                return 1;
            }
            return 0;
        }



    }
?>