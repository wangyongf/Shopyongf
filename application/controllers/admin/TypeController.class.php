<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月29日下午4:44:15
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 商品类型控制器
 */
class TypeController extends BaseController {
	/*
	 * 显示商品类型
	 */
	public function indexAction() {
		//1. 获得所有的商品类型数据
		$typeModel = new TypeModel('goods_type');
// 		$types = $typeModel->getTypes();
		
		//改进版，分页输出
		//获取当前分页，通过url的参数(page)
		$current = isset($_GET['page']) ? $_GET['page'] : 1;
		
		//获取每页显示的记录数
		$pagesize = 2;
		$offset = ($current - 1) * $pagesize;
		$types = $typeModel->getPageTypes($offset, $pagesize);
		
		//使用分页类获取分页信息
		//获取总的记录数
		$where = "";	//此时条件为空
		$total = $typeModel->total($where);
		$this->library('Page');
		$page = new Page($total, $pagesize, $current, 'index.php', 
				array('p'=>'admin', 'c'=>'type', 'a'=>'index'));
		$pageinfo = $page->showPage();
		
		//2. 展示到视图
		include CUR_VIEW_PATH . "goods_type_list.html";
	}
		
	/*
	 * 展示添加界面
	 */
	public function addAction() {
		include CUR_VIEW_PATH . "goods_type_add.html";
	}
	
	/*
	 * 添加类型动作
	 */
	public function insertAction() {
		//1. 接收表单数据
		$data['type_name'] = trim($_POST['type_name']);
		
		//2. 验证及处理
		if ($data['type_name'] === '') {
			$this->jump("index.php?p=admin&c=type&a=add", "商品类型名称不能为空", 3);
		}
		
		//载入辅助函数
		$this->helper('input');
		$data = deepspecialchars($data);
		$data = deepslashes($data);
		
		//3. 调用模型完成入库，并给出提示
		$typeModel = new TypeModel('goods_type');
		if ($typeModel->insert($data)) {
			$this->jump('index.php?p=admin&c=type&a=index', "添加商品类型成功", 2);
		} else {
			$this->jump('index.php?p=admin&c=type&a=add', "添加商品类型失败", 3);
		}
	}
}
	