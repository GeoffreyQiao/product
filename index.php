<?php

require 'init.inc.php';
$constr = null;
if (!empty($_GET)) {
	if (isset($_GET['Con']) && !empty($_GET['Con'])){
		$constr = $_GET['Con'].'_Con';
	}
	if (isset($_GET['Code']) && !empty($_GET['Code'])) {
		try {
			$rs = new $constr($_GET['Code']);
		} catch (Exception $e) {
			return false;
		}
		// return $rs;
	}else {
		try {
			$rs = new $constr();
		} catch (Exception $e) {
			return false;
		}
		return $rs;
	}
}
