<?php
/**
 * 前台首页控制器
 */
class IndexController extends PlatformController{
	/**
	 * 显示前台首页
	 */
	public function IndexAction(){
		
		//调用Article模型
		$article = Factory::M('ArticleModel');
		//获取推荐文章信息
		$recommendArt = $article->getRecommendArt(5);
		//分配变量
		$this->assign('recommendArt',$recommendArt);
		//提取站长信息
		$master = Factory::M('MasterModel');
		$masterInfo = $master->getMasterInfo();
		$this->assign('masterInfo',$masterInfo);
		//提取最新文章信息
		$newArt = $article->getNewArt(8);
		$this->assign('newArt',$newArt);
		//提取最热门的推荐文章信息
		$rmdArtByHits = $article->getRmdArtByHits(8);
		$this->assign('rmdArtByHits',$rmdArtByHits);

		//显示输出视图文件
		$this->display('index.html');
	}
}