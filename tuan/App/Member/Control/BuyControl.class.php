<?php  

class BuyControl extends CommonControl{

	public $orders = array();

	public function index(){
		$db = K('user');
		$address = $db->getAddress($this->uid);
		$this->assign('address',$address);
		$gid = $this->_get('gid','intval');
		$db = K('goods');
		$goods = $db->getGoodsFind($gid);
		$this->assign('goods',$goods);

		$this->display();
	}

	public function payment(){
		if(IS_POST === true){
			if(!isset($_POST['addressid'])) $this->error('请选择一个收获地址',U('Memeber/Account/setAddress'));
			/**
			 * 从购物车提交订单
			 */
			if(is_array($_POST['gid'])){
				$data = $_POST;
				 foreach($data['gid'] as $k=>$v){
				 	$_POST['gid'] = $v;
				 	$_POST['price'] =$data['price'][$k];
				 	$_POST['goods_num'] = $data['goods_num'][$k];
				 	$_POST['addressid'] = $data['addressid'];
				 	if(!$this->addOrder()){
				 		throw new Exception('订单提交失败');
				 	}
				 }
				/**
				 * 直接由商品页提交订单
				 */
			}else{
				if(!$this->addOrder()) throw new Exception('订单提交失败');

			}
		}

		$order = $this->getOrderData();
		$sumArr = array();
		foreach($order as $v){
			$sumArr[] = $v['price']*$v['goods_num'];
		}
		$this->assign('sumPrice',array_sum($sumArr));
		$this->assign('order',$order);
		$db = K('user');
		$balance = $db->getUserBalance($this->uid);
		$this->assign('balance',$balance);
		$this->display();		
	}

	private function getOrderData(){
		$db = K('order');
		$orderid = $this->_get('oid','intval',null);
		if(is_null($orderid)){			
			$where = array('user_id'=>$this->uid);
			$res = $db->getOrderData($where,$this->orders);
		}else{
			
			$where = array('orderid'=>$orderid);
			$res = $db->getOrderData($where);
		}
		
		return $res;
	}

	private function addOrder(){
		$data =  array();
		$data['user_id']  = $this->uid;
		$data['goods_id']  =$this->_post('gid','intval');
		$data['goods_num']  =$this->_post('goods_num','intval');
		$data['addressid']  =$this->_post('addressid','intval');
		$data['total_money']  = $data['goods_num']*$this->_post('price','intval');
		$db = K('order');
		$where = array('user_id'=>$this->uid,'goods_id'=>$data['goods_id'],'status'=>0);
		
		$res = $db->checkOrder($where);
		if(!$res){
			$res = $db->addOrder($data);
			$this->orders[] = $res;
			return $res;
		}
		$this->orders = $res;
		return $res;
	}

	public function checkBuy(){
		if(IS_POST === false){
			exit;
		}
		
		$orderids = $_POST['orderid'];
		$db = K('order');
		$data = $db->getOrder($orderids);
		$sumArr = array();
		foreach($data as $v){
			$sumArr[] = $v['price']*$v['goods_num'];
		}
		$totalPrice = array_sum($sumArr);
		$db = K('user');
		$balance = $db->getUserBalance($this->uid);
		if($balance<$totalPrice){
			$this->error(
				'付款失败，请充值！',U('Account/index')
				);
		}else{
			$this->buysuccess($orderids,$totalPrice);
		}

	}

	public function buysuccess($orderids,$totalPrice){
		$db = K('order');
		$res = $db->updateStatus($orderids);
		if(!$res){
			$this->error('付款失败',U('Index/Index/index'));
		}else{
			$db = K('user');
			$db->updateBalance($this->uid,$totalPrice);
			$db = K('cart');
			$db->delCart(array('user_id'=>$this->uid));
			$db = K('goods');
			$db->updateBuy($orderids);
			$this->display('buysuccess');
			
		}
	}

















}














?>