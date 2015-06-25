<?php  
class CartControl extends Control{
	private $uid = null;

	public function __init(){
		if(isset($_SESSION[C('RBAC_AUTH_KEY')])){
			$this->uid = $_SESSION[C('RBAC_AUTH_KEY')];
			$this->writeCart();
		}
		$this->setNav();
		$this->assign('userIsLogin',isset($_SESSION[C('RBAC_AUTH_KEY')]));

	}

	public function index(){

		$cart = $this->getCartData();
		$data = $this->disCart($cart);
		if(IS_AJAX ===false){
			$this->assign('cart',$data[0]);
			$this->assign('total',$data[1]);
			$db = K('user');
			$address= $db->getAddress($this->uid);
			$this->assign('address',$address);
			$this->display();
		}else{
			if(isset($data[0])){
				exit(json_encode(array('status'=>true,'data'=>$data[0])));
			}else{
				exit(json_encode(array('status'=>false)));
			}
		}




	}

	public function getCartData(){
		$db = K('cart');
		$result = array();
		if(is_null($this->uid)){
			if(!isset($_SESSION['cart']['goods'])) return;
			$carts = $_SESSION['cart']['goods'];
			foreach($carts as $v){
				$data = $db->getGoods(array('gid'=>$v['id']));
				$data['goods_num'] = $v['num'];
				$result[] =$data;
			}

		}else{
			$result = $db->getCartAll($this->uid);
		}
		return $result;
	}

	public function disCart($cart){
		if(empty($cart)) return;
		$total = 0;
		foreach($cart as $k=>$v){
			$cart[$k]['xiaoji'] = $v['goods_num']*$v['price'];
			$cart[$k]['status'] = $v['end_time']<time()?'已下架':'可购买';
			$pathInfo = pathinfo($v['goods_img']);
			$cart[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_90x55.'.$pathInfo['extension'];
			$total += $cart[$k]['xiaoji'];
		}
		return array($cart,$total);
	}

	public function add(){
		if(IS_AJAX ===false) throw new Exception('请求错误');
		$result = array();
		if(is_null($this->uid)){
			$data = array(
				'id' => $this->_get('gid','intval'),
				'name' =>'',
				'num' =>1,
				'price' =>0

				);
			Cart::add($data);
			$total = count($_SESSION['cart']['goods']);
			$result = array('status'=>true,'total'=>$total);
		}else{
			$data = array();
			$data['goods_id'] = $this->_get('gid','intval');
			$data['user_id'] = $this->uid;
			$data['goods_num'] = 1;
			$result = $this->checkAdd($data);
			if($result){
				$db = K('cart');
				$where = array('user_id'=>$data['user_id']);
				$total = $db->countCart($where);
				$result = array('status'=>true,'total'=>$total);
			}

		}
		exit(json_encode($result));
	}

	private function writeCart(){
		if(!isset($_SESSION['cart']['goods']))return;
		$carts = $_SESSION['cart']['goods'];
		foreach($carts as $v){
			$data = array();
			$data['user_id'] = $this->uid;
			$data['goods_id'] = $v['id'];
			$data['goods_num'] = $v['num'];
			$this->checkAdd($data);
		}
		unset($_SESSION['cart']);
	}

	private function checkAdd($data){
		$where = array('user_id'=>$data['user_id'],'goods_id'=>$data['goods_id']);
		$db = K('cart');
		$cart_id = $db->checkCart($where);
		if($cart_id){
			return $db->incCart($cart_id,$data['goods_num']);
		}else{
			return $db->addCart($data);
		}

	}

	public function del(){
		
		$gid = $this->_get('gid','intval');
		if(IS_AJAX === false)exit;
		$result = array();
		$result['status'] = false;

		if(is_null($this->uid)){
			foreach($_SESSION['cart']['goods'] as $k=>$v){
				if($v['id'] == $gid){
					unset($_SESSION['cart']['goods'][$k]);
					$result['status'] = true;
				}
			}
		}else{
			$where = array('user_id'=>$this->uid,'goods_id'=>$gid);
			$db = K('cart');
			if($db->delCart($where)){
				$result['status'] = true;
			}
		}

		exit(json_encode($result));
	}

	public function updateGoodsNum(){
		if(IS_AJAX === false) return false;
		$gid  = $this->_post('gid','intval');
		$num = $this->_post('num','intval');
		$result = array();
		if(is_null($this->uid)){
			foreach($_SESSION['cart']['goods'] as $k=>$v){
				if($v['id'] == $gid){
					$_SESSION['cart']['goods'][$k]['num'] = $num;
					$result = array(
						'status' =>true,
						'num' => $num
						);
				}
			}
		}else{
			$db = K('cart');
			$where = array(
				'goods_id'=>$gid,
				'user_id' =>$this->uid
				);
			if($db->updateCartNum($where,$num)){
				$result = array(
					'status' => true,
					'num' =>$num
					);
			}
		}
		exit(json_encode($result));

	}

	private function setNav(){
		$db = K('category');
		$nav = $db->getCategoryLevel(0);
		$this->assign('nav',$nav);
	}









}





?>