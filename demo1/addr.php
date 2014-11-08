<?php

require 'init.inc.php';

//接收表单的参数
if(isset($_POST['pid']) && $_POST['pid'] != ""){

	$pid = $_POST['pid'];
}

if(isset($_POST['p']) && $_POST['p'] != ""){

	$p = $_POST['p'];
}

if(isset($_POST['cid']) && $_POST['cid'] != ""){

	$cid = $_POST['cid'];
}

if(isset($_POST['c']) && $_POST['c'] != ""){

	$c = $_POST['c'];
}

if(isset($_POST['aid']) && $_POST['aid'] != ""){

	$aid = $_POST['aid'];
}

if(isset($_POST['a']) && $_POST['a'] != ""){

	$a = $_POST['a'];
}

if(isset($_POST['sid']) && $_POST['sid'] != ""){

	$sid = $_POST['sid'];

	$smarty->assign("sid",$sid);
}

if(isset($_POST['s']) && $_POST['s'] != ""){

	$s = $_POST['s'];

	$smarty->assign("s",$s);
}

$smarty->assign("pid",$pid);
$smarty->assign("p",$p);
$smarty->assign("cid",$cid);
$smarty->assign("c",$c);
$smarty->assign("aid",$aid);
$smarty->assign("a",$a);


$smarty->display("addr.html");