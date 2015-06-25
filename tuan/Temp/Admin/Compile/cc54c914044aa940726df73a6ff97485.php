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
<script type="text/javascript" src="http://localhost/SH_tuan/tuan/App/Admin/Tpl//Public/js/category.js"></script>
<div id="map">
	<span class='title'>添加分类</span>
</div>
<div id="content">
	<form id="categoryForm" action="<?php echo U('Admin/Category/edit');?>/cid/<?php echo $category['cid'];?>" method="post">
	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="20%">名称</th>
				<th>值</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>所属分类</td>
				<td>
					<select name="pid">
						<option value="<?php echo $parent['cid'];?>"><?php echo $parent['cname'];?></option>
						<option value="0">顶级分类</option>
						<?php if(is_array($level)):?><?php  foreach($level as $v){ ?>
							<option value="<?php echo $v['cid'];?>">|<?php echo $v['html'];?><?php echo $v['cname'];?></option>
						<?php }?><?php endif;?>
					</select>
					
					
				</td>
			</tr>
			<tr>
				<td>分类名称</td>
				<td>
					<input type="text" name="cname" value="<?php echo $category['cname'];?>" />
				</td>
			</tr>
			<tr>
				<td>分类标题</td>
				<td>
					<textarea name="title"><?php echo $category['title'];?></textarea>
				</td>
			</tr>
			<tr>
				<td>分类关键字</td>
				<td>
					<textarea name="keywords"><?php echo $category['keywords'];?></textarea>
				</td>
			</tr>
			<tr>
				<td>分类描述</td>
				<td>
					<textarea name="description"><?php echo $category['description'];?></textarea>
				</td>
			</tr>
			<tr>
				<td>分类排序</td>
				<td>
					<input name="sort" type="text" value="<?php echo $category['sort'];?>" />
				</td>
			</tr>
			<tr>
				<td>是否显示</td>
				<td>
					<?php if($category['display']){?>
						<lable>
						<input type="radio" name="display" checked=true value="1"/>	
						<span>显示</span>
						</lable>
						<lable>
						<input type="radio" name="display" value="0"/>	
						<span>隐藏</span>
						</lable>
						<?php  }else{ ?>
						<lable>
						<input type="radio" name="display"  value="1"/>	
						<span>显示</span>
						</lable>
						<lable>
						<input type="radio" name="display" checked=true value="0"/>	
						<span>隐藏</span>
						</lable>
					<?php }?>
					
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