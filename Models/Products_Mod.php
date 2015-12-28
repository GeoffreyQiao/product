<?php

class Products_Mod extends Model{
	public $table = 'products';

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
	}
	protected function findInsert($id){
		$sql = 'SELECT * FROM '.$this->table.' WHERE Id = '.$id;
		return $this->query($sql);
	}

	public function find($code){
		$sql = "SELECT * FROM $this->table WHERE barCode = $code";
		return $rs = $this->get_row($sql);
	}
}
