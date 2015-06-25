<?php  
class AccountControl extends CommonControl{


public function index(){
	$db = K('user');
	$balance = $db->getUserBalance($this->uid);
	$this->assign('balance',$balance);
	$this->display();
}

public function setting(){
	$this->display();
}

public function setAddress(){
	$db = K('user');
	$address = $db->getAddress($this->uid);
	$this->assign('address',$address);
	$this->display();
}


public function delAddress(){
	$db = K('user');
	$id = $this->_get('addressid','intval');
	if($db->delAddress($id)){
		$this->success('删除成功！','setAddress');
	}else{
		$this->error('删除失败','setAddress');
	}
}

public function addAddress(){
	$data = array();
	foreach($_POST as $k=>$v){
		$data[$k] = strip_tags($v);
	}
	$data['user_id'] = $this->uid;
	$db = K('user');
	if($db->addAddress($data)){
		$this->success('添加成功','index');
	}else{
		$this->error('添加失败','index');
	}
}


public function add(){
	$db = K('user');
	$data = array();
	if($db->addBalance($this->uid)){
		$this->success('充值成功',U('index'));
	}else{
		$this->error('充值失败',U('index'));
	}
	
}









}






?>