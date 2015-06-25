<?php 	 

class DetailControl extends CommonControl{
	private $gid;
	private $db;

	public function __auto(){
		$this->gid = $this->_get('gid');
		$this->db = K('goods');
	}

	public function index(){
		$data = $this->db->getGoodsDetail($this->gid);
        $this->setRecentView();
		$goods = $this->disgoods($data);
		$this->assign('detail',$goods);
		$this->display();
	}

	public function disgoods($data){
		if(!is_array($data)) return;
    	$pathInfo = pathinfo($data['goods_img']);
    	if($pathInfo){
    		$data['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo['filename'].'_460x280.'.$pathInfo['extension'];
    	}
    	$data['zhekou'] = round(($data['price']/($data['old_price']-1)*10),1);
    	if($data['end_time']-time()>(3600*24*3)){
        		$data['end_time'] = '剩余<span>3</span>天以上';
        	}else{
        		$data['end_time'] = date('Y-m-d',$data['end_time']).'下架';
        	}
        $goodsServe = array_slice(unserialize($data['goods_server']),0,2);
        $serve = C('goods_server');
        $data['serve'] = array();
        foreach($goodsServe as $k=>$v){
        	$data['serve'][] = $serve[$goodsServe[$k]];
        }
    	return $data;
	}

    private function setRecentView(){
        $key = encrypt('recent-view');
        $value = isset($_COOKIE[$key])?unserialize(decrypt($_COOKIE[$key])):array();
        if(!in_array($this->gid,$value)){
            array_unshift($value,$this->gid);
        }
        setcookie($key,encrypt(serialize($value)),time()+86400,'/');
    }

    














}




















?>