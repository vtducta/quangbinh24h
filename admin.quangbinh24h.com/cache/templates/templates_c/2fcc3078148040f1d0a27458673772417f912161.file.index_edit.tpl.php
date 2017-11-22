<?php /* Smarty version Smarty-3.1.12, created on 2017-10-28 09:15:46
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/category/index_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135602018459f3e85231b961-04123761%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2fcc3078148040f1d0a27458673772417f912161' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/category/index_edit.tpl',
      1 => 1504767330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135602018459f3e85231b961-04123761',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'GUrl' => 0,
    'template_helper' => 0,
    'data' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59f3e8526a1ec5_15385285',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f3e8526a1ec5_15385285')) {function content_59f3e8526a1ec5_15385285($_smarty_tpl) {?>    <?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
                    <h3>Tạo Chuyên mục</h3>                   

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
                        <li class="active">Sửa Chuyên mục</li>
                    </ul>

                </div><!-- End .heading-->
                <div class="row-fluid clearfix">
                    <form action="/" id="category_edit" method="POST">
                    <?php echo $_smarty_tpl->tpl_vars['template_helper']->value->displayAlert();?>

                        <div class="span8" style="margin:0;">
                            <div class="box">   
                                <div class="title">
                                    <h4>
                                        <span class="icon16 brocco-icon-grid"></span>
                                        <span>Sửa Chuyên mục</span>
                                    </h4>                                    
                                </div>                     
                                <div class="content clearfix">                               
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Tên chuyên mục</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['category']->get('title');?>
" />
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">slug</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" type="text" name="meta_slug" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['category']->get('meta_slug');?>
"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>        
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Vị trí</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" type="text" name="ordering" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['category']->get('ordering');?>
"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Hiển thị</label>
                                                <div class="span8">
                                                    <select name="display">
                                                        <option value="0" <?php if ($_smarty_tpl->tpl_vars['data']->value['category']->get('home_display')==0){?>selected<?php }?>>hiển thị</option>
                                                        <option value="1" <?php if ($_smarty_tpl->tpl_vars['data']->value['category']->get('home_display')==1){?>selected<?php }?>>ẩn</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                                                
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Miêu tả</label>
                                                <div class="span8">
                                                    <textarea name="description" style="height:50px; width:70%"><?php echo $_smarty_tpl->tpl_vars['data']->value['category']->get('description');?>
</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Meta Title</label>
                                                <div class="span8">
                                                    <input class="span8" name="meta_title" id="normalInput" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['category']->get('meta_title');?>
" />                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Meta Description</label>
                                                <div class="span8">
                                                    <input class="span5" type="text" name="meta_description" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['category']->get('meta_description');?>
"/>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Meta Keyword</label>
                                                <div class="span8">
                                                    <input class="span5" type="text" name="meta_keyword" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['category']->get('meta_keywork');?>
"/>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="checkboxes">Chuyên mục cha</label>
                                                <div class="span8">
                                                    <div class="controls">   
                                                        <select name="parent_cat">
                                                        <option value="0">default</option>
                                                        <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                                                                <option <?php if ($_smarty_tpl->tpl_vars['data']->value['category']->get('parent_id')==$_smarty_tpl->tpl_vars['val']->value['id']){?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</option>
                                                        <?php } ?>
                                                        </select>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </div>   
                                     <hr class="line" />
                                     <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['category']->get('id');?>
" />
                                     <input type="hidden" name="action" value="editcategory" /> 
                                     <input type="hidden" name="act" value="ActionCategory" /> 
                                     <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                                                
                                                <a class="btn btn-success btn-large" onclick="$('#category_edit').submit();">Sửa chuyên mục</a>                                                
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
<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>