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
                {*include file='reporter/global.tpl'*}
                <div class="row-fluid">
                    <div class="box gradient">                                
                                <div class="title">
                                    <h4>
                                        <span>Danh sách bài đã public và được hẹn giờ !</span>
                                    </h4>
                                </div>                
                                <div class="clearfix right margin10">                                    
                                </div>
                                    <div class="content noPad">    
                                    <div class="clearfix"> 
                                    <table class="responsive table table-bordered" id="checkAll">
                                        <thead>
                                          <tr>
                                            <th colspan="2">Tiêu đề</th>                                            
                                            <th>Chuyên mục</th>
                                            <th>Người viết</th>
                                            <th>Người duyệt</th>
                                           
                                            <th>Thời gian</th>
                                            <th>Thời gian xuất bản</th>
                                          </tr>
                                        </thead>
                                        <tbody>   
                                        {foreach from=$data.list_news item=val key=key name=foo}
                                             <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >
                                                <td width="85"><a href="#" class="list-post-thumb"><img src="{$template_helper->get_thumb_image($val.images,80,60)}"/></a></td>
                                                <td class="alignleft"><span class="lastedit-pe"></span><a href="#"><strong>{$val.title}</strong></a>
                                                    <p class="listing-lead">{$val.intro_text}</p>                                                      
                                                </td>                                                
                                                <td>{$val.category}</td>                                                
                                                <td><strong style="color: blue;">{$val.creat_by}</strong></td>
                                                <td><strong style="color: blue;">{$val.modified_by}</strong></td>
                                                
                                                <td>
                                                <span>{$val.create_date_int|date_format:"%d-%m-%Y %H:%M:%S"}</span>
                                                </td>
                                                <td>
                                                    <strong><span>{$val.timer|date_format:"%d-%m-%Y %H:%M:%S"}</span></strong>
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
                                            <li><a href="{$link_helper->link_admin("NewsTimer",1)}"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                                            {foreach from=$data.paging.page item=val key=k} 
                                                <li {if $val eq $data.paging.current} class="active"{/if}>
                                                    <a href="{$link_helper->link_admin("NewsTimer",$val)}"><span>{$val}</span></a>
                                                </li>                                                    
                                            {/foreach}                                               
                                            <li><a href="{$link_helper->link_admin("NewsTimer",$data.paging.total)}"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
                                          </ul>
                                    </div>                                        
                                    {/if}                           
                                </div>
                            </div><!-- End .box -->
                </div><!-- End .row-fluid --> 
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    </div><!-- End #wrapper -->
{include file='block/footer.tpl'}