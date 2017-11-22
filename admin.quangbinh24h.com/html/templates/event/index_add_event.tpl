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
                    <h3>Thêm sự kiện</h3>                    
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
                        <li class="active">Thêm sự kiện</li>
                    </ul>

                </div><!-- End .heading-->    

                <div class="row-fluid clearfix">
                    <form action="/" method="post" id="addnewsevent"> 
                        <div class="span8" style="margin:0;">
                            <div class="box">   
                                <div class="title">
                                    <h4>
                                        <span class="icon16 brocco-icon-grid"></span>
                                        <span>Nội dung sự kiện</span>
                                    </h4>                                    
                                </div>                     
                                <div class="content clearfix">  
                                      
                                                                                                           
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Tên sự kiện</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" name="title" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>     
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Miêu tả sự kiện</label>
                                                <div class="span8">                                                    
                                                    <textarea class="text" name="description" style="height:80px;"></textarea>
                                                </div>
                                            </div>
                                        </div>                                      
                                    </div>  
                                                                                           
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Meta Title</label>
                                                <div class="span8">
                                                    <p><span id="counter_title"></span> ký tự còn lại</p>
                                                    <input class="span8" id="meta_title" name="meta_title" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Meta description</label>
                                                <div class="span8"> 
                                                    <p><span id="counter_description"></span> ký tự còn lại</p>                                                   
                                                    <textarea class="text" id="meta_description" name="meta_description" style="height:80px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Meta keyword</label>
                                                <div class="span8">                                                    
                                                    <textarea class="text" name="meta_keyword" style="height:80px;"></textarea>
                                                </div>
                                            </div>
                                        </div>                                      
                                    </div>  
                                    <hr class="line" />    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Chuyên mục</label>
                                                <div class="span8">                                                    
                                                    <select name="category_id">
                                                        <option value="0">Chọn chuyên mục</option>
                                                        {foreach from=$data.list_category item=item}
                                                            <option value="{$item.id}">{$item.title}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                      
                                    </div>                                                                                                                                          
                                     <hr class="line" />
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Nổi bật trang chủ</label>
                                                <div class="span8">                                                    
                                                    <select name="feature_home">                                                       
                                                        <option value="0">Không</option>
                                                        <option value="1">Có</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                      
                                    </div>    
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Xuất bản</label>
                                                <div class="span8">
                                                     <input type="radio" id="inlineCheckbox4" checked="checked" value="1" name="status" class="ibutton2222"/>
                                                   
                                                </div>
                                            </div>       
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Chờ duyệt</label>
                                                <div class="span8">
                                                   
                                                     <input type="radio" id="inlineCheckbox4" value="2" name="status" class="ibutton2222" />
                                                </div>
                                            </div>     
                                        </div>
                                    </div>    
                                                                                                                                                                          
                                     <hr class="line" />
                                     
                                     <input type="hidden" name="action" value="addevent" />
                                     <input type="hidden" name="act" value="EventAction" />
                                     <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                                                
                                                <a class="btn btn-success btn-large" onclick="$('#addnewsevent').submit();" >Lưu</a>
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

    
