<?php /* Smarty version Smarty-3.1.12, created on 2017-09-12 13:07:31
         compiled from "/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/user/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35277941759b779a3ebf765-28716763%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98fc0d5bb98f479ccf8ebb3a53adf78e2375368d' => 
    array (
      0 => '/home/app/quangbinh24h-apps/admin.quangbinh24h.com/html/templates/user/login.tpl',
      1 => 1504767333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35277941759b779a3ebf765-28716763',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'template_helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59b779a3f0b2b2_08284591',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b779a3f0b2b2_08284591')) {function content_59b779a3f0b2b2_08284591($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>     
    <title><?php if (isset($_smarty_tpl->tpl_vars['data']->value['object']['title'])){?><?php echo $_smarty_tpl->tpl_vars['data']->value['object']['title'];?>
<?php }else{ ?>WeAdmin | Dashboard<?php }?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Supr admin template - new premium responsive admin template. This template is designed to help you build the site administration without losing valuable time.Template contains all the important functions which must have one backend system.Build on great twitter boostrap framework" />
    <meta name="keywords" content="admin, admin template, admin theme, responsive, responsive admin, responsive admin template, responsive theme, themeforest, 960 grid system, grid, grid theme, liquid, masonry, jquery, administration, administration template, administration theme, mobile, touch , responsive layout, boostrap, twitter boostrap" />
    <meta name="application-name" content="Supr admin template" />
     <meta name="robots" content="noindex" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  

    <!-- Le styles -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css" />
    <link href="css/icons.css" rel="stylesheet" type="text/css" />
    <link href="plugins/uniform/uniform.default.css" type="text/css" rel="stylesheet" />

    <!-- Main stylesheets -->
    <link href="css/main.css" rel="stylesheet" type="text/css" /> 
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
        <link type="text/css" href="css/ie.css" rel="stylesheet" />
    <![endif]-->    
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png" />    
</head>
      
    <body class="loginPage">

    <div class="container-fluid">

        <div id="header">

            <div class="row-fluid">

                <div class="navbar">
                    <div class="navbar-inner">
                      <div class="container">
                            <a class="brand" href="javascript:void(0)"><img height="56px" src="images/logo.png?2" /></a>
                      </div>
                    </div><!-- /navbar-inner -->
                  </div><!-- /navbar --> 
            </div><!-- End .row-fluid --> 
        </div><!-- End #header --> 
    </div><!-- End .container-fluid --> 
    <div class="container-fluid">        
        <div class="loginContainer">
            <?php echo $_smarty_tpl->tpl_vars['template_helper']->value->displayAlert();?>
  
            <form class="form-horizontal" action="/" method="post" id="loginForm" />   
                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span12" for="username">
                                Tên đăng nhập:
                                <span class="icon16 icomoon-icon-user-2 right gray marginR10"></span>
                            </label>
                            <input class="span12" id="username" type="text" name="username" value="" title="Username" />
                            <label for="username" generated="true" class="error" style="display:none;">Fill me please</label>
                        </div> 
                    </div>
                </div>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span12" for="password">
                                Mật khẩu:
                                <span class="icon16 icomoon-icon-locked right gray marginR10"></span>
                                <span class="forgot"><a href="javascript:void(0)">Quên mật khẩu?</a></span>
                            </label>
                            <input class="span12" id="password" type="password" name="password" value="" title="*******" />
                            <label for="password" generated="true" class="error" style="display: none;">Chưa điền mật khẩu</label>
                        </div>
                    </div>
                </div>
                <div class="form-row row-fluid">                       
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="form-actions">
                            <div class="span12 controls">
                                <input type="hidden" name="act" value="LoginAction" />
                                <input type="hidden" name="action" value="login" />
                               <!-- <input type="checkbox" id="keepLoged" value="Value" class="styled" name="logged" /> Lưu mật khẩu        -->
                                <button type="submit" onclick="$('#loginForm').submit();" class="btn btn-info right" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> Đăng nhập</button>
                            </div>
                            </div>
                        </div>
                    </div> 
                </div>

            </form>
        </div>

    </div><!-- End .container-fluid -->         
    
    <!-- Le javascript   ================================================== -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap.js"></script>  
    <script type="text/javascript" src="plugins/touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="plugins/ios-fix/ios-orientationchange-fix.js"></script>
    <script type="text/javascript" src="plugins/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="plugins/uniform/jquery.uniform.min.js"></script>
                                                                                           
     <script type="text/javascript">
        // document ready function
        $(document).ready(function() {
            $("input, textarea, select").not('.nostyle').uniform();
            $("#loginForm").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 1
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }  
                },
                messages: {
                    username: {
                        required: "Fill me please",
                        minlength: "My name is bigger"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "My password is more that 6 chars"
                    }
                }   
            });
        });
    </script>  
    </body>
</html>
<?php }} ?>