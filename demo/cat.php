<?php
/**
 * www.i466.cn
 * blog.csdn.net/yongf2014
 * ==============================================
 * 版权所有 1996-2100 http://www.i466.cn
 *  ----------------------------------------------
 * 这是一个自由软件,但是未经授权不得用于任何商业目的和用途
 * ==============================================
 * @date: 2015年10月2日下午3:23:13
 * @author: Scott_Wang
 * @version:1.1.0
 */
	
/*
 * 期望的数据
 */
array(
		array(
				"cat_id"=>1,
				"cat_name"=>"男女服装",
				"parent_id"=>0,
				"child" => array(
						array(
								"cat_id"=>2,
								"cat_name"=>"男装",
								"parent_id"=>1,
								"child"=> array(
										array(
												"cat_id"=>5,
												"cat_name"=>"西服",
												"parent_id"=>2,
												
										),
								)
						),
						array(
								"cat_id"=>3,"cat_name"=>"女装",
								"parent_id"=>1
						),
				)
		),
		array("cat_id"=>2,"cat_name"=>"男装","parent_id"=>1),
		array("cat_id"=>3,"cat_name"=>"女装","parent_id"=>1),
		array("cat_id"=>4,"cat_name"=>"裙子","parent_id"=>3),
		array("cat_id"=>5,"cat_name"=>"西服","parent_id"=>2),
		array("cat_id"=>6,"cat_name"=>"鞋帽服饰","parent_id"=>0),
		array("cat_id"=>7,"cat_name"=>"鞋子","parent_id"=>6),
		array("cat_id"=>8,"cat_name"=>"帽子","parent_id"=>6),
);

/*
 * 数据库中的数据
 */
array(
		array("cat_id"=>1,"cat_name"=>"男女服装","parent_id"=>0),
		array("cat_id"=>2,"cat_name"=>"男装","parent_id"=>1),
		array("cat_id"=>3,"cat_name"=>"女装","parent_id"=>1),
		array("cat_id"=>4,"cat_name"=>"裙子","parent_id"=>3),
		array("cat_id"=>5,"cat_name"=>"西服","parent_id"=>2),
		array("cat_id"=>6,"cat_name"=>"鞋帽服饰","parent_id"=>0),
		array("cat_id"=>7,"cat_name"=>"鞋子","parent_id"=>6),
		array("cat_id"=>8,"cat_name"=>"帽子","parent_id"=>6),
);
	