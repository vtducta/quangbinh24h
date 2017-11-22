<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
      xsi:schemaLocation="
            http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
  {foreach from=$data.content item=item}
      <url>
            {$item.tags = str_replace(",","aa",$item.tags)}
            {$item.tags=htmlspecialchars($item.tags,ENT_QUOTES)}
            {$item.tags=str_replace("aa",",",$item.tags)}
           <loc>{$link->link_to_news($item.meta_slug,$item.id)}</loc>
           <lastmod>{$item.create_date_int|date_format:"%Y-%m-%d"}T{date("H:i:s",$item.create_date_int)}+07:00</lastmod>
           <news:news>
             <news:publication>               
               <news:name>Người Đưa Tin</news:name>
               <news:language>vi</news:language>
             </news:publication>
             <news:publication_date>{$item.create_date_int|date_format:"%Y-%m-%d"}T{date("H:i:s",$item.create_date_int)}+07:00</news:publication_date>
             <news:title>{$item.title|replace:'&':'&amp;'}</news:title>
             <news:keywords>{$item.category}{if $item.tags},{$item.tags}{/if}</news:keywords>
           </news:news>
      </url>
  {/foreach}  
</urlset>