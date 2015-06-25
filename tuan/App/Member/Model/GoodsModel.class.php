<?php  

class GoodsModel extends ViewModel{
	public $table = 'goods';
	public $view ;

	public function getGoodsFind($gid){
		return $this->where(array('gid'=>$gid))->find();
	}

	public function updateBuy($orders){
		$this->view = array(
			'order' =>array(
				'type' =>'inner',
				'on'   =>'order.goods_id=goods.gid'
				)
			);
		$res = $this->field('gid')->in(array('orderid'=>$orders))->select();
		$gids = array();
		foreach($res as $v){
			$gids[] = $v['gid'];
		}
		$this->table('goods')->in(array('gid'=>$gids))->inc('buy','',1);

	}

	public function getGoods($gids){
		return $this->in(array('gid'=>$gids))->limit(3)->select();

	}











}














?>