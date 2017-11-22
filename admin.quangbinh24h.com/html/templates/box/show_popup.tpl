 <table class="responsive table table-bordered" id="checkAll">
    <thead>
      <tr>
        <th>Loại</th>                                            
        <th>Vị trí</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
 
    {foreach from=$data.list_box item=val key=k}
      <tr>
        <td>
            {$val.type}
        </td>
        <td>{$val.name}</td>
        <td id="set_hot_news{$val.id}">      
            {if !in_array($val.id,$data.list_box_art)}    
                <button data-toggle="modal" type="button" class="btn btn-info btn-large" style="width: 100px;font-size: 15px; font-weight: bold;" onclick="set_news_hot({$val.id},{$data.news_id},'set_pos')">Set vị trí</button>
            {else}
                <button data-toggle="modal" type="button" class="btn btn-mini" style="width: 100px; font-size: 15px; font-weight: bold; height: 38px; border: 1px solid;" onclick="set_news_hot({$val.id},{$data.news_id},'delete_pos')" >Hạ xuống</button>
            {/if}
        </td>
      </tr> 
    {/foreach}
    </tbody>
</table>