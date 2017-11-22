<!DOCTYPE html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="REFRESH" content="1800" />
    <title>{if $data.object.title}{$data.object.title}{else}{/if}</title>
    <meta name="keywords" content="{if isset($data.object.meta_keyword)}{$data.object.meta_keyword}{/if}">
    <meta name="description" content="{if isset($data.object.meta_description)}{$data.object.meta_description}{/if}">
    <meta property="og:title" content="{if isset($data.object.facebook)}{$data.object.facebook}{else}{if isset($data.object.title)}{$data.object.title}{else}{/if}{/if}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{if isset($data.flag_fb_image)}{$data.news_content_thumb}{else}http://danang24h.vn/images/default/logo-ndt-400-300.png{/if}"/>
    <meta property="og:site_name" content="Nghệ An 24h"/>
    <meta property="og:description”" content="{if isset($data.object.facebookDesc)}{$data.object.facebookDesc}{else}{if isset($data.object.meta_description)}{$data.object.meta_description}{/if}{/if}"/>
    
    {if isset($data.object.site) and $data.object.site == 'Home'}
    <meta property="og:url" content="http://danang24h.vn/" />
    <meta http-equiv="REFRESH" content="1800" />
    <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
    <meta name="DC.title" content="{if isset($data.object.title)}{$data.object.title}{else}{/if}" />
    <meta name="DC.identifier" content="//danang24h.vn/" />
    <meta name="DC.description" content="{if isset($data.object.meta_description)}{$data.object.meta_description}{/if}" />
    <meta name="DC.subject" content=" {if isset($data.object.meta_keyword)}{$data.object.meta_keyword}{/if}"/>
    <meta name="DC.language" content="VN" />
    <link rel="canonical" href="http://danang24h.vn/" />    
    <link rel="alternate" media="handheld" href="http://mdanang24h.vn/" />
    <meta name="distribution" content="Global" />
    {/if}
    <meta name="author" content="http://danang24h.vn/" />
    <meta name="RATING" content="GENERAL" />
    <meta name="REVISIT-AFTER" content="1 DAYS" />
    <meta name="RATING" content="GENERAL" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {if isset($data.noindex)}
    <meta name="robots" content="noindex,nofollow" />
    {else}
    <meta name="robots" content="index,follow,noodp" />
    {/if}
    <link rel="shortcut icon" href="/images/favicon.ico?2" type="image/x-icon" />
    
    <link rel="stylesheet" href="/css/font-awesome.min66b4.css">
    <link rel="stylesheet" href="/css/bootstrap66b4.css">
    <link rel="stylesheet" href="/css/small-business66b4.css">
    <link rel="stylesheet" href="/css/styles_3.42.04011566b4.css?v=14">
    <link rel="stylesheet" href="/css/style-201666b4.css?v=1">
    <link rel="stylesheet" href="/css/jquery.bxslider.css">
    
    <script src="/js/jquery.min.js"></script>
    <script src="/js/global.js"></script>
    <script src="/js/news.js"></script>
    <script src="/js/jquery.bxslider.min.js"></script>
    {literal}
     <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-106772086-1', 'auto');
  ga('send', 'pageview');

</script>
    {/literal}
    {literal}
    <script src="https://apis.google.com/js/platform.js" async defer>
      {lang: 'vi'}
    </script>
    {/literal}



</head>
<body>
<div id="myvne_taskbar"></div>
