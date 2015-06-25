<?php 	 

class LocalityModel extends Model{

	public function getLocalityLevel($pid){
		$res = $this->field('lid,lname')->where(array('pid'=>$pid))->select();
		return $res;
	}

	public function getLocalityPid($lid){
		$res = $this->field('pid')->where(array('lid'=>$lid))->find();
		if($pid = current($res)) {
			return $pid;
		}
		return false;
	}

	public function getSonLocality($lid){
		$res = $this->field('lid')->where(array('pid'=>$lid))->select();
		return $res;

	}



















}























?>