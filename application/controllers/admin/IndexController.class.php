<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月22日下午2:43:02
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
//后台控制器
class IndexController extends Controller{
	public function indexAction(){
		//echo "admin...index";
		include CUR_VIEW_PATH . "index.html";
	}
	
	public function topAction(){
		include CUR_VIEW_PATH . "top.html";
	}
	
	public function menuAction(){
		include CUR_VIEW_PATH . "menu.html";
	}
	
	public function dragAction(){
		include CUR_VIEW_PATH . "drag.html";
	}
	
	public function mainAction(){
		include CUR_VIEW_PATH . "main.html";
// 		//载入辅助函数
// 		$this->helper("input");
// 		f1();
// 		//实例化admin模型
// 		$adminModel = new AdminModel("admin");	//传递不要前缀的表名
// 		$admins = $adminModel->test();
// 		echo "<pre>";
// 		var_dump($admins);
// 		echo "</pre>";
	}
}

