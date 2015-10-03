<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月25日下午3:24:27
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 商品分类模型
 */
class CategoryModel extends Model {
	
	/*
	 * 获取所有的分类信息
	 */
	public function getCats() {
		$sql = "SELECT * FROM {$this->table}";
		$cats = $this->db->getAll($sql);
		return $this->tree($cats);
	}
	
	/*
	 * 定义一个方法，用于形成树状结构
	 * @param $arr array 给定数组
	 * @param $pid int 指定从哪个节点开始找
	 * @return array 构造好的数组 
	 */
	public function tree($arr, $pid=0, $level=0) {
		static $tree = array();
		foreach ($arr as $v) {
			if ($v['parent_id'] == $pid) {
				$v['level'] = $level;
				$tree[] = $v;
				$this->tree($arr, $v['cat_id'], $level+1);
			}
		}
		return $tree;
	}
	
	/*
	 * 获取指定节点的所有的子孙节点的id
	 */
	public function getSubIds($pid) {
		$sql = "SELECT * FROM {$this->table}";
		$cats = $this->db->getAll($sql);
		$cats = $this->tree($cats, $pid);
		$list = array();
		foreach ($cats as $cat) {
			$list[] = $cat['cat_id'];
		}
		return $list;
	}
	
	/*
	 * 将二维数组转为多维数组（包含关系）
	 */
	public function childList($arr, $pid=0) {
		$list = array();
		foreach ($arr as $v) {
			if ($v['parent_id'] == $pid) {
				//说明找到了，继续以该节点作为当前节点来查找其后代节点
				$child = $this->childList($arr, $v['cat_id']);
				
				//再将找到的这个结果保存起来
				$v['child'] = $child;
				$list[] = $v;
			}
		}
		return $list;
	}
	
	/*
	 * 在前台获得所有的分类数据
	 */
	public function frontCats() {
		$sql = "SELECT * FROM {$this->table}";
		$cats = $this->db->getAll($sql);
		return $this->childList($cats);
	}
}
	