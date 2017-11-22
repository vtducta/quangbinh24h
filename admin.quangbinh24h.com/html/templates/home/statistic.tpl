{include file='block/head.tpl'}
<!-- loading animation -->
<!--<div id="qLoverlay"></div>
<div id="qLbar"></div>  -->
{literal}
<script type="text/javascript">
    flag =0;
</script>
{/literal}
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
                    <form method="post" action="" id="statistic">
                        <div class="clearfix" style="padding: 10px;">
                            <div class="left marginT10 marginR10"> 
                                <input type="text" name="date_from" id="datepicker" placeholder="Từ ngày" />
                            </div>
                            <div class="left marginT10 marginR10"> 
                                <input type="text" name="date_to" id="datepicker-inline" placeholder="Đến ngày" />
                            </div>
                            <div class="left marginT10" style="width: 190px;overflow:hidden;margin-left: 10px;">
                                <select name="select_user" id="select_user">
                                    <option id="0" value="0" >User</option>
                                    {foreach from=$data.list_user item=val}
                                    <option id="{$val->user_id}" value="{$val->user_id}" >{$val->username}</option>
                                    {/foreach}                
                                </select>
                            </div>
                            <div class="left" style="">
                                <a onclick="document.getElementById('statistic').submit();" class="btn btn-info left margin10" style="z-index: 3;">Thống kê</a>
                            </div>
                        </div>
                    </form>
                </div><!-- End .box -->
                {if $data.total_view}
                Tổng bài viết: {$data.total_news}<br>
                Tổng view: {$data.total_view}<br>
                {/if}
            </div><!-- End .row-fluid --> 
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->
</div><!-- End #wrapper -->
{include file='block/footer.tpl'}
