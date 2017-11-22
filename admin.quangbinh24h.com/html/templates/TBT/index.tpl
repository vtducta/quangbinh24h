{include file='block/head.tpl'}
<!-- loading animation -->
<!--<div id="qLoverlay"></div>
<div id="qLbar"></div>  -->
{literal}
<script type="text/javascript">
    flag =0;
</script>
{/literal}
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
                <div class="box gradient">                                
                    <div class="title">
                        <h4>
                            <span>Danh sách bài đã pubic</span>
                        </h4>
                    </div>                 
                    {include file='TBT/filter.tpl'}                                                       
                    <div id="list_news">
                        <div class="clearfix">                                      
                            {include file='block/search.tpl'}                                    
                            <table class="responsive table table-bordered" id="checkAll">
                                <thead>
                                    <tr>
                                        <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                        <th colspan="2">Tiêu đề</th>                                            
                                        <th>Chuyên mục</th>
                                        <th>Người viết</th>
                                        <th>Set vị trí</th>
                                        <th>views</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    {foreach from=$data.list_news item=val key=key name=foo}
                                    <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >
                                        <td class="chChildren"><input type="checkbox" name="checkbox" value="{$val.id}" class="styled" /></td>
                                        <td width="85"><a href="{$link_helper->link_edit("AcpEditNews",$val.id)}" class="list-post-thumb"><img src="{$template_helper->get_thumb_image($val.images,80,60)}"/></a></td>
                                        <td class="alignleft"><span class="lastedit-pe"></span><a href="{$link_helper->link_edit("AcpEditNews",$val.id)}"><strong>{$val.title|stripslashes}</strong></a>
                                            <p class="listing-lead">{$val.intro_text}</p>
                                            <div class="quk-edit">  
                                                <a href="{$link_helper->xemnhanh($val.meta_slug,$val.id)}" target="_blank">Xem nhanh</a> 
                                                |
                                                <a href="{$link_helper->link_edit("AcpEditNews",$val.id)}">Sửa</a>
                                            </div>
                                        </td>                                                
                                        <td>{$val.category}</td>
                                        <td><strong style="color: blue;">{$val.creat_by}</strong></td>
                                        <td>
                                            <button onclick="load_popup_home({$val.id})" style="width: 100px; height: 30px; font-size: 13px; font-weight: bold;" class="btn btn-mini" type="button" href="#news_noibat" data-toggle="modal">Vị trí nổi bật</button>
                                        </td>
                                        <td>{$val.views}</td>
                                        <td>
                                            <span>{$val.create_date_int|date_format:"%d-%m-%Y %H:%M:%S"}</span>
                                        </td>
                                    </tr> 
                                    {/foreach}
                                </tbody>                                        
                            </table>                                    
                        </div>                                 
                        <div class="margin10 clearfix">    
                            {if $data.paging.total >1}
                            <div class="pagination right">
                                <ul>
                                    <li><a href="{$link_helper->link_admin("AcpHome",1)}"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                                    {foreach from=$data.paging.page item=val key=k} 
                                    <li {if $val eq $data.paging.current} class="active"{/if}>
                                    <a href="{$link_helper->link_admin("AcpHome",$val)}"><span>{$val}</span></a>
                                    </li>                                                    
                                    {/foreach}                                               
                                    <li><a href="{$link_helper->link_admin("AcpHome",$data.paging.total)}"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
                                </ul>
                            </div>                                        
                            {/if}                           
                        </div>
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

    function set_news_hot(feature_id,news_id,action){
    $.ajax({
    type: "POST",
    url: "/?act=BoxNews",
    data: {act : 'BoxNews' , news_id : news_id , feature_id : feature_id , action : action},
    success: function(data){
    $('#set_hot_news'+feature_id).fadeOut();
    $('#set_hot_news'+feature_id).html("");
    $('#set_hot_news'+feature_id).html(data);
    $('#set_hot_news'+feature_id).fadeIn();
    }
    });
    return;
    }
</script>
{/literal}

{literal}    
<script type="text/javascript">
    $(document).ready(function(){
    $('.content_type').change(function(){
    var value = $(this).attr('value');
    if(value!=0) {                        
    window.location='{/literal}{$link_helper->link_admin("AcpHome",$data.paging.current)}&content_type={literal}'+value;
    }
    });
    });
</script>       
{/literal}    
{include file='block/footer.tpl'}
