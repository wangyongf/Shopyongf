<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月30日下午9:25:37
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 商品品牌控制器
 */
class BrandController extends BaseController {
	/*
	 * 载入添加商品品牌界面
	 */
	public function addAction() {
		//载入视图
		include CUR_VIEW_PATH . "brand_add.html";
	}
}
	