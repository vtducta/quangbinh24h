<div class="clearfix" style="padding: 10px;">
    <div class="left marginT10 marginR10"> 
        <input type="text" name="date_time" id="datepicker" value="Chọn ngày" />
    </div>
    <div class="left marginT10" style="width: 190px;overflow:hidden ;">
        <select name="select_cat" id="select_cat">
            <option id="0" value="0" >Lọc theo chuyên mục</option>
            {foreach from=$data.list_category item=val key=k}
                {if $val.status eq 1 and $val.home_display eq 0}
                    <option id="{$val.id}" value="{$val.id}" >{$val.title}</option>
                
                {foreach from=$val.child item=v key=k}
                    {if $v->get('status') eq 1 and $v->get('home_display') eq 0}
                        <option id="{$v->get('id')}" value="{$v->get('id')}" >|__{$v->get('title')}</option>
                    {/if}
                {/foreach}
                {/if}
            {/foreach}                
        </select>

    </div>
    <div class="left" style="">
        <a href="javascript:void(0)" class="btn btn-info left margin10" style="z-index: 3;" onclick="filter(1)">Lọc</a>
    </div>
</div><!--clear--> 