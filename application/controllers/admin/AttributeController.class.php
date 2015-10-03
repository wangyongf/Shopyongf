<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月29日下午11:18:19
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 属性控制器
 */
class AttributeController extends BaseController {
	/*
	 * 显示商品属性
	 */
	public function indexAction() {
		//获取所有的商品类型
		$typeModel = new TypeModel("goods_type");
		$types = $typeModel->getTypes();
		
		$attrModel = new AttributeModel('attribute');
		
		//接收type_id
		$type_id = $_GET['type_id'] + 0;
		
		//获取当前页
		$current = isset($_GET['page']) ? $_GET['page'] : 1;
		//获取每页的分页数
		$pagesize = 2;
		//总的记录数
		$where = "type_id = $type_id";
		$total = $attrModel->total($where); 
		
		//计算offset
		$offset = ($current - 1) * $pagesize;
		
		//分页获取该类型下所有的属性
// 		$attrs = $attrModel->getAttrs($type_id);
		$attrs = $attrModel->getPageAttrs($type_id, $offset, $pagesize);
		
		//实例化分页类，得到分页信息
		$this->library('Page');
		$page = new Page($total, $pagesize, $current, 'index.php',
				array('p'=>'admin', 'c'=>'attribute', 'a'=>'index', 'type_id'=>$type_id));
		$pageinfo = $page->showPage();
		
		include CUR_VIEW_PATH . "attribute_list.html";
	}
	
	/*
	 * 展示添加界面
	 */
	public function addAction() {
		//1. 获取所有的商品类型
		$typeModel = new TypeModel("goods_type");
		$types = $typeModel->getTypes();		
		
		//2. 载入视图
		include CUR_VIEW_PATH . "attribute_add.html";
	}
	
	/*
	 * 属性入库
	 */
	public function insertAction() {
		//1. 接收表单数据
		$data['attr_name'] = trim($_POST['attr_name']);
		$data['type_id'] = $_POST['type_id'];
		$data['attr_type'] = $_POST['attr_type'];
		$data['attr_input_type'] = $_POST['attr_input_type'];
		
		//对可选值列表做判断
		$data['attr_value'] = isset($_POST['attr_value']) ? $_POST['attr_value'] : "";
		
		//2. 验证及处理
		//载入辅助函数
		$this->helper('input');
		$data = deepspecialchars($data);
		$data = deepslashes($data);
		
		//3. 调用模型完成入库，并给出提示
		$attributeModel = new AttributeModel("attribute");
		if ($attributeModel->insert($data)) {
			$this->jump("index.php?p=admin&c=attribute&a=index", "添加属性成功", 2);
		} else {
			$this->jump("index.php?p=admin&c=attribute&a=add", "添加属性失败", 3);
		}
	}
	
	/*
	 * 获取指定类型下的属性
	 */
	public function getAttrsAction() {
		//获取type_id
		$type_id = $_GET['type_id'] + 0;
		
		//调用模型，查找属性并构造表单返回
		$attrModel = new AttributeModel("attribute");
		$attrs = $attrModel->getAttrsForm($type_id);
		echo <<<STR
<script type="text/javascript">
	window.parent.document.getElementById("tbody-goodsAttr").innerHTML = "$attrs";
</script>
STR;
	}
}
	