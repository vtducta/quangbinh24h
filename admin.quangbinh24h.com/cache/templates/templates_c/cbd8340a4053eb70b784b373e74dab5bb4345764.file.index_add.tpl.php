<?php /* Smarty version Smarty-3.1.12, created on 2017-09-13 14:03:38
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/video_html5/index_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49064808859b8d84a302297-32729397%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cbd8340a4053eb70b784b373e74dab5bb4345764' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/video_html5/index_add.tpl',
      1 => 1504767333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49064808859b8d84a302297-32729397',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'GUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b8d84a349a94_23722306',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b8d84a349a94_23722306')) {function content_59b8d84a349a94_23722306($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
   
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
                <h3>Thêm video</h3>   
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
                <form id="AddVideo" action="/" method="post">
                    <div class="span8" style="margin:0;">
                        <div class="box">   
                            <div class="title">
                                <h4>
                                    <span class="icon16 brocco-icon-grid"></span>
                                    <span>Nội dung video</span>
                                </h4>                                    
                            </div>                                                     
                            <div class="content clearfix">                                    
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="normal">Tên video</label>
                                            <div class="span8">
                                                <input class="" id="id_title" type="text" name="title" value="" />                                                                                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                                         
                                <hr class="line" />                                     
                                      
                                <label class="form-label span3" for="textarea">Ảnh thumbnail
                                    <span class="help-block">Kích thước tối đa được tải lên 2mb</span></label>
                                <button id="upload" type="button" ><span>Tải ảnh từ máy tính</span></button>
                                <p><span id="status"></span></p>
                                <div id="display-file"></div>
                                <input type="hidden" id="flagthumb" name="id_thumb" value="0">  
                                <hr class="line" /> 
                                
                                <div style="float: left;margin: 5px;">
                                    <button id="uploadfile" type="button" ><span>Tải file từ máy tính</span></button>
                                    <div id="display-file-doc"  style="width: 85px;height: 85px;" ></div>
                                </div>
                                <p><span id="statusfile"></span></p>
                                <label class="error" style="display:none;">Báo lỗi</label>
                                <input type="hidden" id="link" name="link" value="0">
                                <hr class="line" />
                                                                                    
                                <input type="hidden" name="action" value="addvideo" />
                                <input type="hidden" name="act" value="VideoActionHtml5" />                                                    
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <button class="btn btn-info btn-large" id="addvideo">Thêm video</button>
                                        </div>                                            
                                    </div>  
                                </div>                                      
                            </div><!--content-->
                        </div><!--box-->
                    </div><!--cot trai-->
                </form>               
            </div><!-- End .row-fluid -->
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->        
</div><!-- End #wrapper -->


<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Js'];?>
jquery_submit.js?12" > </script>        

<?php echo $_smarty_tpl->getSubTemplate ('video_html5/add_js.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
 
<?php }} ?>