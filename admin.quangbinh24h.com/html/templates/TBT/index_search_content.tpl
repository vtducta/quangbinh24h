<!doctype html>
<html>
<head>
<title>Search</title>
</head>
<body>
    <center>
        <h3>Search Content</h3>
        <form action="" method="get">
            <label>Nhập từ khóa muốn tìm kiếm</label>
            <input type="text" name="content"/>
            <input type="submit" value="Go">
        </form>
    </center>
    {if $data.result}
    <center>
        <table>
            <tr>
                <th></th>
                <th>Tiêu đề</th>
                <th>Chuyên mục</th>
                <th>Người viết</th>
                <th>Edit bài</th>
            </tr>
            <tr>
                {foreach from=$data.result item=val name=foo}
                    <td><input type="checkbox" name="checkbox" value="{$val.id}"></td> 
                    <td>{$val.title}</td> 
                    <td>{$val.category}</td> 
                    <td>{$val.category}</td> 
                {/foreach}
            </tr>
            
        </table>
    </center>
    {/if}
</body>
</html>