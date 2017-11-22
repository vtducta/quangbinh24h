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
                            <a href="{$GUrl.Base}" class="tip" title="Trở lại bảng điều khiển">
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
                    <div>
                        <div id ="count_news">
                        </div>                                        
                    </div><!-- End .span8 -->                    
                </div><!-- End .row-fluid --> 
                               <div class="row-fluid">
                    <div class="box gradient">                                
                                <div class="title">
                                    <h4>
                                        <span>Danh sách bài Tìm kiếm</span>
                                    </h4>
                                </div>
                                <div class="clearfix right margin10">                                    
                                </div>
                                    <div class="content noPad">                                    
                                    <div class="clearfix">                                                                          
                                    {include file='block/search.tpl'}
                                    {if $data.list_news}                                    
                                    <table class="responsive table table-bordered" id="checkAll">
                                        <thead>
                                          <tr>
                                            <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                            <th colspan="2">Tiêu đề</th>                                            
                                            <th>Chuyên mục</th>
                                            <th>Tags</th>
                                            <th>Người viết</th>                                            
                                            <th>Thời gian</th>
                                          </tr>
                                        </thead>
                                        <tbody> 
                                          {foreach from=$data.list_news item=val key=key name=foo}
                                             <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >
                                                <td class="chChildren"><input type="checkbox" name="checkbox" value="{$val.id}" class="styled" /></td>
                                                <td width="85"><a href="{$link_helper->link_edit("AcpEditNews",$val.id)}" class="list-post-thumb"><img src="{$template_helper->get_thumb_image($val.images,80,60)}"/></a></td>
                                                <td class="alignleft"><span class="lastedit-pe"></span><a href="{$link_helper->link_edit("AcpEditNews",$val.id)}"><strong>{$val.title}</strong></a>
                                                    <p class="listing-lead">{$val.intro_text}</p>
                                                      <div class="quk-edit">  
                                                        <a href="{$link_helper->xemnhanh($val.meta_slug,$val.id)}" target="_blank">Xem nhanh</a>                                               
                                                        |
                                                       
                                                        {if $data.group_user_id==4 || $data.group_user_id==5}
                                                            <a href="{$link_helper->link_edit("AcpEditNews",$val.id)}">Sửa</a>
                                                        {/if}
                                                        
                                                        {if $data.group_user_id==1}
                                                            <a href="{$link_helper->link_edit("AdminEditNews",$val.id)}">Sửa</a>
                                                        {/if}
                                                        
                                                        {if $data.group_user_id==3}
                                                            <a href="{$link_helper->link_edit("ReporterEdit",$val.id)}">Sửa</a>
                                                        {/if}
                                                        
                                                        {if $data.group_user_id==2}
                                                            <a href="{$link_helper->link_edit("BtvEditNews",$val.id)}">Sửa</a>
                                                        {/if}
                                                            
                                                        {if $data.group_user_id!=5}        
                                                        |
                                                        <a href="{$link_helper->link_deleted("hiddennews",$val.id)}">Ẩn</a>  
                                                        {/if}                 
                                                    </div>
                                                </td>                                                
                                                <td>{$val.category}</td>                                                
                                                <td>{$val.creat_by}</td>
                                                <td>{$val.tags}</td>
                                                <td>
                                                <span>{$val.create_date_int|date_format:"%d-%m-%Y %H:%M:%S"}</span>
                                                </td>
                                              </tr> 
                                        {/foreach}
                                        </tbody>
                                    </table>
                                {else}
                                    <h3>KHông có kết quả  tìm kiếm nào!</h3>
                                {/if}
                                </div>
                                <div class="margin10 clearfix">                               
                                  {if $data.paging.total >1}
                                        <div class="pagination right">
                                              <ul>
                                                <li><a href="{$template_helper->link_backend_search($data.keyword,1)}"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                                                {foreach from=$data.paging.page item=val key=k} 
                                                    <li {if $val eq $data.paging.current} class="active"{/if}>
                                                        <a href="{$template_helper->link_backend_search($data.keyword,$val)}"><span>{$val}</span></a>
                                                    </li>                                                    
                                                {/foreach}                                               
                                                <li><a href="{$template_helper->link_backend_search($data.keyword,$data.paging.total)}"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
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
