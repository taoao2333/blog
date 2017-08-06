<?php

/**
 * 前台文章管理控制器
 */
class ArticleController extends PlatformController {
	/**
	 * 显示栏目首页动作
	 */
	public function indexAction(){
		//接收栏目编号，也就是一级分类的编号
		$cate_id = $_GET['cate_id'];
		//获取该栏目下所有的文章的信息
		$article = Factory::M('ArticleModel');
		$artInfo = $article->getArtInfo($cate_id);
		//分配变量
		$this->assign('artInfo',$artInfo);
		//获取页码字符串
		//先实例化分页类
		$rowPerPage = 9;
		$maxNum = $GLOBALS['conf']['Page']['maxNum'];
		$url="index.php?p=Home&c=Article&a=index&cate_id=$cate_id";
		$rowCount = $article->getRowCount($cate_id);
		$page = new Page($rowPerPage,$rowCount,$maxNum,$url);
		$strPage = $page->show();
		//分配变量
		$this->assign('strPage',$strPage);
		//调用公共动作
		$this->PublicAction($cate_id);	
		//输出视图
		$this->display('index.html');
	}
	/**
	 * 公共动作
	 */
	protected function PublicAction($cate_id) {
		//获取右侧子类别信息
		$category = Factory::M('CategoryModel');
		$subCate = $category->getSubCateById($cate_id);
		$this->assign('subCate',$subCate);
		//获取面包屑导航所有的父分类列表
		$list = $category->getAllParentCateName($cate_id);
		$this->assign('list',$list);
		$article = Factory::M('ArticleModel');
		//获取点击排行文章
		$sortByHits = $article->getSortByHits($cate_id,9);
		//分配变量
		$this->assign('sortByHits',$sortByHits);
		//获取当前分类推荐文章
		$sortByRecommend = $article->getSortByRecommend($cate_id,9);
		//分配变量
		$this->assign('sortByRecommend',$sortByRecommend);

	} 
	/**
	 * 显示文章内容页动作
	 */
	public function showAction(){
		//接收文章的id号
		$art_id = $_GET['art_id'];
		//调用模式
		$article = Factory::M("ArticleModel");
		//根据id号查询文章的信息
		$row=$article->getArtInfoById($art_id);
		$this->assign('row',$row);
		//更新浏览次数
		$article->updateHitsById($art_id);
		//获取当前的文章的分类的id号
		$cate_id=$row['cate_id'];
		$this->PublicAction($cate_id);
		//获取文章的上一篇和下一篇的信息
		$prev = $article->getPrevArt($art_id);
		$next = $article->getNextArt($art_id);
		//分配变量
		$this->assign('prev',$prev);
		$this->assign('next',$next);
		//输出视图
		$this->display('show.html');
	}
}