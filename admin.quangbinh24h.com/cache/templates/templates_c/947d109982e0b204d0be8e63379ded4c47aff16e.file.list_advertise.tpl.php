<?php /* Smarty version Smarty-3.1.12, created on 2017-09-14 08:00:01
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/advertise/list_advertise.tpl" */ ?>
<?php /*%%SmartyHeaderCode:179603145859b9d491925604-44916209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '947d109982e0b204d0be8e63379ded4c47aff16e' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/advertise/list_advertise.tpl',
      1 => 1504767329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '179603145859b9d491925604-44916209',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'position_id' => 0,
    'position_name' => 0,
    'tpl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b9d4919c3af1_03651868',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b9d4919c3af1_03651868')) {function content_59b9d4919c3af1_03651868($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('block/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
    <h3>Danh sách Banner/Adsense</h3>
    <div class="resBtnSearch">
        <a href="#"><span class="icon16 brocco-icon-search"></span></a>
    </div>
    <ul class="breadcrumb">
        <li>Vị trí hiện tại:</li>
        <li>
            <a href="" class="tip" title="Danh sách Banner/Adsense">
                <span class="icon16 icomoon-icon-screen"></span>
            </a>
            <span class="divider">
                <span class="icon16 icomoon-icon-arrow-right"></span>
            </span>
        </li>
        <li class="active">Danh sách Banner/Adsense</li>
    </ul>
</div><!-- End .heading-->

<div class="row-fluid">
    <div class="box gradient">
        <form name="advertise1" id="ad_filter" method="post">
        <div class="row-fluid filter-date-block">
            <div class="row-fluid  marginT10 marginB10">
                <div class="clearfix">
                    <div class="left margin10">
                        <select name="type_select">
                            <option value="pc">PC</option>
                            <option value="mobile" <?php if ($_smarty_tpl->tpl_vars['data']->value['type']=='mobile'){?>selected<?php }?>>Mobile</option>
                        </select>
                        <select name="module_select">
                            <option value="home">Trang chủ</option>
                            <option value="cat" <?php if ($_smarty_tpl->tpl_vars['data']->value['module']=='cat'){?>selected<?php }?>>Chuyên mục</option>
                            <option value="detail" <?php if ($_smarty_tpl->tpl_vars['data']->value['module']=='detail'){?>selected<?php }?>>Chi tiết</option>
                        </select>
                        <?php if (is_array($_smarty_tpl->tpl_vars['data']->value['positions'])){?>
                        <select name="ads_select">
                            <?php  $_smarty_tpl->tpl_vars['position_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['position_name']->_loop = false;
 $_smarty_tpl->tpl_vars['position_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['positions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['position_name']->key => $_smarty_tpl->tpl_vars['position_name']->value){
$_smarty_tpl->tpl_vars['position_name']->_loop = true;
 $_smarty_tpl->tpl_vars['position_id']->value = $_smarty_tpl->tpl_vars['position_name']->key;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['position_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['advertise_position']==$_smarty_tpl->tpl_vars['position_id']->value){?>selected="selected"<?php }?>>
                            <?php echo $_smarty_tpl->tpl_vars['position_name']->value;?>

                            </option>
                            <?php } ?>
                        </select>
                        <?php }?>
                    </div>
                </div><!-- End .clearfix -->
            </div>
        </div>
        </form>
    <form name="advertise" id="advertise" action="" method="post" enctype="multipart/form-data">
        <div class="span8" style="margin: 0;">
            <div class="box">
                <div class="title">
                    <h4>
                        <span class="icon16 brocco-icon-grid"></span>
                        <span>Tạo Banner/Adsense</span>
                    </h4>
                </div>
                <div class="content clearfix">
                    <?php echo $_smarty_tpl->tpl_vars['tpl']->value->displayAlert();?>

                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span3" for="normal">Tên quảng cáo</label>
                                <div class="span8">
                                    <input type="text" id="advertise_title" name="advertise_title" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['advertise']['advertise_title'];?>
" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr class="line" />
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span3" for="checkboxes">Mã nhúng</label>
                                <div class="span8">
                                    <textarea name="advertise_embed" style="height: 200px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['advertise']['advertise_embed'];?>
</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                       
                    
                    <hr class="line" />
                    <div class="form-row row-fluid">
                        <label class="form-label span6" for="checkboxes">Active / Deactive?</label>
                        <div class="span4 noMar">
                            <input type="checkbox" name="advertise_active" class="ibutton"
                            <?php if (isset($_smarty_tpl->tpl_vars['data']->value['advertise']['advertise_active'])&&$_smarty_tpl->tpl_vars['data']->value['advertise']['advertise_active']==1){?>checked="checked"<?php }?>/>
                        </div>
                    </div>
                    <hr class="line" />
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['type'];?>
" />
                                <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['module'];?>
" />
                                <input type="hidden" name="action" value="" />
                                <?php if (isset($_smarty_tpl->tpl_vars['data']->value['advertise']['advertise_id'])){?>
                                <a class="btn btn-info btn-large" onclick="advertise.action.value='update';document.getElementById('advertise').submit();">Cập nhật</a>
                                <input type="hidden" name="id" value="1">
                                <?php }else{ ?>
                                <a class="btn btn-info btn-large" onclick="advertise.action.value='add';document.getElementById('advertise').submit();">Tạo quảng cáo</a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div><!--content-->
            </div><!--box-->
        </div><!--cot trai-->

        <div class="span4">
        </div><!--cot phai-->

    </div><!-- End .box -->
    </div><!-- End .row-fluid -->
</form>
<?php echo $_smarty_tpl->getSubTemplate ('block/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript">
    $('select[name="type_select"]').change(function(){
        var type = $('select[name="type_select"]').val();
        var module = $('select[name="module_select"]').val();
        var ads = '';
        if(type=='pc') ads = 'top-header';
        else if(type=='mobile') ads = 'mobile-top-header';
        window.location.href = "/?act=ListAdvertise&type="+type+"&module="+module+"&advertise_position="+ads;
    });
    $('select[name="module_select"]').change(function(){
        var type = $('select[name="type_select"]').val();
        var module = $('select[name="module_select"]').val();
        var ads = '';
        if(type=='pc') ads = 'top-header';
        else if(type=='mobile') ads = 'mobile-top-header';
        window.location.href = "/?act=ListAdvertise&type="+type+"&module="+module+"&advertise_position="+ads;
    });
    $('select[name="ads_select"]').change(function(){
        var type = $('select[name="type_select"]').val();
        var module = $('select[name="module_select"]').val();
        var ads = $('select[name="ads_select"]').val();
        window.location.href = "/?act=ListAdvertise&type="+type+"&module="+module+"&advertise_position="+ads;
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR'
        });
    });
    $(function() {
        $('#datetimepicker2').datetimepicker({
            language: 'pt-BR'
        });
    });
</script><?php }} ?>