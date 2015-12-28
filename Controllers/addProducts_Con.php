<?php

class addProducts_Con{
	protected $dataList = array();
	public function __construct(){
		include ROOT . 'tpls'. DS . 'AddProducts.html';
	}
	public function addProducts($col = 'barCode', $v){
		$db = new Products_Mod();
		if ($res = $db->add($dataList)) {
		}
	}

	public function __set($k, $v){
		$this->dataList[$k] = $v;
	}

	public function __get($k){
		if (array_key_exists($k, $this->dataList)) {
			return $this->dataList[$k];
		}
		return null;
	}
}
