<?php  
class UserControl extends Control{
	public $db;
	public $uid;
	public function __init(){
		$this->db = K('user');
		$this->uid = $this->_get('uid');
	}
	public function index(){
		$data = $this->db->getAllUser();
		$this->assign('user',$data);
		$this->display();
	}

	public function del(){
		$res = $this->db->delUser($this->uid);
		if($res){
			$this->success('删除成功',U('index'));
		}else{
			$this->error('删除失败',U('index'));
		}
	}




}























?>