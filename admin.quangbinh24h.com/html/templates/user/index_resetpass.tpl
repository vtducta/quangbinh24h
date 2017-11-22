{include file='block/head.tpl'}
    <!-- loading animation -->
    <div id="qLoverlay"></div>
    <div id="qLbar"></div>
    {include file='block/header.tpl'} 
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
        {include file='block/menu_left.tpl'}
        <!--Body content-->
        <div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper--> 
                <div class="heading">
                    <h3>Cập nhật mật khẩu</h3>
                    <div class="resBtnSearch">
                        <a href="#"><span class="icon16 brocco-icon-search"></span></a>
                    </div>
                    <ul class="breadcrumb">
                        <li>Vị trí hiện tại:</li>
                        <li>
                            <a href="{$GUrl.Base}" class="tip" title="Trở lại bảng điều khiển">
                                <span class="icon16 icomoon-icon-screen"></span>
                            </a> 
                            <span class="divider">
                                <span class="icon16 icomoon-icon-arrow-right"></span>
                            </span>
                        </li>
                        <li class="active">Cập nhật mật khẩu</li>
                    </ul>

                </div><!-- End .heading-->
                <div class="row-fluid clearfix">
                    <form id="updateuser" action="/" method="post">
                        <div class="span8" style="margin:0;">
                            <div class="box">   
                                <div class="title">
                                    <h4>
                                        <span class="icon16 brocco-icon-grid"></span>
                                        <span>Cập nhật mật khẩu</span>
                                    </h4>                                    
                                </div>                     
                                <div class="content clearfix">
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Mật khẩu cũ</label>
                                                <div class="span8">
                                                    <input class="span5" type="password" disabled="disabled"  value="{$data.user_info->get('password')}"/>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Mật khẩu mới</label>
                                                <div class="span8">
                                                  <input class="span5" type="password" id="pass_new" name="pass_new" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Mật khẩu mới lần 2</label>
                                                <div class="span8">
                                                  <input class="span5" type="password" id="confim_pass" name="confim_pass" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                                             
                                    <input type="hidden" name="id" value="{$data.user_info->get('user_id')}">
                                    <input type="hidden" name="action" value="updatepass" />
                                    <input type="hidden" name="act" value="UserAction" />                                                   
                                     <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                                                
                                                <button class="btn btn-info" type="button" onclick="check_confirm();">Cập nhật</button>      
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
    {literal}
        <script type="text/javascript">
            function check_confirm()
            {                
                pass_new = $('#pass_new').val();
                confirm_pass = $('#confim_pass').val();
                console.log(pass_new+confirm_pass);
                if(pass_new.length===0 || !pass_new || confirm_pass.length===0 || !confirm_pass)
                {
                    alert("vui lòng nhập đầy đủ thông tin !");
                    return false;
                }                
                if(pass_new.length<6)
                {
                    alert(" mật khẩu 6 ký tự trở lên !");
                    return false;
                }
                if(pass_new != confirm_pass)
                {
                    alert("Mật khẩu xác nhận không giống nhau !");
                    return false;
                }
                $('#updateuser').submit();
            }
        </script>
    {/literal}
{include file='block/footer.tpl'}

