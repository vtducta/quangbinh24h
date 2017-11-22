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
    <h3>Bảng điều khiển</h3> 
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
<div class="row-fluid">
    {$template_helper->displayAlert()}
    <div>
        <div id ="count_news">
        </div>                
    </div><!-- End .span8 -->                    
</div><!-- End .row-fluid --> 
<div class="row-fluid">         
         <div class="row-fluid"> 
        <form action="/" method="get" id="filter_form">
            <div class="left margin10">           
                <select name="select_cat" id="select_cat">
                    <option id="0" value="0" >Lọc theo chuyên mục</option>
                    {foreach from=$data.list_category item=val key=k}
                    {if $val.status eq 1}
                    <option id="{$val.id}" value="{$val.id}" {if $val.id==$data.cat_id}selected="selected"{/if}>{$val.title}</option>
                    {/if}
                    {foreach from=$val.child item=v key=k}
                    {if $val.status eq 1}
                    <option id="{$v->get('id')}" value="{$v->get('id')}" {if $v->get('id')==$data.cat_id}selected="selected"{/if}>|__{$v->get('title')}</option>
                    {/if}
                    {/foreach}
                    {/foreach}                
                </select>
                <input type="hidden" name="act" value="AcpNotPublic">
                 <input type="hidden" name="page" value="{$data.paging.current}" id="paging">
                <button  type="button" class="btn btn-info" onclick="$('#paging').val(1);$('#filter_form').submit();">Lọc</button>
            </div>                                            
            <!--<div class="left margin10">
                <button  type="button" class="btn btn-info" onclick="timkiem()">Tìm bài viết</button>
            </div>   -->
        </form>                                 
        </div>              
    <div class="box gradient">                                
        <div class="title">
            <h4>
                <span>Danh sách bài chờ duyệt</span>
            </h4>
        </div>                                                
       
        <div style="margin-bottom: 20px;">
            <ul id="myTab" class="nav nav-tabs pattern">
                <li class="active"><a href="#home" data-toggle="tab">Bài chờ duyệt từ Biên tập viên</a></li>
                <li><a href="#profile" data-toggle="tab">Bài chờ duyệt từ Reporter</a></li>                                    
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="home">                                    
                    <table class="responsive table table-bordered" id="checkAll">
                        <thead>
                            <tr>                                         
                                <th colspan="2">Tiêu đề</th>                                            
                                <th>Chuyên mục</th>
                                <th>Người viết</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>   
                            {foreach from=$data.list_news item=val key=key name=foo}
                            {if $val.status eq 3}
                            <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >                                                
                                <td width="85"><a href="{$link_helper->link_edit("AcpEditNews",$val.id)}&action=newswait" class="list-post-thumb"><img src="{$template_helper->get_thumb_image($val.image_url,80,60)}"/></a></td>
                                <td class="alignleft"><span class="lastedit-pe"></span><a href="{$link_helper->link_edit("AcpEditNews",$val.id)}&action=newswait"><strong>{$val.title}</strong></a>
                                    <p class="listing-lead">{$val.intro_text}</p>
                                    <div class="quk-edit">                                                          
                                        <a href="{$link_helper->link_edit("AcpEditNews",$val.id)}&action=newswait">Sửa</a>|<a href="{$link_helper->link_deleted("publicnews",$val.id)}">public</a>
                                    </div>
                                </td>                                                
                                <td>{$val.category}</td>                                                
                                <td><strong style="color: blue;">{$val.creat_by}</strong></td>
                                <td>
                                    <span>{$val.create_date_int|date_format:"%d-%m-%Y %H:%M:%S"}</span>
                                </td>
                            </tr> 
                            {/if}
                            {/foreach}
                        </tbody>                                        
                    </table>                                    
                </div>
                <div class="tab-pane fade" id="profile">
                    <table class="responsive table table-bordered" id="checkAll">
                        <thead>
                            <tr>                                         
                                <th colspan="2">Tiêu đề</th>                                            
                                <th>Chuyên mục</th>
                                <th>Người viết</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>   
                            {foreach from=$data.list_news item=val key=key name=foo}
                            {if $val.status eq 2}
                            <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >                                                
                                <td width="85"><a href="{$link_helper->link_edit("AcpEditNews",$val.id)}&action=newswait" class="list-post-thumb"><img src="{$template_helper->get_thumb_image($val.image_url,80,60)}"/></a></td>
                                <td class="alignleft"><span class="lastedit-pe"></span><a href="{$link_helper->link_edit("AcpEditNews",$val.id)}&action=newswait"><strong>{$val.title}</strong></a>
                                    <p class="listing-lead">{$val.intro_text}</p>
                                    <div class="quk-edit">                                                          
                                        <a href="{$link_helper->link_edit("AcpEditNews",$val.id)}&action=newswait">Sửa</a>            
                                        |
                                        <a href="{$link_helper->link_deleted("publicnews",$val.id)}">public</a>
                                    </div>
                                </td>                                                
                                <td>{$val.category}</td>                                                
                                <td><strong style="color: blue;">{$val.creat_by}</strong></td>
                                <td>
                                    <span>{$val.create_date_int|date_format:"%d-%m-%Y %H:%M:%S"}</span>
                                </td>
                            </tr> 
                            {/if}
                            {/foreach}
                        </tbody>                                        
                    </table>  
                </div>                                  
                    <div class="margin10 clearfix">    
                        {if $data.paging.total >1}
                        <div class="pagination right">
                            <ul>
                                <li><a href="javascript:$('#paging').val(1);$('#filter_form').submit();"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                                {foreach from=$data.paging.page item=val key=k} 
                                <li {if $val eq $data.paging.current} class="active"{/if}>
                                <a href="javascript:$('#paging').val({$val});$('#filter_form').submit();"><span>{$val}</span></a>
                                </li>                                                    
                                {/foreach}                                               
                                <li><a href="javascript:$('#paging').val({$data.paging.total});$('#filter_form').submit();"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
                            </ul>
                        </div>                                        
                        {/if}                          
                    </div>
                </div><!-- End .box -->
            </div><!-- End .row-fluid --> 
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->
    </div><!-- End #wrapper -->
    <!--popup-->
    <div class="modal fade hide" id="news_noibat">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
            <h3>Vị trí nổi bật tin</h3>
        </div>

        <div class="modal-body" id="tinNoiBat">
        Xin chờ
        </div>

        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
        </div>
    </div>
    {literal}
    <script type="text/javascript">
        function load_popup_home(news_id){
            $.ajax({
                type: "POST",
                url: "/?act=BoxNews",
                data: {act : 'BoxNews' ,action : 'show_popup', news_id : news_id},
                success: function(data){
                    $('#tinNoiBat').html(data);
                }
            });
            return;
        }
        
        function set_news_hot(feature_id,news_id){
            $.ajax({
                type: "POST",
                url: "/?act=BoxNews",
                data: {act : 'BoxNews' , news_id : news_id , feature_id : feature_id , action : "set_pos"},
                success: function(data){
                    $('#set_hot_news'+feature_id).fadeOut();
                    $('#set_hot_news'+feature_id).html("done");
                  //  $('#set_hot_news'+feature_id).html(data);
                    $('#set_hot_news'+feature_id).fadeIn();
                }
            });
            return;
        }
    </script>
    {/literal}
{include file='block/footer.tpl'}