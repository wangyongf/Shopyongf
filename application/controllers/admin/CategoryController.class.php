<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月25日下午2:29:16
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 商品分类控制器
 */
class CategoryController extends BaseController {
	
	/*
	 * 显示商品分类
	 */
	public function indexAction() {
		$categoryModel = new CategoryModel("category");
		$cats = $categoryModel->getCats();
		
		//载入显示页面
		include CUR_VIEW_PATH . "cat_list.html";
	}
	
	/*
	 * 展示添加分类动作
	 */
	public function addAction() {
		$categoryModel = new CategoryModel("category");
		$cats = $categoryModel->getCats();
// 		var_dump($cats);
		include CUR_VIEW_PATH . "cat_add.html";
	}
	
	/*
	 * 添加分类动作
	 */
	public function insertAction() {
		//1. 收集表单数据
		$data['cat_name'] = trim($_POST['cat_name']);
		$data['parent_id'] = $_POST['parent_id'];
		$data['unit'] = trim($_POST['unit']);
		$data['sort_order'] = trim($_POST['sort_order']);
		$data['is_show'] = $_POST['is_show'];
		$data['cat_desc'] = trim($_POST['cat_desc']);
		
		//2. 验证及处理
		//判断分类名称是否为空
		if ($data['cat_name'] === "") {
			$this->jump("index.php?p=admin&c=category&a=add", "分类名称不能为空", 3);
		}
		
		//载入辅助函数
		$this->helper('input');
		//完成实体转义
		$data = deepspecialchars($data);		
		
		//3. 调用模型， 完成入库， 并给出提示
		$categoryModel = new CategoryModel("category");
		if ($categoryModel->insert($data)) {
			$this->jump("index.php?p=admin&c=category&a=index", "添加分类成功", 2);
		} else {
			$this->jump("index.php?p=admin&c=category&a=add", "添加分类失败", 3);
		}
	}
	
	/*
	 * 载入分类动作
	 */
	public function editAction() {
		//1.获取当前分类的信息
		//这里加0是阻止Url攻击！
		$cat_id = $_GET['cat_id'] + 0;
		$categoryModel = new CategoryModel('category');
		$cat = $categoryModel->selectByPk($cat_id);
		
		//获取所有的分类信息
		$cats = $categoryModel->getCats();
		
		//2.载入编辑表单
		include CUR_VIEW_PATH . "cat_edit.html";
	}
	
	/*
	 * 更新分类信息动作
	 */
	public function updateAction() {
		//1.收集表单数据
		$data['cat_name'] = trim($_POST['cat_name']);
		$data['parent_id'] = $_POST['parent_id'];
		$data['unit'] = trim($_POST['unit']);
		$data['sort_order'] = trim($_POST['sort_order']);
		$data['is_show'] = $_POST['is_show'];
		$data['cat_desc'] = trim($_POST['cat_desc']);
		$data['cat_id'] = $_POST['cat_id'];
		
		//2.验证及处理
		//判断分类名称是否为空
		if ($data['cat_name'] === "") {
			$this->jump("index.php?p=admin&c=category&a=add", "分类名称不能为空", 3);
		}

		//不能将当前节点及其子节点作为上级节点
		$categoryModel = new CategoryModel('category');
		//获取当前节点的所有子孙节点
		$ids = $categoryModel->getSubIds($data['cat_id']);
		//将当前节点的id合并进去
		$ids[] = $data['cat_id'];
		if (in_array($data['parent_id'], $ids)) {
			$this->jump('index.php?p=admin&c=category&a=edit&cat_id=' . $data['cat_id'], "不能将当前节点或其子孙节点作为上级节点",3);
		}
		
		//3. 调用模型完成更新操作
		if ($categoryModel->update($data)) {
			$this->jump("index.php?p=admin&c=category&a=index", "更新成功", 2);
		} else {
			$this->jump("index.php?p=admin&c=category&a=edit&cat_id=" .$data['cat_id'], "更新失败", 3);
		}
	}
	
	public function deleteAction() {
		//1. 获取商品分类
		$cat_id = $_GET['cat_id'] + 0;
		
		//2. 做一些相应的判断
		//如果不是叶子分类，则不允许删除
		$categoryModel = new CategoryModel('category');
		$cats = $categoryModel->getSubIds($cat_id);
		if (!empty($cats)) {
			$this->jump('index.php?p=admin&c=category&a=index', '不是叶子分类，不允许删除！', 5);
		}		
		
		//3. 调用模型，完成删除，并给出提示
		if ($categoryModel->delete($cat_id)) {
			$this->jump('index.php?p=admin&c=category&a=index', "删除商品分类成功", 2);
		} else {
			$this->jump('index.php?p=admin&c=category&a=index', "删除商品分类失败", 3);
		}
	}
}
	