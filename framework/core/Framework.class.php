<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月21日下午9:51:04
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
//核心启动类
class Framework{
	
	//让项目启动起来
	public static function run(){
// 		echo "running...";
		self::init();
		self::autoload();
		self::router();
	}
	
	//初始化方法
	public static function init(){
		//定义路径,获取当前的工作路径 getcwd()
		define("DS", DIRECTORY_SEPARATOR);
		define("ROOT", getcwd() . DS);	//项目根目录
		define("APP_PATH", ROOT . "application" . DS);
		define("FRAMEWORK_PATH", ROOT . "framework" . DS);
		define("PUBLIC_PATH", ROOT . "public" . DS);
		define("MODEL_PATH", APP_PATH . "models" . DS);
		define("VIEW_PATH", APP_PATH . "views" . DS);
		define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);
		define("CONFIG_PATH", APP_PATH . "config" . DS);
		define("CORE_PATH", FRAMEWORK_PATH . "core" . DS);
		define("DB_PATH", FRAMEWORK_PATH . "database" . DS);
		define("HELPER_PATH", FRAMEWORK_PATH . "helpers" . DS);
		define("LIB_PATH", FRAMEWORK_PATH . "libraries" . DS);
		
		//前后台的控制器和视图目录的定义,解析url中的参数,才可以确定具体的路径
		define("PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : "home");
		define("CONTROLLER", isset($_REQUEST['c']) ? ucfirst($_REQUEST['c']) : "Index");
		define("ACTION", isset($_REQUEST['a']) ? $_REQUEST['a'] : "index");
		
		define("CUR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);
		define("CUR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);
		
		//上传文件路径常量
		define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DS);
		
		//手动载入核心类
		require CORE_PATH . "Controller.class.php";
		require CORE_PATH . "Model.class.php";
		require DB_PATH . "Mysql.class.php";
		$GLOBALS['config'] = include CONFIG_PATH . "config.php";
		
		//开启session，后面要用到
		session_start();
	}
	
	//路由方法
	public static function router(){
		//确定类名和方法名
		$controller_name = CONTROLLER . "Controller";	//如GoodsController
		$action_name = ACTION . "Action";
		//实例化控制器,然后调用相应的方法
		$controller = new $controller_name;
		$controller->$action_name();
	}
	
	//注册加载方法
	public static function autoload(){
		spl_autoload_register(array(__CLASS__, "load"));
	}
	
	//加载方法
	public static function load($classname){
		//只负责加载application下面的控制器类和模型类,如GoodsController, AdminModel
		if (substr($classname, -10) == 'Controller') {
			require CUR_CONTROLLER_PATH . "{$classname}.class.php";
		} elseif (substr($classname, -5) == "Model") {
			require MODEL_PATH . "{$classname}.class.php";
		} else {
			//其他情况,暂无
		}
	}
}
	