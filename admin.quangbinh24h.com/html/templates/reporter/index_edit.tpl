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
                <h3>Sửa bài viết</h3>   
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
                <form id="AddNews" action="/" method="post">
                    <div class="span8" style="margin:0;">
                        <div class="box">   
                            <div class="title">
                                <h4>
                                    <span class="icon16 brocco-icon-grid"></span>
                                    <span>Nội dung bài viết</span>
                                </h4>                                    
                            </div>                                                     
                            <div class="content clearfix">                                    
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="normal">Tên bài viết</label>
                                            <div class="span8">
                                                <input class="" id="id_title" type="text" name="title" value="{$data.content->get('title')|escape:'html'}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                                        
                                <!--END SEO-->
                                <div class="well">
                                    <a href="javascript:void(0)" onclick="open_seo()">SEO</a>
                                    <div class="seo-wrap">
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span2" for="checkboxes">Title</label>
                                                    <div class="span8">
                                                        <p><span id="counter_title"></span> ký tự còn lại</p>
                                                        <input id="meta_title" type="text" name="meta_title" value="{if $data.content->get('meta_title')}{$data.content->get('meta_title')}{else}{$data.content->get('title')}{/if}"/>                                                           
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                        <hr class="line" />
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span2" for="checkboxes">Slug</label>
                                                    <div class="span8">
                                                        <input type="text" name="slug_name" value="{$data.content->get('meta_slug')}" />                                                           
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                        <hr class="line" />
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span2" for="checkboxes">Keyword</label>
                                                    <div class="span8">
                                                        <textarea class="text" style="height:60px; width:100%" name="meta_keyword">{if $data.content->get('meta_keywork')}{$data.content->get('meta_keywork')}{else}{$data.tags}{/if}</textarea>                                                           
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                        <hr class="line" />
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span2" for="checkboxes">Description</label>
                                                    <div class="span8">
                                                        <p><span id="counter_description"></span> ký tự còn lại</p>
                                                        <textarea id="meta_description" class="text" name="meta_description" style="height:60px; width:100%">{$data.content->get('meta_description')}</textarea>                                                           
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div>
                                    </div><!--SEO wrap-->
                                </div>
                                <!--END SEO-->
                                <hr class="line" />                                     
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">Mô tả ngắn</label>
                                            <div class="span8">
                                                <!--<p><span id="counter_sapo"></span> ký tự còn lại</p>-->
                                                <textarea id="short_desc" name="short_desc">{$data.content->get('intro_text')}</textarea>                                                    
                                            </div>
                                        </div>
                                    </div>                                       
                                </div>                                       
                                <hr class="line" />                                        
                                <label class="form-label span3" for="textarea">Ảnh thumbnail
                                    <span class="help-block">Kích thước tối đa được tải lên 2mb</span></label>
                                <button id="upload" type="button" ><span>Tải ảnh từ máy tính</span></button>
                                <p><span id="status"></span></p>
                                <hr class="line" />
                                <div id="display-file">
                                    <img src="{if $data.link_thumb} {$data.link_thumb->get('upload_url')} {/if}" alt="" style="width: 85px; height: 85px;">
                                </div>
                                <input type="hidden" id="flagthumb" name="id_thumb" value="{$data.content->get('images')}">   
                                
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="journalists">Nguồn bài viết</label>
                                            <div class="span8">                                              
                                                <select name="source_id" style="width:250px">
                                                    <option value="0"> Chọn nguồn bài viết</option> 
                                                    {foreach from=$data.list_source key=key item=val}    
                                                        <option value="{$val->id}" {if $data.content->get("source_id")==$val->id}selected=selected{/if}> {$val->name}</option>
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
                                            <label class="form-label span3" for="tags">Bài viết liên quan</label>
                                            <div class="span8">
                                                <input id="token-input" type="token-input" name="news_relations" style="width:100%;" />
                                                {literal}
                                                <script type="text/javascript">                        
                                                    $(document).ready(function() {
                                                        $("#token-input").tokenInput("{/literal}{$GUrl.Base}{literal}?act=Suggestion", {
                                                            theme : "facebook",
                                                            tokenDelimiter: ",",
                                                            preventDuplicates: true, 
                                                            prePopulate: {/literal}{$data.token_input}{literal}               
                                                        });        
                                                    });
                                                </script>   
                                                {/literal}                 
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <hr class="line" />
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">                                                
                                            <textarea class="mceEditor" id="mceEditor" name="content">{$data.content->get('content_text')}</textarea>
                                        </div>
                                    </div>  
                                </div>                                        
                                <input type="hidden" name="action" value="btveditnews" />
                                <input type="hidden" name="act" value="NewsAction" />
                                <input type="hidden" name="id" value="{$data.content->get('id')}" />                                                                    
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                         <div class="row-fluid">                                                                                            
                                            <button class="btn btn-info btn-large" id="ctv_send">Gửi bài</button>
                                            <button class="btn btn-danger btn-large" id="ctv_draft">Lưu tạm</button>
                                        </div>
                                    </div>  
                                </div>
                            </div><!--content-->
                        </div><!--box-->
                    </div><!--cot trai-->
                    <div class="span4"> 
                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 cut-icon-comment"></span>
                                    <span>Trạng thái</span>
                                </h4>                      
                                <a href="#" class="minimize">Thu nhỏ</a>              
                            </div>                                                    
                            <div class="content">                                                                  
                                <div class="form-row row-fluid">
                                    <div class="clearfix">                                            
                                        <div class="" id="status_news">                                                
                                        </div> 
                                    </div>                                        
                                </div>
                            </div><!--content-->                                
                        </div><!--box-->                             
                        <!-- ===================== Begin category Box ========================= -->
                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 cut-icon-comment"></span>
                                    <span>Chuyên mục</span>
                                </h4>                      
                                <a href="#" class="minimize">Thu nhỏ</a>
                            </div><!-- end .title -->
                            <div class="content" style="max-height:300px;overflow-y:scroll">                                     
                                {foreach from=$data.list_category key=key item=val}                                                                            
                                   
                                        <input type="checkbox" name="news_cat[]" {if in_array($val.id,$data.cat_selected)} checked="checked" {/if} value="{$val.id}"><strong style="color: blue;">{$val.title}</strong><br>
                                
                                    {foreach from=$val.child item=item}
                                      
                                            <input type="checkbox" name="news_cat[]" {if in_array($item.id,$data.cat_selected)} checked="checked" {/if} value="{$item.id}">|__{$item.title}</strong><br>
                                     
                                    {/foreach}                                
                                {/foreach} 
                            </div><!-- end .content -->
                        </div><!-- end .box -->
                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 brocco-icon-tag"></span>
                                    <span>Tag / Từ khóa</span>
                                </h4>  
                                <a href="#" class="minimize">Thu nhỏ</a>                                  
                            </div>                     
                            <div class="content">
                                <div class="form-row row-fluid">
                                    <div class="controls">
                                        {*<textarea class="text" name="news_tag" style="height:80px;">{$data.tags}</textarea>*}
                                        <input id="tag_main" type="token-input" name="news_tag" style="width:100%;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 brocco-icon-tag"></span>
                                    <span>Note</span>
                                </h4>  
                                <a href="#" class="minimize">Thu nhỏ</a>                                  
                            </div>                     
                            <div class="content">
                                <div class="form-row row-fluid">
                                    <div class="controls">
                                        <textarea class="text" name="news_note" style="height:80px;">{$data.content->get("note")}</textarea>
                                    </div>
                                </div>
                            </div><!--content-->
                        </div><!--box-->
                        <div class="" id="status_news"></div>
                    </div><!--cot phai-->                            
                </form>
            </div><!-- End .row-fluid -->
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->        
    </div><!-- End #wrapper -->    
{literal}
        <script type="text/javascript" {/literal}src="{$GUrl.Js}jquery_submit.js?1" {literal}> </script>
{/literal}
</body>
</html>
{literal}
<script type="text/javascript">
    $("#tag_main").tokenInput("/?act=SearchTag", {                   
        theme : "facebook",
        allowFreeTagging: true,
        tokenDelimiter: ",",
        preventDuplicates: true,
        prePopulate : {/literal}{$data.tags}{literal},
        tokenLimit : 10
    });
</script>   
{/literal}