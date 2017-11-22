{if $data.group_user eq 4}
<div class="mainnav">
    <ul>                        
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 brocco-icon-list"></span>Bài viết</a>
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->linkhome('AcpAddNews')}"><span class="icon16 brocco-icon-pencil"></span>Thêm tin mới</a></li>
                <li><a href="{$link_helper->linkhome('AcpNotPublic')}"><span class="icon16 brocco-icon-clock"></span>Bài chờ duyệt</a></li>
                <li><a href="{$link_helper->linkhome('AcpHome')}"><span class="icon16 brocco-icon-refresh"></span>Bài đã đăng</a></li>    
                <li><a href="{$link_helper->linkhome('AcpTimer')}"><span class="icon16 brocco-icon-alarm"></span>Bài hẹn giờ</a></li>
                <li><a href="{$link_helper->linkhome('AcpNewsDraft')}"><span class="icon16 brocco-icon-trashcan"></span>Bài lưu tạm</a></li>
                <li><a href="{$link_helper->linkhome('MyPost')}"><span class="icon16 brocco-icon-user"></span>Bài Của tôi</a></li>   
                <li><a href="{$link_helper->linkhome('AcpNewsDeleted')}"><span class="icon16 brocco-icon-database"></span>Bài tạm xóa</a></li>       
            </ul>
        </li>
        <li class="dropdown"><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-light-bulb"></span>Quản lý tác giả</a>
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->link_admin('ListJournalist')}"><span class="icon16 icomoon-icon-diamond"></span>Danh sách tác giả</a></li>
                <li><a href="{$link_helper->link_admin('CreateJournalist')}"><span class="icon16 icomoon-icon-pencil-2"></span>Tạo tác giả</a></li>    
            </ul>
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-users"></span>Quản lý nguồn bài viết</a>
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->link_source('manage')}"><span class="icon16 entypo-icon-users"></span>Danh sách nguồn bài viết</a></li>
                <li><a href="{$link_helper->link_source('add')}"><span class="icon16 entypo-icon-add"></span>Thêm nguồn bài viết</a>
            </ul>
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-email"></span>Quản lý sự kiện</a>
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->linkhome('ListEvent')}"><span class="icon16  icomoon-icon-enter-2 "></span>Danh sách sự kiện</a></li>      
                <li><a href="{$link_helper->linkhome('AddEvent')}"><span class="icon16 brocco-icon-pencil"></span>Thêm sự kiện</a></li>                  
            </ul>
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-share"></span>Quản lý chuyên mục</a>    
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->linkhome('ListCategory')}"><span class="icon16 entypo-icon-bookmark"></span>Danh sách chuyên mục</a></li>    
                <li><a href="{$link_helper->linkhome('CategoryAdd')}"><span class="icon16 brocco-icon-pencil"></span>Thêm chuyên mục</a></li> 
            </ul>    
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-users"></span>Quản lý thành viên</a>
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->linkhome('ListUser')}"><span class="icon16 entypo-icon-users"></span>Danh sách thành viên</a></li>
                <li><a href="{$link_helper->linkhome('AddUser')}"><span class="icon16 entypo-icon-add"></span>Thêm thành viên </a>
            </ul>
        </li>
        <li><a href="/?act=ListAdvertise" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-users"></span>Quản lý quảng cáo</a></li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 brocco-icon-list"></span>Quản lý video</a>
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->linkhome('VideoAddHtml5')}"><span class="icon16 brocco-icon-pencil"></span>Thêm video</a></li>
                <li><a href="{$link_helper->linkhome('VideoListHtml5')}"><span class="icon16 brocco-icon-refresh"></span>Danh sách video</a></li>    
            </ul>
        </li>
    </ul>
