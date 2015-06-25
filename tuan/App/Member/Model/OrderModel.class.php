<?php  
class OrderModel extends ViewModel{

	public $table = 'order';
	public $view;
	
	public function addOrder($data){
		return $this->add($data);
	}

	public function getOrderData($where,$oid=null){
		$this->view = array(
			'goods' => array(
				'type' => 'inner',
				'on'  =>'goods.gid=order.goods_id'
				)
			);
		$fields = array(
			'main_title',
			'price',
			'gid',
			'goods_num',
			'orderid',
			'goods_img',
			'status'
			);
		if(is_null($oid)){
			return $this->field($fields)->where($where)->select();
		}else{
			return $this->field($fields)->where($where)->in(array('orderid'=>$oid))->select();
		}
		
	}


	public function checkOrder($where){
		$res = $this->field('orderid')->where($where)->select();
		$ords = array();
		if($res){
			foreach($res as $k=>$v){
			$ords[] = $v['orderid'];
		}
		}
		
		return $ords;
	}

	public function getOrder($orderids){
		$this->view = array(
			'goods' => array(
				'type' =>'inner',
				'on'   => 'goods.gid=order.goods_id'
				)
			);
		return $this->field(array('price','goods_num'))->in(array('orderid'=>$orderids))->select();
	}

	public function updateStatus($orderids){
		 $this->in(array('orderid'=>$orderids))->save(array('status'=>1));
		 return $this->getAffectedRows();
	}

	public function delOrder($oid){
		return $this->where(array('orderid'=>$oid))->delete();
	}





















}

























?>