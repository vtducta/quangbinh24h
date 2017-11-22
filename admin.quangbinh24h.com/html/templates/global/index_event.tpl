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
                <div class="row-fluid">                                                
                    <a class="btn btn-success btn-large" href="{$link_helper->linkhome('AddEvent')}">Thêm sự kiện</a>
                </div>
                <hr class="line" />
                <div class="row-fluid">
                    <div class="box gradient">                                
                                <div class="title">
                                    <h4>
                                        <span>Danh sách Sự kiện</span>
                                    </h4>
                                </div>                
                                <div class="clearfix right margin10">                                    
                                </div>
                                    <div class="content noPad">                                     
                                    <div class="clearfix">
                                    <table class="responsive table table-bordered" id="checkAll">
                                        <thead>
                                          <tr>
                                            <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" /></th>
                                            <th>Tên sự kiện</th>                                            
                                            <th>Số bài viết</th>
                                          </tr>
                                        </thead>
                                        <tbody>   
                                        {foreach from=$data.list_event item=val key=key name=foo}
                                             <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >
                                                <td ><input type="checkbox" name="checkbox[]" value="{$val.id}"/></td>                                                
                                                <td class="alignleft"><span class="lastedit-pe"></span><strong>{$val.title}</strong>
                                                      <div class="quk-edit">  
                                                        <a href="http://danang24h.tinmoi.vn/ev{$val.id}/{$val.meta_slug}.html" target="_blank">Xem nhanh</a>                                               
                                                        |
                                                        <a href="{$link_helper->link_edit("EditEvent",$val.id)}">Sửa</a>                                               
                                                        |
                                                        <a href="{$link_helper->link_deleted("deletedEvent",$val.id)}">Xóa</a>                                                                    
                                                    </div>
                                                </td>
                                                <td>{$val.total}</td>
                                              </tr> 
                                        {/foreach}
                                        </tbody>                                        
                                    </table>
                                </div>
                            </div><!-- End .box -->
                </div><!-- End .row-fluid --> 
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    </div><!-- End #wrapper -->
{include file='block/footer.tpl'}