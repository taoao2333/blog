<?php
/**
 * 后台首页管理控制器
 */
class ManageController extends PlatformController{
	/**
	 * 后台动作首页
	 */
	public function indexAction(){
		//echo '这里是管理后台首页';
		$this->display('index.html');
	}
}