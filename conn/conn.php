<?php

class opmysql{

    private $host = 'localhost';
    private $name = 'root';
    private $pwd = '';
    private $dBase = 'area';

    private $conn = '';
    private $result = '';
    private $msg = '';
    private $fields;
    private $fieldsNum = 0;
    private $rowsNum = 0;
    private $rowsRst = '';
    private $filesArray = array();
    private $rowsArray = array();


	function __construct($host = '',$name = '',$pwd = '',$dBase = ''){
		
		if($host!='')
			$this->host = $host;
		if($name!='')
			$this->name = $name;	
		if($pwd!='')
			$this->pwd = $pwd;
		if($dBase!='')
			$this->dBase = $dBase;
	}
	
	//连接数据库
	function init_conn() {
		$this->conn=@mysql_connect($this->host,$this->name,$this->pwd);
		@mysql_select_db($this->dBase,$this->conn);
		mysql_query("set names utf8");
	}
	
	//查询结果
	function mysql_query_rst($sql){
		if($this->conn == ''){
			$this->init_conn();
		}
		$this->result=@mysql_query($sql,$this->conn);
	}
	
	//返回查询记录数
	function getRowsNum($sql) {
		$this->mysql_query_rst($sql);
		if(mysql_errno() == 0){
			return @mysql_num_rows($this->result);
		}else{
			return '';
		}
	}
	
	//将查询结果输出成一个数组并返回（单条记录）
	function getRowsRst($sql) {
		$this->mysql_query_rst($sql);
		if(mysql_errno() == 0){
			$this->rowsRst = mysql_fetch_array($this->result,MYSQL_ASSOC);
			return $this->rowsRst;
		}else{
			return '';
		}
	}
	
	//将查询结果输出成一个含多条记录的二维数组并返回
	function getRowsArray($sql){
		$this->mysql_query_rst($sql);
		if(mysql_errno() == 0){
			while($row = mysql_fetch_array($this->result,MYSQL_ASSOC)){
				$this->rowsArray[] = $row;
			}
			return $this->rowsArray;
		}else{
			return '';
		}
	}
	
	//返回查询结果的特定字段
	function getFields($sql,$num){
		
		$this->mysql_query_rst($sql);
		if(mysql_errno() == 0){
			
			$this->rowsRst = mysql_fetch_array($this->result);
			return $this->rowsRst[$num];
		}else{
			return '';
		}
	}
	
	//返回增、删、改记录数，用来判断操作是否成功
	function uidRst($sql){
		if($this->conn == ''){
			$this->init_conn();
		}
		@mysql_query($sql);
		$this->rowsNum = @mysql_affected_rows();
		if(mysql_errno == 0){
			return $this->rowsNum;
		}else{
			return '';
		}
	}
	
	//错误提示
	function msg_error(){
		//return $this->msg = $php_errormsg;
		$this->msg = "错误";
		return $this->msg;
	}
	
	//释放结果集
	function close_rst(){
		mysql_free_result($this->result);
		$this->msg = '';
		$this->fieldsNum = 0;
		$this->rowsNum = 0;
		$this->filesArray = '';
		$this->rowsArray = '';
	}
	
	//关闭数据库
	function close_conn(){
		$this->close_rst();
		mysql_close($this->conn);
		$this->conn = '';
	}
}

$conne = new opmysql();
?>