<?php
/**
 * 后台分类表操作模型
 */
class CategoryModel extends Model {
	public function getCategory(){
		$sql= "select * from bg_category order by cate_sort asc";
		$list = $this->dao->fetchAll($sql);
		return $this->getCateTree($list);
	}
	/**
	 * 格式化分类列表，树状展示
	 * @param  array $list  原始分类列表
	 * @param  integer $pid   父类ID号
	 * @param  integer $level 缩进级别
	 * @return array $cate_list 格式化之后的分类列表
	 */
	public function getCateTree($list,$pid=0,$level=0) {
		//定义静态数组用于存放格式化之后分类列表
		static $cate_list = array();
		//遍历
		foreach ($list as $row) {
			if ($row['cate_pid'] == $pid) {
				$row['level'] = $level;
				$cate_list[] = $row;
				//递归点
				$this->getCateTree($list,$row['cate_id'],$level+1);
			}
		}
		return $cate_list;
	}

	/**
	 * 添加分类入库
	 * @parma array $cate 分类的信息数组
	 */
	public function insertCate($cate){
		//通过数组得到多个变量
		extract($cate);
		$sql="insert into bg_category values (null,'$cate_name',$cate_pid,$cate_sort,'$cate_desc')";
		return $this->dao->my_query($sql);
	}

	/**
	 * 根据id号获取单个分类的信息
	 */
	public function getCategoryById($cate_id){
		$sql="select * from bg_category where cate_id = $cate_id";
		return $this->dao->fetchRow($sql);
	}

	public function updateCateById($cate){
		extract($cate);
		$sql = "update bg_category set cate_name = '$cate_name',cate_pid=$cate_pid,cate_sort = $cate_sort,cate_desc = '$cate_desc' where cate_id = $cate_id";
		return $this->dao->my_query($sql);
	}

	/**
	 * 获取当前分类的子分类
	 */
	public function getSubId($cate_id){
		$sql="select * from bg_category where cate_pid = $cate_id";
		return $this->dao->fetchAll($sql);
	}
	/**
	 * 根据id号删除某个分类
	 */
	public function delCategoryById($cate_id){
		$sql="delete from bg_category where cate_id = $cate_id";
		return $this->dao->my_query($sql);
	}
	/**
	 * 批量删除分类
	 */
	public function delAllCategory($cate_id){
		$cate_id = implode(',', $cate_id);
		$sql="delete from bg_category where cate_id in($cate_id)";
		return $this->dao->my_query($sql);
	}
}
