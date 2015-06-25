<?php
//测试控制器类
class IndexControl extends CommonControl{

	private $cid;
	private $lid;
	private $price;
	private $url;
	private $order;
	private $db;

	public function __auto(){
		if(strlen(__URL__)<strlen(__ROOT__.'/index.php/Index/Index/index')){
			$this->url = __ROOT__.'/index.php/Index/Index/index';
		}else{
			$this->url = url_param_remove('keywords',__URL__);
		}
		
		$this->db = K('goods');
		$this->cid = $this->_get('cid','intval',null);
		$this->lid = $this->_get('lid','intval',null);
		$this->price = $this->_get('price','',null);
		$this->order  = $this->_get('order','','t-desc');

		$this->setCategory();
		$this->setLocality();
		$this->setPrice();
		$this->setOrderUrl();
	}



    public function index(){
    	$this->setSearchWhere();
    	$this->setOrder();

        $total = $this->db->getGoodsTotal();
        $page = new Page($total,5);
        $data = $this->db->getGoods($page->limit());
    	$goods = $this->disGoods($data);

    	$this->assign('goods',$goods);
        $this->assign('page',$page->show());

        $this->display();
    }


    public function disGoods($data){
    	if(!is_array($data)) return;
    	foreach($data as $k=>$v){
    		$pathInfo = pathinfo($v['goods_img']);
    		if($pathInfo){
    			$data[$k]['goods_img'] = __ROOT__.'/'.$pathInfo['dirname'].'/'.$pathInfo['filename'].'_310x185.'.$pathInfo['extension'];
    		}
    		$data[$k]['sub_title'] = mb_substr($v['sub_title'],0,30,'utf8');
    	}
    	return $data;
    }


    public function setOrder(){
    	$order = '';
    	$arr = explode('-',$this->order);
    	switch($arr[0]){
    		case 'd':
    			$order = 'begin_time '.$arr[1];
    		break;
    		case 'b':
    			$order = 'buy '.$arr[1];
    		break;
    		case 'p':
    			$order = 'price '.$arr[1];
    		break;
    		case 't':
    			$order = 'begin_time '.$arr[1];
    		break;
    	}
    	$this->db->order = $order;
    }


    public function setSearchWhere(){
    	if(isset($_GET['keywords'])){
    		$this->db->keywords = $_GET['keywords'];
    		return;
    	}
    	if(!is_null($this->cid)){
    		$db = K('category');
    		$sonCids = $db->getSonCategory($this->cid);
    		if(is_array($sonCids)){
    			foreach($sonCids as $v){
    				$this->db->cids['goods.cid'][] = $v['cid'];
    			}
    		}
    		
    	}

    	if(!is_null($this->lid)){
    		$db = K('locality');
    		$sonLids = $db->getSonLocality($this->lid);
	    	foreach($sonLids as $v){
	    		$this->db->lids['goods.lid'][] = $v['lid'];
	    	}	
    	}

    	if(!is_null($this->price)){
    		$arr = explode('-',$this->price);
    		if(isset($arr[1])){
    			$price = 'price>'.$arr[0].' and price<'.$arr[1];
    		}else{
    			$price = 'price>'.$arr[0];
    		}
    		$this->db->price = $price;
    	}

    }


    public function setCategory(){
    	$url = url_param_remove('cid',$this->url);
    	$db = K('category');

    	if(is_null($this->cid)){
    		$topCategory = $db->getCategoryLevel(0);
    		$tmpArr = array();
    		$tmpArr[] = '<a class="active" href="'.$url.'">全部</a> ';
    		foreach($topCategory as $v){
    			$tmpArr[] = '<a href = "'.$url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
    		}
    		$this->assign('topCategory',$tmpArr);
    		return;
    	}

    	$pid = $db->getCategoryPid($this->cid);
    	$topCategory = $db->getCategoryLevel(0);
    	$tmpArr = array();
    	$tmpArr[] = '<a href="'.$url.'">全部</a>';
    	foreach ($topCategory as $v){
    		if($pid == $v['cid'] || $this->cid == $v['cid']){
    			$tmpArr[] = '<a class="active" href="'.$url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
    		}else{
    			$tmpArr[] = '<a href = "'.$url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
    		}
    	}
    	$this->assign('topCategory',$tmpArr);


    	if($pid==0){
    		$sonCategory = $db->getCategoryLevel($this->cid);

    	}else{
    		$sonCategory = $db->getCategoryLevel($pid);

    	}
    	if(is_null($sonCategory))return;

    	$tmpArr = array();
    	if($pid == 0){
    		$tmpArr[] = '<a class="active"  href="'.$url.'/cid/'.$this->cid.'">全部</a>';
    	}else{
    		$tmpArr[] = '<a  href="'.$url.'/cid/'.$pid.'">全部</a>';
    	}
    	foreach ($sonCategory as $v){
    		if($v['cid'] == $this->cid){
    			$tmpArr[] = '<a class="active" href="'.$url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
    		}else{
    			$tmpArr[] = '<a  href="'.$url.'/cid/'.$v['cid'].'">'.$v['cname'].'</a>';
    		}
    	}
    	$this->assign('sonCategory', $tmpArr);
    }


