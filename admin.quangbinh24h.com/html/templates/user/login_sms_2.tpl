<script src="http://admincms.nguoiduatin.vn/js/app/Duo-Web-v1.bundled.min.js.js"></script>
{literal}
<script>
    Duo.init({
        'host': '{/literal}{$data.host}{literal}',
        'post_action':'sms.php',
        'username' : '{/literal}{$data.username}{literal}',
        'password' : '{/literal}{$data.userpass}{literal}',
        'sig_request':'{/literal}{$data.sig_request}{literal}' 
    });
</script>
{/literal}
<iframe id="duo_iframe" width="620" height="500" frameborder="0" allowtransparency="true" style="background: transparent;"></iframe>