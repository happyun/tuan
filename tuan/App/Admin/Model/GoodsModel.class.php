<?php  

class GoodsModel extends ViewModel{
	public $table = 'goods';
	public $view = array(
		'category' => array(
			'type' => 'inner',
			'on'   =>'category.cid=goods.cid'
			),
		'locality' =>array(
			'type' => 'inner',
			'on'   => 'locality.lid=goods.lid'
			),
		'shop'     => array(
			'type' =>'inner',
			'on'   =>'shop.shopid = goods.shopid'
			)

		);


	public function addPro($data){
		$res = null;
		$res1 = $this->table('goods')->add($data['goods']);
		if($res1){
			$data['goods_detail']['goods_id'] = $res1;
			$res = $this->table('goods_detail')->add($data['goods_detail']);
		}
		return $res;
		
	}

	public function updatePro($data,$gid){
		$res = $this->table('goods')->where(array('gid'=>$gid))->save($data['goods']);
		$res2 = $this->table('goods_detail')->where(array('goods_id'=>$gid))->save($data['goods_detail']);

	}

	public function totalPro(){
		return $this->count();
	}
	public function allPro($limit){
		return $this->limit($limit)->select();
	}
	public function current($gid){
		$this->view['goods_detail'] = array('type' => 'inner','on' => 'goods_detail.goods_id = goods.gid');
		$res = $this->where(array('gid'=>$gid))->find();
		return $res;
	}

	public function delPro($gid){
		$res1 = $this->table('goods_detail')->where(array('goods_id'=>$gid))->delete();
		$res = $this->table('goods')->where(array('gid'=>$gid))->delete();
		
		if($res && $res1){
			return true;
		}else{
			return false;
		}
	}



}












?>