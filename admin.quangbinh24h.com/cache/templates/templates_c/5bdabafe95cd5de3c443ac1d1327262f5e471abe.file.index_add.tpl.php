<?php /* Smarty version Smarty-3.1.12, created on 2017-09-16 11:07:11
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/TTK/index_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139788634259bca36f956973-54340423%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bdabafe95cd5de3c443ac1d1327262f5e471abe' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/TTK/index_add.tpl',
      1 => 1504767333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139788634259bca36f956973-54340423',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'GUrl' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59bca36fa44ac5_20764055',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59bca36fa44ac5_20764055')) {function content_59bca36fa44ac5_20764055($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    
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
                <form id="AddNews" action="/" method="post">
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
                                                
                                                <input class="" id="id_title"  type="text" name="title" value="" />
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
                                                        <input id="meta_title" type="text" name="meta_title" value=""/>                                                           
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
                                                        <input type="text" name="slug_name" value="" />                                                           
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
                                                        <textarea class="text" style="height:60px; width:100%" name="meta_keyword"></textarea>                                                           
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
                                                        <textarea id="meta_description" class="text" name="meta_description" style="height:60px; width:100%"></textarea>                                                           
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
                                                <textarea id="short_desc" name="short_desc" ></textarea>                                                    
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
                                <div id="display-file"></div>
                                <input type="hidden" id="flagthumb" name="id_thumb" value="0">
                                
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
"> <?php echo $_smarty_tpl->tpl_vars['val']->value->name;?>
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
                                            <label class="form-label span3" for="journalists">Tác giả</label>
                                            <div class="span8">
                                                <input id="journalist-input" type="token-input" name="news_journalist" style="width:100%;"/>
                                                <div class="box">
                                                    <div class="form-row row-fluid">
                                                        <div class="">   
                                                            <select class="nostyle" multiple="multiple"  size="10" id="id-tac-gia">
                                                                <option value="0">Nhập tác giả</option>
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
                                            <label class="form-label span3" for="journalists">Người viết</label>
                                            <div class="span8">                                              
                                                <select name="writter" style="width:250px">
                                                    <option value="0"> Chọn tên người viết</option> 
                                                <!-- <?php echo var_dump($_smarty_tpl->tpl_vars['data']->value['user_id_login']);?>
-->
                                                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_user_']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>    
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value->user_id;?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['user_id_login']==$_smarty_tpl->tpl_vars['val']->value->user_id){?>selected="selected"<?php }?>> <?php echo $_smarty_tpl->tpl_vars['val']->value->fullname;?>
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
                                            <textarea class="mceEditor" id="mceEditor" name="content"></textarea>
                                        </div>
                                    </div>  
                                </div>                                        
                                <input type="hidden" name="action" value="addnews" />
                                <input type="hidden" name="act" value="NewsAction" />                                                    
                                <input type="hidden" name="status" value="3">
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid"> 
                                            <button class="btn btn-info btn-large" id="xuatban" onclick="check24h()">Xuất bản</button>
                                              
                                             <script type="text/javascript">  
                                             function check24h()
                                              {
                                                var value=document.getElementById('id-tac-gia').value;
                                                 if(value==null)
                                                  {
                                                  alert("Vui Lòng Cập Nhật Tác Giá !!^-^");
                                                  }
                                                }
                                              </script>
                                                
                                            <button class="btn btn-danger btn-large" id="draft">Lưu tạm</button>
                                        </div>
                                    </div>  
                                </div>
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
                                            <input data-format="dd-MM-yyyy hh:mm:ss" name="timer" value=""  type="text" readonly="readonly"></input>
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
                                    <input type="checkbox" name="news_cat[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><strong style="color: blue;"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</strong><br>
                                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                    <input type="checkbox" name="news_cat[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
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
                                        <textarea class="text" name="news_note" style="height:80px;"></textarea>
                                    </div>
                                </div>
                            </div><!--content-->
                        </div><!--box-->
                    </div><!--cot phai-->                            
                </form>
            </div><!-- End .row-fluid -->
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->        
    </div><!-- End #wrapper --> 
    
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Js'];?>
autosavedraft.js"></script> 
    
    
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Js'];?>
jquery_submit.js?12" > </script>
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
    $(document).ready(function() {
        $("#tag_main").tokenInput("/?act=SearchTag", {
            theme : "facebook",
            allowFreeTagging: true,
            tokenDelimiter: ",",
            preventDuplicates: true,
            tokenLimit : 10
        });
    });
</script>   
<?php }} ?>