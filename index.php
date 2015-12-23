<?php

require 'init.inc.php';
$db = new index_Mod();
$constr = null;
print_r($_GET);
if (!empty($_GET)) {
	if (array_key_exists('Con', $_GET)) {
		try {
			$constr =$_GET['Con'].'_Con';
		} catch (Exception $e) {
			return false;
		}
	}
	if (array_key_exists('Code', $_GET)) {
		try {
			$rs = new $constr($_GET['Code']);
		} catch (Exception $e) {
			return false;
		}
		return $rs;
	}
}
