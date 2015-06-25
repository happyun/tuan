<?php  

class LocalityModel extends Model{

public $table='locality';

public function getParentInfo($lid){
	$data = $this->where(array('lid'=>$lid))->find();
	if($data){
		return $data;
	}else{
		return array(
			'lid' => 0,
			'lname' =>'顶级地区'
			);
	}
}

public function allLoc(){
	return $this->all();
}

public function addLocality($data){
	$res = $this->add($data);
	return $res;
}

public function getCurrent($lid){
	return $this->where(array('lid'=>$lid))->find();
}

public function updateLocality($data,$lid){
	$res = $this->where(array('lid'=>$lid))->save($data);
	return $res;
}
public function checkChild($lid){
	$res = $this->where(array('pid'=>$lid))->count();
	return $res;
}
public function delLoc($lid){
	$res = $this->where(array('lid'=>$lid))->delete();
	return $res;

}






}












?>