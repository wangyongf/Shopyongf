<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月22日下午8:32:40
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
//基础控制器
class Controller{
	//定义跳转方法
	public function jump($url, $message, $wait=3) {
		if ($wait == 0) {
			header("Location:$url");
		} else {
			include CUR_VIEW_PATH . "message.html";
		}
		
		//要强制退出
		exit();
	}
	
	//定义载入辅助函数方法,如input_helper.php文件
	public function helper($helper){
		require HELPER_PATH . "{$helper}_helper.php";
	}
	
	//定义载入类文件的方法,如Page.class.php
	public function library($lib){
		require LIB_PATH . "{$lib}.class.php";
	}
}
	