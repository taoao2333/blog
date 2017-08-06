<?php
/**
 * 站长管理控制器
 */
class MasterController extends PlatformController{
	/**
	 * 显示站长信息
	 */
	public function indexAction(){
		//调用模型
		$master = Factory::M('MasterModel');
		$masterInfo = $master->getMasterInfo();

		$this->assign('masterInfo',$masterInfo);

		$this->display('index.html');
	}
	/**
	 * 更新站长信息
	 */
	public function editAction(){
		//接收表单
		$masterInfo = array();
		$masterInfo['nickname'] = $this->escapeData($_POST['nickname']);
		$masterInfo['job'] = $this->escapeData($_POST['job']);
		$masterInfo['home'] = $this->escapeData($_POST['home']);
		$masterInfo['tel'] = $this->escapeData($_POST['tel']);
		$masterInfo['email'] = $this->escapeData($_POST['email']);
		//验证数据
		if(empty($masterInfo['nickname'])||empty($masterInfo['job'])||empty($masterInfo['home'])||empty($masterInfo['tel'])||empty($masterInfo['email'])){
			$this->jump('index.php?p=Back&c=Master&a=index',':( 信息填写不完整！');
		}
		//调用模型
		$master = Factory::M('MasterModel');
		$result = $master->updateMasterInfo($masterInfo);
		if($result) {
			$this->jump('index.php?p=Back&c=Master&a=index',':) 更新成功');
		}else{
			$this->jump('index.php?p=Back&c=Master&a=index',':( 发生未知错误，更新失败！');
		}
	}

}