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

<div id="map">
	<span class='title'>分类列表</span>
</div>
<div id="content">
	<table id="table" class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="5%"></th>
				<th width="25%">分类名称</th>
				<th width="30%">分类标题</th>
				<th width="10%">分类排序</th>
				<th width="10%">是否显示</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($data)):?><?php  foreach($data as $k=>$v){ ?>
			<tr class="level_<?php echo $v['level'];?> pid_<?php echo $v['pid'];?>" cid="<?php echo $v['cid'];?>" level="<?php echo $v['level'];?>">
				<td><a class='btn btn-mini btn-info unfold' style="font-size:16px;" href="">+</a></td>
				<td>|-<?php echo $v['html'];?><?php echo $v['cname'];?></td>
				<td><?php echo $v['title'];?></td>
				<td><?php echo $v['sort'];?></td>
				<td>
					<?php if($v['display']){?>
						显示
						<?php  }else{ ?>
						隐藏
					<?php }?>
				</td>
				<td>
					<a class='btn btn-small' href="<?php echo U('Admin/Category/add');?>/cid/<?php echo $v['cid'];?>">添加子类</a>
					<a class='btn btn-small' href="<?php echo U('Admin/Category/edit');?>/cid/<?php echo $v['cid'];?>">编辑</a>
					<a class='btn btn-small delAffirm' href="<?php echo U('Admin/Category/del');?>/cid/<?php echo $v['cid'];?>">删除</a>
				</td>
			</tr>
		<?php }?><?php endif;?>	
		</tbody>
	</table>
</div>
</body>
</html>