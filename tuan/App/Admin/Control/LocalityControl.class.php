<?php 	 
class LocalityControl extends Control{

	private $db;
	private $lid;

	public function __init(){
		$this->db = K('locality');
		$this->lid = $this->_get('lid');
	}

	public function index(){
		$dataRes = $this->db->allLoc();
		$data = Data::channel($dataRes,'lid','pid',0,0,2,'--');
		$this->assign('data',$data);
		$this->display();
	}

	public function add(){
		if(IS_GET){
		$parent = $this->db->getParentInfo($this->lid);
		$this->assign('parent',$parent);

		$locality = $this->db->allLoc();
		$catList = Data::channel($locality,'lid','pid',0,0,2,'--');
		$this->assign('level',$catList);	
		$this->display();
		exit;
		}

		$data = $this->getData();
		if($this->db->addLocality($data)){
			$this->success('添加成功',U('Admin/Locality/index'));
		}else{
			$this->error('添加失败',U('Admin/Locality/index'));
		}
	}

	public function edit(){
		if(IS_GET){
			$locality = $this->db->allLoc();
			$catList = Data::channel($locality,'lid','pid',0,0,2,'--');
			$this->assign('level',$catList);

			$oldData = $this->db->getCurrent($this->lid);
			$parent = $this->db->getParentInfo($oldData['pid']);
			$this->assign('parent',$parent);
			$this->assign('locality',$oldData);
			$this->display();
			exit;
		}

		$data = $this->getData();
		if($this->db->updateLocality($data,$this->lid)){
			$this->success('编辑成功',U('Admin/Locality/index'));
		}else{
			$this->error('编辑失败',U('Admin/Locality/index'));
		}
	}

	public function del(){
		if(IS_GET){
			if($this->db->checkChild($this->lid)){
				$this->error('请先删除子分类',U('Admin/Locality/index'));
				exit;
			}

			$res = $this->db->delLoc($this->lid);
			if($res){
				$this->success('删除成功',U('Admin/Locality/index'));
			}else{
				$this->error('非法删除',U('Admin/Locality/index'));
			}
		}else{
		$this->error('非法删除',U('Admin/Locality/index'));
	}
	}


	private function getData(){
		$data = array();
		$data['lname'] = $this->_post('lname','strip_tags');
		$data['sort'] = $this->_post('sort','intval');
		$data['display'] = $this->_post('display','intval');
		$data['pid'] = $this->_post('pid','intval');
		return $data;
	}


}






























?>