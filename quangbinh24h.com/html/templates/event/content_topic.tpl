{$stt=0}
{foreach from=$data.block_topic item=val key=k name=a}
    {if $val.list_news}
        <div class="hCat hCat-1 {if $stt%2 !=0} odd {/if}">
            <div class="hCat-head"><h3><span class="hCat-icon1"></span><a href="{$link_helper->link_to_event($val.meta_slug,$val.id)}">{$val.title}</a></h3></div>
            <div class="hCat-content">        
                <ul class="hCat-list pkg">                
                    {foreach from=$val.list_news item=v key=k name=foo}
                    {if $smarty.foreach.foo.index ==0}
                    <li class="topnews pkg"><a href="{$link_helper->link_to_news($v->get('meta_slug'),$v->get('id'))}" class="thumb"><img src="{$template_helper->get_thumb_image($v->get('upload_url'),144,90)}" /></a>
                        <h2 class="title"><a href="{$link_helper->link_to_news($v->get('meta_slug'),$v->get('id'))}">{$v->get('title')}</a></h2>
                        <p class="desc">{$v->get('intro_text')|truncate:80:"..."}</p>
                    </li>
                    {/if}
                    {if $smarty.foreach.foo.index ==1}
                    <li class="secondnews pkg">
                        <a href="{$link_helper->link_to_news($v->get('meta_slug'),$v->get('id'))}" class="thumb"><img alt="" src="{$template_helper->get_thumb_image($v->get('upload_url'),103,77)}" /></a>
                        <h2 class="title"><a href="{$link_helper->link_to_news($v->get('meta_slug'),$v->get('id'))}">{$v->get('title')}</a></h2>
                        <p class="desc">{$v->get('intro_text')|truncate:70:"..."}</p>
                    </li>
                    {/if}
                    {if $smarty.foreach.foo.index >1 && $smarty.foreach.foo.index <5}
                    <li class="pkg"><h2 class="title"><a href="{$link_helper->link_to_news($v->get('meta_slug'),$v->get('id'))}">{$v->get('title')}</a></h2></li>   
                    {/if}
                    {/foreach}
                </ul>            
            </div>
        </div><!--o to xe may-->
        {$stt=$stt+1}   
    {/if}
{/foreach}  
