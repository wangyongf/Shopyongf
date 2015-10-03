<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月29日下午11:39:34
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 属性模型
 */
 class AttributeModel extends Model {
 	/*
 	 * 获取所有的商品属性
 	 */
 	public function getAttrs($type_id) {
//  		$sql = "SELECT * FROM {$this->table} WHERE type_id = $type_id";
		$sql = "SELECT a.*,b.type_name FROM yongf_attribute as a inner 
				join yongf_goods_type as b on a.type_id = b.type_id where a.type_id = $type_id";
 		return $this->db->getAll($sql);
 	}
 	
 	/*
 	 * 分页获取制定类型下的属性
 	 */
 	public function getPageAttrs($type_id, $offset, $pagesize) {
 		$sql = "SELECT a.*,b.type_name FROM yongf_attribute as a inner
 				join yongf_goods_type as b on a.type_id = b.type_id where a.type_id = $type_id 
 				limit $offset, $pagesize";
 		return $this->db->getAll($sql);
 	}
 	
 	/*
 	 * 获取指定类型下的属性，并构成表单
 	 */
 	public function getAttrsForm($type_id) {
 		//获取该类型下所有的属性
 		$sql = "select * from {$this->table} where type_id = $type_id";
 		$attrs = $this->db->getAll($sql);
 		
 		$res = "<table width='100%' id='attrTable'>";
 		$res .= "<tbody>";
 		foreach ($attrs as $attr) {
 			$res .= "<tr>";
 			$res .= "<td class='label'>{$attr['attr_name']}</td>";
 			$res .= "<td>";
 			$res .= "<input type='hidden' name='attr_id_list[]' value='" . $attr['attr_id'] . "'>";
 			
 			//根据attr_input_type不同的值，生成不同的表单元素
 			switch ($attr['attr_input_type']) {
 				case 0: #文本框
 					$res .= "<input name='attr_value_list[]' type='text' size='40'>";
 					break;
 				case 1: #下拉列表
 					$res .= "<select name='attr_value_list[]'>";
 					$res .= "<option value=''>请选择...</option>";
 					$opts = explode(PHP_EOL, $attr['attr_value']);
 					foreach ($opts as $opt) {
	 					$res .= "<option value='$opt'>$opt</option>";
 					}
 					$res .= "</select>";
 					break;
 				case 2: #多行文本
 					$res .= "<textarea name='attr_value_list[]'></textarea>";
 					break;
 			}
 			
 			$res .= "<input type='hidden' name='attr_price_list[]' value='0'>";
 			$res .= "</td>";
 			$res .= "</tr>";
 		}
 		$res .= "</tbody>";
 		$res .= "</table>";
 		return $res;
 	}
}