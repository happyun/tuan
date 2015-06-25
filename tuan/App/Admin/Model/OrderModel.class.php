<?php  
class OrderModel extends ViewModel{
	public $view = array(
		'goods'=>array(
			'type' => 'inner',
			'on'   =>'goods.gid=order.goods_id'
			)
		);

	public $table = 'Order';


	public function getOrders($where){
		$field = array(
			'main_title',
			'price',
			'goods_num',
			'status',
			'orderid'
			);
		if(is_null($where)){
			$res = $this->field($field)->select();
		}else{
			$res = $this->field($field)->where(array('status'=>$where))->select();
		}
		
		return $res;
	}

	public function delOrder($oid){
		return($this->table('order')->where($oid)->delete());

	}
















}











?>