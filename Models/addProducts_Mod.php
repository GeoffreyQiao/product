<?php

class addProducts_Mod extends Model{
	protect $table = 'products';

	public function add($data){
		$sql = $this->get_insert_db_sql($this->table, $data);
		$rs  = $this->query($sql);
		if ($rs && $this->affected_rows()) {
			echo '<h3>Success!</h3><br/><p>商品添加成功！商品ID:'.$this->last_id().'</p>';
			return $this->findInsert($this->last_id());
		}else {
			echo '<h3 style="color:red">商品添加失败！</h3>';
			return false;
		}
		protect function findInsert($id){
			$sql = 'SELECT * FROM '.$this->table.' WHERE Id = '.$id;
			return $this->query($sql);
		}
	}
}
