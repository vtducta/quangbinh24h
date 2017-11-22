<?php /* Smarty version Smarty-3.1.12, created on 2017-09-19 16:00:22
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/search/fillter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146170033059c0dca6da18f3-19761701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49d5e2b07964c5c1f7c16fb24545c82024115265' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/search/fillter.tpl',
      1 => 1504767332,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146170033059c0dca6da18f3-19761701',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'link_helper' => 0,
    'template_helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59c0dca6ea7150_03650729',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c0dca6ea7150_03650729')) {function content_59c0dca6ea7150_03650729($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/app/kcms/libraries/smarty/plugins/modifier.date_format.php';
?><div class="clearfix">                                      
    <?php echo $_smarty_tpl->getSubTemplate ('block/search.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                                    
    <?php if ($_smarty_tpl->tpl_vars['data']->value['list_news']){?>
        <table class="responsive table table-bordered" id="checkAll">
            <thead>
                <tr>
                    <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                    <th colspan="2">Tiêu đề</th>                                            
                    <th>Chuyên mục</th>
                    <th>Người viết</th>
                    <th>views</th>
                    <th>Thời gian</th>
                    <th>Set vị trí</th>
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
                    <td width="85"><a href="<?php if ($_smarty_tpl->tpl_vars['data']->value['flag']){?><?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("AdminEditNews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("AcpEditNews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
<?php }?>" class="list-post-thumb"><img src="<?php echo $_smarty_tpl->tpl_vars['template_helper']->value->get_thumb_image($_smarty_tpl->tpl_vars['val']->value['images'],80,60);?>
"/></a></td>
                    <td class="alignleft"><span class="lastedit-pe"></span><a href="<?php if ($_smarty_tpl->tpl_vars['data']->value['flag']){?><?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("AdminEditNews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("AcpEditNews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
<?php }?>"><strong><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</strong></a>
                        <p class="listing-lead"><?php echo $_smarty_tpl->tpl_vars['val']->value['intro_text'];?>
</p>
                        <div class="quk-edit">  
                            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->xemnhanh($_smarty_tpl->tpl_vars['val']->value['meta_slug'],$_smarty_tpl->tpl_vars['val']->value['id']);?>
" target="_blank">Xem nhanh</a>                                               
                            |
                            <?php if ($_smarty_tpl->tpl_vars['data']->value['flag']){?>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("AdminEditNews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Sửa</a>            
                            <?php }else{ ?>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_edit("AcpEditNews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Sửa</a>            
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['data']->value['group_user_id']!=5){?>
                            |
                            <a href="<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_deleted("hiddennews",$_smarty_tpl->tpl_vars['val']->value['id']);?>
">Ẩn</a>      
                            <?php }?>             
                        </div>
                    </td>                                                
                    <td><?php echo $_smarty_tpl->tpl_vars['val']->value['category'];?>
</td>  
                    <td><strong style="color: blue;"><?php echo $_smarty_tpl->tpl_vars['val']->value['creat_by'];?>
</strong></td>
                    <td><strong style="color: blue;"><?php echo $_smarty_tpl->tpl_vars['val']->value['views'];?>
</strong></td>                                                                  
                    
                    <td>
                        <span><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['val']->value['create_date_int'],"%d-%m-%Y %H:%M:%S");?>
</span>
                    </td>
                    <td>
                   <button onclick="load_popup_home(<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
)" style="width: 100px; height: 30px; font-size: 13px; font-weight: bold;" class="btn btn-mini" type="button" href="#news_noibat" data-toggle="modal">Vị trí nổi bật</button>
                    </td>
                </tr> 
                <?php } ?>
            </tbody>                                        
        </table>  
   <?php }else{ ?>                                  
        <center><h3>Không có bài viết nào !</h3></center>
   <?php }?>
</div>   
<?php if ($_smarty_tpl->tpl_vars['data']->value['list_news']){?>                              
    <div class="margin10 clearfix">    
        <?php if ($_smarty_tpl->tpl_vars['data']->value['paging']['total']>1){?>
        <div class="pagination right">
            <ul>
                <li><a href="javascript:void(0)" onclick="filter(1)"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['paging']['page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['val']->key;
?> 
                <li <?php if ($_smarty_tpl->tpl_vars['val']->value==$_smarty_tpl->tpl_vars['data']->value['paging']['current']){?> class="active"<?php }?>>
                <a href="javascript:void(0)" onclick="filter(<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
)"><span><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</span></a>
                </li>                                                    
                <?php } ?>                                               
                <li><a href="javascript:void(0)" onclick="filter(<?php echo $_smarty_tpl->tpl_vars['data']->value['paging']['total'];?>
)"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
            </ul>
        </div>                                        
        <?php }?>                           
    </div>
<?php }?><?php }} ?>