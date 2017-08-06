<?php
/**
 * 后台文章管理控制器
 */
class ArticleController extends PlatformController{
	/**
	 * 文章首页动作
	 */
	public function indexAction() {
		//提取所有文章的信息
		$article = Factory::M('ArticleModel');
		$artInfo = $article->getArticle();
		//分配变量
		$this->assign('artInfo',$artInfo);	
		//------------分页--------
		$rowsPerPage = $GLOBALS['conf']['Page']['rowsPerPage'];
		$maxNum = $GLOBALS['conf']['Page']['maxNum'];
		$url = 'index.php?p=Back&c=Article&a=index';
		$rowCount = $article->getRowCount();
		//实例化分页类
		$page = new Page($rowsPerPage,$rowCount,$maxNum,$url);
		$strPage = $page->show();
		//-----------分页结束--------
		//分配页码字符串
		$this->assign('strPage',$strPage);
		//输出视图
		$this->display('index.html');
	}
	/**
	 * 显示添加文章表单的动作
	 */
	public function addAction() {
		// 提取所有的分类信息
		$category = Factory::M('CategoryModel');
		$cateInfo = $category->getCategory();
		// 分配变量
		$this->assign('cateInfo', $cateInfo);
		// 输出视图文件
		$this->display('add.html');
	}
	/**
	 * 处理添加动作
	 */
	public function dealAddAction() {
		// 接收表单
		$art = array();
		$art['cate_id'] = $_POST['cate_id'];
		$art['title'] = $this->escapeData($_POST['title']);
		$art['author'] = $this->escapeData($_POST['author']);
		$art['art_desc'] = $this->escapeData($_POST['art_desc']);
		$art['content'] = addslashes($_POST['content']);
		// 判断数据的合法性
		if(empty($art['title']) || empty($art['author']) || empty($art['art_desc']) || empty($art['content'])) {
			$this->jump('index.php?p=Back&c=Article&a=add',':( 填写的信息不完整!');
		}
		//判断是否有缩略图上传，暂时省略
		if($_FILES['thumb']['error'] != 4){
			//说明没有文件上传
			$upload = new Upload;//实例化上传类
			$allow = array('image/png','image/jpeg','image/gif','image/jpg');
			$path = UPLOADS_DIR.'thumb/'.date('Ymd');
			if(!file_exists($path)){
				mkdir($path);
			}
			//调用上传类的核心方法
			$result = $upload->uploadAction($_FILES['thumb'],$allow,$path);
			if($result){
				//上传成功
				$art['thumb'] = $result;
			}else{
				//上传失败，输出错误信息并跳转
				$error = Upload::$error;
				$this->jump('index.php?p=Back&c=Article&a=add',$error);
			}
		}else{
			//说明没有缩略图上传
			$art['thumb'] = 'default.jpg';
		}
		//3，调用模型，数据入库
		$article = Factory::M('ArticleModel');
		//调用insertart方法
		$result = $article->insertArt($art);
		//4，跳转分类首页
		if($result){
			$this->jump('index.php?p=Back&c=Article&a=index');
		}else{
			$this->jump('index.php?p=Back&c=Article&a=add',':( 发生未知错误，发布文章失败！');
		}
	}

