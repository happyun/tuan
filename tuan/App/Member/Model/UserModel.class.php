<?php  
class UserModel extends ViewModel{

	public $table = 'user';
	public $view;

	public function check($field,$value){
		return $this->where(array($field=>$value))->count();
	}

	public function addUser($data){
		$uid = $this->add($data);
		$data = array('user_id'=>$uid);
		$this->table('userinfo')->add($data);
		return $uid;
	}

	public function getUser($where){
		return $this->where($where)->find();

	}
	public function getAddress($uid){
		return $this->table('user_address')->where(array('user_id'=>$uid))->select();
	}

	public function getUserBalance($uid){
		$result = $this->field('balance')->table('userinfo')->where(array('user_id'=>$uid))->find();
		return $result['balance'];
	}

	public function delAddress($id){
		$res = $this->table('user_address')->where(array('addressid'=>$id))->delete();
		return $res;
	}
	public function addAddress($data){
		$res = $this->table('user_address')->add($data);
		return $res;
	}

	public function addBalance($uid){
		return $this->table('userinfo')->inc('balance','user_id='.$uid,1000);
	}

	public function updateBalance($uid,$num){
		$this->table('userinfo')->dec('balance','user_id='.$uid,$num);
	}


	public function checkCollect($where){
		return $this->table('collect')->where($where)->count();
	}

	public function addCollect($data){
		return $this->table('collect')->add($data);
	}

	public function getCollect($where){
		$this->view = array(
			'collect' => array(
				'type' => 'inner',
				'on'  =>'user.uid = collect.user_id'
				),
			'goods'   => array(
				'type' => 'inner',
				'on'   =>  'goods.gid=collect.goods_id'
				)
			);
		$fields = array(
			'main_title',
			'goods_img',
			'price',
			'end_time',
			'gid'
			);

		return $this->field($fields)->where($where)->select();


	}


	public function delCollect($where){

		return $this->table('collect')->where($where)->del();

	}











}







?>