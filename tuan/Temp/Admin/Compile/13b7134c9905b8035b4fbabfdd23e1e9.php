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
<script type="text/javascript" src="http://localhost/SH_tuan/tuan/App/Admin/Tpl//Public/js/locality.js"></script>
<div id="map">
	<span class='title'>添加地区</span>
</div>
<div id="content">
	<form id="localityForm" action="<?php echo U('Admin/Locality/add');?>" method="post">
	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="20%">名称</th>
				<th>值</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>所属地区</td>
				<td>
					<select name="pid">
						<option value="<?php echo $parent['lid'];?>"><?php echo $parent['lname'];?></option>
						<option value="0">顶级地区</option>
						<?php if(is_array($level)):?><?php  foreach($level as $v){ ?>
							<option value="<?php echo $v['lid'];?>">|<?php echo $v['html'];?><?php echo $v['lname'];?></option>
						<?php }?><?php endif;?>
					</select>
					
					
				</td>
			</tr>
			<tr>
				<td>地区名称</td>
				<td>
					<input type="text" name="lname" />
				</td>
			</tr>
			<tr>
				<td>地区排序</td>
				<td>
					<input name="sort" type="text" />
				</td>
			</tr>
			<tr>
				<td>是否显示</td>
				<td>
					<lable>
						<input type="radio" name="display" checked=true value="1"/>	
						<span>显示</span>
					</lable>
					<lable>
						<input type="radio" name="display" value="0"/>	
						<span>隐藏</span>
					</lable>
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