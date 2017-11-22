{include file='block/head.tpl'}
<!-- loading animation -->
<div id="qLoverlay"></div>
<div id="qLbar"></div>
{include file='block/header.tpl'}
<div id="wrapper">
<div class="resBtn">
    <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
</div>
<div class="collapseBtn">
    <a href="#" class="tipR" title="Ẩn menu"><span class="icon12 minia-icon-layout"></span></a>
</div>
<div id="sidebarbg"></div>
{include file='block/menu_left.tpl'}
<div id="content" class="clearfix">
<div class="contentwrapper"><!--Content wrapper-->
<div class="heading">
    <h3>Danh sách Banner/Adsense</h3>
    <div class="resBtnSearch">
        <a href="#"><span class="icon16 brocco-icon-search"></span></a>
    </div>
    <ul class="breadcrumb">
        <li>Vị trí hiện tại:</li>
        <li>
            <a href="" class="tip" title="Danh sách Banner/Adsense">
                <span class="icon16 icomoon-icon-screen"></span>
            </a>
            <span class="divider">
                <span class="icon16 icomoon-icon-arrow-right"></span>
            </span>
        </li>
        <li class="active">Danh sách Banner/Adsense</li>
    </ul>
</div><!-- End .heading-->

<div class="row-fluid">
    <div class="box gradient">
        <form name="advertise1" id="ad_filter" method="post">
        <div class="row-fluid filter-date-block">
            <div class="row-fluid  marginT10 marginB10">
                <div class="clearfix">
                    <div class="left margin10">
                        <select name="type_select">
                            <option value="pc">PC</option>
                            <option value="mobile" {if $data.type eq 'mobile'}selected{/if}>Mobile</option>
                        </select>
                        <select name="module_select">
                            <option value="home">Trang chủ</option>
                            <option value="cat" {if $data.module eq 'cat'}selected{/if}>Chuyên mục</option>
                            <option value="detail" {if $data.module eq 'detail'}selected{/if}>Chi tiết</option>
                        </select>
                        {if is_array($data.positions)}
                        <select name="ads_select">
                            {foreach from=$data.positions item=position_name key=position_id}
                            <option value="{$position_id}" {if $data.advertise_position eq $position_id}selected="selected"{/if}>
                            {$position_name}
                            </option>
                            {/foreach}
                        </select>
                        {/if}
                    </div>
                </div><!-- End .clearfix -->
            </div>
        </div>
        </form>
    <form name="advertise" id="advertise" action="" method="post" enctype="multipart/form-data">
        <div class="span8" style="margin: 0;">
            <div class="box">
                <div class="title">
                    <h4>
                        <span class="icon16 brocco-icon-grid"></span>
                        <span>Tạo Banner/Adsense</span>
                    </h4>
                </div>
                <div class="content clearfix">
                    {$tpl->displayAlert()}
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span3" for="normal">Tên quảng cáo</label>
                                <div class="span8">
                                    <input type="text" id="advertise_title" name="advertise_title" value="{$data.advertise.advertise_title}" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr class="line" />
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span3" for="checkboxes">Mã nhúng</label>
                                <div class="span8">
                                    <textarea name="advertise_embed" style="height: 200px;">{$data.advertise.advertise_embed}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    {*if $data.module != 'home'}
                    <hr class="line" />
                    <div class="form-row row-fluid">
                        <label class="span5" style="z-index: 9999;position: relative;font-weight: bold;text-transform: uppercase;">Không hiển thị chuyên mục</label>
                        <div class="box">
                            <div class="content">
                                <div class="form-row row-fluid">
                                    <div class="">   
                                        <select name="news_focus[]" class="nostyle valid" multiple="multiple" size="10">
                                            {foreach from=$data.list_category item=item}
                                            <option {if in_array($item->id,$data.list_cat_selected)} selected="selected" {/if} id="{$item->id}" value="{$item->id}">{$item->title}</option>
                                            {/foreach}
                                        </select>                                        
                                    </div> 
                                </div>
                            </div><!--content-->
                        </div>
                    </div>
                    {/if*}   
                    {*<hr class="line" />
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span3" for="normal">Bắt đầu</label>
                                <div class="span8">
                                    <div class="noMar">
                                        <div id="datetimepicker1" class="input-append date">
                                            <span class="add-on">
                                                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                                </i>
                                            </span>
                                            <input style="width:90%" type="text" data-format="dd-MM-yyyy hh:mm:ss" name="start_date" value="{if isset($data.advertise.start_date)}{$data.advertise.start_date|date_format:'%d-%m-%Y %H:%M:%S'}{else}{$smarty.now|date_format:'%d-%m-%Y %H:%M:%S'}{/if}" readonly="readonly"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <label class="form-label span3" for="normal">Kết thúc</label>
                                <div class="span8">
                                    <div class="noMar">
                                        <div id="datetimepicker2" class="input-append date">
                                            <span class="add-on">
                                                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                                </i>
                                            </span>
                                            <input style="width:90%" type="text" data-format="dd-MM-yyyy hh:mm:ss" name="end_date" value="{if isset($data.advertise.end_date)}{$data.advertise.end_date|date_format:'%d-%m-%Y %H:%M:%S'}{else}{$smarty.now|date_format:'%d-%m-%Y %H:%M:%S'}{/if}" readonly="readonly"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>*}
                    <hr class="line" />
                    <div class="form-row row-fluid">
                        <label class="form-label span6" for="checkboxes">Active / Deactive?</label>
                        <div class="span4 noMar">
                            <input type="checkbox" name="advertise_active" class="ibutton"
                            {if isset($data.advertise.advertise_active) and $data.advertise.advertise_active eq 1}checked="checked"{/if}/>
                        </div>
                    </div>
                    <hr class="line" />
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <input type="hidden" name="type" value="{$data.type}" />
                                <input type="hidden" name="module" value="{$data.module}" />
                                <input type="hidden" name="action" value="" />
                                {if isset($data.advertise.advertise_id)}
                                <a class="btn btn-info btn-large" onclick="advertise.action.value='update';document.getElementById('advertise').submit();">Cập nhật</a>
                                <input type="hidden" name="id" value="1">
                                {else}
                                <a class="btn btn-info btn-large" onclick="advertise.action.value='add';document.getElementById('advertise').submit();">Tạo quảng cáo</a>
                                {/if}
                            </div>
                        </div>
                    </div>
                </div><!--content-->
            </div><!--box-->
        </div><!--cot trai-->

        <div class="span4">
        </div><!--cot phai-->

    </div><!-- End .box -->
    </div><!-- End .row-fluid -->
