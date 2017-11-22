{include file='block/head.tpl'}
<div class="wrapper" id="container">
    {include file='block/header.tpl'}
    <section class="template2" id="category">
        <div class="content-wrap">
            <section class="cate_content">
                {foreach from=$data.news_hot_cat item=val name=foo}
                <section class="featured">
                    <article class="featured picture">
                        <div class="cover">
                            <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"><img src="{$val.images}" border="0" class="image1" title="{$val.title}"/></a>
                        </div>
                        <header>
                            <p class="title"><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></p>
                            <p class="summary">{$val.intro_text}</p>
                        </header>
                    </article>
                </section>
                {/foreach}
                <section class="cate_content tt-cate">
                    <header></header>
                    {foreach from=$data.list_news item=val name=foo}
                    <article>
                        <div style="background-image: url({$val.images})" class="cover"> <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"></a> </div>
                        <header class="cate-new">
                            <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a><span class="social"></span></h1>
                            <time datetime="{$val.create_date_int|date_format:"%H:%M %d-%m-%Y"}">{$val.create_date_int|date_format:"%H:%M %d-%m-%Y"}</time>
                            <p class="summary">{$val.intro_text}</p>
                        </header>
                    </article>
                    {/foreach}
                    <div class="clearfix"></div>
                    
                    {if $data.paging.total >1}
                        <div class="text-center">
                            <ul class="pagination none_mobile">
                                <li><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$data.paging.current-5)}">&lt;&lt;</a></li>
                                <li><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$data.paging.current-1)}">&lt;</a></li>
                                {foreach from=$data.paging.page key=key item=one}
                                <li {if $one eq $data.paging.current}class="active"{/if}><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$one)}">{$one}</a></li>
                                {/foreach}
                                <li><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$data.paging.current+1)}">&gt;</a></li>
                                <li><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$data.paging.current+5)}">&gt;&gt;</a></li>
                            </ul>
                            <ul class="pagination block_mobile">
                                <li><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$data.paging_mobile.current-3)}">&lt;&lt;</a></li>
                                <li><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$data.paging_mobile.current-1)}">&lt;</a></li>
                                {foreach from=$data.paging_mobile.page key=key item=one name=foo}
                                <li {if $one eq $data.paging_mobile.current}class="active"{/if}><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$one)}">{$one}</a></li>
                                {/foreach}
                                <li><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$data.paging_mobile.current+1)}">&gt;</a></li>
                                <li><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$data.paging_mobile.current+3)}">&gt;&gt;</a></li>
                            </ul>
                        </div>
                    {/if}
                </section>
                <div style="clear:both"></div>
                <section class="well_read_mobile cate_content tt-cate">
                    <div class="head_well_read">BÀI ĐỌC NHIỀU</div>
                    {foreach from=$data.list_docnhieu item=val name=foo}
                    <article>
                        <div class="cover" style="background-image: url({$val.images})">
                            <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"></a>
                        </div>
                        <header class="cate-new">
                            <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></h1>
                            <time datetime="{$val.create_date_int|date_format:"%H:%M %d-%m-%Y"}">{$val.create_date_int|date_format:"%H:%M %d-%m-%Y"}</time>
                            <p class="summary">{$val.intro_text}</p>
                        </header>
                    </article>
                    {/foreach}
                </section>
            </section>
            <section class="cate_sidebar"></section>
        </div>
        <section class="sidebar">
            <section class="video tin-anh">
                <header>
                    <h1><a>BÀI ĐỌC NHIỀU</a></h1>
                </header>
                {foreach from=$data.list_docnhieu item=val name=foo}
                <article class="{if $smarty.foreach.foo.index == 0}featured {/if}video tin-anh">
                    <div class="cover" style="background-image: url({$val.images})">
                        <a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"></a>
                    </div>
                    <header>
                        <h1><a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}" title="{$val.title}">{$val.title}</a></h1>
                    </header>
                </article>
                {/foreach}
            </section>

            {$data.listAds['cat-sidebar-1']}
            {$data.listAds['cat-sidebar-2']}
            {$data.listAds['cat-sidebar-3']}
        </section>
    </section>
</div>
{include file='block/footer.tpl'}