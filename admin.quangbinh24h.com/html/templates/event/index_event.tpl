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
                </div><!-- End .row-fluid -->         
                {*        
                <div class="row-fluid">                                                
                    <a class="btn btn-success btn-large" href="{$link_helper->linkhome('AddEvent')}">Thêm sự kiện</a>
                </div>
                <hr class="line" />      *}
                <div class="row-fluid">
                    <div class="box gradient">                                
                                <div class="title">
                                    <h4>
                                        <span>Danh sách Sự kiện</span>
                                    </h4>
                                </div>      
                                <div class="margin10 clearfix">
                                    <form id="search_form" method="get" action="">
                                        <div class="left margin10" >                                        
                                            <label>Tìm kiếm theo tên : </label>
                                            <input type="text" class="text" aria-controls="   checkAll" name="name" id="name" value="{if isset($data.search_data.name)}{stripslashes($data.search_data.name)}{/if}">
                                            <input type="hidden" value="1" name="page" id="page">
                                            <input type="hidden" value="ListEvent" name="act">
                                        </div>
                                        <div class="left margin10"  style="width:200px;overflow:hidden">
                                            <label>Chuyên mục</label>
                                            <select name="category_id">
                                                <option value="0">Tất cả</option>
                                                {foreach from=$data.list_category item=item}
                                                    <option value="{$item.id}" {if isset($data.search_data.category_id) && $data.search_data.category_id==$item.id}selected="selected"{/if}>{$item.title}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                        <div class="left margin10"  style="width:200px;overflow:hidden">
                                            <label>Trạng thái</label>
                                            <select name="status" style="width:200px">
                                                <option value="1" {if !isset($data.search_data.status) || $data.search_data.status==1}selected="selected"{/if}>Xuất bản</option> 
                                                <option value="2" {if isset($data.search_data.status) && $data.search_data.status==2}selected="selected"{/if}>Chờ duyệt</option> 
                                                <option value="3" {if isset($data.search_data.status) && $data.search_data.status==3}selected="selected"{/if}>Đã xóa</option> 
                                            </select>
                                        </div>                                            
                                        <div class="left margin10">
                                            <label>&nbsp; &nbsp;</label>
                                            <button onclick="paging(1)" class="btn btn-info" style="">Tìm sự kiện</button>
                                        </div>
                                    </form>
                                </div>                    
                              
                                    <div class="content noPad">                                     
                                    <div class="clearfix">
                                    <table class="responsive table table-bordered" id="checkAll">
                                        <thead>
                                          <tr>
                                            <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" /></th>
                                            <th>ID</th>
                                            <th>Tên sự kiện</th>                                            
                                            <th>Miêu tả</th>
                                            <th>Chuyên mục</th>                                            
                                            <th>Số bài viết</th>
                                          
                                          </tr>
                                        </thead>
                                        <tbody>   
                                        {foreach from=$data.list_event item=val key=key name=foo}
                                             <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >
                                                <td ><input type="checkbox" name="checkbox[]" value="{$val.id}"/></td>   
                                                <td >{$val.id}</td>                                             
                                                <td class="alignleft " style="width:40%"><span class="lastedit-pe"></span><strong>{$val.title}</strong>
                                                      <div class="quk-edit">  
                                                        <a href="http://danang24h.tinmoi.vn/ev{$val.id}/{$val.meta_slug}.html" target="_blank">Xem nhanh</a>                                               
                                                        |
                                                        <a href="{$link_helper->link_edit("EditEvent",$val.id)}">Sửa</a>                                               
                                                        |
                                                        <a href="{$link_helper->link_deleted("deletedEvent",$val.id)}">Xóa</a> 
                                                        |
                                                        <a href="{$link_helper->linkhome('')}?act=EventSearchNews&event_id={$val.id}">Thêm bài viết vào sự kiện</a>                                                                   
                                                    </div>
                                                </td>
                                            
                                                <td>{$val.description}</td>
                                                <td style="width:10%">{$val.category}</td>
                                                <td>{$val.total}</td>
                                               
                                              </tr> 
                                        {/foreach}
                                        </tbody>                                        
                                    </table>
                                </div>
                                <div class="margin10 clearfix">    
                                    <div class="pagination left">
                                        total : {$data.paging.total}
                                    </div>
                                  {if $data.paging.total_page >1}
                                    <div class="pagination right">
                                          <ul>
                                            <li><a href="javascript:paging(1);"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                                            {foreach from=$data.paging.page item=val key=k} 
                                                <li {if $val eq $data.paging.current_page} class="active"{/if}>
                                                    <a href="javascript:paging({$val});"><span>{$val}</span></a>
                                                </li>                                                    
                                            {/foreach}                                               
                                            <li><a href="javascript:paging({$data.paging.total_page});"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
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
        $("#search_form").submit();       
    }
</script>
{/literal}
{include file='block/footer.tpl'}