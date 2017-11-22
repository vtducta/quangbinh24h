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
                    <h3>Tạo thành viên</h3>                   

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
                        <li class="active">Tạo thành viên</li>
                    </ul>

                </div><!-- End .heading-->
                <div class="row-fluid clearfix">
                    <form action="/" id="adduser" method="POST">
                    {$template_helper->displayAlert()}
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
                                                        {foreach from=$data.list_cat item=val key=k}                                                    
                                                            <tr>
                                                                <td><input type="checkbox" id="inlineCheckbox1" name="news_cat[]" value="{$val.id}" class="styled" /><strong>{$val.title}</strong></td>
                                                                    <tr>
                                                                        {foreach from=$val.child item=v}
                                                                            <td><input type="checkbox" id="inlineCheckbox1" name="news_cat[]" value="{$v.id}" class="styled" />{$v.title}</td>
                                                                        {/foreach}
                                                                    </tr>
                                                            </tr>
                                                        {/foreach}
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
{include file='user/load_js.tpl'}
{include file='block/footer.tpl'}