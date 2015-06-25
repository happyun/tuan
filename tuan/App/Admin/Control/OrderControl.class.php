<?php  

class OrderControl extends Control{
	public $db;
	public $oid;
	public function __init(){
		$this->db = K('order');
		$this->oid = $this->_get('orderid');
	}

	public function index(){
		$where = $this->_get('status');
		$data = $this->db->getOrders($where);
		$order = $this->disOrder($data);
		$this->assign('order',$order);
		$this->display();
	}

	public function disOrder($data){
		if(is_null($data))return;
		foreach($data as $k=>$v){
			$data[$k]['total_money'] = $v['price']*$v['goods_num'];
			$data[$k]['status'] = ($v['status'])?'已付款':'未付款';
		}
		
		return $data;
	}

	public function del(){
		$res = $this->db->delOrder($this->oid);
		if($res){
			$this->success('订单删除成功',U('index'));
		}else{
			$this->error('订单删除失败',U('index'));
		}
	}








}















?>