<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"
      xsi:schemaLocation="
            http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

{foreach from=$data.content item=item}
  <url>
       <loc>{$link->link_to_news($item.meta_slug,$item.id)}</loc>
       <lastmod>{$item.create_date_int|date_format:"%Y-%m-%d"}T{date("H:i:s",$item.create_date_int)}+07:00</lastmod>
       <changefreq>always</changefreq>
       <priority>0.6400</priority>
       <video:video>
         <video:thumbnail_loc>{$item.thumb}</video:thumbnail_loc> 
         <video:title><![CDATA[{$item.title}]]></video:title>
         <video:description><![CDATA[{$item.intro_text}]]></video:description>
         <video:publication_date>{$item.create_date_int|date_format:"%Y-%m-%d"}</video:publication_date>
         <video:player_loc allow_embed="yes" autoplay="ap=1">{$item.link_video}</video:player_loc>         
         </video:video>
  </url>
{/foreach}
</urlset>