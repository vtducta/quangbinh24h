<?php
interface IModelEventInsert 
{
    public function before_insert($data);
    public function after_insert($data);
    public function on_insert_failure($data,$ex);
    public function on_insert_success($data);
}  

interface IModelEventUpdate 
{
    public function before_update($data,$condition);
    public function after_update($data,$condition);
    public function on_update_failure($data,$condition,$ex); 
    public function on_update_success($data,$condition);
}

interface IModelEventDelete 
{
    public function before_delete($condition); 
    public function after_delete($condition);  
    public function on_delete_failure($condition,$ex);
    public function on_delete_success($condition);
}
?>