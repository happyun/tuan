<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<script type='text/javascript' src='http://localhost/SH_tuan/hdphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<link href="http://localhost/SH_tuan/hdphp/Extend/Org/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"><script src="http://localhost/SH_tuan/hdphp/Extend/Org/bootstrap/js/bootstrap.min.js"></script>
  <!--[if lte IE 6]>
  <link rel="stylesheet" type="text/css" href="http://localhost/SH_tuan/hdphp/Extend/Org/bootstrap/ie6/css/bootstrap-ie6.css">
  <![endif]-->
  <!--[if lte IE 7]>
  <link rel="stylesheet" type="text/css" href="http://localhost/SH_tuan/hdphp/Extend/Org/bootstrap/ie6/css/ie.css">
  <![endif]-->
<script type="text/javascript" src="http://localhost/SH_tuan/tuan/App/Admin/Tpl//Public/js/common.js"> </script>
<link href="http://localhost/SH_tuan/tuan/App/Admin/Tpl//Public/css/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<link href="http://localhost/SH_tuan/hdphp/Extend/Org/HdUi/css/hdui.css" rel="stylesheet" media="screen"><script src="http://localhost/SH_tuan/hdphp/Extend/Org/HdUi/js/hdui.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=AC37be9efe7459c38f04c34a964155a2"></script>
<script type="text/javascript" src="http://localhost/SH_tuan/tuan/App/Admin/Tpl//Public/js/shop.js"></script>

<div id="map">
	<span class='title'>添加商铺</span>
</div>
<div id="content">
	<form id="shopForm" action="<?php echo U('Admin/Shop/add');?>" method="post">
	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="20%">名称</th>
				<th>值</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>商铺名称</td>
				<td>
					<input type="text" name="shopname" />
				</td>
			</tr>
			<tr>
				<td>商铺地址</td>
				<td>
					<input type="text" name="shopaddress" />
				</td>
			</tr>
			<tr>
				<td>地铁地址</td>
				<td>
					<input type="text" name="metroaddress"/>
				</td>
			</tr>
			<tr>
				<td>商铺电话</td>
				<td>
					<input type="text" name="shoptel" />
				</td>
			</tr>
			<tr>
				<td>商铺坐标</td>
				<td>
					<input id="shopcoord" name="shopcoord" type="text" />
					<input id="getPoint" class='btn' type="button" value="获取坐标">
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class='btn' /></td>
			</tr>
		</tbody>
	</table>
	</form>
	
	
	
</div>
</body>
</html>