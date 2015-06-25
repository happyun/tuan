<?php  

class GoodsControl extends Control{

	private $db;
	private $gid;

	public function __init(){
		$this->db = K('goods');
		$this->gid = $this->_get('gid');
	}


	public function index(){
		$total = $this->db->totalPro();
		$page = new Page($total,2,2);
		$data = $this->db->allPro($page->limit());
		$this->assign('page',$page->show());
		$this->assign('goods',$data);		
		$this->display();
	}

	public function add(){
		if(IS_POST){
			$data = $this->getData();
			$res = $this->db->addPro($data);
			if($res){
				$this->success('添加成功',U('Admin/Goods/index'));
			}
			else{
				$this->error('添加失败',U('Admin/Goods/index'));
			}
			exit;
		}
		$this->getShop();
		$this->getCat();
		$this->getLoc();
		$this->assign('goods_server',C('goods_server'));
		$this->display();
		
	}

	public function edit(){
		if(IS_GET){
			$data = $this->db->current($this->_get('gid'));
			$this->assign('server',C('goods_server'));
			$data['goods_server'] = unserialize($data['goods_server']);
			$this->assign('goods',$data);
			$this->display();
		}

		if(IS_POST){
			$data = $this->getData();
			$res = $this->db->updatePro($data,$this->gid);
			if($res){
				$this->success('编辑成功',U('Admin/Goods/index'));
			}
			else{
				throw new Exception('编辑失败!');
			}
		}
	

	}

	public function del(){
		$res = $this->db->delPro($this->gid);
		if($res){
			$this->success('删除成功',U('Admin/Goods/index'));
		}else{
			throw new Exception('编辑失败');
		}

	}
	public function getShop(){
		$shopid = $this->_get('shopid');
		$shop = K('shop')->getCurrent($shopid);
		$this->assign('shop',$shop);
	}

	public function getCat(){
		$data = K('category')->allCat();
		$category = Data::channel($data,'cid','pid',0,0,2,'--');
		$this->assign('category',$category);
	}

	public function getLoc(){
		$data = K('locality')->allLoc();
		$locality = Data::channel($data,'lid','pid',0,0,2,'--');
		$this->assign('locality',$locality);
	}

	private function getData(){
		$data = array();
		$data['goods']['cid'] = $this->_post('cid','intval');
		$data['goods']['lid'] = $this->_post('lid','intval');
		$data['goods']['shopid'] = $this->_post('shopid','intval');
		$data['goods']['price'] = $this->_post('price','intval');
		$data['goods']['old_price'] = $this->_post('old_price','intval');
		$data['goods']['main_title'] = $this->_post('main_title','strip_tags');
		$data['goods']['sub_title'] = $this->_post('sub_title','strip_tags');
		$data['goods']['begin_time'] = $this->_post('begin_time','strtotime');
		$data['goods']['end_time'] = $this->_post('end_time','strtotime');
		if(isset($_POST['goods_img'])){
			if(isset($_POST['old_img'])){
				foreach($_POST['old_img'] as $k=>$v){
					$this->delOldFile($_POST['old_img'][$k]['path']);
				}
				
			}
			$data['goods']['goods_img'] = $_POST['goods_img'][1]['path'];
		}
		$data['goods_detail']['detail'] = $_POST['detail'];
		$data['goods_detail']['goods_server'] = serialize($_POST['goods_server']);
		return $data;
	}


	public function delOldFile($img){
		$path = pathinfo($img);
		$pic = array(
			ROOT_PATH.$img,
			ROOT_PATH.$path['dirname'].'/'.$path['filename'].'_460x280'.$path['extension'],
			ROOT_PATH.$path['dirname'].'/'.$path['filename'].'200x100'.$path['extension'],
			ROOT_PATH.$path['dirname'].'/'.$path['filename'].'310x185'.$path['extension'],
			ROOT_PATH.$path['dirname'].'/'.$path['filename'].'90x55'.$path['extension']
			);
		foreach($oldFiles as $v){
			if(file_exists($v)) unlink($v);
		}
	}



}

















?>