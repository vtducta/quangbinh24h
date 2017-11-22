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
                    <h3>Ủy quyền</h3>                    
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
                        <li class="active">Ủy quyền</li>
                    </ul>
                </div><!-- End .heading-->
                <div class="row-fluid clearfix">
                {$template_helper->displayAlert()}
                    <form id="permission" action="/" method="post">
                        <div class="span8" style="margin:0;">
                            <div class="box">   
                                <div class="title">
                                    <h4>
                                        <span class="icon16 brocco-icon-grid"></span>
                                        <span>Ủy quyền</span>
                                    </h4>                                    
                                </div>                     
                                <div class="content clearfix">
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Tên thành viên</label>
                                                <div class="span8">                                                    
                                                    <select name="username">
                                                        <option id="0" value="0">default</option>
                                                       {foreach from=$data.list_user item=val key=k}                                                                
                                                            {if $val.group_id eq 1}
                                                                <option id="{$val.id}" value="{$val.id}">{$val.user_name}</option>
                                                            {/if}
                                                       {/foreach}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                          
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Quyền</label>
                                                <div class="span8">
                                                    <div class="controls">   
                                                        <select name="groupname">                                                            
                                                            <option id="4" value="4">Tổng biên tập</option>
                                                        </select>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Ngày bắt đầu</label>
                                                <div class="span8">
                                                    <input type="text" name="start_time" id="datepicker" class="span5" value="" />                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="normal">Ngày kết thúc</label>
                                                <div class="span8">
                                                    <input type="text" name="end_time" id="datepicker" class="span5" value="" />                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                                                        
                                    <hr class="line"/>                                   
                                    <input type="hidden" name="action" value="addpermission" /> 
                                    <input type="hidden" name="act" value="UserAction" /> 
                                     <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">                                                
                                                <a class="btn btn-success btn-large" onclick="$('#permission').submit();">Ủy quyền</a>                                                
                                            </div>
                                        </div>  
                                      </div> 
                                </div><!--content-->                                
                            </div><!--box--> 
                            <!--<div class="box">   
                                <div class="title">
                                    <h4>
                                        <span class="icon16 brocco-icon-grid"></span>
                                        <span>Lịch sử hành động</span>
                                    </h4>                                    
                                </div>                     
                                <div class="content clearfix">
                                     <table class="responsive table">
                                        <thead>
                                          <tr>                                            
                                            <th>Thành viên</th>
                                            <th>Ủy quyền cho</th>
                                            <th>Thời gian</th>
                                            <th>Vị trí</th>
                                          </tr>
                                        </thead>
                                        <tbody>                                         
                                        {foreach from=$data.user_permissions item=val key=key}                                        
                                          <tr>
                                            <td>{$key +1}</td>
                                            <td>{$val.user_create}</td>
                                            <td>{$val.user}</td>
                                            <td>{$val.start_time|date_format:"%d-%m-%Y"} - {$val.end_time|date_format:"%d-%m-%Y"}</td>
                                            <td>{if $val.group eq 4}Tổng biên tập{elseif $val.group eq 1}Thư ký tòa soạn{/if}</td>
                                          </tr>
                                        {/foreach}
                                        </tbody>
                                    </table>
                              
                                </div><!--content-->
                            </div><!--box-->   
                        </div><!--cot trai-->
                    </form>
                </div><!-- End .row-fluid -->
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->
    
    </div><!-- End #wrapper -->
    {include file='block/flag_edit.tpl'}
{include file='block/footer.tpl'}
