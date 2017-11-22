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
                <h3>Tạo tác giả</h3>                   
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
                    <li class="active">Tạo tác giả</li>
                </ul>

            </div><!-- End .heading-->
            <div class="row-fluid clearfix">
                <form action="/" id="addjournalist" action="/" method="POST">
                    {$template_helper->displayAlert()}
                    <div class="span12" style="margin:0;">
                        <div class="box">   
                            <div class="title">
                                <h4>
                                    <span class="icon16 brocco-icon-grid"></span>
                                    <span>Tạo tác giả</span>
                                </h4>                                    
                            </div>                     
                            <div class="content clearfix">                               
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="normal">Full name :</label>
                                            <div class="span8">
                                                <input class="span8" id="full_name" type="text" name="full_name" />
                                            </div>
                                        </div>
                                    </div>
                                </div>      

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="normal">Bút danh *:</label>
                                            <div class="span8">
                                                <input class="span8" id="pen_name" type="text" name="pen_name" />
                                            </div>
                                        </div>
                                    </div>
                                </div>                                   
   

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="normal">Email *:</label>
                                            <div class="span8">
                                                <input class="span8" id="email" type="text" name="email" />
                                            </div>
                                        </div>
                                    </div>
                                </div>                                   

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="normal">Ngày sinh :</label>
                                            <div class="span8">                                                    
                                                <input type="text" name="birthday"   id="datepicker" class="span8"  value="" />                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">FaceBook :</label>
                                            <div class="span8">
                                                <input class="span6" name="facebook" type="text" />   
                                            </div>
                                        </div>
                                    </div>                                       
                                </div> 
                                 
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">Facebook Link :</label>
                                            <div class="span8">
                                                <input class="span6" name="facebook_link" type="text" />   
                                            </div>
                                        </div>
                                    </div>                                       
                                </div>   
                                
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">Google Plus :</label>
                                            <div class="span8">
                                                <input class="span6" name="gplus" type="text" />   
                                            </div>
                                        </div>
                                    </div>                                       
                                </div> 
                                
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">Google Plus Link:</label>
                                            <div class="span8">
                                                <input class="span6" name="gplus_link" type="text" />   
                                            </div>
                                        </div>
                                    </div>                                       
                                </div> 
                                
                                <label class="form-label span3" for="textarea">Ảnh đại diện
                                    <span class="help-block">Kích thước tối đa được tải lên 2mb</span></label>
                                <button id="upload" type="button" ><span>Tải ảnh từ máy tính</span></button>
                                <p><span id="status"></span></p>
                                <label class="error" style="display:none;">Báo lỗi</label>
                                <div id="display-file"></div>
                                <input type="hidden" id="avatar" name="avatar" value="">    

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">Tiểu sử</label>
                                            <div class="span8">
                                                <textarea class="" name="biography" style="height:100px; width:70%"></textarea>                                                    
                                            </div>
                                        </div>
                                    </div>                                       
                                </div>  
                                
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">Đánh giá :</label>
                                            <div class="span8">
                                                <input class="span6" name="rate" type="text" />
                                            </div>
                                        </div>
                                    </div>                                       
                                </div>   
                                
                                <input type="hidden" name="mode" value="create"/> 
                                <input type="hidden" name="act" value="JournalistProcess" /> 
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">                                                
                                            <button class="btn btn-info btn-large" id="create_journalist">Tạo tác giả</button>
                                            &nbsp;&nbsp;
                                            <a class="btn btn-info btn-large" href="{$link_helper->link_admin('ListJournalist')}">Quay lại</a>
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
{include file='block/footer.tpl'}
{include file='journalist/create_js.tpl'}
