<?php  
class CategoryModel extends Model{

	public function getCategoryLevel($pid){
		$res = $this->field('cname,cid')->where(array('pid'=>$pid))->select();
		return $res;

	}

	public function getCategoryPid($cid){
		$res = $this->field('pid')->where(array('cid'=>$cid))->find();
		if(is_array($res)) {
			$pid = current($res);
			return $pid;}else{
				return false;
			}
	}

	public function getSonCategory($cid){
		$res = $this->field('cid')->where(array('pid'=>$cid))->select();
		return $res;
		
		

	}



















}











?>