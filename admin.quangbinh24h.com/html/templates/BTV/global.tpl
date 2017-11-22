<div class="centerContent">                                 
    <ul class="bigBtnIcon">                                
        <li>
            <a href="{$link_helper->linkhome('BtvAdd')}">
                <span class="icon brocco-icon-pencil"></span>
                <span class="txt">Viết bài mới</span>                                       
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" title="Tổng số bài đã viết" class="pattern tipB">
                <span class="icon brocco-icon-clock"></span>
                <span class="txt">Số bài đã viết</span>  
                <span class="notification blue">{if $data.static.total}{$data.static.total}{else}0{/if}</span>             
            </a>
        </li>
        <li>
            <a href="{$link_helper->linkhome('BtvNewsPublic')}" title="Bài đã được đăng" class="pattern tipB">
                <span class="icon brocco-icon-play"></span>
                <span class="txt">Bài đã public</span>
                <span class="notification green">{if $data.static.total_public}{$data.static.total_public}{else}0{/if}</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" title="Bài Chờ duyệt" class="pattern tipB">
                <span class="icon brocco-icon-alarm"></span>
                <span class="txt">Bài chờ duyệt</span>
                <span class="notification green">{$data.static.total_not_public}</span>
            </a>
        </li>    
    </ul>
</div>