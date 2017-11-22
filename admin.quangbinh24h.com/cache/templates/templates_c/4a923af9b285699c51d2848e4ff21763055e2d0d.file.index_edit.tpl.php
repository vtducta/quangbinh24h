<?php /* Smarty version Smarty-3.1.12, created on 2017-09-16 11:09:28
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/TTK/index_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:193904121159bca3f801b015-61909436%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a923af9b285699c51d2848e4ff21763055e2d0d' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/TTK/index_edit.tpl',
      1 => 1504767333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193904121159bca3f801b015-61909436',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'GUrl' => 0,
    'msg1' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59bca3f81de4b7_38451121',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59bca3f81de4b7_38451121')) {function content_59bca3f81de4b7_38451121($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/app/kcms/libraries/smarty/plugins/modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    
<?php echo $_smarty_tpl->getSubTemplate ('block/load_tinyMCE.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    
<!-- loading animation -->
<div id="qLoverlay"></div>
<div id="qLbar"></div>
<?php echo $_smarty_tpl->getSubTemplate ('block/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="wrapper">               
    <div class="resBtn">
        <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
    </div>        
    <div class="collapseBtn">
        <a href="#" class="tipR" title="Ẩn menu"><span class="icon12 minia-icon-layout"></span></a>
    </div>
    <div id="sidebarbg"></div>
    <?php echo $_smarty_tpl->getSubTemplate ('block/menu_left.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <div id="content" class="clearfix">
        <div class="contentwrapper"><!--Content wrapper-->    
            <div class="heading">         
                <h3>Viết bài mới</h3>   
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
            <div class="row-fluid clearfix">
                <form id="editNews" action="/" method="post">
                    <div class="span8" style="margin:0;">
                        <div class="box">   
                            <div class="title">
                                <h4>
                                    <span class="icon16 brocco-icon-grid"></span>
                                    <span>Nội dung bài viết</span>
                                </h4>                                    
                            </div>                                                     
                            <div class="content clearfix">                                    
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="normal">Tên bài viết</label>
                                            <div class="span8">
                                                
                                                <input class="" id="id_title" type="text" name="title" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['content']->get('title'), ENT_QUOTES, 'UTF-8', true);?>
" />
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                                          
                                <!--END SEO-->
                                <div class="well">
                                    <a href="javascript:void(0)" onclick="open_seo()">SEO</a>
                                    <div class="seo-wrap">
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span2" for="checkboxes">Title</label>
                                                    <div class="span8">
                                                        <p><span id="counter_title"></span> ký tự còn lại</p>
                                                        <input id="meta_title" type="text" name="meta_title" value="<?php if ($_smarty_tpl->tpl_vars['data']->value['content']->get('meta_title')){?><?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('meta_title');?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('title');?>
<?php }?>"/>                                                           
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                        <hr class="line" />
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span2" for="checkboxes">Slug</label>
                                                    <div class="span8">
                                                        <input type="text" name="slug_name" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('meta_slug');?>
" />                                                           
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                        <hr class="line" />
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span2" for="checkboxes">Keyword</label>
                                                    <div class="span8">
                                                        <textarea class="text" style="height:60px; width:100%" name="meta_keyword"><?php if ($_smarty_tpl->tpl_vars['data']->value['content']->get('meta_keywork')){?><?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('meta_keywork');?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['data']->value['tags'];?>
<?php }?></textarea>                                                           
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                        <hr class="line" />
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span2" for="checkboxes">Description</label>
                                                    <div class="span8">
                                                        <p><span id="counter_description"></span> ký tự còn lại</p>
                                                        <textarea id="meta_description" class="text" name="meta_description" style="height:60px; width:100%"><?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('meta_description');?>
</textarea>                                                           
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                    </div><!--SEO wrap-->
                                </div>
                                <!--END SEO-->

                                <hr class="line" />                                     
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">Mô tả ngắn</label>
                                            <div class="span8">
                                                <!--<p><span id="counter_sapo"></span> ký tự còn lại</p>-->
                                                <textarea id="short_desc" name="short_desc"><?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('intro_text');?>
</textarea>                                                    
                                            </div>
                                        </div>
                                    </div>                                       
                                </div>                                       
                                <hr class="line" />                                        
                                <label class="form-label span3" for="textarea">Ảnh thumbnail
                                    <span class="help-block">Kích thước tối đa được tải lên 2mb</span></label>
                                <button id="upload" type="button" ><span>Tải ảnh từ máy tính</span></button>
                                <p><span id="status"></span></p>
                                <hr class="line" />
                                <div id="display-file">                                        
                                    <img <?php if ($_smarty_tpl->tpl_vars['data']->value['link_thumb']){?> src="<?php echo $_smarty_tpl->tpl_vars['data']->value['link_thumb']->get('upload_url');?>
" <?php }else{ ?> src="" <?php }?>alt="" style="width: 85px; height: 85px;">
                                </div>
                                <input type="hidden" id="flagthumb" name="id_thumb" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('images');?>
">      

                                <hr class="line" />
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="journalists">Tác giả</label>
                                            <div class="span8">
                                                <input id="journalist-input" type="token-input" name="news_journalist" style="width:100%;"/>
                                                <div class="box">
                                                    <div class="form-row row-fluid">
                                                        <div class="">   
                                                            <select class="nostyle" multiple="multiple"  size="10">
                                                                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_journalist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>    
                                                                <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" onclick="addJournalist('<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
','<?php echo $_smarty_tpl->tpl_vars['val']->value['full_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['val']->value['pen_name'];?>
)')"> <?php echo $_smarty_tpl->tpl_vars['val']->value['full_name'];?>
(<?php echo $_smarty_tpl->tpl_vars['val']->value['pen_name'];?>
)</option>
                                                                <?php } ?>      
                                                            </select>     
                                                        </div> 
                                                    </div>
                                                </div><!-- end .box -->                      
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                
                                <hr class="line" />
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="journalists">Nguồn bài viết</label>
                                            <div class="span8">                                              
                                                <select name="source_id" style="width:250px">
                                                    <option value="0"> Chọn nguồn bài viết</option> 
                                                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_source']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>    
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['content']->get("source_id")==$_smarty_tpl->tpl_vars['val']->value->id){?>selected=selected<?php }?>> <?php echo $_smarty_tpl->tpl_vars['val']->value->name;?>
</option>
                                                    <?php } ?>
                                                </select>                                                      
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <hr class="line" />
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="journalists">Người viết</label>
                                            <div class="span8">                                              
                                                <select name="writter" style="width:250px">
                                                    <option value="0"> Chọn tên người viết</option> 
                                                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_user_']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>    
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value->user_id;?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['content']->get('creat_by')==$_smarty_tpl->tpl_vars['val']->value->user_id){?>selected="selected"<?php }?>> <?php echo $_smarty_tpl->tpl_vars['val']->value->fullname;?>
 - <?php echo $_smarty_tpl->tpl_vars['val']->value->username;?>
</option>  
                                                    <?php } ?>      
                                                </select> 
                                                <br>   
                                                <i>Trong trường hợp viết bài hộ người khác, hãy chọn tên người cần viết hộ</i>                                                         
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <hr class="line" />
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="tags">Bài viết liên quan</label>
                                            <div class="span8">
                                                <input id="token-input" type="token-input" name="news_relations" style="width:100%;" />
                                                
                                                <script type="text/javascript">                        
                                                    $(document).ready(function() {
                                                        $("#token-input").tokenInput("<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Base'];?>
?act=Suggestion", {
                                                            theme : "facebook",
                                                            tokenDelimiter: ",",
                                                            preventDuplicates: true, 
                                                            prePopulate: <?php echo $_smarty_tpl->tpl_vars['data']->value['token_input'];?>
               
                                                        });        
                                                    });
                                                </script>   
                                                                 
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <hr class="line" />
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">                                                
                                            <textarea class="mceEditor" id="mceEditor" name="content"><?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('content_text');?>
</textarea>
                                        </div>
                                    </div>  
                                </div>                                        
                                <?php if ($_smarty_tpl->tpl_vars['data']->value['action']=='newswait'){?>
                                <input type="hidden" name="action" value="editnewswait" />
                                <?php }else{ ?>
                                <input type="hidden" name="action" value="editnews" />
                                <?php }?>                                    
                                <input type="hidden" name="act" value="NewsAction" />                                                    
                                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get('id');?>
" />
                                <input type="hidden" name="status" value="3">
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">                                                                                                
                                            <?php if ($_smarty_tpl->tpl_vars['data']->value['action']=='newswait'){?>  
                                            <button class="btn btn-info btn-large" id="update">Xuất bản</button>
                                            <button class="btn btn-info btn-large" id="ad_save">Update</button>
                                            <button class="btn btn-danger btn-large" id="return">Trả bài</button>
                                            <?php }else{ ?>
                                            <?php if ($_smarty_tpl->tpl_vars['data']->value['content']->get("public")==2){?>
                                            <button class="btn btn-info btn-large" id="update">Xuất bản</button>
                                            <button class="btn btn-info btn-large" id="ad_save">Cập nhật</button>
                                            <?php }else{ ?>
                                            <button class="btn btn-info btn-large" id="update">Cập nhật</button>
                                            <?php }?>
                                            <button class="btn btn-danger btn-large" id="deleted">Hạ bài</button>  
                                            <?php }?>
                                        </div>
                                    </div>  
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['data']->value['msg_array']){?>
                                <div class="form-row row-fluid">
                                    <?php  $_smarty_tpl->tpl_vars['msg1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['msg1']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['msg_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['msg1']->key => $_smarty_tpl->tpl_vars['msg1']->value){
$_smarty_tpl->tpl_vars['msg1']->_loop = true;
?>
                                    <p><?php echo $_smarty_tpl->tpl_vars['msg1']->value;?>
</p>
                                    <?php } ?>
                                </div>
                                <?php }?>
                            </div><!--content-->
                        </div><!--box-->
                    </div><!--cot trai-->
                    <div class="span4"> 
                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 cut-icon-comment"></span>
                                    <span>Trạng thái</span>
                                </h4>                      
                                <a href="#" class="minimize">Thu nhỏ</a>              
                            </div>                                                    
                            <div class="content">                                                                  
                                <div class="form-row row-fluid">
                                    <div class="clearfix">                                               
                                        <div class="" id="status_news">                                                
                                        </div>  
                                    </div>
                                    <label class="form-label span6" for="checkboxes">Hẹn giờ</label>
                                    <div class="well">
                                        <div id="datetimepicker1" class="input-append date">
                                            <input data-format="dd-MM-yyyy hh:mm:ss" name="timer" value="<?php if ($_smarty_tpl->tpl_vars['data']->value['content']->get('timer')){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['content']->get('timer'),"%d-%m-%Y %H:%M:%S");?>
<?php }?>"   type="text" readonly="readonly"></input>
                                            <span class="add-on">
                                                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function() {
                                        $('#datetimepicker1').datetimepicker({
                                        language: 'pt-BR'
                                        });
                                        });
                                    </script>                                                                                
                                </div>
                            </div><!--content-->
                        </div><!--box-->
                        <!-- ===================== Begin category Box ========================= -->
                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 cut-icon-comment"></span>
                                    <span>Chuyên mục</span>
                                </h4>                      
                                <a href="#" class="minimize">Thu nhỏ</a>
                            </div><!-- end .title -->
                            <div class="content" style="max-height:300px;overflow-y:scroll">
                                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                                <input type="checkbox" name="news_cat[]" <?php if (in_array($_smarty_tpl->tpl_vars['val']->value['id'],$_smarty_tpl->tpl_vars['data']->value['cat_selected'])){?> checked="checked" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><strong style="color: blue;"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</strong><br>
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                <input type="checkbox" name="news_cat[]" <?php if (in_array($_smarty_tpl->tpl_vars['item']->value['id'],$_smarty_tpl->tpl_vars['data']->value['cat_selected'])){?> checked="checked" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">|__<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</strong><br>
                                <?php } ?>                                
                                <?php } ?>     
                            </div><!-- end .content -->
                        </div><!-- end .box -->

                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 brocco-icon-tag"></span>
                                    <span>Tag / Từ khóa</span>
                                </h4>  
                                <a href="#" class="minimize">Thu nhỏ</a>                                  
                            </div>                     
                            <div class="content">
                                <div class="form-row row-fluid">
                                    <div class="controls">
                                        
                                        <input id="tag_main" type="token-input" name="news_tag" style="width:100%;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ===================== Begin event Box ========================= -->                      
                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 cut-icon-comment"></span>
                                    <span>Chọn sự kiện</span>
                                </h4>                      
                                <a href="#" class="minimize">Thu nhỏ</a>
                            </div><!-- end .title -->
                            <div class="content">                                     
                                <div class="form-row row-fluid">
                                    <input id="token-input-event" type="token-input" name="news_events" style="width:100%;" />                                                          
                                    
                                    <script type="text/javascript">                        
                                        $(document).ready(function() {
                                        $("#token-input-event").tokenInput("<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Base'];?>
?act=EventSuggest", {                   
                                        theme : "facebook",
                                        tokenDelimiter: ",",
                                        preventDuplicates: true,  
                                        prePopulate: <?php echo $_smarty_tpl->tpl_vars['data']->value['list_event_selected'];?>
 

                                        });        
                                        });
                                    </script>   
                                     
                                </div>
                            </div><!-- end .content -->
                        </div><!-- end .box -->
                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 brocco-icon-tag"></span>
                                    <span>Note</span>
                                </h4>  
                                <a href="#" class="minimize">Thu nhỏ</a>                                  
                            </div>                     
                            <div class="content">
                                <div class="form-row row-fluid">
                                    <div class="controls">
                                        <textarea class="text" name="news_note" style="height:80px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['content']->get("note");?>
</textarea>
                                    </div>
                                </div>
                            </div><!--content-->
                        </div><!--box-->
                        <?php if ($_smarty_tpl->tpl_vars['data']->value['action']=='newswait'){?>
                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 brocco-icon-tag"></span>
                                    <span>Lý do trả bài</span>
                                </h4>  
                                <a href="#" class="minimize">Thu nhỏ</a>                                  
                            </div>                     
                            <div class="content">
                                <div class="form-row row-fluid">
                                    <div class="controls">
                                        <textarea class="text" name="reason" style="height:80px;"></textarea>
                                    </div>
                                </div>
                            </div><!--content-->
                        </div><!--box--> 
                        <?php }?>
                    </div><!--cot phai-->                            
                </form>
            </div><!-- End .row-fluid -->
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->        
</div><!-- End #wrapper -->  

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Js'];?>
jquery_submit.js?123" > </script>
<script type="text/javascript">                        
    $(document).ready(function() {

    $("#journalist-input").tokenInput("<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Base'];?>
?act=SearchJournalist", {                   
    theme : "facebook",
    tokenDelimiter: ",",
    preventDuplicates: true,            
    prePopulate : <?php echo $_smarty_tpl->tpl_vars['data']->value['news_journalist'];?>
,            
    tokenLimit : 1
    });        
    });

    function addJournalist(id, pen_name) 
    {
    $('#journalist-input').tokenInput("add", {id : id, name: pen_name});
    }
</script>

<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<script type="text/javascript">
    $("#tag_main").tokenInput("/?act=SearchTag", {                   
        theme : "facebook",
        allowFreeTagging: true,
        tokenDelimiter: ",",
        preventDuplicates: true,
        prePopulate : <?php echo $_smarty_tpl->tpl_vars['data']->value['tags'];?>
,
        tokenLimit : 10
    });
</script>   
<?php }} ?>