<?php

class FindProducts_Con{
	public function __construct($barCode){
		if (strlen($barCode)==13) {
			$this->findCode($barCode);
		}
	}

	public function findCode($code){
		$db = new Products_Mod();
		return $db->find($code);
	}
}
