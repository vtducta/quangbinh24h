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
                <h3>Viết bài mới</h3>   
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
                                                {*<p><span id="counter_id_title"></span> ký tự còn lại</p>*}
                                                <input class="" id="id_title"  type="text" name="title" value="" />
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
                                                        <input id="meta_title" type="text" name="meta_title" value=""/>                                                           
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
                                                        <input type="text" name="slug_name" value="" />                                                           
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
                                                        <textarea class="text" style="height:60px; width:100%" name="meta_keyword"></textarea>                                                           
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
                                                        <textarea id="meta_description" class="text" name="meta_description" style="height:60px; width:100%"></textarea>                                                           
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
                                                <textarea id="short_desc" name="short_desc" ></textarea>                                                    
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
                                <div id="display-file"></div>
                                <input type="hidden" id="flagthumb" name="id_thumb" value="0">
                                
                                <hr class="line" />
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="journalists">Nguồn bài viết</label>
                                            <div class="span8">                                              
                                                <select name="source_id" style="width:250px">
                                                    <option value="0"> Chọn nguồn bài viết</option>
                                                    {foreach from=$data.list_source key=key item=val}    
                                                        <option value="{$val->id}"> {$val->name}</option>  
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
                                            <label class="form-label span3" for="journalists">Tác giả</label>
                                            <div class="span8">
                                                <input id="journalist-input" type="token-input" name="news_journalist" style="width:100%;"/>
                                                <div class="box">
                                                    <div class="form-row row-fluid">
                                                        <div class="">   
                                                            <select class="nostyle" multiple="multiple"  size="10" id="id-tac-gia">
                                                                <option value="0">Nhập tác giả</option>
                                                                {foreach from=$data.list_journalist key=key item=val}    
                                                                <option value="{$val.id}" onclick="addJournalist('{$val.id}','{$val.full_name}({$val.pen_name})')"> {$val.full_name}({$val.pen_name})</option>
                                                                {/foreach}      
                                                            </select>     
                                                        </div> 
                                                    </div>
                                                </div><!-- end .box -->                      
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <hr class="line" />
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="journalists">Người viết</label>
                                            <div class="span8">                                              
                                                <select name="writter" style="width:250px">
                                                    <option value="0"> Chọn tên người viết</option> 
                                                <!-- {var_dump($data.user_id_login)}-->
                                                    {foreach from=$data.list_user_ key=key item=val}    
                                                        <option value="{$val->user_id}" {if $data.user_id_login==$val->user_id}selected="selected"{/if}> {$val->fullname} - {$val->username}</option>  
                                                    {/foreach}      
                                                </select> 
                                                <br>   
                                                <i>Trong trường hợp viết bài hộ người khác, hãy chọn tên người cần viết hộ</i>                                                         
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
                                            <textarea class="mceEditor" id="mceEditor" name="content"></textarea>
                                        </div>
                                    </div>  
                                </div>                                        
                                <input type="hidden" name="action" value="addnews" />
                                <input type="hidden" name="act" value="NewsAction" />                                                    
                                <input type="hidden" name="status" value="3">
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid"> 
                                            <button class="btn btn-info btn-large" id="xuatban" onclick="check24h()">Xuất bản</button>
                                              {literal}
                                             <script type="text/javascript">  
                                             function check24h()
                                              {
                                                var value=document.getElementById('id-tac-gia').value;
                                                 if(value==null)
                                                  {
                                                  alert("Vui Lòng Cập Nhật Tác Giá !!^-^");
                                                  }
                                                }
                                              </script>
                                                {/literal}
                                            <button class="btn btn-danger btn-large" id="draft">Lưu tạm</button>
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
                                    <label class="form-label span6" for="checkboxes">Hẹn giờ</label>
                                    <div class="well">
                                        <div id="datetimepicker1" class="input-append date">
                                            <input data-format="dd-MM-yyyy hh:mm:ss" name="timer" value=""  type="text" readonly="readonly"></input>
                                            <span class="add-on">
                                                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function() {
                                            $('#datetimepicker1').datetimepicker({
                                                language: 'pt-BR'
                                            });
                                        });
                                    </script>
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
                                    <input type="checkbox" name="news_cat[]" value="{$val.id}"><strong style="color: blue;">{$val.title}</strong><br>
                                    {foreach from=$val.child item=item}
                                    <input type="checkbox" name="news_cat[]" value="{$item.id}">|__{$item.title}</strong><br>
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
                                        {*<textarea class="text" name="news_tag"  style="height:80px;"></textarea>*}
                                        <input id="tag_main" type="token-input" name="news_tag" style="width:100%;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ===================== Begin event Box ========================= -->
                         <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 cut-icon-comment"></span>
                                    <span>Chọn sự kiện</span>
                                </h4>                      
                                <a href="#" class="minimize">Thu nhỏ</a>
                            </div><!-- end .title -->
                            <div class="content">                                     
                                <div class="form-row row-fluid">
                                    <input id="token-input-event" type="token-input" name="news_events" style="width:100%;" />                                                          
                                    {literal}
                                    <script type="text/javascript">                        
                                        $(document).ready(function() {
                                            $("#token-input-event").tokenInput("{/literal}{$GUrl.Base}{literal}?act=EventSuggest", {                   
                                                theme : "facebook",
                                                tokenDelimiter: ",",
                                                preventDuplicates: true,                
                                            });        
                                        });
                                    </script>   
                                    {/literal}        
                                </div>
                            </div><!-- end .content -->
                        </div><!-- end .box -->      
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
                                        <textarea class="text" name="news_note" style="height:80px;"></textarea>
                                    </div>
                                </div>
                            </div><!--content-->
                        </div><!--box-->
                    </div><!--cot phai-->                            
                </form>
            </div><!-- End .row-fluid -->
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->        
    </div><!-- End #wrapper --> 
    {literal}
    <script type="text/javascript" {/literal}src="{$GUrl.Js}autosavedraft.js"{literal}></script> 
    {/literal}
    {literal}
        <script type="text/javascript" {/literal}src="{$GUrl.Js}jquery_submit.js?12" {literal}> </script>
        <script type="text/javascript">                        
            $(document).ready(function() {

            $("#journalist-input").tokenInput("{/literal}{$GUrl.Base}{literal}?act=SearchJournalist", {                   
            theme : "facebook",
            tokenDelimiter: ",",
            preventDuplicates: true,            
            prePopulate : {/literal}{$data.news_journalist}{literal},            
            tokenLimit : 1
            });        
            });

            function addJournalist(id, pen_name) 
            {
            $('#journalist-input').tokenInput("add", {id : id, name: pen_name});
            }
           
        </script>
    {/literal}
{include file='block/footer.tpl'}
{literal}
<script type="text/javascript">                        
    $(document).ready(function() {
        $("#tag_main").tokenInput("/?act=SearchTag", {
            theme : "facebook",
            allowFreeTagging: true,
            tokenDelimiter: ",",
            preventDuplicates: true,
            tokenLimit : 10
        });
    });
</script>   
{/literal}