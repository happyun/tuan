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
<script type="text/javascript" src="http://localhost/SH_tuan/tuan/App/Admin/Tpl//Public/js/goods.js"></script>
<link href="http://localhost/SH_tuan/hdphp/Extend/Org/JqueryUi/css/flick/jquery-ui-1.10.3.custom.css" rel="stylesheet"><script src="http://localhost/SH_tuan/hdphp/Extend/Org/JqueryUi/js/jquery-ui-1.10.3.custom.js"></script>
<div id="map">
	<span class='title'>编辑商品</span>
</div>
<div id="content">
	<form id="goodsForm" action="<?php echo U('Admin/Goods/edit');?>/gid/<?php echo $goods['gid'];?>" method="post">
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
					<input type="hidden" name="shopid" value="<?php echo $goods['shopid'];?>"/>
					<?php echo $goods['shopname'];?>
				</td>
			</tr>
			<tr>
				<td>分类名称</td>
				<td>
					
					<select name="cid" >
						<option value="<?php echo $goods['cid'];?>"><?php echo $goods['cname'];?></option>
						<?php if(is_array($category)):?><?php  foreach($category as $v){ ?>
							<option value="<?php echo $v['cid'];?>"><?php echo $v['html'];?><?php echo $v['cname'];?></option>	
						<?php }?><?php endif;?>
					</select>
				</td>
			</tr>
			<tr>
				<td>所在地区</td>
				<td>
					<select name="lid" >
						<option value="<?php echo $goods['lid'];?>"><?php echo $goods['lname'];?></option>
						<?php if(is_array($locality)):?><?php  foreach($locality as $v){ ?>
							<option value="<?php echo $v['lid'];?>"><?php echo $v['html'];?><?php echo $v['lname'];?></option>	
						<?php }?><?php endif;?>
					</select>
				</td>
			</tr>
			<tr>
				<td>商品主标题</td>
				<td>
					<input type="text" name="main_title" value="<?php echo $goods['main_title'];?>" />
				</td>
			</tr>
			<tr>
				<td>商品副标题</td>
				<td>
					<textarea name="sub_title"><?php echo $goods['sub_title'];?></textarea>
				</td>
			</tr>
			<tr>
				<td>现价</td>
				<td>
					<input type="text" name="price" value="<?php echo $goods['price'];?>"/>
				</td>
			</tr>
			<tr>
				<td>原价</td>
				<td>
					<input type="text" name="old_price" value="<?php echo $goods['old_price'];?>"/>
				</td>
			</tr>
			<tr>
				<td>上架时间</td>
				<td>
					<input id="begin_time" type="text" name="begin_time" value="<?php echo date('Y-m-d',$goods['begin_time']);?>" />
				</td>
			</tr>
			<tr>
				<td>下架时间</td>
				<td>
					<input id="end_time" type="text" name="end_time" value="<?php echo date('Y-m-d',$goods['end_time']);?>" />
				</td>
			</tr>
			<tr>
				<td>商品展示图</td>
				<td>
					<link rel="stylesheet" type="text/css" href="http://localhost/SH_tuan/hdphp/Extend/Org/Uploadify/uploadify.css" />
            <script type="text/javascript" src="http://localhost/SH_tuan/hdphp/Extend/Org/Uploadify/jquery.uploadify.min.js"></script>
            <script type="text/javascript">
            var HDPHP_CONTROL         = "http://localhost/SH_tuan/index.php/Admin/Goods";
            var UPLOADIFY_URL    = "http://localhost/SH_tuan/hdphp/Extend/Org/Uploadify/";
            var HDPHP_UPLOAD_THUMB    ="460,280,200,100,310,185,90,55";
HDPHP_UPLOAD_TOTAL = 0</script>
            <script type="text/javascript" src="http://localhost/SH_tuan/hdphp/Extend/Org/Uploadify/hd_uploadify.js"></script>
<script type="text/javascript">
    $(function() {
        hd_uploadify_options.removeTimeout  =0;
        hd_uploadify_options.fileSizeLimit  ="2MB";
        hd_uploadify_options.fileTypeExts   ="*.jpg;*.png;*.gif";
        hd_uploadify_options.queueID        ="hd_uploadify_goods_img_queue";
        hd_uploadify_options.showalt        =true;
        hd_uploadify_options.uploadLimit    =1;
        hd_uploadify_options.success_msg    ="正在上传...";//上传成功提示文字
        hd_uploadify_options.formData       ={image : "1", someOtherKey:1,hdsid:"41f804ce2758559d07f27cd15600b366",upload_dir:"",hdphp_upload_thumb:"460,280,200,100,310,185,90,55"};
        hd_uploadify_options.thumb_width          =200;
        hd_uploadify_options.thumb_height          =150;
        hd_uploadify_options.uploadsSuccessNums = 0;

        $("#hd_uploadify_goods_img").uploadify(hd_uploadify_options);
        });
</script>
<input type="file" name="up" id="hd_uploadify_goods_img"/>
<div tool="hd_uploadify_goods_img_msg uploadify_upload_msg">
</div>
<div id="hd_uploadify_goods_img_queue"></div>
<div class="hd_uploadify_goods_img_files uploadify_upload_files" input_file_id ="hd_uploadify_goods_img">
    <ul></ul>
    <div style="clear:both;"></div>
</div>
			
					<img width="200" src="http://localhost/SH_tuan/<?php echo $goods['goods_img'];?>"/>
					<input type="hidden" name="old_img" value="<?php echo $goods['goods_img'];?>"/>
				</td>
			</tr>	
			<tr>
				<td>商品服务</td>
				<td>
					<?php if(is_array($server)):?><?php  foreach($server as $k=>$v){ ?>
						<?php if(in_array($k,$goods['goods_server'])){?>
						<label>
							<input type="checkbox" checked=true name="goods_server[]" value="<?php echo $k;?>">
							<?php echo $v['name'];?>
						</label>
						<?php }else{?>
						<label>
							<input type="checkbox" name="goods_server[]" value="<?php echo $k;?>">
							<?php echo $v['name'];?>
						</label>
						<?php }?>
					<?php }?><?php endif;?>
				</td>
			</tr>	
			<tr>
				<td>商品细节展示</td>
				<td>
					<script charset="utf-8" src="http://localhost/SH_tuan/hdphp/Extend/Org/Editor/Keditor/kindeditor-all-min.js"></script>
            <script charset="utf-8" src="http://localhost/SH_tuan/hdphp/Extend/Org/Editor/Keditor/lang/zh_CN.js"></script>
        <textarea id="hd_detail" name="detail"><?php echo $goods['detail'];?></textarea>
    <script>
        var options_detail = {
        filterMode : false
                ,id : "editor_id"
        ,width : "100%"
        ,height:"300px"
                ,formatUploadUrl:false
        ,allowFileManager:false
        ,allowImageUpload:true
        ,uploadJson : "http://localhost/SH_tuan/index.php/Admin/Goods&m=keditor_upload&editor_type=2&Image=1&uploadsize=2000000&maximagewidth=false&maximageheight=false&hdsid=41f804ce2758559d07f27cd15600b366"//处理上传脚本
        };var hd_detail;
        KindEditor.ready(function(K) {
                    hd_detail = KindEditor.create("#hd_detail",options_detail);
        });
        </script>
        
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