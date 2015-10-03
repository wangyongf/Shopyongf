<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年10月2日下午2:58:59
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 前台首页控制器
 */
class IndexController extends Controller {
	/*
	 * 显示首页
	 */
	public function indexAction() {
		$categoryModel = new CategoryModel("category");
		$cats = $categoryModel->frontCats();
		$goodsModel = new GoodsModel("goods");
		$bestGoods = $goodsModel->getBestGoods();
		
		//载入首页模块
		include CUR_VIEW_PATH . "index.html";
	}
}
	