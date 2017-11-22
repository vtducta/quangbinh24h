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
            <div class="contentwrapper"><!--Con1tent wrapper-->
                <div class="heading">
                    <h3>Danh sách nguồn Bài Viết</h3>                    
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
                        <li class="active">Danh sách nguồn Bài Viết</li>
                    </ul>
                </div><!-- End .heading-->
                <!-- Build page from here: -->
                <div class="row-fluid">
                {$template_helper->displayAlert()}
                    <div class="box gradient">                                
                                <div class="title">
                                    <h4>
                                        <span>Danh sách nguồn Bài Viết</span>
                                    </h4>
                                </div> 
                                <div class="margin10 clearfix">
                                    <form id="search_form" method="get" action="">
                                        <div class="left margin10" >                                        
                                            <label>Tìm kiếm theo tên : </label>
                                            <input type="text" class="text" aria-controls="   checkAll" name="name" id="name" value="{if isset($data.search_data.name)}{stripslashes($data.search_data.name)}{/if}">
                                            <input type="hidden" value="1" name="page" id="page">
                                            <input type="hidden" value="Source" name="act">
                                            <input type="hidden" value="manage" name="action">
                                        </div>
                                        <div class="left margin10"  style="width:200px;overflow:hidden">
                                            <label>Chọn trạng thái</label>
                                            <select name="status" style="width:200px">
                                                <option value="1" {if !isset($data.search_data.status) || $data.search_data.status==1}selected="selected"{/if}>kích hoạt</option> 
                                                <option value="2" {if isset($data.search_data.status) && $data.search_data.status==2}selected="selected"{/if}>đã xóa</option> 
                                            </select>
                                        </div>                                            
                                        <div class="left margin10">
                                            <label>&nbsp; &nbsp;</label>
                                            <button onclick="paging(1)" class="btn btn-info" style="">Tìm nguồn Bài Viết</button>
                                        </div>
                                    </form>
                                </div>                                                                   
                                    <div class="content noPad">
                                    <table class="responsive table table-bordered" id="checkAll">
                                        <thead>
                                          <tr>
                                            <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                            <th>Tên nguồn Bài Viết</th>                                            
                                            <th>Miêu tả</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        {foreach from=$data.list_source item=val key=k}
                                          <tr>
                                            <td class="chChildren"><input type="checkbox" name="checkbox[]" value="{$val->id}" class="styled" /></td>
                                            <td class="alignleft">
                                                <span class="lastedit-pe"></span><strong style="color: blue;">{$val->name}</strong>
                                                <div class="quk-edit">
                                                    <a href="{$link_helper->link_source("edit",$val->id)}">Sửa</a>
                                                    | 
                                                    <a  href="{$link_helper->link_source("delete",$val->id)}">Xóa</a
                                                </div>
                                            </td>
                                            <td>{$val->description}</td>
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
