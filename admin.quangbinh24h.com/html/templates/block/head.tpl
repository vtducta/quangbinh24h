<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- THIS IS DOWNLOADED FROM WWW.SXRIPTGATES.COM - SO THIS IS YOUR NEW SITE FOR DOWNLOAD SCRIPT ;) -->
    <title>{if isset($data.object.title)}{$data.object.title}{else}WeAdmin | Dashboard{/if}</title>
    <meta name="Referrer" content="origin">
    <meta name="author" content="SuggeElson" />
    <meta name="description" content="Nguoi dua tin, dua tin nhanh" />
    <meta name="keywords" content="Nguoi dua tin, dua tin nhanh" />   
     <meta name="robots" content="noindex" />
   
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Le styles -->
    <!-- Use new way for google web fonts 
    http://www.smashingmagazine.com/2012/07/11/avoiding-faux-weights-styles-google-web-fonts -->
    <!-- Headings -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' />  -->
    <!-- Text -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' /> --> 
    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->

    <link href="{$GUrl.Base}/css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="{$GUrl.Base}/css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />    
    <link href="{$GUrl.Base}/css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css" />
    <link href="{$GUrl.Base}/css/icons.css" rel="stylesheet" type="text/css" />    
    <link href="{$GUrl.Base}/css/bootstrap/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />       
    
    <!-- Plugin stylesheets -->
    <link href="{$GUrl.Base}/plugins/qtip/jquery.qtip.css" rel="stylesheet" type="text/css" />
    <link href="{$GUrl.Base}/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <link href="{$GUrl.Base}/plugins/jpages/jPages.css" rel="stylesheet" type="text/css" />
    <link href="{$GUrl.Base}/plugins/prettify/prettify.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/inputlimiter/jquery.inputlimiter.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/ibutton/jquery.ibutton.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/uniform/uniform.default.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/color-picker/color-picker.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/select/select2.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/validate/validate.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/pnotify/jquery.pnotify.default.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/pretty-photo/prettyPhoto.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/smartWizzard/smart_wizard.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/dataTables/jquery.dataTables.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/elfinder/elfinder.css" type="text/css" rel="stylesheet" />
    <link href="{$GUrl.Base}/plugins/plupload/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" rel="stylesheet" />    
    <link rel="stylesheet" href="{$GUrl.Css}default/token-input.css" type="text/css" />
    <link rel="stylesheet" href="{$GUrl.Css}default/token-input-facebook.css" type="text/css" />        

    <!-- Main stylesheets -->
    <link href="{$GUrl.Base}/css/main.css?1" rel="stylesheet" type="text/css" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]--> 
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico?2" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png" />
    <script type="text/javascript">
        //adding load class to body and hide page
        document.documentElement.className += 'loadstate';                
    </script>        
    <script type="text/javascript" src="{$GUrl.Js}jquery.min.js"></script>
     
    
        
    <!-- Le javascript ================================================== -->    
    <script type="text/javascript" src="js/bootstrap/bootstrap.js"></script>  
    
    <!--<script type="text/javascript" src="{$GUrl.Js}jquery-ui.js"></script> -->     
    
   <!-- <script type="text/javascript" src="plugins/touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="plugins/ios-fix/ios-orientationchange-fix.js"></script>      -->
    
    
    <script type="text/javascript" src="{$GUrl.Js}jquery.tokeninput.js?1"></script>     
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="{$GUrl.Js}bootstrap-datetimepicker.min.js"></script>
    <!-- smoke_js -->
    <link rel="stylesheet" href="{$GUrl.Base}/plugins/smoke/themes/gebo.css" />
    <!-- Load plugins -->
    <script type="text/javascript" src="{$GUrl.Base}/plugins/smoke/smoke.js"> </script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/qtip/jquery.qtip.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/flot/jquery.flot.grow.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/flot/jquery.flot.tooltip_0.4.4.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/knob/jquery.knob.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/prettify/prettify.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/watermark/jquery.watermark.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/elastic/jquery.elastic.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/inputlimiter/jquery.inputlimiter.1.3.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/maskedinput/jquery.maskedinput-1.3.min.js"></script>
          
    <script type="text/javascript" src="{$GUrl.Base}/plugins/uniform/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/stepper/ui.stepper.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/color-picker/colorpicker.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/timeentry/jquery.timeentry.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/select/select2.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/dualselect/jquery.dualListBox-1.3.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/animated-progress-bar/jquery.progressbar.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/pnotify/jquery.pnotify.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/lazy-load/jquery.lazyload.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/jpages/jPages.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/pretty-photo/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/smartWizzard/jquery.smartWizard-2.0.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/ios-fix/ios-orientationchange-fix.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/elfinder/elfinder.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/plupload/plupload.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/plupload/plupload.html4.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>    
    <script type="text/javascript" src="{$GUrl.Base}/plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>    
    <script src="{$GUrl.Base}/js/jquery.ajax.form.js"></script>
   
    <!-- Important Place before main.js -->
    <script type="text/javascript" src="{$GUrl.Js}jquery-ui.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/plugins/ibutton/jquery.ibutton.min.js?vdd"></script> 
              <script type="text/javascript" src="{$GUrl.Js}jquery-ui.min.js"></script>
    <script type="text/javascript" src="{$GUrl.Base}/js/main.js"></script>      
    <!-- word counter        -->
        <script src="{$GUrl.Js}jquery.simplyCountable.js"></script>     
        {literal}
        <script>
        $(document).ready(function()
        {
          $('#meta_title').simplyCountable({
            counter: '#counter_title',
            strictMax :true,
            maxCount: 68,
            countDirection: 'down'
          });
          
          /*$('#id_title').simplyCountable({
            counter: '#counter_id_title',
            strictMax :true,
            maxCount: 68,
            countDirection: 'down'
          });*/
          
          $('#meta_description').simplyCountable({
                counter: '#counter_description',
                strictMax :true,
                maxCount: 160,
                countDirection: 'down'
          });
              
           $('#short_desc').simplyCountable({
            counter: '#counter_sapo',
            strictMax :true,
            maxCount: 200,
            countDirection: 'down'
          });
       
       
          });
          
         
        </script>
        <style>
        li.token-input-token-facebook p {
    display: block;
    margin: 0;
    padding: 0;
    white-space: normal;
}
        </style>
        {/literal}  
</head>      
<body>