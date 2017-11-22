<div class="art-content pkg">    
    <div class="art-main search-result">
    {$first_art = null}
    {foreach from=$data.list_news item=val key=k}
        {$first_art = $val}
        {break}
    {/foreach}
        
    
        <ul class="catPost-list pkg">
             <li class="pkg">
                <h1 class="title"><a href="{$link_helper->link_to_event($data.event->get('meta_slug'),$data.event->get('id'))}">{$data.event->get('title')}</a></h1>
                <a class="thumb-7" style="width:300px;height:205px" href="{$link_helper->link_to_event($data.event->get('meta_slug'),$data.event->get('id'))}"><img alt="{$data.event->get('title')}" src="{if $first_art}{$template_helper->get_thumb_image($first_art->get('upload_url'),300,205)}{/if}" ></a>
                <p style="line-height:16px;margin-top:10px">{$data.event->get('description')}</p>
                <div class="share">                        
                    <b style="float:left">Chia sẻ chủ đề trên :
                    </b>      
                    <div class="fb-like" style="float: left;" data-href="{$link_helper->link_to_event($data.event->get('meta_slug'),$data.event->get('id'))}" data-width="130" data-layout="button_count" data-show-faces="true" style="float:left" data-send="false" data-share="true"></div>
                    <div style="float: left; width: 70px;">  
                        <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>                        
                        <g:plusone size="medium" href="{$link_helper->link_to_event($data.event->get('meta_slug'),$data.event->get('id'))}"></g:plusone>
                    </div>
                </div>
            </li>
        
        {if $data.list_news}   
        {$run=0}
        {foreach from=$data.list_news item=val key=k}
            {$run=$run+1}
            <li class="pkg">
            <h3 class="title"><a href="{$link_helper->link_to_news($val->get('meta_slug'),$val->get('id'))}">{$val->get('title')}{if $val->get('content_type') eq "photo"} <img src="{$GUrl.Base}images/default/photo.jpg"> {elseif $val->get('content_type') eq "video"} <img src="{$GUrl.Base}images/default/video_icon.gif">{/if}</a></h3>
                <a title="{$val->get('title')|replace:'"':''}" class="thumb-7" href="{$link_helper->link_to_news($val->get('meta_slug'),$val->get('id'))}"><img alt="{$val->get('title')|replace:'"':''}" src="{$template_helper->get_thumb_image($val->get('upload_url'),162,94)}"></a>      
                <p class="desc"><strong>{$val->get('create_date_int')|date_format:"%d-%m-%Y"}</strong></p>
                <p>{$val->get('intro_text')}</p>
            </li>     
            {if $run==5} 
                <li class="pkg">
                   <h2 class="title"><a href="{$link_helper->link_to_event($data.event->get('meta_slug'),$data.event->get('id'))}">Tin tức {$data.event->get('title')}</a> đang được bạn đọc quan tâm</h2>
                   
                </li>         
            {/if}   
        {/foreach}
            {if $data.event->get('meta_keywork')}
                <li class="pkg">
                   <p style="text-align:justify;padding:5px;line-height:16px">{$data.event->get('meta_keywork')}</p>
                </li>      
            {/if}
            {else}   
            <li class="pkg">
                   <p style="text-align:justify;padding:5px;line-height:16px">Chưa có bài viết nào thuộc sự kiện này</p>
                </li>                                  
            {/if}
        </ul> 
    
    {if $data.paging.total >1}
        <div class="page-wrap pkg">
        <div class="paging">
        <a class="prev" href="{$link_helper->link_to_event($data.event->get('meta_slug'),$data.event->get('id'),1)}">&lt;</a>
        {foreach from=$data.paging.page key=key item=one} 
        <a {if $one eq $data.paging.current}class="current" {/if} href="{$link_helper->link_to_event($data.event->get('meta_slug'),$data.event->get('id'),$one)}">{$one}</a>                            
        {/foreach}
        <a class="next active" href="{$link_helper->link_to_event($data.event->get('meta_slug'),$data.event->get('id'),$data.paging.total)}">&gt;</a>
            </div>
        </div><!--page wrap-->
    {/if} 
    </div><!--art-main-->                                
</div>
