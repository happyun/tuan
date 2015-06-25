<?php  

class LoginControl extends Control{

	public function index(){
		$this->display();
	}

	public function login(){
		if(IS_POST === false) throw new Exception('非法请求!');

		$username = $this->_post('username');
		$password = $this->_post('password','md5');

		$where = array('uname'=>$username,'or','email'=>$username);
		$this->db = K('user');
		$userinfo = $this->db->getUser($where);

		if($userinfo['password'] == $password){
			$_SESSION[C('RBAC_AUTH_KEY')]=$userinfo['uid'];
			if(isset($_POST['auto_login'])){
				setcookie(session_name(),session_id(),time()+C('COOKIE_LIFT_TIME'),'/');
			}else{
				setcookie(session_name(),session_id(),0,'/');
			}
			$this->success('登录成功',U('Index/Index/index'));
		}else{
			$this->error('登录失败',U('Member/Login/index'));
		}
	}

	public function quit(){	
		setcookie(session_name(),session_id(),time()-1,'/');
		session_unset();
		session_destroy();
		$this->success('退出成功',__ROOT__);
	}











}














?>