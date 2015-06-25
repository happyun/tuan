<?php  

class UserModel extends ViewModel{
	public $table = 'user';
	public $view = array(
		'userinfo'=>array(
			'type' => 'inner',
			'on'   => 'userinfo.user_id=user.uid'
			)
		);

	public function getAllUser(){
		$field = array(
			'uname',
			'email',
			'phone',
			'balance'
			);
		return $this->field($field)->select();
	}

	public function delUser($uid){
		$this->table('collect')->where(array('user_id'=>$uid))->del();
		$this->table('cart')->where(array('user_id'=>$uid))->del();
		$this->table('order')->where(array('user_id'=>$uid))->del();
		$this->table('userinfo')->where(array('user_id'=>$uid))->del();
		$this->table('user_address')->where(array('user_id'=>$uid))->del();
		return $this->where(array('uid'=>$uid))->del();


		
	}







}















?>