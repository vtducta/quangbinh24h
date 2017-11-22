{literal}
<style>
    .rss-result ul li{
    list-style : none
    }
</style>
{/literal}
<div class="art-content pkg">    
    <div class="rss-result">
        <div class="art-related-head"><h3>Các kênh RSS do danang24h.vn cung cấp<span class="search-key"></span></h3></div>
        <ul>  
            <li class="pkg">
                <div class="desc"><strong>+>Trang chủ</strong> <a href="{$link_helper->link_view_rss()}">{$link_helper->link_view_rss()}</a></div>
            </li>                
            {foreach from=$data.list_category item=val key=k}
            <li class="pkg">
                <div class="desc"><strong>+>{$val.title}</strong> <a href="{$link_helper->link_view_rss($val.meta_slug)}">{$link_helper->link_view_rss($val.meta_slug)}</a></div>
            </li>   
            {foreach $val.child as $sub}

            <li class="pkg">
                <div class="desc"><strong>&nbsp;&nbsp;&nbsp;{$sub.title}</strong> <a href="{$link_helper->link_view_rss($sub.meta_slug)}">{$link_helper->link_view_rss($sub.meta_slug)}</a></div>
            </li>  

            {/foreach}      
            {/foreach}
        </ul>
    </div><!--art-main-->                                
</div>