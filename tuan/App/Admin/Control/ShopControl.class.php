<?php  

class ShopControl extends Control{


	public function __init(){
		$this->db = K('shop');
		$this->shopid = $this->_get('shopid');
	}

	public function index(){
		$total = $this->db->totalShop();
		$page = new page($total,1);
		$data = $this->db->getShop($page->limit());
		$this->assign('page',$page->show());
		$this->assign('data',$data);
		$this->display();
	}

	public function add(){
		if(IS_POST){
			$data = $this->getData();
			if($this->db->addshop($data)){
				$this->success('添加成功',U('Admin/Shop/index'));
			}else{
				$this->error('添加失败');
			}
		}
		
		$this->display();
	}

	public function edit(){
			if(IS_GET){
			$oldData = $this->db->getCurrent($this->shopid);
			$this->assign('shop',$oldData);
			$this->display();
			exit;
		}

		$data = $this->getData();
		if($this->db->updateshop($data,$this->shopid)){
			$this->success('编辑成功',U('Admin/shop/index'));
		}else{
			$this->error('编辑失败',U('Admin/shop/index'));
		}
	}

	public function del(){

		if(IS_GET){
			$res = $this->db->delShop($this->shopid);
			if($res){
				$this->success('删除成功',U('Admin/shop/index'));
			}else{
				$this->error('删除失败',U('Admin/shop/index'));
			}
		}
	}

	private function getData(){
		$data = array();
		$data['shopname'] = $this->_post('shopname','strip_tags');
		$data['shopaddress'] = $this->_post('shopaddress','htmlspecialchars');
		$data['metroaddress'] = $this->_post('metroaddress','htmlspecialchars');
		$data['shoptel'] = $this->_post('shoptel','htmlspecialchars');
		$data['shopcoord'] = $this->_post('shopcoord','strip_tags');
		return $data;
	}


















}












?>