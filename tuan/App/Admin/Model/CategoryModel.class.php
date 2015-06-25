<?php  

class CategoryModel extends Model{

public $table = 'category';

public function allCat(){
	return $this->all();

}
public function getParentInfo($cid){
	$data = $this->where(array('cid'=>$cid))->find();
	if($data){
		return $data;
	}else{
		return array(
			'cid' => 0,
			'cname' =>'顶级分类'

			);
	}
}

public function addCategory($data){
	$res = $this->add($data);
	return $res;
}

public function getCurrent($cid){
	$data = $this->where(array('cid'=>$cid))->find();
	return $data;
}

public function updateCategory($data,$cid){
	$res = $this->where(array('cid'=>$cid))->save($data);
	return $res;
}

public function delCat($cid){
	$res = $this->where(array('cid'=>$cid))->delete();
	return $res;
}

public function checkChild($cid){
	$child = $this->where(array('pid'=>$cid))->count();
	return $child;
}



}





?>