</form>
{include file='block/footer.tpl'}
<script type="text/javascript">
    $('select[name="type_select"]').change(function(){
        var type = $('select[name="type_select"]').val();
        var module = $('select[name="module_select"]').val();
        var ads = '';
        if(type=='pc') ads = 'top-header';
        else if(type=='mobile') ads = 'mobile-top-header';
        window.location.href = "/?act=ListAdvertise&type="+type+"&module="+module+"&advertise_position="+ads;
    });
    $('select[name="module_select"]').change(function(){
        var type = $('select[name="type_select"]').val();
        var module = $('select[name="module_select"]').val();
        var ads = '';
        if(type=='pc') ads = 'top-header';
        else if(type=='mobile') ads = 'mobile-top-header';
        window.location.href = "/?act=ListAdvertise&type="+type+"&module="+module+"&advertise_position="+ads;
    });
    $('select[name="ads_select"]').change(function(){
        var type = $('select[name="type_select"]').val();
        var module = $('select[name="module_select"]').val();
        var ads = $('select[name="ads_select"]').val();
        window.location.href = "/?act=ListAdvertise&type="+type+"&module="+module+"&advertise_position="+ads;
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR'
        });
    });
    $(function() {
        $('#datetimepicker2').datetimepicker({
            language: 'pt-BR'
        });
    });
</script>