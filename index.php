<?php

require 'init.inc.php';
$db = new index_Mod();
$constr = null;
if (!empty($_GET)) {
	foreach ($_GET as $k => $v) {
		$constr = $_GET[$k];
	}
	$constr .= '_Con';
	try {
		$con = @new $constr();
	} catch (Exception $e) {
		return false;
	}
}
