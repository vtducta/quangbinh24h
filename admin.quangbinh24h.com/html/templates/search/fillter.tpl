<div class="clearfix">                                      
    {include file='block/search.tpl'}                                    
    {if $data.list_news}
        <table class="responsive table table-bordered" id="checkAll">
            <thead>
                <tr>
                    <th id="masterCh" class="ch"><input type="checkbox" name="checkbox" value="all" class="styled" /></th>
                    <th colspan="2">Tiêu đề</th>                                            
                    <th>Chuyên mục</th>
                    <th>Người viết</th>
                    <th>views</th>
                    <th>Thời gian</th>
                    <th>Set vị trí</th>
                </tr>
            </thead>
            <tbody>   
                {foreach from=$data.list_news item=val key=key name=foo}
                <tr {if $smarty.foreach.foo.index %2!=0} class="second" {/if} >
                    <td class="chChildren"><input type="checkbox" name="checkbox" value="{$val.id}" class="styled" /></td>
                    <td width="85"><a href="{if $data.flag}{$link_helper->link_edit("AdminEditNews",$val.id)}{else}{$link_helper->link_edit("AcpEditNews",$val.id)}{/if}" class="list-post-thumb"><img src="{$template_helper->get_thumb_image($val.images,80,60)}"/></a></td>
                    <td class="alignleft"><span class="lastedit-pe"></span><a href="{if $data.flag}{$link_helper->link_edit("AdminEditNews",$val.id)}{else}{$link_helper->link_edit("AcpEditNews",$val.id)}{/if}"><strong>{$val.title}</strong></a>
                        <p class="listing-lead">{$val.intro_text}</p>
                        <div class="quk-edit">  
                            <a href="{$link_helper->xemnhanh($val.meta_slug,$val.id)}" target="_blank">Xem nhanh</a>                                               
                            |
                            {if $data.flag}
                                <a href="{$link_helper->link_edit("AdminEditNews",$val.id)}">Sửa</a>            
                            {else}
                                <a href="{$link_helper->link_edit("AcpEditNews",$val.id)}">Sửa</a>            
                            {/if}
                            {if $data.group_user_id!=5}
                            |
                            <a href="{$link_helper->link_deleted("hiddennews",$val.id)}">Ẩn</a>      
                            {/if}             
                        </div>
                    </td>                                                
                    <td>{$val.category}</td>  
                    <td><strong style="color: blue;">{$val.creat_by}</strong></td>
                    <td><strong style="color: blue;">{$val.views}</strong></td>                                                                  
                    
                    <td>
                        <span>{$val.create_date_int|date_format:"%d-%m-%Y %H:%M:%S"}</span>
                    </td>
                    <td>
                   <button onclick="load_popup_home({$val.id})" style="width: 100px; height: 30px; font-size: 13px; font-weight: bold;" class="btn btn-mini" type="button" href="#news_noibat" data-toggle="modal">Vị trí nổi bật</button>
                    </td>
                </tr> 
                {/foreach}
            </tbody>                                        
        </table>  
   {else}                                  
        <center><h3>Không có bài viết nào !</h3></center>
   {/if}
</div>   
{if $data.list_news}                              
    <div class="margin10 clearfix">    
        {if $data.paging.total >1}
        <div class="pagination right">
            <ul>
                <li><a href="javascript:void(0)" onclick="filter(1)"><span class="icon12 minia-icon-arrow-left-3"></span></a></li>
                {foreach from=$data.paging.page item=val key=k} 
                <li {if $val eq $data.paging.current} class="active"{/if}>
                <a href="javascript:void(0)" onclick="filter({$val})"><span>{$val}</span></a>
                </li>                                                    
                {/foreach}                                               
                <li><a href="javascript:void(0)" onclick="filter({$data.paging.total})"> <span class="icon12 minia-icon-arrow-right-3"></span></a></li>
            </ul>
        </div>                                        
        {/if}                           
    </div>
{/if}