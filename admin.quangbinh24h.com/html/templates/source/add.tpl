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
                    <h3>Tạo Nguồn Bài Viết</h3>                   

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
                        <li class="active">Tạo Nguồn Bài Viết</li>
                    </ul>

                </div><!-- End .heading-->
                <div class="row-fluid clearfix">
                    <form action="" id="adduser" method="POST">
                    {$template_helper->displayAlert()}
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
                                                    <input class="span8" id="normalInput" type="text" name="name" value="{if isset($data.post.name)}{$data.post.name}{/if}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Miêu tả</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" type="text" name="description" value="{if isset($data.post.description)}{$data.post.description}{/if}"/>                                                    
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
                                                <a class="btn btn-success btn-large" href='{$link_helper->link_source("manage")}' style="margin-left:20px">Quản lý nguồn bài viết</a>                                            
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