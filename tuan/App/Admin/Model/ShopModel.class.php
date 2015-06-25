<?php  

class ShopModel extends Model{
	public $table = 'shop';

	public function addshop($data){
		$res = $this->add($data);
		return $res;
	}

	public function totalShop(){
		$shop = $this->count();
		return $shop;
	}

	public function getShop($limit){
		$data = $this->limit($limit)->select();
		return $data;
	}

	public function getCurrent($shopid){
		$data = $this->where(array('shopid'=>$shopid))->find();
		return $data;
	}

	public function updateshop($data,$shopid){
		$res = $this->where(array('shopid'=>$shopid))->update($data);
		return $res;
	}

	public function delShop($shopid){
		$res = $this->where(array('shopid'=>$shopid))->delete();
		return $res;
	}




}














?>