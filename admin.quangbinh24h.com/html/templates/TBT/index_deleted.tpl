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
                    <div class="box gradient">                                
                                <div class="title">
                                    <h4>
                                        <span>Danh sách bài đã pubic</span>
                                    </h4>
                                </div>                
                                <div class="clearfix right margin10">                                    
                                </div>
                                    <div class="clearfix">                                      
                                    {include file='block/search.tpl'}
                                    <table class="responsive table table-bordered" id="checkAll">
                                        <thead>
                                          <tr>
                                            <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                            <th colspan="2">Tiêu đề</th>                                            
                                            <th>Chuyên mục</th>                                            
                                            <th>Người viết</th>
                                            <th>Edit bài</th>
                                            <th>Thể loại bài</th>                                            
                                            <th>Tags</th>
                                            <th>Thời gian</th>
                                          </tr>
                                        </thead>
                                        <tbody>   
                                        {foreach from=$data.list_news item=val key=key name=foo}
                                             <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >
                                                <td class="chChildren"><input type="checkbox" name="checkbox" value="{$val.id}" class="styled" /></td>
                                                <td width="85"><img style="width: 80px; height: 60px;" src="{$template_helper->get_thumb_image($val.images,80,60)}"/></td>
                                                <td class="alignleft"><span class="lastedit-pe"></span><strong>{$val.title}</strong>
                                                    <p class="listing-lead">{$val.intro_text}</p>
                                                      <div class="quk-edit">  
                                                        <a href="{$link_helper->link_deleted("restorenews",$val.id)}"><span style="color: red;">Khôi phục lại bài viết</span></a>                                                     
                                                    </div>
                                                </td>                                                
                                                <td>{$val.category}</td>                                                                                                
                                                <td><strong style="color: blue;">{$val.creat_by}</strong></td>
                                                <td><strong style="color: blue;">{$val.modified_by}</strong></td>
                                                 <td>{if $val.hotnews eq 1}Sản xuất hiện trường {elseif $val.hotnews eq 2}Sản Xuất {elseif $val.hotnews eq 3}Khai thác {elseif $val.hotnews eq 4}Tổng hợp {elseif $val.hotnews eq 5}Phóng sự - điều tra {else}Chưa rõ{/if}</td>
                                                <td>{$val.tags}</td>                                                
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
                                            <li><a href="{$link_helper->link_admin("AcpNewsDeleted",1)}"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                                            {foreach from=$data.paging.page item=val key=k} 
                                                <li {if $val eq $data.paging.current} class="active"{/if}>
                                                    <a href="{$link_helper->link_admin("AcpNewsDeleted",$val)}"><span>{$val}</span></a>
                                                </li>                                                    
                                            {/foreach}                                               
                                            <li><a href="{$link_helper->link_admin("AcpNewsDeleted",$data.paging.total)}"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
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