<?php
/**
	file:init.inc.php Smarty对象的实例化及初始化文件
*/

/* *********************Smarty设置*********************** */
//根目录路径方式，用于Smarty设置
define("ROOT",str_replace("\\","/",dirname(__FILE__))."/");

require ROOT.'libs/Smarty.class.php';
$smarty = new Smarty();

//Smarty3设置默认路径
$smarty ->setTemplateDir(ROOT.'templates/')
		->setCompileDir(ROOT.'templates_c/')
		->setPluginsDir(ROOT.'plugins/')
		->setCacheDir(ROOT.'cache/')
		->setConfigDir(ROOT.'configs');

$smarty->caching = false;
$smarty->cache_lifetime = 60*60*24; //模版缓存有效时间为1天
$smarty->left_delimiter = '<{';
$smarty->right_delimiter = '}>';

/***********************************************************/

//根目录url方式
$PHP_SELF=$_SERVER['PHP_SELF'];
$ROOT_URL='http://'.$_SERVER['HTTP_HOST'].substr($PHP_SELF,0,strrpos($PHP_SELF,'/')+1);
define(ROOT_URL,$ROOT_URL);

//模版目录url方式
define("Template_Dir",$ROOT_URL.'templates');