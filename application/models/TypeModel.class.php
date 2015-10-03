<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月29日下午6:53:11
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 商品类型模型
 */
class TypeModel extends Model {
	/*
	 * 获取所有的商品类型
	 */
	public function getTypes() {
		$sql = "SELECT * FROM {$this->table} ORDER BY type_id";
		return $this->db->getAll($sql);
	}
	
	/*
	 * 分页获取商品类型数据
	 */
// 	public function getPageTypes($offset, $pagesize) {
// 		$sql = "SELECT * FROM {$this->table} ORDER BY type_id LIMIT $offset, $pagesize";
// 		return $this->db->getAll($sql);
// 	}
	
	/*
	 * 分页获取商品类型数据，改进版
	 */
	public function getPageTypes($offset, $pagesize) {
		$sql = "SELECT a.*,COUNT(b.attr_name) AS num FROM {$this->table} AS a 
					LEFT JOIN yongf_attribute AS b 
				    ON a.type_id = b.type_id GROUP BY a.type_id ORDER BY type_id LIMIT $offset,$pagesize";
		return $this->db->getAll($sql); 
	}
}
	