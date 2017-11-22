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
                    <h3>Danh sách thành viên</h3>                    
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
                        <li class="active">Danh sách thành viên</li>
                    </ul>
                </div><!-- End .heading-->
                <!-- Build page from here: -->
                <div class="row-fluid">
                {$template_helper->displayAlert()}
                    <div class="box gradient">                                
                                <div class="title">
                                    <h4>
                                        <span>Danh sách thành viên</span>
                                    </h4>
                                </div>                                                                    
                                    <div class="content noPad">
                                    <table class="responsive table table-bordered" id="checkAll">
                                        <thead>
                                          <tr>
                                            <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                                            <th>Tên đăng nhập</th>                                            
                                            <th>Fullname</th>
                                            <th>Chức danh</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        {foreach from=$data.list_user item=val key=k}
                                          <tr>
                                            <td class="chChildren"><input type="checkbox" name="checkbox[]" value="{$val.id}" class="styled" /></td>
                                            <td class="alignleft"><span class="lastedit-pe"></span><strong style="color: blue;">{$val.user_name}</strong>
                                                <div class="quk-edit">
                                                <a href="{$link_helper->link_edit("EditUser",$val.id)}">Sửa</a>
                                                | 
                                                <a  href="{$link_helper->linkhome("UserAction")}&action=deleteUser&id={$val.id}">Xóa</a>
                                                | 
                                                <a  href="{$link_helper->link_edit("ResetPass",$val.id)}">Reset pass</a>
                                                </div>
                                            </td>
                                            <td>{$val.fullname}</td>
                                            <td>{if $val.id eq 121}Coder{elseif $val.group_id eq 1}<strong style="color: blue;">S.Mod</strong>{elseif $val.group_id eq 2}<strong style="color: green">Mod</strong> {elseif $val.group_id eq 3}<strong style="color: red;">Reporter</strong>{elseif $val.group_id eq 4}<strong style="color: gray;">Administrator</strong>{/if}</td>
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
