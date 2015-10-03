<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月27日下午5:39:28
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 登陆控制器
 */
class LoginController extends Controller {
	/*
	 * 载入登录页面
	 */
	public function loginAction() {
// 		session_start();
		include CUR_VIEW_PATH . 'login.html';
	}
	
	/*
	 * 处理用户登录的动作
	 */
	public function signinAction() {
		//0. 验证验证码
		$captcha = trim($_POST['captcha']);
		if (strtolower($captcha) != $_SESSION['captcha']) {
			$this->jump('index.php?p=admin&c=login&a=login', "别灌水了", 3);
		}
		
		//1. 收集用户名和密码
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
// 		//对用户名和密码进行转义
// 		$username = addslashes($username);
// 		$password = addslashes($password);
		//载入辅助函数
		$this->helper('input');
		$username = deepslashes($username);
		$password = deepslashes($password);
				
		//2. 验证和处理数据
		//3. 调用模型来进行验证，给出提示
		$adminModel = new AdminModel('admin');
		$user_info = $adminModel->checkUser($username, $password);
		if (empty($user_info)) {
			//不存在该用户
			$this->jump("index.php?p=admin&c=login&a=login", "<font color=red>用户名或密码错误</font>",3);
		} else {
			//登陆成功，保存用户登陆状态，跳转到后台首页
			$_SESSION['admin'] = $user_info;
			$this->jump("index.php?p=admin", "欢迎回来！", 1);
		}
	}
	
	/*
	 * 生成验证码
	 */
	public function captchaAction() {
		//载入验证码
		$this->library("Captcha");
		
		//实例化验证码类对象，并调用方法生成验证码
		$captcha = new Captcha();
		$captcha->generateCode();
		
		//保存到session中
		$_SESSION['captcha'] = $captcha->getCode();
	}
}
	