<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年10月2日下午4:41:08
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 后台基础控制器
 */
class BaseController extends Controller {
	/*
	 * 构造方法
	 */
	public function __construct() {
		$this->checkLogin();
	}
	
	/*
	 * 验证用户是否登录
	 */
	public function checkLogin() {
		//只需要检查session即可
		if (empty($_SESSION['admin'])) {
			//说明没有登陆，就需要给出提示，并跳转到登录页面
			$this->jump("index.php?p=admin&c=login&a=login", "你还没有登陆呢！", 3);
		}
	}
}
	