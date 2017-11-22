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
        <div class="centerContent">                                 
            <ul class="bigBtnIcon">                                
                <li>
                    <a href="{$link_helper->linkhome('BtvAdd')}">
                        <span class="icon brocco-icon-pencil"></span>
                        <span class="txt">Viết bài mới</span>                                       
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" title="Tổng số bài đã viết" class="pattern tipB">
                        <span class="icon brocco-icon-clock"></span>
                        <span class="txt">Số bài đã viết</span>  
                        <span class="notification blue">{$data.static.total}</span>             
                    </a>
                </li>
                <li>
                    <a href="{$link_helper->linkhome('BtvNewsPublic')}" title="Bài đã được đăng" class="pattern tipB">
                        <span class="icon brocco-icon-play"></span>
                        <span class="txt">Bài đã public</span>
                        <span class="notification green">{$data.static.total_public}</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" title="Bài Chờ duyệt" class="pattern tipB">
                        <span class="icon brocco-icon-alarm"></span>
                        <span class="txt">Bài chờ duyệt</span>
                        <span class="notification green">{$data.static.total_not_public}</span>
                    </a>
                </li>    
            </ul>
        </div>
        <div class="row-fluid">
            <div class="box gradient">                                
                <div class="title">
                    <h4>
                        <span>Danh sách bài chờ duyệt</span>
                    </h4>
                </div>                
                <div class="clearfix right margin10">                                    
                </div>
                <div class="content noPad">    
                    <div class="clearfix"> 
                        {if $data.list_news} 
                        <table class="responsive table table-bordered" id="checkAll">
                            <thead>
                                <tr>
                                    <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                    <th colspan="2">Tiêu đề</th>                                            
                                    <th>Chuyên mục</th>
                                    <th>Thể loại bài</th>
                                    <th>Người viết</th>
                                    <th>Kiểu tin</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>  
                                {foreach from=$data.list_news item=val key=key name=foo}
                                <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >
                                    <td class="chChildren"><input type="checkbox" name="checkbox" value="{$val.id}" class="styled" /></td>
                                    <td width="85"><a href="{$link_helper->link_edit("BtvEditNews",$val.id)}&action=newswait" class="list-post-thumb"><img src="{$template_helper->get_thumb_image($val.images,80,60)}"/></a></td>
                                    <td class="alignleft"><span class="lastedit-pe"></span><a href="{$link_helper->link_edit("BtvEditNews",$val.id)}&action=newswait"><strong>{$val.title}</strong></a>
                                        <p class="listing-lead">{$val.intro_text}</p>
                                        <div class="quk-edit">                                                          
                                            <a href="{$link_helper->link_edit("BtvEditNews",$val.id)}&action=newswait">Sửa</a>            
                                            |
                                            <a href="{$link_helper->link_deleted("publicnewsdraft",$val.id)}">Duyệt bài</a>                   
                                        </div>
                                    </td>                                                
                                    <td>{$val.category}</td>                                                                                    
                                    <td>{if $val.hotnews eq 1}Sản xuất hiện trường {elseif $val.hotnews eq 2}Sản Xuất {elseif $val.hotnews eq 3}Khai thác {elseif $val.hotnews eq 4}Tổng hợp {elseif $val.hotnews eq 5}Phóng sự - điều tra{elseif $val.hotnews eq 6}Bài dịch {else}Chưa rõ{/if}</td>
                                    <td>{$val.creat_by}</td>
                                    <td>{$val.content_type}</td>
                                    <td>
                                        <span>{$val.create_date_int|date_format:"%d-%m-%Y %H:%M:%S"}</span>
                                    </td>
                                </tr> 
                                {/foreach}                                      
                            </tbody>                                        
                        </table>
                        {else}
                        <center><h3>Chưa có bài viết nào được nhận !</h3></center>
                        {/if}
                    </div>                                 
                    <div class="margin10 clearfix">    
                        {if $data.paging.total >1}
                        <div class="pagination right">
                            <ul>
                                <li><a href="{$link_helper->link_admin("BtvHome",1)}"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                                {foreach from=$data.paging.page item=val key=k} 
                                <li {if $val eq $data.paging.current} class="active"{/if}>
                                <a href="{$link_helper->link_admin("BtvHome",$val)}"><span>{$val}</span></a>
                                </li>                                                    
                                {/foreach}                                               
                                <li><a href="{$link_helper->link_admin("BtvHome",$data.paging.total)}"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
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