</div>
{elseif $data.group_user eq 1}
<div class="mainnav">
    <ul>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 brocco-icon-list"></span>Bài viết</a>
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->linkhome('AdminAdd')}"><span class="icon16 brocco-icon-pencil"></span>Viết bài mới</a></li>
                <li><a href="{$link_helper->linkhome('AdminNotPublic')}"><span class="icon16 brocco-icon-list"></span>Bài nhận duyệt</a></li>        
                <li><a href="{$link_helper->linkhome('AdminHome')}"><span class="icon16 brocco-icon-pointer"></span>Bài đã đăng </a></li>
                <li><a href="{$link_helper->linkhome('AdminTimer')}"><span class="icon16 brocco-icon-alarm"></span>Bài hẹn giờ</a></li>     
                <li><a href="{$link_helper->linkhome('MyPost')}"><span class="icon16 brocco-icon-user"></span>Bài Của tôi</a></li>   
                <li><a href="{$link_helper->linkhome('AdminNewsDraft')}"><span class="icon16 brocco-icon-trashcan"></span>Bài lưu tạm</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-light-bulb"></span>Quản lý tác giả</a>
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->link_admin('ListJournalist')}"><span class="icon16 icomoon-icon-diamond"></span>Danh sách tác giả</a></li>
                <li><a href="{$link_helper->link_admin('CreateJournalist')}"><span class="icon16 icomoon-icon-pencil-2"></span>Tạo tác giả</a></li>    
            </ul>
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-users"></span>Quản lý nguồn bài viết</a>
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->link_source('manage')}"><span class="icon16 entypo-icon-users"></span>Danh sách nguồn bài viết</a></li>
                <li><a href="{$link_helper->link_source('add')}"><span class="icon16 entypo-icon-add"></span>Thêm nguồn bài viết</a>
            </ul>
        </li>
        <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 brocco-icon-list"></span>Quản lý video</a>
            <ul class="sub" style="display:block">
                <li><a href="{$link_helper->linkhome('VideoAddHtml5')}"><span class="icon16 brocco-icon-pencil"></span>Thêm video</a></li>
                <li><a href="{$link_helper->linkhome('VideoListHtml5')}"><span class="icon16 brocco-icon-refresh"></span>Danh sách video</a></li>    
            </ul>
        </li>
    </ul>
</div>
{elseif $data.group_user eq 2 || $data.group_user eq 5}
<ul>
    <li>
        <a href="#"  style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-alert"></span>Bài viết</a>
        <ul class="sub" style="display:block">
            <li><a href="{$link_helper->linkhome('BtvHome')}"><span class="icon16 brocco-icon-list"></span>Bài nhận duyệt</a></li>
            <li><a href="{$link_helper->linkhome('BtvAdd')}"><span class="icon16 brocco-icon-pencil"></span>Viết bài mới</a></li>
            <li><a href="{$link_helper->linkhome('NewsTimer')}"><span class="icon16 brocco-icon-alarm"></span>Bài hẹn giờ</a></li>
            <li><a href="{$link_helper->linkhome('BtvNewsDraft')}"><span class="icon16 brocco-icon-switch"></span>Bài lưu tạm</a></li>
            <li><a href="{$link_helper->linkhome('BtvNewsPublic')}"><span class="icon16 brocco-icon-play"></span>Bài public của bạn</span></a></li> 
            {if $data.group_user eq 5}
            <li><a href="{$link_helper->linkhome('BtvNewsPublicAll')}"><span class="icon16 brocco-icon-play"></span>Danh sách bài xuất bản</span></a></li>
            {/if}
            <li><a href="{$link_helper->linkhome('BtvNotPublic')}"><span class="icon16 brocco-icon-warning"></span>Bài Chờ TKTS duyệt</a></li>
            <li><a href="{$link_helper->linkhome('BtvNewsOff')}"><span class="icon16 brocco-icon-refresh"></span>Danh sách bài trả về</a></li>
        </ul>
    </li>
    <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 entypo-icon-users"></span>Quản lý nguồn bài viết</a>
        <ul class="sub" style="display:block">
            <li><a href="{$link_helper->link_source('manage')}"><span class="icon16 entypo-icon-users"></span>Danh sách nguồn bài viết</a></li>
            <li><a href="{$link_helper->link_source('add')}"><span class="icon16 entypo-icon-add"></span>Thêm nguồn bài viết</a>
        </ul>
    </li>
    <li><a href="#" style="color:black;font-weight: bold;"><span class="icon16 brocco-icon-list"></span>Quản lý video</a>
        <ul class="sub" style="display:block">
            <li><a href="{$link_helper->linkhome('VideoAddHtml5')}"><span class="icon16 brocco-icon-pencil"></span>Thêm video</a></li>
            <li><a href="{$link_helper->linkhome('VideoListHtml5')}"><span class="icon16 brocco-icon-refresh"></span>Danh sách video</a></li>    
        </ul>
    </li>
</ul>
{elseif $data.group_user eq 3}
<ul>
    <li><a href="{$link_helper->linkhome('ReporterAdd')}"><span class="icon16 brocco-icon-pencil"></span>Viết bài mới</a></li>        
    <li><a href="{$link_helper->linkhome('HomeReporter')}"><span class="icon16 brocco-icon-list"></span>Bài đã public</a></li>
    <li><a href="{$link_helper->linkhome('ReporterDraft')}"><span class="icon16 brocco-icon-switch"></span>Bài lưu tạm</a></li>
    <li><a href="{$link_helper->linkhome('ReporterWait')}"><span class="icon16 brocco-icon-warning"></span>Bài Chờ BTV duyệt</a></li>        
    <li><a href="{$link_helper->linkhome('ReporterOff')}"><span class="icon16 brocco-icon-refresh"></span>Danh sách bài trả về</a></li>
</ul>
{/if}
