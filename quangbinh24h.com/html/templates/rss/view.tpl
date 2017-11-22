{if isset($data.build_sitemap)}
<?xml version="1.0" encoding="UTF-8"?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>http://danang24h.vn</loc>
        <changefreq>always</changefreq>
        <priority>1</priority>
    </url>
    {foreach from=$data.list_category item=val}
    <url>
        <loc>{$link_helper->link_to_category($val.meta_slug)}</loc>
        <changefreq>always</changefreq>
        <priority>0.9</priority>
    </url>
   
    {/foreach}
    
</urlset>
{else}
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"> 
    <channel>
        <title>danang24h.vn/</title>
        <atom:link href="{if $data.title} {$link_helper->link_view_rss($data.title->get('meta_slug'))} {else}{$link_helper->link_view_rss()}{/if}" rel="self" type="application/rss+xml" />    
        <link>{$GUrl.Base}</link>
        <description>{$data.object.meta_keyword}</description>
        <pubDate><![CDATA[{$smarty.now|date_format}]]></pubDate>
        <generator>{$GUrl.Base}?v=2.7.1</generator>
        <language>en</language>
        <sy:updatePeriod>hourly</sy:updatePeriod>
        <sy:updateFrequency>1</sy:updateFrequency>   
        {foreach from=$data.list_news item=val key=key}

        <item>
            <image>
                {$val.images}
            </image>
            <title>{$val.title}</title> 
            <link>{$link_helper->link_to_news($val.meta_slug,$val.id)}</link>            
            <pubDate>{$val.create_date_int|date_format:"%d-%m-%Y %H:%M:%S"}</pubDate>
            <dc:creator>Người đưa tin</dc:creator>  
            <guid isPermaLink="false">{$link_helper->link_to_news($val.meta_slug,$val.id)}</guid>
            <description><![CDATA[<a href="{$link_helper->link_to_news($val.meta_slug,$val.id)}"><img src="{$template_helper->get_thumb_image($val.images,130,100)}" width=130 height=100 /></a><br/>{$val.intro_text}]]></description>            
        </item>                          
        {/foreach}
    </channel>
</rss>       
{/if}