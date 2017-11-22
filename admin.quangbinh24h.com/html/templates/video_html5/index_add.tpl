{include file='block/head.tpl'}   
{include file='block/load_tinyMCE.tpl'}  
<!-- loading animation -->
<div id="qLoverlay"></div>
<div id="qLbar"></div>
{include file='block/header.tpl'}
<div id="wrapper">               
    <div class="resBtn">
        <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
    </div>        
    <div class="collapseBtn">
        <a href="#" class="tipR" title="Ẩn menu"><span class="icon12 minia-icon-layout"></span></a>
    </div>
    <div id="sidebarbg"></div>
    {include file='block/menu_left.tpl'}
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

{literal}
<script type="text/javascript" {/literal}src="{$GUrl.Js}jquery_submit.js?12" {literal}> </script>        
{/literal}
{include file='video_html5/add_js.tpl'}
{include file='block/footer.tpl'} 
