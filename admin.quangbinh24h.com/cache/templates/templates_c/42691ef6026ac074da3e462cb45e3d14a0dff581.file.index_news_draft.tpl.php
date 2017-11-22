<?php /* Smarty version Smarty-3.1.12, created on 2017-09-16 11:09:24
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/TTK/index_news_draft.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14557748559bca3f4e1bcb4-11980357%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '42691ef6026ac074da3e462cb45e3d14a0dff581' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/TTK/index_news_draft.tpl',
      1 => 1504767333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14557748559bca3f4e1bcb4-11980357',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_helper' => 0,
    'data' => 0,
    'val' => 0,
    'link_helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59bca3f4f26c19_75595700',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59bca3f4f26c19_75595700')) {function content_59bca3f4f26c19_75595700($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/app/kcms/libraries/smarty/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<!-- loading animation -->
<div id="qLoverlay"></div>
<div id="qLbar"></div>

<script type="text/javascript">
    flag =0;
</script>

<?php echo $_smarty_tpl->getSubTemplate ('block/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="wrapper">
    <!--Responsive navigation button-->  
    <div class="resBtn">
        <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
    </div>        
    <!--Sidebar collapse button-->  
    <div class="collapseBtn">
        <a href="#" class="tipR" title="Ẩn menu"><span class="icon12 minia-icon-layout"></span></a>
    </div>
    <!--Sidebar background-->
    <div id="sidebarbg"></div>
    <?php echo $_smarty_tpl->getSubTemplate ('block/menu_left.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <!--Body content-->
    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Content wrapper-->
            <div class="heading"> 
                <h3>Bảng điều khiển</h3> 
                <div class="resBtnSearch">
                    <a href="#"><span class="icon16 brocco-icon-search"></span></a>
                </div>               
                <ul class="breadcrumb">
                    <li>Vị trí hiện tại:</li>
                    <li>
                        <a href="" class="tip" title="Trở lại bảng điều khiển">
                            <span class="icon16 icomoon-icon-screen"></span>
                        </a> 
                        <span class="divider">
                            <span class="icon16 icomoon-icon-arrow-right"></span>
                        </span>
                    </li>
                    <li class="active">Bảng điều khiển</li>
                </ul>

            </div><!-- End .heading-->
            <div class="row-fluid">
                <?php echo $_smarty_tpl->tpl_vars['template_helper']->value->displayAlert();?>

                <div>
                    <div id ="count_news">
                    </div>                
                </div><!-- End .span8 -->                    
            </div><!-- End .row-fluid --> 
            <div class="row-fluid">
                <div class="box gradient">                                
                    <div class="title">
                        <h4>
                            <span>Danh sách bài lưu tạm</span>
                        </h4>
                    </div>                 
                    <?php echo $_smarty_tpl->getSubTemplate ('block/filter.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                                    
                    <div id="list_news">
                        <div class="clearfix">                                      
                            <?php echo $_smarty_tpl->getSubTemplate ('block/search.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                                    
                            <?php if ($_smarty_tpl->tpl_vars['data']->value['list_news']){?>
                            <table class="responsive table table-bordered" id="checkAll">
                                <thead>
                                    <tr>
                                        <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                        <th colspan="2">Tiêu đề</th>                                            
                                        <th>Chuyên mục</th>
                                       <!-- <th>Thể loại bài</th> -->
                                        <th>Tags</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['index']++;
?>
                                    <tr <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['index']%2!=0){?> class="second" <?php }?> >
                                        <td class="chChildren"><input type="checkbox" name="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="styled" /></td>
                                        <td width="85"><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("AcpEditNews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
" class="list-post-thumb"><img src="<?php echo $_smarty_tpl->tpl_vars['template_helper']->value->get_thumb_image($_smarty_tpl->tpl_vars['val']->value['images'],80,60);?>
"/></a></td>
                                        <td class="alignleft"><span class="lastedit-pe"></span><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("AcpEditNews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
"><strong><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</strong></a>
                                            <p class="listing-lead"><?php echo $_smarty_tpl->tpl_vars['val']->value['intro_text'];?>
</p>
                                            <div class="quk-edit">                                                                                                                  
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("AdminEditNews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Sửa</a>            
                                                |
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_deleted("publicdraft",$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Public</a>            
                                                |
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_deleted("hiddennews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Ẩn</a>                   
                                            </div>
                                        </td>                                                
                                        <td><?php echo $_smarty_tpl->tpl_vars['val']->value['category'];?>
</td>                                                                                                 
                                        <!--<td><?php if ($_smarty_tpl->tpl_vars['val']->value['hotnews']==1){?>Sản xuất hiện trường <?php }elseif($_smarty_tpl->tpl_vars['val']->value['hotnews']==2){?>Sản Xuất <?php }elseif($_smarty_tpl->tpl_vars['val']->value['hotnews']==3){?>Khai thác <?php }elseif($_smarty_tpl->tpl_vars['val']->value['hotnews']==4){?>Tổng hợp <?php }elseif($_smarty_tpl->tpl_vars['val']->value['hotnews']==5){?>Phóng sự - điều tra<?php }elseif($_smarty_tpl->tpl_vars['val']->value['hotnews']==6){?>Bài dịch <?php }else{ ?>Chưa rõ<?php }?></td>-->
                                        <td><?php echo $_smarty_tpl->tpl_vars['val']->value['tags'];?>
</td>
                                        <td>
                                            <span><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%d-%m-%Y %H:%M:%S");?>
</span>
                                        </td>
                                    </tr> 
                                    <?php } ?>
                                </tbody>                                        
                            </table>
                            <?php }else{ ?>                                                                            
                            <div><center><h4>Chưa có bài viết nào</h4></center></div>
                            <?php }?>
                        </div>                                 
                        <div class="margin10 clearfix">    
                            <?php if ($_smarty_tpl->tpl_vars['data']->value['paging']['total']>1){?>
                            <div class="pagination right">
                                <ul>
                                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_admin("AcpNewsDraft",1);?>
"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['paging']['page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['val']->key;
?> 
                                    <li <?php if ($_smarty_tpl->tpl_vars['val']->value==$_smarty_tpl->tpl_vars['data']->value['paging']['current']){?> class="active"<?php }?>>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_admin("AcpNewsDraft",$_smarty_tpl->tpl_vars['val']->value);?>
"><span><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</span></a>
                                    </li>                                                    
                                    <?php } ?>                                               
                                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_admin("AcpNewsDraft",$_smarty_tpl->tpl_vars['data']->value['paging']['total']);?>
"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
                                </ul>
                            </div>                                        
                            <?php }?>                           
                        </div>
                    </div>    
                </div><!-- End .box -->
            </div><!-- End .row-fluid --> 
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->
    </div><!-- End #wrapper -->    
<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>