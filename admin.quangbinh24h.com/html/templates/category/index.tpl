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
            <a class="btn btn-success btn-large" href="{$link_helper->linkhome('CategoryAdd')}">Thêm Chuyên mục</a>
        </div>
        <hr class="line" />
        <div class="row-fluid">
            <div class="box gradient">                                
                <div class="title">
                    <h4>
                        <span>Danh sách Chuyên mục</span>
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
                                    <th>Tên chuyên mục</th>                                            
                                    <th>description</th>                                            
                                    <th>meta_slug</th>                                            
                                    <th>meta_title</th>                                            
                                    <th>meta_keyword</th>                                            
                                    <th>meta_description</th>                                            
                                </tr>
                            </thead>
                            <tbody>   
                                {foreach from=$data.list_category item=val key=key name=foo}
                                <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >
                                    <td ><strong style="color: blue;">{$val.id}</strong></td>                                                
                                    <td class="alignleft"><span class="lastedit-pe"></span><strong style="color: blue;">{$val.title}</strong>
                                        <div class="quk-edit">  
                                            <a href="http://danang24h.tinmoi.vn/c/{$val.meta_slug}" target="_blank">Xem nhanh</a>                                               
                                            |
                                            <a href="{$link->link_edit("CategoryEdit",$val.id)}">Sửa</a>                                                                                                       
                                        </div>
                                    </td> 
                                    <td>{$val.description}</td>
                                    <td>{$val.meta_slug}</td>
                                    <td>{$val.meta_title}</td>
                                    <td>{$val.meta_keyword}</td>
                                    <td>{$val.meta_description}</td>
                                </tr>
                                {foreach from=$val.child item=item}
                                <tr>
                                    <td ><strong style="color: blue;">{$item.id}</strong></td>
                                    <td class="alignleft"><span class="lastedit-pe"></span><strong>___{$item.title}</strong>
                                        <div class="quk-edit">  
                                            <a href="http://danang24h.tinmoi.vn/c/{$item.meta_slug}" target="_blank">Xem nhanh</a>                                               
                                            |
                                            <a href="{$link->link_edit("CategoryEdit",$item.id)}">Sửa</a>                                                                                                       
                                        </div>
                                    </td>
                                    <td>{$item.description}</td>
                                    <td>{$item.meta_slug}</td>
                                    <td>{$item.meta_title}</td>
                                    <td>{$item.meta_keyword}</td>
                                    <td>{$item.meta_description}</td>
                                </tr>
                                {/foreach}
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