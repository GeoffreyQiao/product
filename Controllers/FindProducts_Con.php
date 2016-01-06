<?php

class FindProducts_Con{
	protected $barCode = null;
	public $productInfo = array();

	public function __construct($code){

		$this->barCode = $code;
		if (strlen($this->barCode)==13) {
			$this->findCode();
		}
		if (empty($this->productInfo['Id'])) {
			return false;
		}
		include ROOT . 'tpls'. DS . 'AddProducts.html';
	}

	protected function findCode(){
		$db = new Products_Mod();
		$this->productInfo = $db->find($this->barCode);
		// $rs = json_encode($rs);
	}
}
