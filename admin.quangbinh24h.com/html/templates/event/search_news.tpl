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
                </div><!-- End .row-fluid -->         
                <div class="row-fluid">
                    <div class="box gradient">                                
                                <div class="title">
                                    <h4>
                                        <span>Thêm bài viết vào sự kiện : {$data.event->get("title")}</span>
                                    </h4>
                                </div>
                                <div class="clearfix right margin10">                                    
                                </div>
                                    <div class="content noPad">                                    
                                    <div class="clearfix">                                                                          
                                   <form action="" method="get" id="search_video">
                                        <div class="left margin10">                                        
                                            <label>Tìm kiếm : <input id="keyword" name="keyword" type="text" aria-controls="checkAll" class="text" value="{$data.keyword}"></label>
                                        </div>     
                                        <input type="hidden" name="act" value="EventSearchNews"> 
                                        <input type="hidden" name="event_id" value="{$data.event->get("id")}"> 
                                        <input type="hidden" id="page" name="page" value="{if isset($data.paging.current)}{$data.paging.current}{else}1{/if}">                              
                                        <div class="left margin10">
                                            <button  type="button" class="btn btn-info" onclick="$('#search_video').submit()">Tìm bài viết</button>
                                        </div>
                                        
                                    </form>                                    
                                    {if $data.list_news}                                    
                                    <table class="responsive table table-bordered" id="checkAll">
                                        <thead>
                                          <tr>
                                            <th id="masterCh" class="ch">Id</th>
                                            <th colspan="2">Tiêu đề</th>                                            
                                            <th>Chuyên mục</th>
                                            <th>Người viết</th>                                            
                                            <th>Thời gian</th>
                                          </tr>
                                        </thead>
                                        <tbody> 
                                          {foreach from=$data.list_news item=val key=key name=foo}
                                             <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} id="art_{$val.id}">
                                                <td class="chChildren">{$val.id}</td>
                                                <td width="85"><img src="{$template_helper->get_thumb_image($val.images,80,60)}"/></td>   
                                                <td style="text-align:left"><strong>{$val.title}</strong><div class="quk-edit">  
                                                    <a href="{$link_helper->xemnhanh($val.meta_slug,$val.id)}" target="_blank">Xem nhanh</a>
                                                   
                                                     | <a href="javascript: insert_event({$val.id});">Thêm vào sự kiện</a>                                          
                                          
                                            </div></td>                                          
                                                <td>{$val.category}</td>                                                
                                                <td>{$val.creat_by}</td>
                                                <td>
                                                <span>{$val.create_date_int|date_format:"%d-%m-%Y %H:%M:%S"}</span>
                                                </td>
                                              </tr> 
                                        {/foreach}
                                        </tbody>
                                    </table>
                                {else}
                                    <div class="span12 clearfix">
                                        <h3 style="display:block">KHông có kết quả  tìm kiếm nào!</h3>
                                    </div>
                                {/if}
                                </div>
                                 <div class="margin10 clearfix">                               
                                  {if $data.paging.total >1}
                                        <div class="pagination right">
                                              <ul>
                                                <li><a href="javascript:paging(1);"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                                                {foreach from=$data.paging.page item=val key=k} 
                                                    <li {if $val eq $data.paging.current} class="active"{/if}>
                                                        <a href="javascript:paging({$val});"><span>{$val}</span></a>
                                                    </li>                                                    
                                                {/foreach}                                               
                                                <li><a href="javascript:paging({$data.paging.total});"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
                                              </ul>
                                        </div>                                        
                                    {/if} 
                                </div>
                            </div><!-- End .box -->
                </div><!-- End .row-fluid --> 
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
</div><!-- End #wrapper -->
{literal}
<script>
    function paging(page){
        $("#page").val(page);
        $("#search_video").submit();       
    }
    
    function insert_event(art_id){
   // alert(art_id);
        $.ajax({
            url : "/",
            type : "POST",
            data : {act : 'EventAction',action : 'addNews',art_id : art_id,event_id : {/literal}{$data.event->get("id")}{literal}},
            success : function(html){     
                if(html==1){    
                    $("#art_"+art_id).remove();
                    alert("Đã thêm tin vào sự kiện");   
                    
                }
            }
        });
    }
</script>
{/literal}
{include file='block/footer.tpl'}
