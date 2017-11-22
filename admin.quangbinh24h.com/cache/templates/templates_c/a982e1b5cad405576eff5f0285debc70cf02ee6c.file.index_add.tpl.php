<?php /* Smarty version Smarty-3.1.12, created on 2017-09-16 10:54:14
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/user/index_add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:71769213759bca0666d5ba3-80221118%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a982e1b5cad405576eff5f0285debc70cf02ee6c' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/user/index_add.tpl',
      1 => 1504767333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71769213759bca0666d5ba3-80221118',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'GUrl' => 0,
    'template_helper' => 0,
    'data' => 0,
    'val' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59bca06673b839_41878788',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59bca06673b839_41878788')) {function content_59bca06673b839_41878788($_smarty_tpl) {?>    <?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
                    <h3>Tạo thành viên</h3>                   

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
                        <li class="active">Tạo thành viên</li>
                    </ul>

                </div><!-- End .heading-->
                <div class="row-fluid clearfix">
                    <form action="/" id="adduser" method="POST">
                    <?php echo $_smarty_tpl->tpl_vars['template_helper']->value->displayAlert();?>

                        <div class="span8" style="margin:0;">
                            <div class="box">   
                                <div class="title">
                                    <h4>
                                        <span class="icon16 brocco-icon-grid"></span>
                                        <span>Tạo thành viên</span>
                                    </h4>                                    
                                </div>                     
                                <div class="content clearfix">                               
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Tên đăng nhập</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" type="text" name="username" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Tên thật</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" type="text" name="user_fullname" />                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Email</label>
                                                <div class="span8">
                                                    <input class="span8" name="email" id="normalInput" type="text" />                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Mật khẩu ban đầu</label>
                                                <div class="span8">
                                                    <input class="span5" type="password" name="password"/>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="checkboxes">Chức danh</label>
                                                <div class="span8">
                                                    <div class="controls">   
                                                        <select id="groupname" name="groupname">
                                                            <option value="4">Administrator - Tổng biên tập</option>
                                                            <option value="1">Super.Mod - Thư ký</option>
                                                            <option value="2">Mod - Biên tập viên</option>
                                                            <option value="3">Reporter - Cộng tác viến</option>
                                                        </select>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </div>                                    
                                    <div id="category" class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="checkboxes">Chuyên mục</label>
                                                <div class="span8">   
                                                    <table border="0" width="100%">                                                    
                                                        <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['list_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['val']->key;
?>                                                    
                                                            <tr>
                                                                <td><input type="checkbox" id="inlineCheckbox1" name="news_cat[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="styled" /><strong><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</strong></td>
                                                                    <tr>
                                                                        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['val']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                                                                            <td><input type="checkbox" id="inlineCheckbox1" name="news_cat[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" class="styled" /><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</td>
                                                                        <?php } ?>
                                                                    </tr>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>                                                    
                                                </div> 
                                            </div>
                                        </div> 
                                    </div>
                                    <hr class="line" />
                                     <div class="form-row row-fluid">
                                         <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="checkboxes">Thông tin thêm</label>
                                                <div class="span8">
                                                    <textarea class="" name="user_provinde" style="height:100px; width:70%"></textarea>                                                    
                                                </div>
                                            </div>
                                        </div>                                       
                                     </div>                                    
                                     
                                     <div class="form-row row-fluid">
                                         <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="checkboxes">Địa chỉ</label>
                                                <div class="span8">
                                                    <textarea name="user_address" style="height:50px; width:70%"></textarea>                                                    
                                                </div>
                                            </div>
                                        </div>                                       
                                     </div> 
                                     
                                     <div class="form-row row-fluid">
                                         <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="checkboxes">Số điện thoại</label>
                                                <div class="span8">
                                                     <input class="span6" name="user_phone" type="text" />                                                                                                          
                                                 </div>
                                            </div>
                                        </div>                                       
                                     </div>
                                     
                                     <hr class="line" />
                                     <input type="hidden" name="action" value="adduser" /> 
                                     <input type="hidden" name="act" value="UserAction" /> 
                                     <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                                                
                                                <a class="btn btn-success btn-large" onclick="$('#adduser').submit();">Tạo thành viên</a>                                                
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