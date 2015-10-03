<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月22日下午9:29:26
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * Admin模型
 */
class AdminModel extends Model{
	/*
	 * 验证用户是否合法
	 */
	public function checkUser($username, $password) {
		$password = md5($password);
		$sql = "SELECT * FROM {$this->table} 
		WHERE admin_name = '$username' AND password = '$password' 
		LIMIT 1";
		return $this->db->getRow($sql);
	}
	
	public function test(){
		$sql = "SELECT * FROM {$this->table}";
		return $this->db->getAll($sql);
	}
}
	