<?php  

class CategoryControl extends Control{

	private $db;
	private $cid;

	public function __init(){
		$this->db = K('Category');
		$this->cid = $this->_get('cid','intval',0);

	}

	public function index(){
		$dataRes = $this->db->allCat();
		$data = Data::channel($dataRes,'cid','pid',0,0,2,'--');
		$this->assign('data',$data);
		$this->display();
	}

	public function add(){
		if(IS_GET){
		$parent = $this->db->getParentInfo($this->cid);
		$this->assign('parent',$parent);

		$category = $this->db->allCat();
		$catList = Data::channel($category,'cid','pid',0,0,2,'--');
		$this->assign('level',$catList);	
		$this->display();
		exit;
		}

		$data = $this->getData();
		if($this->db->addCategory($data)){
			$this->success('添加成功',U('Admin/Category/index'));
		}else{
			$this->error('添加失败');
		}
	}

	public function edit(){
		if(IS_GET){
			$category = $this->db->allCat();
			$catList = Data::channel($category,'cid','pid',0,0,2,'--');
			$this->assign('level',$catList);

			$oldData = $this->db->getCurrent($this->cid);
			$parent = $this->db->getParentInfo($oldData['pid']);
			$this->assign('parent',$parent);
			$this->assign('category',$oldData);
			$this->display();
			exit;
		}

		$data = $this->getData();
		if($this->db->updateCategory($data,$this->cid)){
			$this->success('编辑成功',U('Admin/Category/index'));
		}else{
			$this->error('编辑失败',U('Admin/Category/index'));
		}

	}

	public function del(){
		if(IS_GET){
			if($this->db->checkChild($this->cid)){
				$this->error('请先删除子分类',U('Admin/Category/index'));
				exit;
			}

			$res = $this->db->delCat($this->cid);
			if($res){
				$this->success('删除成功',U('Admin/Category/index'));
			}else{
				$this->error('非法删除',U('Admin/Category/index'));
			}
		}else{
		$this->error('非法删除',U('Admin/Category/index'));
	}
}

	private function getData(){
		$data = array();
		$data['cname'] = $this->_post('cname','strip_tags');
		$data['title'] = $this->_post('title','htmlspecialchars');
		$data['keywords'] = $this->_post('keywords','htmlspecialchars');
		$data['description'] = $this->_post('description','htmlspecialchars');
		$data['sort'] = $this->_post('sort','intval');
		$data['display'] = $this->_post('display','intval');
		$data['pid'] = $this->_post('pid','intval');
		return $data;
	}
		


		}





























?>