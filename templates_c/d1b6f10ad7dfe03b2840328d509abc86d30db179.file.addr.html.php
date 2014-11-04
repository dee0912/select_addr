<?php /* Smarty version Smarty-3.1.18, created on 2014-11-04 09:54:15
         compiled from "addr.html" */ ?>
<?php /*%%SmartyHeaderCode:774354583b21cb7474-11331551%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1b6f10ad7dfe03b2840328d509abc86d30db179' => 
    array (
      0 => 'addr.html',
      1 => 1415094854,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '774354583b21cb7474-11331551',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54583b21d1fa51_57459009',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54583b21d1fa51_57459009')) {function content_54583b21d1fa51_57459009($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>传统形式动态添加的多级联动菜单</title>
<script src="js/jquery-1.8.3.min.js"></script>
</head>
<body>

	<form id="select-form">
	
		<!-- 第一级 省份 -->
		<select id="province">	
			<option>选择省份</option>
		</select>

		<!-- 第一级 城市 初始状态不可用 -->
		<select id="city" disabled>	
			<option>选择城市</option>
		</select>

		<!-- 第一级 区县 初始状态不可用 -->
		<select id="area" disabled>	
			<option>选择区县</option>
		</select>
		
		<!-- 隐藏域 -->
		<input type="hidden" id="pid">
		<input type="hidden" id="cid">
		<input type="hidden" id="aid">

	</form>

</body>
<script>

	$(function(){
	
		//ajax方式加载省份
		$.post("sel.php",{
			city:true
		},function(data,textStatus){
		
			//接收json数据
			var dataObj = eval("("+data+")"); //转换为json对象 

			$.each(dataObj,function(idx,item){ 
									 
				$option_new = $("<option value=\""+item.provinceID+"\">"+item.province+"</option>");
				$option_new.insertAfter($("#province").children(":first"));
			})

		});

		
		//选择省份
		$("#province").bind("change",function(){
		
			//遍历option
			$(this).children().each(function(){

				if($(this).val() == $(this).parent().val()){

					//选中该条
					$(this).attr("selected",true);
					
					//把该条的id放入隐藏域
					$("#pid").val($(this).val());
				}else{
				
					//没有选中的去掉之前的selected
					$(this).removeAttr("selected");
				}

			});

			//选中省份之后，使用ajax获取城市菜单
			$.post("sel.php",{
				pid : $("#pid").val()
			},function(data,textStatus){
			
				//如果有返回值
				if(data){

					//城市菜单可用
					$("#city").attr("disabled",false);

					//接收json数据
					var dataObj = eval("("+data+")"); //转换为json对象 

					$.each(dataObj,function(idx,item){ 
											 
						$option_new = $("<option value=\""+item.cityID+"\">"+item.city+"</option>");
						$option_new.insertAfter($("#city").children(":first"));
					})
				}else{
				
					//没有返回值，说明第一级菜单没有选中省份
					//城市菜单恢复默认而且不可用
					$("#city").children().removeAttr("selected");
					$("#city").attr("disabled",true);
				}
			});

		});

	});

</script>
</html><?php }} ?>
