<?php  
class OrderControl extends CommonControl{
public function index(){
	$db = K('order');
	$status = $this->_get('status','intval',null);
	if(is_null($status)){
		$where = array('user_id'=>$this->uid);
	}else{
		$where = array('user_id'=>$this->uid,'status'=>$status);
	}
	$data = $db->getOrderData($where);
	$order = $this->disData($data);
	$this->assign('order',$order);
	$this->display();
}

public function disData($data){
	if(!$data) return false;
        	foreach ($data as $k=> $v){
        		$pathInfo = pathinfo($v['goods_img']);
        		$data[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_90x55.'.$pathInfo['extension'];
        		$data[$k]['zongji'] = $v['goods_num']*$v['price'];
        		$data[$k]['status'] = $v['status']?'已支付':'未付款';
        	}
        	return $data;

}

public function del(){
	$oid = $this->_get('oid','intval',null);
	$db = K('order');
	$res = $db->delOrder($oid);
	if($res){
		$this->success('订单删除成功',U('index'));
	}
	else{
		$this->error('订单删除失败',U('index'));
	}


}
}
























?>