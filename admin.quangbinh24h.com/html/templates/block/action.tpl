<div class="centerContent">                                 
    <ul class="bigBtnIcon">                                
    {if $data.group_user eq 4}
        <li>
            <a href="{$link_helper->linkhome('AcpAddNews')}">
                <span class="icon brocco-icon-pencil"></span>
                <span class="txt">Viết bài mới</span>                                       
            </a>
        </li>
         <li>
            <a href="{$link_helper->linkhome('AcpNotPublic')}" title="Bài đã chờ duyệt" class="pattern tipB">
                <span class="icon brocco-icon-clock"></span>
                <span class="txt">Bài chờ duyệt</span>  
                <span class="notification blue">{$data.total.no_public}</span>             
            </a>
        </li>
        <li>
            <a href="{$link_helper->linkhome('AcpHome')}" title="Bài đã được đăng" class="pattern tipB">
                <span class="icon brocco-icon-play"></span>
                <span class="txt">Bài đã public</span>
                <span class="notification green">{$data.total.public}</span>
            </a>
        </li>
         <li>
            <a href="{$link_helper->linkhome('AcpTimer')}" title="Bài hẹn giờ" class="pattern tipB">
                <span class="icon brocco-icon-alarm"></span>
                <span class="txt">Bài hẹn giờ</span>
                <span class="notification green">{$data.total.timer}</span>
            </a>
        </li>
        <li>
            <a href="{$link_helper->linkhome('Royalties')}" title="Nhuận bút" class="pattern tipB">
                <span class="icon brocco-icon-plus"></span>
                <span class="txt">Nhuận bút</span>                
            </a>
        </li>
    {elseif $data.group_user eq 1}
        <li>
            <a href="{$link_helper->linkhome('AdminAdd')}">
                <span class="icon brocco-icon-pencil"></span>
                <span class="txt">Viết bài mới</span>                                       
            </a>
        </li>
        <li>
            <a href="{$link_helper->linkhome('AdminNotPublic')}" title="Bài đã chờ duyệt" class="pattern tipB">
                <span class="icon brocco-icon-pause"></span>
                <span class="txt">Bài chờ duyệt</span>  
                <span class="notification blue">{$data.total_user.no_public}</span>             
            </a>
        </li>
        <li>
            <a href="{$link_helper->linkhome('AdminHome')}" title="Bài đã được đăng" class="pattern tipB">
                <span class="icon brocco-icon-play"></span>
                <span class="txt">Bài đã public</span> 
                <span class="notification green">{$data.total_user.public}</span>                            
            </a>
        </li>
    {/if}
        <li>
            <a href="{$link_helper->linkhome('AddEvent')}" title="Tạo sự kiện"  class="tipB">
                <span class="icon brocco-icon-calendar"></span>
                <span class="txt">Tạo sự kiện</span>
                <span class="notification gray">{$data.total.event}</span>
            </a>
        </li>                               
        <li>
            <a href="{$link_helper->linkhome('NewsComment')}" title="Quản lý comment" class="pattern tipB">
                <span class="icon cut-icon-comment "></span>
                <span class="txt">Comment</span>            
            </a>
        </li>    
    </ul>
</div>
