<?php

/**
 * 后台分类管理控制器
 */
class CategoryController extends PlatformController {
	/**
	 * 显示分类管理首页
	 */
	public function indexAction(){
		//操作模型，提取所有的分类信息
		$category = Factory::M('CategoryModel');
		$cateInfo = $category->getCategory();
		//分配变量到视图文件
		$this->assign('cateInfo',$cateInfo);
		$this->display('index.html');
	}

	public function addAction(){
		//提取分类信息
		$category = Factory::M('CategoryModel');
		$cateInfo = $category->getCategory();
		//分配变量到视图文件
		$this->assign('cateInfo',$cateInfo);
		//输出视图
		$this->display('add.html');
	}

	/**
	 * dealAdd动作需要做的事
	 *接收数据
	 *判断数据合法性
	 *数据入库（写入到分类表）
	 *跳转到分类首页，能看到添加的分类的信息
	 */
	public function dealAddAction(){
		//接收数据
		$cate = array();
		$cate['cate_name'] = $this->escapeData($_POST['cate_name']);
		$cate['cate_pid'] = $_POST['cate_pid'];
		$cate['cate_sort'] = $this->escapeData($_POST['cate_sort']);
		$cate['cate_desc'] = $this->escapeData($_POST['cate_desc']);
		//判断数据的合法性
		if (empty($cate['cate_name']) || empty($cate['cate_desc']) || empty($cate['cate_sort'])) {
			$this->jump('index.php?p=Back&c=Category&a=add', ':( 信息不完整');
		}
		if (!is_numeric($cate['cate_sort']) || (int)$cate['cate_sort'] != $cate['cate_sort'] || $cate['cate_sort'] < 1) {
			$this->jump('index.php?p=Back&c=Category&a=add',':( 排序应该为1-50');
		}
		//3，数据入库，操作模型
		$category = Factory::M('CategoryModel');
		//调用insertCate方法
		$result = $category->insertCate($cate);
		//4，跳转分类首页
		if($result){
			$this->jump('index.php?p=Back&c=Category&a=index');
		}else{
			$this->jump('index.php?p=Back&c=Category&a=add',':( 发生未知错误，添加失败！');
		}
	}
	/**
	 * 展示修改分类的表单
	 * @return [type] [description]
	 */
	public function editAction() {
		//先获取当前分类的id号
		$cate_id = $_GET['cate_id'];
		//提取分类信息
		$category = Factory::M('CategoryModel');
		$cate = $category->getCategoryById($cate_id);
		//分配变量
		$this->assign('cate',$cate);
		//页面中依然要显示所有的分类，所以还是要提取所有的分类信息
		$cateInfo = $category->getCategory();
		$this->assign('cateInfo',$cateInfo);
		//输出视图
		$this->display('edit.html');
	}

	public function dealEditAction(){
		//接收数据
		$cate = array();
		$cate['cate_name'] = $this->escapeData($_POST['cate_name']);
		$cate['cate_pid'] = $_POST['cate_pid'];
		$cate['cate_sort'] = $this->escapeData($_POST['cate_sort']);
		$cate['cate_desc'] = $this->escapeData($_POST['cate_desc']);
		$cate['cate_id'] = $_POST['cate_id'];
		//判断数据的合法性
		if (empty($cate['cate_name']) || empty($cate['cate_desc']) || empty($cate['cate_sort'])) {
			$this->jump("index.php?p=Back&c=Category&a=edit&$cate_id={$cate['cate_id']}", ':( 信息不完整');
		}
		if (!is_numeric($cate['cate_sort']) || (int)$cate['cate_sort'] != $cate['cate_sort'] || $cate['cate_sort'] < 1) {
			$this->jump("index.php?p=Back&c=Category&a=edit&$cate_id={$cate['cate_id']}",':( 排序应该为1-50');
		}
		//3，数据入库，操作模型
		$category = Factory::M('CategoryModel');
		//调用insertCate方法
		$result = $category->updateCateById($cate);
		//4，跳转分类首页
		if($result){
			$this->jump('index.php?p=Back&c=Category&a=index');
		}else{
			$this->jump("index.php?p=Back&c=Category&a=edit&$cate_id={$cate['cate_id']}",':( 发生未知错误，修改失败！');
		}
	}

	/**
	 * 删除某条指定的分类的动作
	 */
	public function delAction(){
		//先获取当前要删除的分类的id号
		$cate_id = $_GET['cate_id'];
		//判断该分类是否可以被删除
		$category = Factory::M('CategoryModel');
		$subId = $category->getsubId($cate_id);
		if($subId){
			$this->jump('index.php?p=Back&c=Category&a=index',':( 该分类存在子分类，不能被删除');
		}
		$result = $category->delCategoryById($cate_id);
		if($result){
			$this->jump('index.php?p=Back&c=Category&a=index');
		}else{
			$this->jump('index.php?p=Back&c=Category&a=index',':( 发生未知错误，删除失败！');
		}
	}
	/**
	 * 批量删除分类动作
	 */
	public function delAllAction(){
		if(!isset($_POST['cate_id'])){
			$this->jump('index.php?p=Back&c=Category&a=index',':( 请先选择要删除的分类！');
		}
		//接收勾选的id号
		$cate_id = $_POST['cate_id'];
		//再判断是否存在子类
		$category = Factory::M('CategoryModel');
		foreach($cate_id as $id){
			if($category->getSubId($id)){
				//说明存在子分类，不能删除
				$this->jump('index.php?p=Back&c=Category&a=index',':( 不能删除有子分类的分类！');
			}
		}
		//最后再执行批量删除操作
		$result = $category->delAllCategory($cate_id);
		if($result){
			$this->jump('index.php?p=Back&c=Category&a=index');
		}else{
			$this->jump('index.php?p=Back&c=Category&a=index',':( 发生未知错误，批量删除失败！');
		}
	}
}