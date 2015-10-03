<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年10月2日下午2:01:20
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 商品模型
 */
class GoodsModel extends Model {
	/*
	 * 获取推荐商品
	 */
	public function getBestGoods() {
		$sql = "select * from {$this->table} where is_best = 1 
		and is_onsale = 1 order by add_time desc limit 4";
		return $this->db->getAll($sql);
	}
}
	