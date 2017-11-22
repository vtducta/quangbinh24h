<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
<channel>
    <link>http://danang24h.vn</link>
    <description>Các bài viết mới nhất</description>
    <title></title>
    <image>
        <url>http://danang24h.vn/images/logo.png</url>
        <title>Báo tin tức mới nhất</title>
        <link>http://danang24h.vn/gl/24h-qua</link>
    </image>
    {foreach from=$data.list_news item=val key=key}
        <item>
            <title>{$val.title}</title>
            <link>{$link_helper->link_to_news($val.meta_slug,$val.id)}</link>
            <description>{$val.intro_text}</description>
            <dc:creator>Nghệ An 24h</dc:creator>
        </item>                 
    {/foreach}
</channel>
</rss>