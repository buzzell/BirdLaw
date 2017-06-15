<?php
	$slug = $_REQUEST['slug'];
	$json = substr(file_get_contents('../js/list.js'), 13);
	$json = substr($json, 0,  -1);
	$list = json_decode($json, true);
	foreach($list as $v){
		if($v['slug'] == $slug){
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($v);
			break;
		}
	}
?>