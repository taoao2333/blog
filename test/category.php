<?php
header("Content-type:text/html;Charset=utf-8");
include './MySQLDB.class.php';
$arr = array(
	'pass'=>'admin',
	'dbname'=>'php2017'
);
$db = MySQLDB::getInstance($arr);

$sql = "select * from category";
$list = $db->fetchAll($sql);
// foreach ($list as $row ) {
// 	echo $row['cate_name'],'<br>';
// }
/**
 * 格式化分类列表，树状展示
 * @param array $list 原始分类列表
 * @param int $pid 父类id号
 * @param int $level 缩进级别
 * @return array $cate_list 格式化之后的分类列表
 */
function getCateTree($list,$pid=0,$level=0) {
	//定义静态数组用于存放格式化之后分类列表
	static $cate_list = array();
	//遍历
	foreach($list as $row) {
		if($row['cate_pid'] == $pid) {
			$row['level'] = $level;
			$cate_list[] = $row;
			getCateTree($list,$row['cate_id'],$level+1);
		}
	}
	return $cate_list;
}
	$cate_list = getCateTree($list);

	foreach($cate_list as $row) {
		echo str_repeat('-', 5*$row['level']),$row['cate_name'],'<br>';
	}
