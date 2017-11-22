{include file='block/head.tpl'}
{literal}
<style type="text/css">
    .fix_withtbl div.selector {width: auto;font-size: 12px;}
    .row-fluid .fix_withtbl [class*="span"] {width: 80px !important;}
    .fix_withtbl .table th, .table td{padding: 3px;}
</style>
{/literal}
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
                        <span>Xuất file</span>
                    </h4>
                </div>                 

                <div class="clearfix">                    
                    <div class="left marginT10" >
                        <div id="datetimepicker2" class="input-append date">
                            <input data-format="dd-MM-yyyy"  name="starttime" value="{if $data.starttime}{$data.starttime|date_format:"%d-%m-%Y"}{/if}" readonly="readonly" type="text"></input>
                            <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                </i>
                            </span>
                        </div>
                    </div>
                    <div class="left marginT10" style="margin-left:15px">
                        <div id="datetimepicker1" class="input-append date">
                            <input data-format="dd-MM-yyyy" name="endtime" value="{if $data.endtime} {$data.endtime|date_format:"%d-%m-%Y"} {/if}"  type="text" readonly="readonly"></input>
                            <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                </i>
                            </span>
                        </div>                        
                    </div>
                 
                    <div class="left margin10">
                        <button  type="button" class="btn btn-info" onclick="loc();">Lọc</button>
                    </div>  
                </div>

                <div id="list_news">
                    <div class="clearfix">
                        <hr class="line" />
                        Tổng số người : {count($data.list_user)}
                        {if $data.list_user}
                           {literal}
                               <style>
                                a:link {
                                    color: green;
                                }

                                /* visited link */
                                a:visited {
                                    color: green;
                                }

                                /* mouse over link */
                                a:hover {
                                    color: red;
                                }

                                /* selected link */
                                a:active {
                                    color: yellow;
                                }
                              </style>
                            {/literal}                 
                            <div class="content noPad fix_withtbl">                                                                   
                                <table class="responsive table table-bordered" id="checkAll" style="padding-left:5px">
                                    <thead>
                                        <tr>
                                            <th width="20px">id</th>                                       
                                            <th width="150px">Người viết</th> 
                                            <th width="100px">Link nhuận</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        {foreach from=$data.list_user item=val key=key name=foo}    
                                        <tr style="heigt:50px;">                                    
                                            <td>{$val.user_id}</td>                                        
                                            <td><strong style="color: blue;">{$val.username}</strong></td>  
                                            <td><a href="{$val.link}" target="_blank">xuất nhuận</a></td>     
                                        </tr> 
                                        
                                        {/foreach}
                                    </tbody>
                                </table>
                            </div> 
                                                               
                     
                        {/if}
                        </div>
                    </div>    
                </div><!-- End .box -->
            </div><!-- End .row-fluid --> 
        </div><!-- End contentwrapper -->
    </div><!-- End #content -->
</div><!-- End #wrapper -->
{literal}
<script type="text/javascript">
    function loc()
    {     
     //   user = $('.select_user').attr('value');
     //   category = $('.select_category').attr('value');
     //   status = $('.status').attr('value');        
     //   content_type = $('.content_type').attr('value');
        starttime= $('input:text[name=starttime]').val();
        endtime = $('input:text[name=endtime]').val();
        window.location.href = '{/literal}{$GUrl.Base}{literal}?act=Royalties&action=export'+'&starttime='+starttime+'&endtime='+endtime;        
    }    
   
</script>
{literal}   
<script type="text/javascript">
    $(function() {
        $('#datetimepicker2').datetimepicker({
            language: 'pt-BR'
        });
    });
    $('#datetimepicker1').datetimepicker({
        language: 'pt-BR'
    });
</script>
{/literal}
{/literal}
</body>
</html>
