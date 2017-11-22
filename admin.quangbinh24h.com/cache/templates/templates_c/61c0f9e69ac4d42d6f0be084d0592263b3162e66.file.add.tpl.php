<?php /* Smarty version Smarty-3.1.12, created on 2017-09-19 21:10:37
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/source/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:80017756059c1255d6b74d8-40507770%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '61c0f9e69ac4d42d6f0be084d0592263b3162e66' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/source/add.tpl',
      1 => 1504767332,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '80017756059c1255d6b74d8-40507770',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'GUrl' => 0,
    'template_helper' => 0,
    'data' => 0,
    'link_helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59c1255d718200_60098987',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59c1255d718200_60098987')) {function content_59c1255d718200_60098987($_smarty_tpl) {?>    <?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <!-- loading animation -->
    <div id="qLoverlay"></div>
    <div id="qLbar"></div>
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
                    <h3>Tạo Nguồn Bài Viết</h3>                   

                    <div class="resBtnSearch">
                        <a href="#"><span class="icon16 brocco-icon-search"></span></a>
                    </div>
                    <ul class="breadcrumb">
                        <li>Vị trí hiện tại:</li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['GUrl']->value['Base'];?>
" class="tip" title="Trở lại bảng điều khiển">
                                <span class="icon16 icomoon-icon-screen"></span>
                            </a> 
                            <span class="divider">
                                <span class="icon16 icomoon-icon-arrow-right"></span>
                            </span>
                        </li>
                        <li class="active">Tạo Nguồn Bài Viết</li>
                    </ul>

                </div><!-- End .heading-->
                <div class="row-fluid clearfix">
                    <form action="" id="adduser" method="POST">
                    <?php echo $_smarty_tpl->tpl_vars['template_helper']->value->displayAlert();?>

                        <div class="span8" style="margin:0;">
                            <div class="box">   
                                <div class="title">
                                    <h4>
                                        <span class="icon16 brocco-icon-grid"></span>
                                        <span>Tạo nguồn bài viết</span>
                                    </h4>                                    
                                </div>                     
                                <div class="content clearfix">                               
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Tên</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" type="text" name="name" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['post']['name'])){?><?php echo $_smarty_tpl->tpl_vars['data']->value['post']['name'];?>
<?php }?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Miêu tả</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" type="text" name="description" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['post']['description'])){?><?php echo $_smarty_tpl->tpl_vars['data']->value['post']['description'];?>
<?php }?>"/>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                     <hr class="line" />
                                     <input type="hidden" name="action" value="add" /> 
                                     <input type="hidden" name="act" value="Source" /> 
                                     <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                                                
                                                <a class="btn btn-success btn-large" onclick="$('#adduser').submit();">Tạo nguồn bài viết</a>    
                                                <a class="btn btn-success btn-large" href='<?php echo $_smarty_tpl->tpl_vars['link_helper']->value->link_source("manage");?>
' style="margin-left:20px">Quản lý nguồn bài viết</a>                                            
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
<?php echo $_smarty_tpl->getSubTemplate ('user/load_js.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>