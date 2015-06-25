<?php  
class IndexControl extends CommonControl{

public function getRecentView(){
	if(IS_AJAX === false)return false;
	$key = encrypt('recent-view');
	$result = array();
	if(!isset($_COOKIE[$key])){
		$result['status'] = false;
		exit(json_encode($result));
	}

	$value = unserialize(decrypt($_COOKIE[$key]));

	$db = K('goods');
	$data = $db->getGoods($value);
	if($data){
		$data = $this->disData($data);
		$result['status'] = true;
		$result['data']= $data;
		exit(json_encode($result));
	}else{
		$result['status'] = false;
	}
	exit(json_encode($result));
}
	private function disData($data){
		foreach ($data as $k=>$v){
    		$pathInfo = pathinfo($v['goods_img']);
    		$data[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_90x55.'.$pathInfo['extension'];
    	}
    	return $data;
	}

	public function clearRecentView(){
		if(IS_AJAX === false)exit();
		$key = encrypt('recent-view');
		if(isset($_COOKIE[$key])){
			unset($_COOKIE[$key]);
		}
		setcookie($key,'',time()-1,'/');

	}

	public function addCollect(){
		$db = K('user');
		$gid = $this->_get('gid','intval',null);
		$data = array(
			'user_id' => $this->uid,
			'goods_id'=>$gid
			);
		$result = array();
		if($db->checkCollect($data)){
			$result = array('status'=>true);
		}else{
			if($db->addCollect($data)){
				$result = array('status'=>true);
			}else{
				$result = array('status'=>false);
			}
		}
		exit(json_encode($result));
	}

	public function collect(){
		$db = K('user');
		$status = $this->_get('status','intval',null);
		$where = array('uid'=>$this->uid);
		if(!is_null($status)){
			if($status == 1){
				$where = 'uid='.$this->uid.' and end_time>='.time();
			}else{
				$where = 'uid='.$this->uid.' and end_time<'.time();
			}
		}

		$data = $db->getCollect($where);
		$collect = $this->disCollectData($data);
		$this->assign('collect',$collect);
		$this->display();
	}

	private function disCollectData($data){
		if(!$data) return false;
		foreach($data as $k=>$v){
			$pathInfo = pathinfo($v['goods_img']);
    		$data[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo["filename"].'_90x55.'.$pathInfo['extension'];
    		$data[$k]['end_time'] = $v['end_time']>time()?'进行中':'已结束';
		}
		return $data;
	}

	public function delCollect(){

		$where = array(
			'user_id' => $this->uid,
			'goods_id'=>$this->_get('gid','intval',0)
			);
		$db = K('user');
		if($db->delCollect($where)){
			$this->success('删除成功','collect');
		}else{
			$this->error('删除失败','collect');
		}

	}











}





?>