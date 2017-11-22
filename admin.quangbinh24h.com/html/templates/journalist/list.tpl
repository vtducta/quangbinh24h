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
                <h3>Danh sách tác giả</h3>                    
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
                    <li class="active">Danh sách tác giả</li>
                </ul>
            </div><!-- End .heading-->
            <!-- Build page from here: -->
            <div class="row-fluid">
                {$template_helper->displayAlert()}  
                <div class="clearfix">
                    <div class="left" style="">
                        <a href="{$link_helper->link_admin('CreateJournalist')}" class="btn btn-info left margin10" style="z-index: 3;">Tạo tác giả</a>
                    </div>
                </div>
                <div class="box gradient">                                
                    <div class="title">
                        <h4>
                            <span>Danh sách tác giả</span>
                        </h4>
                    </div>
                    {if sizeof($data.list_journalist) > 0}
                    <div class="content noPad">
                        <table class="responsive table table-bordered" id="checkAll">
                            <thead>
                                <tr>
                                    <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                    <th>Tên đầy đủ</th>
                                    <th>Bút danh</th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Facebook</th>
                                    <th>GPlus</th>
                                    <th>Avatar</th>
                                    <th>Tiểu sử</th>
                                    <th>Đánh giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$data.list_journalist item=val key=k}
                                <tr>
                                    <td class="chChildren"><input type="checkbox" name="checkbox[]" value="{$val.id}" class="styled" /></td>
                                    <td class="alignleft"><span class="lastedit-pe"></span><strong>{$val.full_name}</strong>
                                        <div class="quk-edit">
                                            <a href="{$link_helper->link_edit("EditJournalist",$val.id)}">Sửa</a>
                                            {if $data.group_user eq 4}
                                            | <a href="{$link_helper->link_delete_journalist($val.id)}" onclick="return confirm('Bạn chắc chắn xóa?');">Xóa</a>
                                            {/if}
                                        </div>
                                    </td>
                                    <td>{$val.pen_name}</td>
                                    <td>{$val.email}</td>
                                    <td>{$val.birthday}</td>
                                    <td><a href="{$val.facebook_link}" target="_blank">{$val.facebook}</a></td>
                                    <td><a href="{$val.gplus_link}" target="_blank">{$val.gplus}</a></td>
                                    <td><img src="{$val.avatar}" style="max-height: 150px;max-width: 150px;"></td>
                                    <td>{$val.biography}</td>
                                    <td>{$val.rate}</td>
                                </tr> 
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                    {elseif sizeof($data.list_journalist) == 0}
                    Bạn chỉ được thao tác đối với những tài khoản bạn đã tạo.   
                    {/if}

                </div><!-- End .box -->
            </div><!-- End .row-fluid -->
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->

    </div><!-- End #wrapper -->
{include file='block/footer.tpl'}