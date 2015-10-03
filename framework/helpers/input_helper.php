<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年9月23日上午9:15:40
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 批量转义，其实，可以把对接收的数据的处理全部放到一个函数中去，比如trim()函数也放到这个函数中
 */
function deepslashes($data) {
// 	//判断$data的表现形式
// 	if (empty($data)) {
// 		return $data;
// 	}
	
	//中高级程序员的写法，被注释的地方是所谓的初级程序员的写法？
	return empty($data) ? $data : (is_array($data) ? array_map('deepslashes', $data) : addslashes($data));
	
// 	if (is_array($data)) {
// 		//数组，对其进行遍历
// 		foreach ($data as $v) {
// 			return deepslashes($v);
// 		}
// 	} else {
// 		//单一变量
// 		return addslashes($data);
// 	}
}

/*
 * 批量实体转义
 */
function deepspecialchars($data) {
	if (empty($data)) {
		return $data;
	}
	return is_array($data) ? array_map('deepspecialchars', $data) : htmlspecialchars($data);
}

/*
 * 处理输入的函数文件
 */
function f1() {
	echo "f1 helper...";
}
	