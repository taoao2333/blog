<?php
/**
 * 前台会员管理控制器
 */

class UserController extends PlatformController{
	/**
	 * 会员注册动作
	 */
	public function registerAction(){
		//提取站长信息
		$master = Factory::M('MasterModel');
		$masterInfo = $master->getMasterInfo();
		$this->assign('masterInfo',$masterInfo);
		//提取最新文章信息
		$article = Factory::M('ArticleModel');
		$newArt = $article->getNewArt(8);
		//分配变量
		$this->assign('newArt',$newArt);
		//提取最热门的推荐文章信息
		$rmdArtByHits = $article->getRmdArtByHits(8);
		//分配变量
		$this->assign('rmdArtByHits',$rmdArtByHits);
		$this->display('register.html');
	}
}
