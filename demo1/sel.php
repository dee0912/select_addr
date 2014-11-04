<?php

require '../conn/conn.php';

//初始加载所有的省份信息
if($_POST['city']){

	$sql = "select provinceID,province from province order by id desc";

	if( $conne->getRowsNum($sql) > 0 ){
	
		$rows = $conne->getRowsArray($sql);
		
		//把二维数组转换成json格式
		echo json_encode($rows);
	}
}

//当接收到post的pid，加载城市信息
if( isset($_POST['pid']) && $_POST['pid']!="选择省份" ){

	$sql = "select cityID,city from city where father = ".$_POST['pid']." order by id desc";

	if( $conne->getRowsNum($sql) > 0 ){
	
		$rows = $conne->getRowsArray($sql);
		
		//把二维数组转换成json格式
		echo json_encode($rows);
	}
}