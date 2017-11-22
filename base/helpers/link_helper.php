<?php
    class LinkHelper extends ALinkHelper
    {    
        public function __construct()
        {
            parent::__construct();
        }

        public function linkhome($action)
        {
            $param = array(
                'pattern' => 'default',
                'var' => array(
                ),
            );
            return Application::buildLink($action,$param); 
        }
        public function link_action_params($action,$mix,$pattern = "default"){
            $var = array();
            $len = count($mix);

            if ($len > 0){
                $i = 1;
                for($i = 1; $i <= $len; $i++){
                    $var["p{$i}"] = $mix[$i-1];
                }
            }
            $param = array(
                'pattern' => $pattern,
                'var'     => $var,
            );
            return Application::buildLink($action,$param);
        }
        public function link_backend_search($keyword,$page=0) 
        {
            $action ="SearchNews";
            if($page <=1)
            {
                $param = array(
                    'pattern' => 'default',
                    'var' => array(
                        'p1' => $keyword
                    ),
                );
            }else{
                $param = array(
                    'pattern' => 'default1',
                    'var' =>array(
                        'p1' => $keyword,
                        'p2' => $page
                    ),
                );
            }
            return Application::buildLink($action,$param);

        }
        public function link_tracking($id)
        {
            $action = "Tracking";
            $param = array(
                'pattern' => 'default',
                'var' => array(
                    'p1'  => $id
                ),
            );
            return Application::buildLink($action,$param);          
        }
        public function link_weather($slug='')
        {
            $action = "thoitiet";
            if($slug)
            {
                $param = array(
                    'pattern' => 'default',
                    'var' => array(
                        'p1' => $slug
                    ),
                );    
            }else{
                $param = array(
                    'pattern' => 'default1',
                    'var' => array(
                    ),
                );
            }

            return Application::buildLink($action,$param);
        }
        public function link_about()
        {
            $action = "About";
            $param = array(
                'pattern' => 'default',
                'var' => array()
            );
            return Application::buildLink($action,$param);
        }

        public function link_gold($date="")
        {
            $action= "GiaVang";
            $_date = str_replace("/",'-',$date);
            if (!strtotime($_date)) $date = "";
            if ($date == "") {
                $param = array(
                    'pattern' => 'default',
                    'var' => array()
                );
            }
            else {
                $param = array(
                    'pattern' => 'default1',
                    'var' => array(
                        'p1' => $date
                    )
                );
            }

            return Application::buildLink($action,$param);
        }
        public function link_ty_gia()
        {
            $action= "TyGia";
            $param = array(
                'pattern' => 'default',
                'var' => array()
            );
            return Application::buildLink($action,$param);
        }
        public function link_search($keyword,$page=0)
        {
            $action ="Search";
            if($page <=1)
            {
                $param = array(
                    'pattern' => 'default',
                    'var' => array(
                        'p1' => $keyword
                    ),
                );
            }else{
                $param = array(
                    'pattern' => 'page',
                    'var' =>array(
                        'p1' => $keyword,
                        'p2' => $page
                    ),
                );
            }
            return Application::buildLink($action,$param);
        }
        public function link_24h()
        {
            $action = "News24h";
            $param = array(
                'pattern' => 'default',
                'var' => array(
            ));
            return Application::buildLink($action,$param);
        }
        public function link_admin($act,$page =0)
        {
            $action = $act;
            if($page <=1)
            {
                $param = array(
                    'pattern' => 'default',
                    'var' => array(                    
                    ),
                ); 
            }else{
                $param = array(
                    'pattern' => 'default1',
                    'var' => array(                    
                        'p1' => $page
                    ),
                ); 
            }
            return Application::buildLink($action,$param);         
        }
        public function xemnhanh1($slug,$id)
        {
            return "http://quangbinh24h.com/$slug-a$id.html?preview=1";
            $time = time();
            $check_sum = base64_encode($id."12345");
            return "http://quangbinh24h.com/?act=ViewPreview&id=$id&check_sum=".$check_sum;         
        }

        public function xemnhanh($slug,$id)
        {
            $time = time();
            $check_sum = base64_encode($time."12345");
            return "http://quangbinh24h.com/$slug-a$id.html";
        }

        public function link_deleted($act,$id)
        {
            $action = "NewsDeletedAction";
            $param = array(
                'pattern' => 'default',
                'var' => array(
                    'p1' => $act,
                    'p2'=>$id
                ),
            );           
            return Application::buildLink($action,$param);         
        }
        public function link_edit($act,$id)       
        {
            $action = $act;
            $param = array(
                'pattern' => 'default',
                'var' => array(
                    'p1' => $id
                ),
            );
            return Application::buildLink($action,$param);         
        }
        public function link_to_category($slug,$page = 0){
            $action = "viewCategory";
            if ($page <= 0){
                $param = array(
                    'pattern' => 'default',
                    'var' => array(
                        'p1' => $slug,
                    ),
                );
            }
            else{
                $param = array(
                    'pattern' => 'page',
                    'var' => array(
                        'p1' => $slug,
                        'p2' => $page,

                    ),
                );
            }
            return Application::buildLink($action,$param); 
        }

        public function link_to_news($slug,$id){
            $action = "viewNews";
            $param = array(
                'pattern' => 'default',
                'var' => array(
                    'p1' => $slug,
                    'p2' => $id,

                ),
            );
            return Application::buildLink($action,$param);
        }

        public function link_news_date($date,$page=1)
        {
            $action = "NewsCalendar";
            if($page<=1)
            {
                $param = array(
                    'pattern' => 'default',
                    'var'=> array(
                        'p1' => $date
                    )
                );
            }else{
                $param = array(
                    'pattern' => 'default1',
                    'var'=> array(
                        'p1' => $date,
                        'p2' => $page
                    )
                );
            }
            return Application::buildLink($action,$param);
        }

        public function link_to_event($slug,$id,$page=0){
            $action = "event";
            if($page<=1)
            {
                $param = array(
                    'pattern' => 'default',
                    'var' => array(
                        'p1' => $id,
                        'p2' => $slug,
                    ),
                );    
            }else{
                $param = array(
                    'pattern' => 'default1',
                    'var' => array(
                        'p1' => $id,
                        'p2' => $slug,
                        'p3' =>$page ,
                    ),
                );
            }

            return Application::buildLink($action,$param);
        }

        public function link_to_news_relation($slug,$id){
            $action = "NewsRelation";
            $param = array(
                'pattern' => 'default',
                'var' => array(
                    'p1' => $slug,
                    'p2' => $id,

                ),
            );
            return Application::buildLink($action,$param);
        }
        public function link_to_tag($slug)
        {
            $action = "NewsTag";
            $param = array(
                'pattern' => 'default',
                'var' => array(
                    'p1' => $slug
                ),
            );
            return Application::buildlink($action,$param);
        }
        public function link_to_tagv2($slug)
        {
            $this->template_helper = Loader::load_helper('template_helper');
            $slug = $this->template_helper->build_slug($slug);
            $action = "NewsTagv2";
            $param = array(
            'pattern' => 'default',
            'var' => array(
            'p1' => $slug
            ),
            );
            return Application::buildlink($action,$param);
        }
        public function link_view_rss($slug='')
        {
            $action = "RssView";
            if($slug)
            {
                $param = array(
                    'pattern' => 'default',
                    'var' => array(
                        'p1' => $slug
                    ),
                );
            }else{
                $param = array(
                    'pattern' => 'default1',
                    'var' => array(),
                );
            }
            return Application::buildlink($action,$param);
        }
        public function link_rss()
        {
            $action = "Rss";
            $param = array(
                'pattern' => 'default',
                'var' => array(
                ),
            );
            return Application::buildlink($action,$param);
        }
        public function link_news_feature($condition,$limit)
        {
            $action = "NewsFeature";
            $param = array(
                'pattern' => "default",
                'var' => array(
                    'p1' => $condition,
                    'p2' => $limit
                ),
            );
            return Application::buildLink($action,$param);
        }
        public function link_delete_journalist($id)
        {
            $action = "DeleteJournalist";
            $param = array(
                'pattern' => 'default',
                'var' => array(
                    'p1' => $id
                )
            );
            return Application::buildLink($action, $param);
        }     

        public function link_back_link($_action="",$id=0)
        {
            $action = "BackLink";
            $param = array(
                'pattern' => 'default',
                'var' => array(
                    'p1' => $_action,
                    "p2" => $id
                )
            );
            return Application::buildLink($action, $param);
        }     

        public function link_source($_action="",$id=0)
        {
            $action = "Source";
            $param = array(
                'pattern' => 'default',
                'var' => array(
                    'p1' => $_action,
                    "p2" => $id
                )
            );
            return Application::buildLink($action, $param);
        }     

        public function link_alter_comment($comment_ids, $active=1)
        {
            $url = $this->get_current_url();
            $action = "AlterComment";
            $param = array(
                'pattern' => 'default1',
                'var' => array(
                    'p1' => $comment_ids,
                    'p2' => $active,
                    'p3' => urlencode($url),
                )
            );
            return Application::buildLink($action, $param);
        }

        public function link_delete_comment($comment_ids)
        {
            $action = "DeleteComment";
            $url = $this->get_current_url();
            $param = array(
                'pattern' => 'default1',
                'var' => array(
                    'p1' => $comment_ids,
                    'p2' => urlencode($url),
                ),
            );
            return Application::buildLink($action, $param);
        }

        public function link_edit_comment($comment_id)
        {
            $action = "EditComment";
            $param = array(
                'pattern' => 'default',
                'var' => array(
                    'p1' => $comment_id
                )
            );
            return Application::buildLink($action, $param);
        }

        public function link_to_tagv2_paging($slug,$page=1)
        {
            if($page==1)
                return $this->link_to_tagv2($slug);

            $action = "NewsTagv2";
            $param = array(
                'pattern' => 'page',
                'var' => array(
                    'p1' => $slug,
                    'p2' => $page
                ),
            );
            return Application::buildlink($action,$param);
        }
    }  
?>
