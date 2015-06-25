<?php  
class CartModel extends ViewModel{

	public $view = array();

	public function getGoods($where){
		$fields = array(
			'main_title',
			'gid',
			'goods_img',
			'price',
			'end_time'
			);
		return $this->table('goods')->field($fields)->where($where)->find();

	}
	
	public function getCartAll($uid){
		$this->view = array(
			'goods' => array(
				'type'=>'inner',
				'on'  =>'goods.gid=cart.goods_id'
				)

			);
		$fields = array(
			'main_title',
			'gid',
			'goods_img',
			'price',
			'end_time',
			'cart_id',
			'goods_num'
			);
		return $this->field($fields)->where(array('user_id'=>$uid))->select();
	}

	public function checkCart($where){
		$result = $this->field('cart_id')->where($where)->find();
		return isset($result['cart_id'])?$result['cart_id']:null;
	}

	public function addCart($data){
		return $this->add($data);
	}

	public function delCart($where){
		return $this->where($where)->del();
	}
	public function updateCartNum($where,$num){
		$this->where($where)->save(array('goods_num'=>$num));
		return $this->getAffectedRows();
	}

	public function countCart($where){
		return $this->where($where)->count();
	}

	public function incCart($id,$num){
		return $this->inc('goods_num','cart_id='.$id,$num);
	}









}






?>