	/**
	 * 修改文章动作
	 */
	public function editAction(){
		//接收文章的ID号
		$art_id = $_GET['art_id'];
		// 提取当前文章的原有的内容
		$article = Factory::M('ArticleModel');
		$art = $article->getArticleById($art_id);
		// 分配变量
		$this->assign('art', $art);
		$category = Factory::M('CategoryModel');
		$cateInfo = $category->getCategory();
		$this->assign('cateInfo',$cateInfo);
		// 输出视图文件
		$this->display('edit.html');
		
	}
	/**
	 * 处理修改文章的动作
	 */
	public function dealEditAction(){
		$art = array();
		$art['cate_id'] = $_POST['cate_id'];
		$art['title'] = $this->escapeData($_POST['title']);
		$art['author'] = $this->escapeData($_POST['author']);
		$art['art_desc'] = $this->escapeData($_POST['art_desc']);
		$art['content'] = addslashes($_POST['content']);
		$art['art_id'] = $_POST['art_id'];
		// 判断数据的合法性
		if(empty($art['title']) || empty($art['author']) || empty($art['art_desc']) || empty($art['content'])) {
			$this->jump("index.php?p=Back&c=Article&a=edit&art_id={$art['art_id']}",':( 填写的信息不完整!');
		}
		//判断是否有缩略图上传，暂时省略
		if($_FILES['thumb']['error'] != 4){
			//说明没有文件上传
			$upload = new Upload;//实例化上传类
			$allow = array('image/png','image/jpeg','image/gif','image/jpg');
			$path = UPLOADS_DIR.'thumb/'.date('Ymd');
			if(!file_exists($path)){
				mkdir($path);
			}
			//调用上传类的核心方法
			$result = $upload->uploadAction($_FILES['thumb'],$allow,$path);
			if($result){
				//上传成功
				$art['thumb'] = $result;
			}else{
				//上传失败，输出错误信息并跳转
				$error = Upload::$error;
				$this->jump("index.php?p=Back&c=Article&a=edit&art_id={$art['art_id']}",$error);
			}
		}else{
			//说明没有缩略图上传
			$art['thumb'] = $_POST['thumb_bak'];
		}
		//3，调用模型，数据入库
		$article = Factory::M('ArticleModel');
		//调用insertart方法
		$result = $article->updateArtById($art);
		//4，跳转分类首页
		if($result){
			$this->jump('index.php?p=Back&c=Article&a=index');
		}else{
			$this->jump("index.php?p=Back&c=Article&a=edit&art_id={$art['art_id']}",':( 发生未知错误，发布失败！');
		}
	}
	/**
	 * 删除文章动作
	 */
	public function delAction(){
		//接收文章的ID号
		$art_id = $_GET['art_id'];
		// 提取当前文章的原有的内容
		$article = Factory::M('ArticleModel');
		$result = $article->delArticleById($art_id);
		if($result) {
			$this->jump('index.php?p=Back&c=Article&a=index');
		}else{
			$this->jump('index.php?p=Back&c=Article&a=index',':( 发生未知错误，删除失败！');
		}
	}
	/**
	 * 批量删除操作
	 */
	public function delAllAction(){
		if(!isset($_POST['art_id'])){
			$this->jump('index.php?p=Back&c=Article&a=index',':( 请先选择需要删除的文章！');
		}
		//接收需要删除的id号
		$art_id = implode(',', $_POST['art_id']);
		//调整模型
		$article = Factory::M('ArticleModel');
		$result = $article->delAllArticle($art_id);
		if($result){
			$this->jump('index.php?p=Back&c=Article&a=index');
		}else{
			$this->jump('index.php?p=Back&c=Article&a=index',':( 发生未知错误，删除失败！');
		}
	}
	/**
	 * 显示回收站动作
	 */
	public function recycleAction(){
		//调用模型，提取已经被逻辑删除的文章
		$article = Factory::M('ArticleModel');
		$artInfo = $article->getDeleArticle();
		$this->assign('artInfo',$artInfo);
		$this->display('recycle.html');
	}
	/**
	 * 根据id号还原文章
	 */
	public function recoverAction(){
		$art_id = $_GET['art_id'];
		// 提取当前文章的原有的内容
		$article = Factory::M('ArticleModel');
		$result = $article->recoverArtById($art_id);
		if($result) {
			$this->jump('index.php?p=Back&c=Article&a=recycle');
		}else{
			$this->jump('index.php?p=Back&c=Article&a=recycle',':( 发生未知错误，还原失败！');
		}
	}
	/**
	 * 根据id号彻底删除一篇文章
	 */
	public function realDelAction(){
		$art_id = $_GET['art_id'];
		// 调用模型
		$article = Factory::M('ArticleModel');
		$result = $article->realDelArticleById($art_id);
		if($result) {
			$this->jump('index.php?p=Back&c=Article&a=recycle');
		}else{
			$this->jump('index.php?p=Back&c=Article&a=recycle',':( 发生未知错误，还原失败！');
		}
	}
	/**
	 * 批量彻底删除文章
	 */
	public function realDelAllAction(){
		if(!isset($_POST['art_id'])){
			$this->jump('index.php?p=Back&c=Article&a=recycle',':( 请先选择需要删除的文章！');
		}
		//接收需要删除的id号
		$art_id = implode(',', $_POST['art_id']);
		//调整模型
		$article = Factory::M('ArticleModel');
		$result = $article->realDelAllArticle($art_id);
		if($result){
			$this->jump('index.php?p=Back&c=Article&a=recycle');
		}else{
			$this->jump('index.php?p=Back&c=Article&a=recycle',':( 发生未知错误，删除失败！');
		}
	}
	/**
	 * 是否推荐文章
	 */
	public function ifRecommendAction() {
		// 接收文章id号
		$art_id = $_GET['art_id'];
		// 接收当前的推荐状态
		$is_recommend = $_GET['is_recommend'];
		// 接收当前的页码
		$pageNum = $_GET['pageNum'];
		// 调用模型,切换推荐状态
		$article = Factory::M('ArticleModel');
		$result = $article->updateRecommendById($art_id,$is_recommend);
		if($result) {
			$this->jump("index.php?p=Back&c=Article&a=index&pageNum=$pageNum");
		}else {
			$this->jump("index.php?p=Back&c=Article&a=index&pageNum=$pageNum",':( 发生未知错误,操作失败!');
		}
	}
}
