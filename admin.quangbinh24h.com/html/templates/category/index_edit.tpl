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
                    <h3>Tạo Chuyên mục</h3>                   

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
                        <li class="active">Sửa Chuyên mục</li>
                    </ul>

                </div><!-- End .heading-->
                <div class="row-fluid clearfix">
                    <form action="/" id="category_edit" method="POST">
                    {$template_helper->displayAlert()}
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
                                                    <input class="span8" id="normalInput" type="text" name="title" value="{$data.category->get('title')}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">slug</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" type="text" name="meta_slug" value="{$data.category->get('meta_slug')}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>        
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Vị trí</label>
                                                <div class="span8">
                                                    <input class="span8" id="normalInput" type="text" name="ordering" value="{$data.category->get('ordering')}"/>
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
                                                        <option value="0" {if $data.category->get('home_display')==0}selected{/if}>hiển thị</option>
                                                        <option value="1" {if $data.category->get('home_display')==1}selected{/if}>ẩn</option>
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
                                                    <textarea name="description" style="height:50px; width:70%">{$data.category->get('description')}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Meta Title</label>
                                                <div class="span8">
                                                    <input class="span8" name="meta_title" id="normalInput" type="text" value="{$data.category->get('meta_title')}" />                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Meta Description</label>
                                                <div class="span8">
                                                    <input class="span5" type="text" name="meta_description" value="{$data.category->get('meta_description')}"/>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Meta Keyword</label>
                                                <div class="span8">
                                                    <input class="span5" type="text" name="meta_keyword" value="{$data.category->get('meta_keywork')}"/>                                                    
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
                                                        {foreach from=$data.list_category  item=val key=key}
                                                                <option {if $data.category->get('parent_id') == $val.id} selected="selected" {/if} value="{$val.id}">{$val.title}</option>
                                                        {/foreach}
                                                        </select>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </div>   
                                     <hr class="line" />
                                     <input type="hidden" name="id" value="{$data.category->get('id')}" />
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
{include file='block/footer.tpl'}