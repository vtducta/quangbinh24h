<?php /* Smarty version Smarty-3.1.12, created on 2017-09-12 13:07:57
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173084861059b779bd3da1b6-65720083%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25db66c4ec1ab696d674dff20a1e7122186a2ceb' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/block/menu.tpl',
      1 => 1504767330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173084861059b779bd3da1b6-65720083',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'link_helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b779bd525674_32580641',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b779bd525674_32580641')) {function content_59b779bd525674_32580641($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['data']->value['group_user']==4){?>
<div class="mainnav">
    <ul>                        
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 brocco-icon-list"></span>Bài viết</a>
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AcpAddNews');?>
"><span class="icon16 brocco-icon-pencil"></span>Thêm tin mới</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AcpNotPublic');?>
"><span class="icon16 brocco-icon-clock"></span>Bài chờ duyệt</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AcpHome');?>
"><span class="icon16 brocco-icon-refresh"></span>Bài đã đăng</a></li>    
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AcpTimer');?>
"><span class="icon16 brocco-icon-alarm"></span>Bài hẹn giờ</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AcpNewsDraft');?>
"><span class="icon16 brocco-icon-trashcan"></span>Bài lưu tạm</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('MyPost');?>
"><span class="icon16 brocco-icon-user"></span>Bài Của tôi</a></li>   
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AcpNewsDeleted');?>
"><span class="icon16 brocco-icon-database"></span>Bài tạm xóa</a></li>       
            </ul>
        </li>
        <li class="dropdown"><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-light-bulb"></span>Quản lý tác giả</a>
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_admin('ListJournalist');?>
"><span class="icon16 icomoon-icon-diamond"></span>Danh sách tác giả</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_admin('CreateJournalist');?>
"><span class="icon16 icomoon-icon-pencil-2"></span>Tạo tác giả</a></li>    
            </ul>
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-users"></span>Quản lý nguồn bài viết</a>
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_source('manage');?>
"><span class="icon16 entypo-icon-users"></span>Danh sách nguồn bài viết</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_source('add');?>
"><span class="icon16 entypo-icon-add"></span>Thêm nguồn bài viết</a>
            </ul>
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-email"></span>Quản lý sự kiện</a>
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('ListEvent');?>
"><span class="icon16  icomoon-icon-enter-2 "></span>Danh sách sự kiện</a></li>      
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AddEvent');?>
"><span class="icon16 brocco-icon-pencil"></span>Thêm sự kiện</a></li>                  
            </ul>
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-share"></span>Quản lý chuyên mục</a>    
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('ListCategory');?>
"><span class="icon16 entypo-icon-bookmark"></span>Danh sách chuyên mục</a></li>    
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('CategoryAdd');?>
"><span class="icon16 brocco-icon-pencil"></span>Thêm chuyên mục</a></li> 
            </ul>    
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-users"></span>Quản lý thành viên</a>
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('ListUser');?>
"><span class="icon16 entypo-icon-users"></span>Danh sách thành viên</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AddUser');?>
"><span class="icon16 entypo-icon-add"></span>Thêm thành viên </a>
            </ul>
        </li>
        <li><a href="/?act=ListAdvertise" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-users"></span>Quản lý quảng cáo</a></li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 brocco-icon-list"></span>Quản lý video</a>
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('VideoAddHtml5');?>
"><span class="icon16 brocco-icon-pencil"></span>Thêm video</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('VideoListHtml5');?>
"><span class="icon16 brocco-icon-refresh"></span>Danh sách video</a></li>    
            </ul>
        </li>
    </ul>
</div>
<?php }elseif($_smarty_tpl->tpl_vars['data']->value['group_user']==1){?>
<div class="mainnav">
    <ul>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 brocco-icon-list"></span>Bài viết</a>
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AdminAdd');?>
"><span class="icon16 brocco-icon-pencil"></span>Viết bài mới</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AdminNotPublic');?>
"><span class="icon16 brocco-icon-list"></span>Bài nhận duyệt</a></li>        
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AdminHome');?>
"><span class="icon16 brocco-icon-pointer"></span>Bài đã đăng </a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AdminTimer');?>
"><span class="icon16 brocco-icon-alarm"></span>Bài hẹn giờ</a></li>     
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('MyPost');?>
"><span class="icon16 brocco-icon-user"></span>Bài Của tôi</a></li>   
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('AdminNewsDraft');?>
"><span class="icon16 brocco-icon-trashcan"></span>Bài lưu tạm</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-light-bulb"></span>Quản lý tác giả</a>
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_admin('ListJournalist');?>
"><span class="icon16 icomoon-icon-diamond"></span>Danh sách tác giả</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_admin('CreateJournalist');?>
"><span class="icon16 icomoon-icon-pencil-2"></span>Tạo tác giả</a></li>    
            </ul>
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-users"></span>Quản lý nguồn bài viết</a>
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_source('manage');?>
"><span class="icon16 entypo-icon-users"></span>Danh sách nguồn bài viết</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_source('add');?>
"><span class="icon16 entypo-icon-add"></span>Thêm nguồn bài viết</a>
            </ul>
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 brocco-icon-list"></span>Quản lý video</a>
            <ul class="sub" style="display:block">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('VideoAddHtml5');?>
"><span class="icon16 brocco-icon-pencil"></span>Thêm video</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('VideoListHtml5');?>
"><span class="icon16 brocco-icon-refresh"></span>Danh sách video</a></li>    
            </ul>
        </li>
    </ul>
</div>
<?php }elseif($_smarty_tpl->tpl_vars['data']->value['group_user']==2||$_smarty_tpl->tpl_vars['data']->value['group_user']==5){?>
<ul>
    <li>
        <a href="#"  style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-alert"></span>Bài viết</a>
        <ul class="sub" style="display:block">
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('BtvHome');?>
"><span class="icon16 brocco-icon-list"></span>Bài nhận duyệt</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('BtvAdd');?>
"><span class="icon16 brocco-icon-pencil"></span>Viết bài mới</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('NewsTimer');?>
"><span class="icon16 brocco-icon-alarm"></span>Bài hẹn giờ</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('BtvNewsDraft');?>
"><span class="icon16 brocco-icon-switch"></span>Bài lưu tạm</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('BtvNewsPublic');?>
"><span class="icon16 brocco-icon-play"></span>Bài public của bạn</span></a></li> 
            <?php if ($_smarty_tpl->tpl_vars['data']->value['group_user']==5){?>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('BtvNewsPublicAll');?>
"><span class="icon16 brocco-icon-play"></span>Danh sách bài xuất bản</span></a></li>
            <?php }?>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('BtvNotPublic');?>
"><span class="icon16 brocco-icon-warning"></span>Bài Chờ TKTS duyệt</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('BtvNewsOff');?>
"><span class="icon16 brocco-icon-refresh"></span>Danh sách bài trả về</a></li>
        </ul>
    </li>
    <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-users"></span>Quản lý nguồn bài viết</a>
        <ul class="sub" style="display:block">
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_source('manage');?>
"><span class="icon16 entypo-icon-users"></span>Danh sách nguồn bài viết</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_source('add');?>
"><span class="icon16 entypo-icon-add"></span>Thêm nguồn bài viết</a>
        </ul>
    </li>
    <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 brocco-icon-list"></span>Quản lý video</a>
        <ul class="sub" style="display:block">
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('VideoAddHtml5');?>
"><span class="icon16 brocco-icon-pencil"></span>Thêm video</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('VideoListHtml5');?>
"><span class="icon16 brocco-icon-refresh"></span>Danh sách video</a></li>    
        </ul>
    </li>
</ul>
<?php }elseif($_smarty_tpl->tpl_vars['data']->value['group_user']==3){?>
<ul>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('ReporterAdd');?>
"><span class="icon16 brocco-icon-pencil"></span>Viết bài mới</a></li>        
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('HomeReporter');?>
"><span class="icon16 brocco-icon-list"></span>Bài đã public</a></li>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('ReporterDraft');?>
"><span class="icon16 brocco-icon-switch"></span>Bài lưu tạm</a></li>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('ReporterWait');?>
"><span class="icon16 brocco-icon-warning"></span>Bài Chờ BTV duyệt</a></li>        
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->linkhome('ReporterOff');?>
"><span class="icon16 brocco-icon-refresh"></span>Danh sách bài trả về</a></li>
</ul>
<?php }?>
<?php }} ?>