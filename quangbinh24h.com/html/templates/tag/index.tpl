{include file='block/head.tpl'}
<div class="wrapper" id="container">
    {include file='block/header.tpl'}
    <section class="template2" id="category">
        <div class="content-wrap">
            <section class="cate_content">
                {foreach from=$data.list_news item=val name=foo}
                {if $smarty.foreach.foo.index == 0}
                <section class="featured">
                    <article class="featured picture">
                        <div class="cover">
                            <a href="{$link_helper->link_to_news($val->meta_slug,$val->id)}"><img src="{$val->upload_url}" border="0" class="image1" title="{$val->title}"/></a>
                        </div>
                        <header>
                            <p class="title"><a href="{$link_helper->link_to_news($val->meta_slug,$val->id)}" title="{$val->title}">{$val->title}</a></p>
                            <p class="summary">{$val->intro_text}</p>
                        </header>
                    </article>
                </section>
                {break}
                {/if}
                {/foreach}
                <section class="cate_content tt-cate">
                    {foreach from=$data.list_news item=val name=foo}
                    {if $smarty.foreach.foo.index > 0}
                    <article>
                        <div style="background-image: url({$val->upload_url})" class="cover"> <a href="{$link_helper->link_to_news($val->meta_slug,$val->id)}"></a> </div>
                        <header class="cate-new">
                            <h1><a href="{$link_helper->link_to_news($val->meta_slug,$val->id)}" title="{$val->title}">{$val->title}</a><span class="social"></span></h1>
                            <time datetime="{$val->create_date_int|date_format:"%H:%M %d-%m-%Y"}">{$val->create_date_int|date_format:"%H:%M %d-%m-%Y"}</time>
                            <p class="summary">{$val->intro_text}</p>
                        </header>
                    </article>
                    {/if}
                    {/foreach}
                    <div class="clearfix"></div>
                    
                    {if $data.paging.total >1}
                        <div class="text-center">
                            <ul class="pagination">
                                <li><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),1)}">&lt;</a></li>
                                {foreach from=$data.paging.page key=key item=one}
                                <li {if $one eq $data.paging.current}class="active"{/if}><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$one)}">{$one}</a></li>
                                {/foreach}
                                <li><a href="{$link_helper->link_to_category($data.object_category->get('meta_slug'),$data.paging.total)}">&gt;</a></li>
                            </ul>
                        </div>
                    {/if}
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

            <div><a href="" target="_blank"><img src="/images/lien-he-quang-cao.png" /></a></div>
            <img src="/images/lien-he-quang-cao.png" />
        </section>
    </section>
</div>
{include file='block/footer.tpl'}