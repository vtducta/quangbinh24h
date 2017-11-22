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
                            <span>Thống kê bài viết</span>
                        </h4>
                    </div>                 
                    <div class="clearfix">
                        <div class="row-fluid clearfix">
                            <div class="span6">                                
                                <table class="responsive table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ngày</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{$smarty.now|date_format:"%d-%m-%Y"}</td>
                                            <td>{$data.total_day}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="responsive table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tháng</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {foreach from=$data.total_month item=val key=key}
                                        <tr>
                                            <td>{$key}</td>
                                            <td>{$val}</td>                                
                                        </tr>
                                        {/foreach}
                                    </tbody>
                                </table>
                            </div><!-- End .span6 --> 
                            <div class="span6">
                                    <div class="title">
                                        <h4>
                                            <span class="icon16 brocco-icon-grid"></span>
                                            <span>Danh sách bài viết thành viên trong Ngày</span>
                                        </h4>
                                        <a href="#" class="minimize">Minimize</a>
                                    </div>
                                    <div class="content noPad">
                                        <table class="responsive table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User name</th>
                                                    <th>Số bài</th>
                                                    <th>Ngày</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                
                                            </tbody>
                                        </table>
                                    </div>
                            </div><!-- End .span6 -->
                        </div>
                    </div>
                </div><!-- End .box -->
            </div><!-- End .row-fluid --> 
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->
    </div><!-- End #wrapper -->    
{include file='block/footer.tpl'}