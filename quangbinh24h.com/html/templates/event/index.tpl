{include file='block/head.tpl'}
<div class="wrap">
        <div class="wrap-inner">
        {include file='block/header.tpl'}
            <div class="pContent">
                <div class="pContent-inner">
                    {include file='block/top.tpl'}
                    {include file='block/search.tpl'}
                    <div class="pTag pkg">
                        <div class="pkg">
                            <div class="alpha left">                               
                                {include file='event/content.tpl'}
                            </div><!--alpha-->
                            <div class="beta right">                        
                                {include file='view/right_content.tpl'}
                            </div><!--beta-->
                        </div>                            
                    </div><!--alpha-->                    
                </div><!--pContent-inner-->
            </div><!--pContent-->
            {include file='block/footer.tpl'}
        </div><!--wrap-inner-->
</div><!--wrap-->
</body>
</html>