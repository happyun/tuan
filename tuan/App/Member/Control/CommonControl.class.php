<?php  

class CommonControl extends Control{

	protected $db;
	protected $uid;
	public function __init(){
		if(!isset($_SESSION[C('RBAC_AUTH_KEY')])){
			go(U('Member/Login/index'));
			exit;
		}

		if(method_exists($this,'__auto')){
			$this->_auto();
		}

		$this->uid = (int)$_SESSION[C('RBAC_AUTH_KEY')];
		$this->setNav();
		$this->assign('userIsLogin',isset($_SESSION[C('RBAC_AUTH_KEY')]));
	}

	private function setNav(){
		$db = K('category');
		$nav = $db->getCategoryLevel(0);
		$this->assign('nav',$nav);
	}






	
}







?>