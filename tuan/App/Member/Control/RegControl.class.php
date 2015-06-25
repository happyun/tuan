<?php  

class RegControl extends Control{

	public function index(){

		$this->display();
	}

	public function showCode(){
		$code = new Code();
		$code->show();
	}

	public function check(){
		$this->db = K('user');
		if(IS_AJAX ===false) throw new Exception('非法请求');
		$key = addlashes(key($_POST));
		$value = $this->_post($key);
		switch($key){
			case 'email':
				if($this->db->check('email',$value)){
					$result = array('status'=>false,'mag'=>'该邮箱已经存在');

				}else{
					$result = array('status' => true);
				}
			break;
			case 'username':
				if($this->db->check('uname',$value)){
					$result = array('status'=>false,'msg'=>'用户名已经存在');
				}else{
					$result = array('status'=>true);
				}
			break;
			case 'code':
				if($_SESSION['code'] != strtoupper($value)){
					$result = array('status'=>false,'msg' =>'验证码输入有误');
				}else{
					$result = array('status'=>true);
				}
			break;
		}
		exit(json_encode($result));
	}

	public function addUser(){
		if(IS_POST === false) throw new Exception('请求非法！');
		$this->db = K('user');
		$data = array();
		$data['email'] = $this->_post('email');
		$data['uname'] = $this->_post('uername');
		$data['password'] = $this->_post('password','md5');
		$uid = $this->db->addUser($data);
		if($uid){
			$_SESSION[C('RBAC_AUTH_KEY')] = $uid;
			setcookie(session_name(),session_id(),time()+C('COOKIE_LIFT_TIME'),'/');
			$this->success('注册成功',U('Index/Index/index'));
		}else{
			$this->error('注册失败',U('Index/Index/index'));
		}

	}








}












?>