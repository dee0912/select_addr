<?php

require '../conn/conn.php';

//初始加载所有的省份信息
if($_POST['city']){

	$sql = "select provinceID,province from province order by id asc";

	if( $num = $conne->getRowsNum($sql) > 0 ){
	
		$rows = $conne->getRowsArray($sql);
		
		//把二维数组转换成json格式
		echo json_encode($rows);
	}
}

//当接收到post的pid，加载城市信息
if( isset($_POST['pid']) && $_POST['pid']!="请选择省份" ){

	$sql = "select cityID,city from city where father = ".$_POST['pid']." order by id asc";

	if( $conne->getRowsNum($sql) > 0 ){
	
		$rows = $conne->getRowsArray($sql);
		
		//把二维数组转换成json格式
		echo json_encode($rows);
	}
}

//当接收到post的cid，加载地区信息
if( isset($_POST['cid']) && $_POST['cid']!="请选择城市" ){

	$sql = "select areaID,area from area where father = ".$_POST['cid']." order by id asc";

	if( $conne->getRowsNum($sql) > 0 ){
	
		$rows = $conne->getRowsArray($sql);
		
		//把二维数组转换成json格式
		echo json_encode($rows);
	}
}

//当接收到post的aid，查看是否还有下一级
if( isset($_POST['aid']) && $_POST['aid']!="选择区县" ){

	$sql = "select streetID,street from street where father = ".$_POST['aid']." order by id asc";

	if( $conne->getRowsNum($sql) > 0 ){
	
		$rows = $conne->getRowsArray($sql);
		
		//把二维数组转换成json格式
		echo json_encode($rows);
	}
}