    public function setLocality(){
    	$url = url_param_remove('lid',$this->url);
    	$db = K('locality');

    	if(is_null($this->lid)){
    		$topLocality = $db->getLocalityLevel(0);
    		$tmpArr = array();
    		$tmpArr[] = '<a class="active" href="'.$url.'">'."全部".'</a>';
    		foreach($topLocality as $v){
    			$tmpArr[] = '<a href="'.$url.'/lid/'.$v['lid'].'">'.$v['lname'].'</a>';
    		}
    		$this->assign('topLocality',$tmpArr);
    		return;

    	}

    	$pid = $db->getLocalityPid($this->lid);

    	$topLocality = $db->getLocalityLevel(0);
    		$tmpArr = array();
    		$tmpArr[] = '<a href="'.$url.'">'."全部".'</a>';
    		foreach($topLocality as $v){
    			if($pid == $v['lid'] || $this->lid == $v['lid']){
    				$tmpArr[] = '<a class="active" href="'.$url.'/lid/'.$v['lid'].'">'.$v['lname'].'</a>';
    			}else{
    				$tmpArr[] = '<a href="'.$url.'/lid/'.$v['lid'].'">'.$v['lname'].'</a>';
    			}
    		}
    		$this->assign('topLocality',$tmpArr);

		$tmpArr = array();
    	if($pid == 0){
    		$sonLocality = $db->getLocalityLevel($this->lid);
    		$tmpArr[] = '<a class="active" href="'.$url.'">'."全部".'</a>';
    	}else{
    		$sonLocality = $db->getLocalityLevel($pid);
    		$tmpArr[] = '<a href="'.$url.'">'."全部".'</a>';
    	}
    	if(is_null($sonLocality)) return;
    	foreach($sonLocality as $v){
    		if($this->lid == $v['lid']){
    				$tmpArr[] = '<a class="active" href="'.$url.'/lid/'.$v['lid'].'">'.$v['lname'].'</a>';
    			}else{
    				$tmpArr[] = '<a href="'.$url.'/lid/'.$v['lid'].'">'.$v['lname'].'</a>';
    			}
    	}
    	$this->assign('sonLocality',$tmpArr);
    }


    public function setPrice(){
    	$url = url_param_remove('price',$this->url);
    	$db = K('category');
    	$key = '';
    	if(is_null($this->cid)){
    		$key = 'all';
    	}else{
    		$pid = $db->getCategoryPid($this->cid);
    		$key = $pid?$pid:$this->cid;
    	}
    	$prices = C('price');
    	$price = $prices[$key];
    	$tmpArr = array();
    	if(is_null($this->price)){
    		$tmpArr[] = '<a class="active" href="'.$url.'">全部</a>';
    	}else{
    		$tmpArr[] = '<a  href="'.$url.'">全部</a>';
    	} 

    	foreach($price as $v){
    		if($this->price == $v[1]){
    			$tmpArr[] = '<a  class="active" href="'.$url.'/price/'.$v[1].'">'.$v[0].'</a>';
    		}else{
    			$tmpArr[] = '<a  href="'.$url.'/price/'.$v[1].'">'.$v[0].'</a>';
    		}
    	}
    	$this->assign('price',$tmpArr);
    }


    public function setOrderUrl(){
        $url = url_param_remove('order',$this->url);
        $orderUrl = array();
        $orderUrl['d'] = $url.'/order/t-desc';
        $orderUrl['b'] = $url.'/order/b-desc';
        $orderUrl['p_d'] = $url.'/order/p-desc';
        $orderUrl['p_a'] = $url.'/order/p-asc';
        $orderUrl['t'] = $url.'/order/t-desc';
        $this->assign('orderUrl',$orderUrl);
    }




}
?>