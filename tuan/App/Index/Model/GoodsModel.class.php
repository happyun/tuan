<?php  
class GoodsModel extends ViewModel{

	public $table = 'goods';

	public $cids = array();
	public $lids = array();
	public $price = '';
	public $keywords = null;
	public $order = '';


	public $view = array(
		'category'=>array(
			'type' => 'inner',
			'on'   =>'category.cid = goods.cid'
			),
		'locality'=>array(
			'type' => 'inner',
			'on'   => 'locality.lid=goods.lid'

			),
		'shop'    =>array(
			'type' =>'inner',
			'on'   =>'shop.shopid=goods.shopid'
			)
		);

	public function getGoods($limit){
		$result = null;
		if(is_null($this->keywords)){
			$where = rtrim('end_time>'.time().' and '.$this->price,' and ');
		}else{
			$where = 'sub_title like "%'.$this->keywords.'%"';
		}
		$fields = array(
			'goods.gid',
			'goods.goods_img',
			'goods.main_title',
			'goods.sub_title',
			'goods.price',
			'goods.old_price',
			'goods.buy'
			);
		if(!empty($this->cids) && !empty($this->lids)){
			$result = $this->field($fields)->where($where)->in($this->cids)->in($this->lids)->order($this->order)->limit($limit)->select();

		}else{
			if(!empty($this->cids)){
			$result = $this->field($fields)->where($where)->in($this->cids)->order($this->order)->limit($limit)->select();
			}
			if(!empty($this->lids)){
			$result = $this->field($fields)->where($where)->in($this->lids)->order($this->order)->limit($limit)->select();
			}
			if(empty($this->cids)&& empty($this->lids)){
			$result = $this->field($fields)->where($where)->order($this->order)->limit($limit)->select();
			}
		}
		return $result;
	}

	public function getGoodsTotal(){
		$count = 0;
		if(is_null($this->keywords)){
			$where = rtrim('end_time>'.time().' and '.$this->price,' and ');
		}else{
			$where = 'main_title like "%'.$this->keywords.'"';
		}
		
		//两个条件都存在的情况
		if(!empty($this->cids) && !empty($this->lids)){
			$count = $this->where($where)->in($this->cids)->in($this->lids)->count();
		}else{
			//存在分类筛选的情况
			if(!empty($this->cids)){
				$count = $this->where($where)->in($this->cids)->count();
			}
			//存在地区筛选的情况
			if(!empty($this->lids)){
				$count = $this->where($where)->in($this->lids)->count();
			}
		}
		//没有任何条件的情况
		if(empty($this->cids) && empty($this->lids)){
			$count = $this->where($where)->count();
		}
		return $count;


	}

	public function getGoodsDetail($gid){
		$this->view['goods_detail'] = array(
				'type'=>'inner',
				'on'=>'goods_detail.goods_id=goods.gid'
		);
		return $this->where(array('gid'=>$gid))->find();
	}


















	
}














?>